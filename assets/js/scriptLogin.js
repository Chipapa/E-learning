var loginApp = angular.module("loginApp", []);
loginApp.controller(('loginNgController'), function ($scope, $http) {
    //alert("hello");
    
    $scope.loginAccount = function (username, password) {
        //alert();
        var loginData = {Username: username, Password: password};
        console.log(loginData);
        $http.post('pages/user_login_process', loginData).then(function (response) {
            console.log(response.data);
            //$location.path('/questions/index');

            location.href ='questions/index';
            //console.log(response.data);
        });
    }
});
