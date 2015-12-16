<?php
require "zoo_connect.php";

include "navigation.php";

$title_id = $_GET['title_id'];
$title = $_GET['title'];
$genre_id = $_GET['genre_id'];
$tag = $_GET['tag'];

$title = $mysqli->real_escape_string($title);
$tag = $mysqli->real_escape_string($tag);

$sql = "UPDATE titles
        SET title = '$title', genre_id = '$genre_id'
        WHERE titles.title_id = $title_id";

if(!empty ($tag)) {
    $tag_insert = "INSERT INTO tags (tag)
                   VALUES ('$tag')";

    $select_tag_id = "SELECT tag_id
                  FROM tags
                  WHERE tag LIKE '$tag'";
}


$results = $mysqli->query($sql);

//$tags_search = "SELECT *
//                FROM tags
//                WHERE tag LIKE '$tag'";
//
//if($tag == )


if(!empty ($tag)) {
    $results_tag_insert = $mysqli->query($tag_insert);
    $results_select_tag_id = $mysqli->query($select_tag_id);
    $row = mysqli_fetch_array($results_select_tag_id);

    $tt_insert = "INSERT INTO title_tag (title_id, tag_id)
              VALUES ($title_id, '". $row['tag_id'] ."')";

    $results_tt_insert = $mysqli->query($tt_insert);
}

?>


<div id="edit_container">

<?php

if(!$results){
    exit("SQL Error: " . $mysqli->error);
} else {
    echo "<br>Record $title was successfully updated.";
}
if(!empty ($tag)) {
    if (!$results_tag_insert) {
        exit("SQL Error: " . $mysqli->error);
    }

    if (!$results_select_tag_id) {
        exit("SQL Error: " . $mysqli->error);
    }

    if (!$results_tt_insert) {
        exit("SQL Error: " . $mysqli->error);
    }
}


?>

</div>
