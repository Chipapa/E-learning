<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>

    </head>
    <body>
        
        <?php
            echo "<div>";
                if (isset($error_message)) {
                    echo $error_message;
                }
                echo validation_errors();
            echo "</div>";
        ?>
        
        <?php echo form_open('pages/user_login_process'); ?>

        <p>Username <input type="email", name="username", placeholder= "Your email"><p>

        <p>Password <input type="password", name="password"></p>

        <p>Stay Logged in? <input type="checkbox", name="stayLoggedIn", value="1"> *THIS FEATURE IS NOT YET WORKING*</p>

        <p><input type="submit", name = "submit", value="Log in"></p>

    </form>

    <p>No Account? Sign up <a href="<?php echo site_url('accounts/signup'); ?>">here</a></p>

</body>
</html>