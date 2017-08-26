
<?php
//if (isset($this->session->userdata['logged_in'])) {
//    $username = ($this->session->userdata['logged_in']['username']);
//    $usertype = ($this->session->userdata['logged_in']['usertype']);
//} else {
//    header("location: loginpage");
//}

?>
<div class="container" id="mainDiv">
    <?php echo  date('Y-m-d H:i:s'); ?>
    <b><a href="<?php echo site_url('pages/logout'); ?>">Logout</a></b>
</div>
