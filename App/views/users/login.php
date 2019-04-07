<?php

# Creating the new user object
$user = new Users;

?>

<h2>Log In:</h2>

<div class="col-md-6">
<form action="<?php $user->loginUser(); ?>" method="POST">
    <input class="form-control" type="text" name="email" placeholder="Enter the E-mail"><br>
    <input class="form-control" type="password" name="password" placeholder="Enter the Password"><br>
    <button class="btn btn-primary btn-block" type="submit" name="login-button">Submit</button>
</form>
</div>
























