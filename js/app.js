var app = angular.module('app', ['ui.grid']);

app.controller('MainCtrl',  ['$scope', '$http', '$timeout', '$interval', function ($scope, $http, $timeout, $interval) {


    $scope.tabs = {selectedTab:-1};
    $scope.gridOptions = {};
    $scope.gridOptions.data = 'myData';

    $scope.userHistory = null;
    $scope.availableamount = 0;


    $scope.gridOptions.columnDefs = [

        { name:'orderDate', displayName :'Order Date', type: 'date', field: 'date', cellFilter: 'date:"yyyy-MM-dd"'},
        { name:'storeName', displayName :'Store'},
        { name:'cashback', displayName :'Cashback'},
        { name:'status', displayName :'Status'}
    ];

  //   $scope.gridOptions.enableCellEditOnFocus = true;
  //  $scope.myData = [{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"186.48","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"217.68","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"292.475","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"1368","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"197.99","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"79.92","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"74.52","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"29.94","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"10","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"5","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"9.999","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"271.88","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":null,"status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"64.7","status":"processed","userReferenceCode":null}];
    $scope.initTabValue = function(){
    	 //alert($scope.paymentdetails.ispaytmactive);
  //  	$scope.paymentdetails.ispaytmactive = '0';
	
	 var tabIndex = 1;
    var url = window.location.href;
		if(url.indexOf("#")!=-1){
		url = url.replace('#', '');
		}

        if(url.indexOf("?")!=-1){
            var splitUrl = url.split("?");
            if(splitUrl.length=2){
                var secondUrl = splitUrl[1];
                if(secondUrl==""){
                    $scope.tabs.selectedTab = tabIndex;
                }else{
                    $scope.initvalue=secondUrl;
                    $scope.tabs.selectedTab = secondUrl;
                    tabIndex = secondUrl;
                }
            }
        }
        $scope.tabChanged(tabIndex);
    }

    $scope.tabChanged = function(tabIndex){
        $scope.tabs.selectedTab = tabIndex;
    if(tabIndex==2){
        $http({
            method : "GET",
            url : "userdashboardimpl.php"
        }).then(function (response) {
          //  alert(JSON.stringify(response.data));
            var jsonData = JSON.stringify(response.data);
            $scope.myData = response.data;
        });
    }
        if(tabIndex==3){
        $http({
                method : "get",
                url : "bankdetails.php",
                data        : $scope.paymentdetails,
                dataType    : 'json'
            }).then(function (response) {
                var jsonData = JSON.stringify(response.data);
                if(response.data==''){
                	$scope.paymentdetails = {};
                    $scope.paymentdetails.ispaytmactive =0;
                }else{
                	 $scope.paymentdetails = response.data;
                }
                
            });

        }

        if(tabIndex==4){
            $scope.withdrawAmount = '';
            $scope.today = new Date();
            //alert(window.location.href);
            $scope.userTransactionHistoryGridOptions = {};
            $scope.userTransactionHistoryGridOptions.data = 'userHistory';


            /* $scope.userTransactionHistoryGridOptions.columnDefs = [
                { name:'paymentRequestedAmount', displayName :'Payment Request Amount'},
                { name:'paymentReqStatus', displayName :'Status'},
                { name:'paymentReqDate', displayName :'Payment Request Date'}
            ]; */
            $scope.getUserAmountDetails();
           $scope.getUserTransactionHistory();
        }

    };


    $scope.getUserAmountDetails =  function() {
        $http({
            method : "POST",
            url : "bankdetails.php",
            data        : { getUserAmountDetails : true },
            dataType    : 'json'
        }).then(function (response) {
            //  var jsonData = JSON.stringify(response.data);
            //$scope.myData = response.data;
            // console.log(response);
            if(response.data){
                if(response.data.banknumber){
                    $scope.banknumber=response.data.banknumber;
                }
                if(response.data.accountname){
                    $scope.accountname = response.data.accountname;
                }
                if(response.data.availableamount){
                    $scope.availableamount = response.data.availableamount;
                }
                if(response.data.ispaytmactive){
                    $scope.ispaytmactive = response.data.ispaytmactive;
                }
                if(response.data.paytmnumber){
                    $scope.paytmnumber = response.data.paytmnumber;
                }
            }
            if(!$scope.banknumber){
                $('.withdrawinfo').removeClass('alert alert-info');
                $('.withdrawinfo').removeClass('alert alert-info').html("");
                if($scope.availableamount > 0){
                    $('.withdrawinfo').addClass('alert alert-danger').html("Please Update Bank Details !!!");
                }
            }
          //  $('.withdrawinfo').addClass('alert alert-info').html(response.data);
         //   $scope.getUserTransactionHistory();
        });
    }

  $scope.saveWithdrawRequest =  function() {
        $http({
            method : "POST",
            url : "withdrawRequest.php",
            data        : { withdrawAmount : $scope.withdrawAmount },
            dataType    : 'json'
        }).then(function (response) {
            //  var jsonData = JSON.stringify(response.data);
            //$scope.myData = response.data;
            console.log(response);
            $('.withdrawinfo').removeClass('alert alert-danger');
            $('.withdrawinfo').removeClass('alert alert-danger').html("");
           $('.withdrawinfo').addClass('alert alert-info').html(response.data);
           $scope.getUserTransactionHistory();
        });
    }
    $scope.getUserTransactionHistory =  function() {
        $http({
            method : "POST",
            url : "withdrawRequest.php",
            data        : { isUsrTransactionHistory : true },
            dataType    : 'json'
        }).then(function (response) {
            //  var jsonData = JSON.stringify(response.data);
            //$scope.myData = response.data;
            //console.log(response)
            $scope.userHistory = response.data;
        });
    }



    function bindPaymentDetails() {
        $scope.paymentdetails = {
            accountname: $scope.paymentdetails.accountname,
            bankname: $scope.paymentdetails.bankname,
            banknumber: $scope.paymentdetails.banknumber,
            ifsccode: $scope.paymentdetails.ifsccode,
            paytmnumber: $scope.paymentdetails.paytmnumber,
            ispaytmactive: $scope.paymentdetails.ispaytmactive,
            paytmnumber: $scope.paymentdetails.paytmnumber
        };
    }

    $scope.savePaymentDetails = function(){
        bindPaymentDetails();
        $http({
            method : "POST",
            url : "bankdetails.php",
            data        : $scope.paymentdetails,
            dataType    : 'json'
        }).then(function (response) {
          //  var jsonData = JSON.stringify(response.data);
            //$scope.myData = response.data;
            $('.bankdetailsinfo').addClass('alert alert-success').html('Payment Details Got Updated Successfully!!!');
        });

      bindPaymentDetails();
    }

}]);
