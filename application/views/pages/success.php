

<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $usertype = ($this->session->userdata['logged_in']['usertype']);
} else {
    header("location: loginpage");
}
?>
<div class="container" id="mainDiv">
    <?php
    echo "Hello <b id='welcome'><i>" . $username . "</i> !</b>";
    echo "<br/>";
    echo "<br/>";
    echo "Welcome to Admin Page";
    echo "<br/>";
    echo "<br/>";
    echo "Your Username is " . $username;
    echo "<br/>";
    echo "And you are a " . $usertype;
    echo "<br/>";
    ?>
    <b><a href="<?php echo site_url('pages/logout'); ?>">Logout</a></b>
</div>

<!--<div class="container">
    TANG INA MO GAGO
</div>-->