<?php
$host = "localhost";
$username = "zootrack_natural";
$password = "myActions2.0";
$database = "zootrack_naturalist_db";

$mysqli = new mysqli($host, $username, $password, $database);

if($mysqli->connect_errno){
    exit("DB Connection Error: " . $mysqli->connect_error);
}

?>