<?php echo validation_errors(); ?>

<?php echo form_open('accounts/signup'); ?>

    <p>Email <input type="email", name="username", placeholder= "Your email"><p>
    <p>Password <input type="password", name="password"></p>
    <p>Re-type Password <input type="password", name="rePassword"></p>
    <p><input type="submit", name = "submit", value="Sign Up"></p>

</form>