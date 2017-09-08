<!DOCTYPE html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $fname = ($this->session->userdata['logged_in']['fname']);
    $lname = ($this->session->userdata['logged_in']['lname']);
    $id = ($this->session->userdata['logged_in']['id']);
    $slug_fullname = $fname . "." . $lname;

} else {
    header("location: loginpage");
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--        <title>Login</title>-->

        <?php include "DesignScript.php"; ?>         

    </head>
    <body>
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top">
            <a class="navbar-brand" href="<?php echo site_url('questions/index'); ?>">CQV E-Learning</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon border border-primary"></span>
            </button>
            <!--            <a class="navbar-brand" href="#">CQV E-Learning</a>-->

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link"  href="<?php //echo site_url('pages/view/success');      ?>">Questions </a>
                    </li>
                    <li class="nav-item" id="stockmarket">
                        <a class="nav-link"  href="<?php echo site_url('stockmarket/index'); ?>">Stock Market    <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="<?php //echo site_url('pages/view/success');      ?>">Leaderboards </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="<?php //echo site_url('pages/view/success');      ?>">Rewards  <?php //echo base_url();      ?></a>
                    </li>
                </ul>
                <div id="iconHeaderMargin">
                    <a href="<?php echo site_url('profile/viewprofile/'.$slug_fullname); ?>" data-toggle="tooltip" data-placement="bottom" title="Profile">
                        <img src="<?php echo base_url(); ?>/assets/png/person-3x.png">
                    </a>
                </div>

                <div id="iconHeaderMargin">
                    <a href="<?php echo site_url('pages/view/success'); ?>" data-toggle="tooltip" data-placement="bottom" title="Rewards">
                        <img src="<?php echo base_url(); ?>/assets/png/badge-3x.png">
                    </a>
                </div>
                
                <div id="iconHeaderMargin">
                    <a href="<?php echo site_url('pages/logout'); ?>" data-toggle="tooltip" data-placement="bottom" title="Logout">
                        <img src="<?php echo base_url(); ?>/assets/png/account-logout-3x.png">
                    </a>
                </div>
                <!--                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>-->
            </div>
        </nav>

        <!--        HIGHLIGHTS CURRENT ACTIVE PAGE IN NAVBAR (BUGGY AF)-->
        <script>
            $(".nav a").on("click", function () {
                $(".nav").find(".active").removeClass("active");
                $(this).parent().addClass("active");
            });
        </script>

