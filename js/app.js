var app = angular.module('app', ['ui.grid']);

app.controller('MainCtrl',  ['$scope', '$http', '$timeout', '$interval', function ($scope, $http, $timeout, $interval) {


    $scope.tabs = {selectedTab:-1};
    $scope.gridOptions = {};
    $scope.gridOptions.data = 'myData';
    $scope.paymentReqMode = 'true';
    $scope.myData = null;
    
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
	
	 var tabValue = 'Dashboard';
    var url = window.location.href;
    var view =  $scope.getParameterByName('view');
    $scope.tabChanged(view);
    }
    $scope.tabChanged = function(tabIndex){
        $scope.tabs.selectedTab = tabIndex;
        if(tabIndex=='Dashboard'){
        	$scope.selectedtabname='Dashboard';
        }
    if(tabIndex=='My Wallet'){
    	$scope.selectedtabname='My Wallet';
        $http({
            method : "GET",
            url : "userdashboardimpl.php"
        }).then(function (response) {
          //  alert(JSON.stringify(response.data));
            var jsonData = JSON.stringify(response.data);
            if(response.data!=null && response.data!=''){
            	
            	 $scope.myData = response.data.usrReportArray;
            	 
            	 if(response.data.utds!=null && response.data.utds!=''){
            		 
            		 if(response.data.utds.availableamount==null){
            			 $scope.availableamount = 0;
            		 }else{
            			 $scope.availableamount = response.data.utds.availableamount;
            		 }
            		 
            		 if(response.data.utds.pendingBal==null){
            			 $scope.pendingBal = 0;
            		 }else{
            			 $scope.pendingBal = response.data.utds.pendingBal;
            		 }
            		 
            		 if(response.data.utds.redemptionMade==null){
            			 $scope.redemptionMade = 0;
            		 }else{
            			 $scope.redemptionMade = response.data.utds.redemptionMade;
            		 }
            		 
            		 if(response.data.utds.paymentRequestedAmount==null){
            			 $scope.paymentRequestedAmount = 0;
            		 }else{
            			 $scope.paymentRequestedAmount = response.data.utds.paymentRequestedAmount;
            		 }
            		 
            		 
            	 }
            }
           // $scope.myData = response.data;
        });
    }
        if(tabIndex=='Bank Details'){
        	$scope.selectedtabname='Bank Details';
        $http({
                method : "get",
                url : "bankdetails.php",
                data        : $scope.paymentdetails,
                dataType    : 'json'
            }).then(function (response) {
                var jsonData = JSON.stringify(response.data);
                if(response.data=='' || response.data.ispaytmactive == null){
                	$scope.paymentdetails = {};
                    $scope.paymentdetails.ispaytmactive =0;
                }else {
                	 $scope.paymentdetails = response.data;
                }
                
            });

        }

        if(tabIndex=='Withdraw'){
				
        	$scope.selectedtabname='Withdraw';
            $scope.withdrawAmount = '';
            $scope.today = new Date();
            //alert(window.location.href);
            $scope.userTransactionHistoryGridOptions = {};
            $scope.userTransactionHistoryGridOptions.data = 'userHistory';

			$('.withdrawinfo').removeClass('alert alert-info').html("");
            $('.withdrawinfo').removeClass('alert alert-info');
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
            if(!$scope.banknumber &&  !$scope.paytmnumber){
				$('.withdrawinfo').removeClass('alert alert-info').html("");
                $('.withdrawinfo').removeClass('alert alert-info');
                if($scope.availableamount > 0){
                    $('.withdrawinfo').addClass('alert alert-danger').html("Please Update Bank Details !!!");
                }
            }
          //  $('.withdrawinfo').addClass('alert alert-info').html(response.data);
         //   $scope.getUserTransactionHistory();
        });
    }
	
	 $scope.saveWithdrawRequestError =  function(msg) {
				$('.withdrawinfo').removeClass('alert alert-danger').html("");
				$('.withdrawinfo').removeClass('alert alert-danger');
			//	$('.withdrawinfo').addClass('alert alert-danger').html("Your earlier payment request is pending, cannot  request one more !!!");
				$('.withdrawinfo').addClass('alert alert-danger').html(msg);
	 }

  $scope.saveWithdrawRequest =  function() {
  
			if($scope.paymentReqMode=='false'){
			    $scope.saveWithdrawRequestError("Your earlier payment request is pending, cannot  request one more !!!");
				return;
			}
			
			
			if(!($scope.banknumber || $scope.paytmnumber)){
				$scope.saveWithdrawRequestError("Please update payment details before withdraw request !!!");
				return;
			}
  
        $http({
            method : "POST",
            url : "withdrawRequest.php",
            data        : { withdrawAmount : $scope.withdrawAmount },
            dataType    : 'json'
        }).then(function (response) {
            //  var jsonData = JSON.stringify(response.data);
            //$scope.myData = response.data;
            console.log(response);
			if(response.data && !angular.isUndefined(response.data.error)){
				var msg =	response.data.error[0];
				 $scope.saveWithdrawRequestError(msg);
			}
			$('.withdrawinfo').removeClass('alert alert-danger').html("");
            $('.withdrawinfo').removeClass('alert alert-danger');
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
			if(response.data && !angular.isUndefined(response.data)){
				$scope.userHistory = response.data;
				angular.forEach($scope.userHistory,function(value,index){
					if(response.data[index].paymentReqStatus == 'pending'){
						$scope.paymentReqMode = 'false';
						return;
					}
				});
			}
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
        	$scope.responsedata(response);
          //  var jsonData = JSON.stringify(response.data);
            //$scope.myData = response.data;
        	$scope.responsedata(response);
            $('.bankdetailsinfo').addClass('alert alert-success').html('Payment Details Got Updated Successfully!!!');
        });

      bindPaymentDetails();
    }
    
    $scope.responsedata = function(response){
    	if(response !=null && response.data!=null){
    		var response = response.data;
    		if(response.indexOf("Please try later") != -1){
    			
    		}
    	}
    }
    
    $scope.getParameterByName = function (name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    
}]);
