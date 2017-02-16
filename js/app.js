var app = angular.module('app', ['ui.grid']);

app.controller('MainCtrl',  ['$scope', '$http', '$timeout', '$interval', function ($scope, $http, $timeout, $interval) {

    $scope.tabs = {selectedTab:-1};
    $scope.gridOptions = {};
    $scope.gridOptions.data = 'myData';


    $scope.gridOptions.columnDefs = [

        { name:'Orderdate' ,displayName :'Order Date'},
        { name:'Store'},
        { name:'Cashback'},
        { name:'Status'}
    ];

 //   $scope.gridOptions.enableCellEditOnFocus = true;
    $scope.myData = [
        {'Orderdate': "Abcd", 'Store':'Flipkart','Cashback':50,'Status':'Pending'},
        {'Orderdate': "Xyz", 'Store': 'Amazon','Cashback':502,'Status':'Approved'}
    ];

    $scope.tabChanged = function(tabIndex){
        $scope.tabs.selectedTab = tabIndex;
    };

}]);
