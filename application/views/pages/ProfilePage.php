<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Profile Page</title>

    </head>
    <body>
        <?php
        if (isset($this->session->userdata['logged_in'])) {
            $username = ($this->session->userdata['logged_in']['username']);
            $usertype = ($this->session->userdata['logged_in']['usertype']);
        } else {
            header("location: loginpage");
        }
        ?>
        <div class="container" id="mainDiv">
            <b><a href="<?php echo site_url('pages/logout'); ?>">Logout</a></b>
        </div>

    </form>
</body>
</html>