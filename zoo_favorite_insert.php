<?php
//$title_id = $_GET("title_id");
//$user_id = $_GET("user_id");

$title_id = $_POST['title_id'];
$user_id = $_POST['user_id'];
$checked = $_POST['checked'];

require "zoo_connect.php";

if ($checked == 'true') {  //probably should check to make sure it isn't already a favorite before inserting it
  $sql = "INSERT INTO favorites (user_id, title_id)
        VALUES ('$user_id', '$title_id')";
} else {  //probably should check to make sure it exists before deleting it-> why? it just won't delete anything if it doesnt exist
//  $sql = "INSERT INTO favorites (user_id, title_id) VALUES ('$user_id', '$title_id')";
  $sql = "DELETE FROM favorites WHERE user_id = ".$user_id. " AND title_id = ".$title_id;
}

$results = $mysqli->query($sql);

if(!results) {
    exit("SQL ERROR: " . $mysqli->error);
}
// else {
//    echo "Successfully Added to Your favorites";
//}