<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

    <?php
    if (isset($this->session->userdata['logged_in'])) {

        header("location: index.php/success");
    }
    ?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>

        <?php include "DesignScript.php"; ?>

    </head>
    <body>

        <div class="container" id="mainDiv">
            <?php
            echo "<div>";
            if (isset($error_message)) {
                echo "<div class='alert alert-danger' role='alert'>";
                echo $error_message;
                echo "</div>";
            }

            if (isset($message_display)) {
                echo "<div class='alert alert-success' role='alert'>";
                echo $message_display;
                echo "</div>";
            }
            if (validation_errors()) {
                echo "<div class='alert alert-danger' role='alert'>";
                echo validation_errors();
                echo "</div>";
            }
            echo "</div>"
            ?>

            <?php echo form_open('pages/user_login_process'); ?>
            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="email" name="username" placeholder= "Your email" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input name="password" class="form-control" id="inputPassword" placeholder="Password" type="password">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    Stay Logged in? <input type="checkbox", name="stayLoggedIn", value="1">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name = "submit">Sign in</button>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    No Account? Sign up <a href="<?php echo site_url('accounts/signup'); ?>">here</a>
                </div>
            </div>
        </form>

    </div>
</body>
</html>