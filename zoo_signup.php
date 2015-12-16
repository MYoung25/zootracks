<?php
require_once "zoo_connect.php";
include "navigation.php";

session_start();



$username = $mysqli->real_escape_string($_POST['username']);

$password = $mysqli->real_escape_string($_POST['password']);
$password = hash('SHA512', $password);

$signup_date = date('Y-m-d', time());

// echo "$username, $password, $email, $signup_date<hr>";

if ( !empty($username) && !empty($password) ) {
    $sql_user = "SELECT *
                FROM users
                WHERE username = '$username'";

    $results_user = $mysqli->query($sql_user);
    if (!$results_user) {
        exit($mysqli->error);
    }

    if ($results_user->num_rows > 0) {
        exit("<strong>$username</strong> is already taken.");
    }

    $sql = "INSERT INTO users (username, password, signup_date)
            VALUES ('$username', '$password', '$signup_date')";

    $results = $mysqli->query($sql);

    if (!results) {
        exit ($mysqli->error);
    } else {
        exit("<div id='sign_success_container'>
  <br>Congratulations, <strong>$username</strong>.
  <br> you can now favorite audio clips!
  <a href='zoo_profile.php'></a>
  <br/>
  <br>
 <a href='zoo_login_form.php'>Login</a> NOW to favorite clips
 <br>
 OR
 <br>
  <a href='zoo_search.php'>SEARCH</a> 90-Second Naturalist clips.
  <br>
  <br>
</div>

");
    }
}
?>


<div id="sign">
<h2>Sign Up</h2>

<form method="post" action="zoo_signup.php">
    <input type="text" name="username" placeholder="Username"/>
    <br/>
    <input type="password" name="password" placeholder="Password"/>
    <br/>
    <input type="submit" value="Sign Up"/>
    <br><br>
</form>
</div>
