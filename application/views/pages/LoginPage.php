<?php
if (isset($this->session->userdata['logged_in'])) {
//            header("location: index.php/success");
    redirect('questions/index');
}
?>

<div class="container" id="mainDivLogin" ng-controller="loginController">
    <div>
        <div class='alert alert-danger' role='alert' ng-show='errorMessage'>
            Validation errors here
        </div>
    </div>

    <form role="form" ng-submit="login(username, password)">
        <div  class="form-group row">

            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="email" name='username' placeholder= "Your email" class="form-control" ng-model="username">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input name='password' class="form-control" id="inputPassword" placeholder="Password" type="password" ng-model="password">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                Stay Logged in? <input type="checkbox" name="stayLoggedIn" value="1">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name = "submit" >Sign in</button>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                No Account? Sign up <a href="">here</a>
            </div>
        </div>
    </form>
</div>

<!--</body>
</html>-->

