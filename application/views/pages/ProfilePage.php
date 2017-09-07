
<?php
//if (isset($this->session->userdata['logged_in'])) {
//    $username = ($this->session->userdata['logged_in']['username']);
//    $usertype = ($this->session->userdata['logged_in']['usertype']);
//} else {
//    header("location: loginpage");
//}

?>
<div class="container" id="mainDiv">
    <div class="row">
        <div class="col-sm-4">
            <img src="<?php echo base_url(); ?>/assets/png/avatar.png">
            <p align="" Avatong </p>
        </div>
        <div class="col-sm-8">
            
        </div>
    <?php echo  date('Y-m-d H:i:s'); ?>
    <b><a href="<?php echo site_url('pages/logout'); ?>">Logout</a></b>
    </div>
</div>

