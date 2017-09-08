

<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $usertype = ($this->session->userdata['logged_in']['usertype']);

    $fname = ($this->session->userdata['logged_in']['fname']);
    $lname = ($this->session->userdata['logged_in']['lname']);
    $ask_points = ($this->session->userdata['logged_in']['ask_points']);
    $answer_points = ($this->session->userdata['logged_in']['answer_points']);
    $total_points = $ask_points + $answer_points;
} else {
    header("location: loginpage");
}
?>
<div class="container" id="mainDiv">
    <h1>TEST PAGE</h1>
    <?php
    echo "Hello <b id='welcome'><i>" . $fname . " " . $lname . "</i> !</b>";
    echo "<br/>";
    echo "<br/>";
    echo "Welcome to Admin Page";
    echo "<br/>";
    echo "<br/>";
    echo "Your Username is " . $username;
    echo "<br/>";
    echo "And you are a " . $usertype;
    echo "<br/>";
    echo "Points from asking: " . $ask_points;
    echo "<br/>";
    echo "Points from answering: " . $answer_points;
    echo "<br/>";
    echo "Total points: " . $total_points;
    echo "<br/>";
    
    echo "<pre>";
    print_r($this->session->all_userdata());   
    echo "</pre>";
    
    ?>
    <b><a href="<?php echo site_url('pages/logout'); ?>">Logout</a></b>
</div>