<?php
require_once "zoo_connect.php";
include_once "navigation.php";

$username = $mysqli->real_escape_string($_POST['username']);

$password = $mysqli->real_escape_string($_POST['password']);

?>

<div id="sign">
<h2>Sign In</h2>
<form method="post" action="zoo_profile.php">
    <input type="text" name="username" placeholder="Username"/>
    <br/>
    <input type="password" name="pass" placeholder="Password"/>
    <br/>
    <input type="submit" value="Sign In"/>
</form>
    <h4>Not a member?</h4>
    Sign Up <a href="zoo_signup.php">HERE!</a><br><br>
</div>