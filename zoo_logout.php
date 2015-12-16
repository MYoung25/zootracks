<?php
session_start();
$username = $_SESSION['username'];

session_destroy();

include "navigation.php";
?>

<div id="logout_container">
    <?php echo "$username was logged out.";
    ?>
</div>