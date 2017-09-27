var app = angular.module("loginApp", []);

app.controller("loginController", function ($scope, $http, $rootScope)
{
    $scope.login = function (username, password)
    {
        var loginData = {Username: username, Password: password};
        //console.log(loginData);
        $http.post('pages/user_login_process', loginData).then(function (response) {
            //alert(response.data);
            if(response.data == "success")
            {
                window.location.href = "questions/index";
            }
            else if (response.data == "validation_error")
            {
                errorMessage = false;
            }
        });
    }
});