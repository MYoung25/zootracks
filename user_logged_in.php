<?php
require_once "zoo_connect.php";

session_start();

if($_SESSION['logged_in'] == true){
    echo "You are logged in as " . $_SESSION['username'] . " <a href='zoo_logout.php'>LOGOUT</a>";
} else {
    echo "<a href='zoo_login_form.php'>Sign In</a> OR <a href='zoo_signup.php'>Sign Up</a> to favorite clips";
}
?>