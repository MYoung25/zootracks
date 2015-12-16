<?php
session_start();
echo "<link rel='stylesheet' type='text/css' href='styles.css'>";

?>

<div id="identity">
    <?php
    if($_SESSION['logged_in'] == true){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $user_id = $_SESSION['user_id'];
        echo "Welcome, " . $_SESSION['username'] . ".";
        if ($_SESSION['admin'] == true){
            echo " You have Admin Privileges.";
        }
//        echo " <a href='zoo_logout.php'>logout</a>";
    } else {
        echo "<a href='zoo_login_form.php'>Sign In</a> OR <a href='zoo_signup.php'>Sign Up</a> to favorite clips";
    }
?>
</div>

<!--<div id="navigation">-->
<!--    <a href="zoo_search.php">-->
<!--        <div style="width: 49%; height: auto;float: left; border-right: double;">-->
<!--            Search-->
<!--        </div>-->
<!--    </a>-->
<!---->
<!--    <a href="zoo_profile.php">-->
<!--        <div style="width: 49%; height: auto; float: left;">Favorites </div>-->
<!--    </a>-->
<!--</div>-->
<!--<br><br>-->

<div class="header_container">
<div class="site-header-inner">
</div>
<ul id="main-menu">
    <li><a href="zoo_search.php">Search</a>
    </li>
    <li>
        <a href="zoo_profile.php">Favorites
        </a>
    </li>

    <?php
    if ($_SESSION['admin'] == true){
    echo "<li>
            <a href='zoo_add_form.php'>Add Podcast</a>
         </li>";}
    ?>


<?php
    if($_SESSION['logged_in'] == false) {
        echo "<li ><a href = 'zoo_login_form.php'> Sign In </a ></li >
    <li ><a href = 'zoo_signup.php'> Sign Up </a ></li >";
    } else {
        echo "<li><a href='zoo_logout.php'>Sign Out</a></li> ";
    }
?>
    <li>
        Testing Git
    </li>
</ul>
    </div>