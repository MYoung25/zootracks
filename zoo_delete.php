<?php
$title_id = $_GET['title_id'];
if(empty($title_id)){
    header("Location: zoo_search.php");
}

require 'zoo_connect.php';
include 'navigation.php';

$sql_select = "SELECT title
               FROM titles
               WHERE title_id = $title_id";

$sql_delete_tag = "DELETE FROM title_tag
               WHERE title_id = $title_id;";

$sql_delete_title = "DELETE FROM titles
                     WHERE title_id = $title_id;";

$results_select = $mysqli->query($sql_select);
if(!$results_select){
    exit("Select SQL Error: " . $mysqli->error);
}

$row = $results_select->fetch_array(MYSQLI_ASSOC);
$title = $row['title'];

$results_delete_tag = $mysqli->query($sql_delete_tag);
$results_delete_title = $mysqli->query($sql_delete_title);

if(!$results_delete_tag && !$results_delete_title){
    exit("SQL Error: " . $mysqli->error);
} else {
    echo "DVD Title '$title' was successfully deleted. <a href='dvd_search.php'>Go back to Search</a>";
}

?>



<div id="delete_container">

    <?php
    echo "<br>$title was successfully DELETED<br><br>";
    ?>

</div>
