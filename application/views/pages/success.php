
<?php
//if (isset($this->session->userdata['logged_in'])) {
//     $username = ($this->session->userdata['logged_in']['username']);
//       $usertype = ($this->session->userdata['logged_in']['usertype']);         
//     $fname = ($this->session->userdata['logged_in']['fname']);
//        $lname = ($this->session->userdata['logged_in']['lname']);
//        $ask_points = ($this->session->userdata['logged_in']['ask_points']);
//          $answer_points = ($this->session->userdata['logged_in']['answer_points']);
//        $total_points = $ask_points."".$answer_points;
//        $full_name = $fname."".$lname;
//   
// //echo site_url('profile/profilepage/'.$full_name);
//   
//} else {
//    header("location: loginpage");
//}
?>
<div class="container" id="mainDiv">

    <form class="container" id="needs-validation" novalidate>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">First name</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom02">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">City</label>
                <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom04">State</label>
                <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                <div class="invalid-feedback">
                    Please provide a valid state.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom05">Zip</label>
                <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                <div class="invalid-feedback">
                    Please provide a valid zip.
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>

    
    <?php
    echo "<pre>";
    print_r($this->session->all_userdata());
    echo "</pre>";
    ?>
    <b><a href="<?php echo site_url('pages/logout'); ?>">Logout</a></b>
</div>