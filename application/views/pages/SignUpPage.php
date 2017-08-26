<?php
if (isset($this->session->userdata['logged_in'])) {

    header("location: success");
}
?>

<div class="container" id="mainDivSignup">
    <?php
    if (validation_errors()) {
        echo "<div class='alert alert-danger' role='alert'>";
        echo validation_errors();
        echo "</div>";
    }
    ?>

    <?php echo form_open('accounts/signup'); ?>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" name="username" placeholder= "Your email" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="rePassword" class="col-sm-2 col-form-label">Re-type Password</label>
        <div class="col-sm-10">
            <input type="password" name="rePassword" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" name = "submit">Sign up</button>
        </div>
    </div>

</form>        
</div>
