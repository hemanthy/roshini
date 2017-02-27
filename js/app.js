var app = angular.module('app', ['ui.grid']);

app.controller('MainCtrl',  ['$scope', '$http', '$timeout', '$interval', function ($scope, $http, $timeout, $interval) {

    $scope.tabs = {selectedTab:-1};
    $scope.gridOptions = {};
    $scope.gridOptions.data = 'myData';


    $scope.gridOptions.columnDefs = [

        { name:'orderDate', displayName :'Order Date', type: 'date', field: 'date', cellFilter: 'date:"yyyy-MM-dd"'},
        { name:'storeName', displayName :'Store'},
        { name:'cashback', displayName :'Cashback'},
        { name:'status', displayName :'Status'}
    ];

    $scope.changePassword = function () {
        
    }

 //   $scope.gridOptions.enableCellEditOnFocus = true;
  //  $scope.myData = [{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"186.48","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"217.68","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"292.475","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"1368","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"197.99","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"79.92","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"74.52","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"29.94","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"10","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"5","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"9.999","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"271.88","status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":null,"status":"processed","userReferenceCode":null},{"orderDate":"2017-02-24 21:51:25","storeName":"hi","cashback":"64.7","status":"processed","userReferenceCode":null}];

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

    };

}]);
