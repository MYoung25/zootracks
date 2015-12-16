<?php
require "zoo_connect.php";
include "navigation.php";

$title = $_GET['title'];
$title = $mysqli->real_escape_string($title);

$genre_id = $_GET['genre_id'];

$filename = $_GET['filename'];
$filename = $mysqli->real_escape_string($filename);

$airdate= $_GET['airdate'];
$airdate = $mysqli->real_escape_string($airdate);

$transcript = $_GET['transcript'];
$transcript = $mysqli->real_escape_string($transcript);

$tag = $_GET['tag'];
$tag = $mysqli->real_escape_string($tag);



$sql = "INSERT INTO titles (title, genre_id, url1, url2, airdate, transcripts)
        VALUES ('$title', '$genre_id', 'http://soundserver.cinradio.org/90_Second_Naturalist/', '$filename', '$airdate', '$transcript')";

$results = $mysqli->query($sql);

$select_title_id = "SELECT title_id
                    FROM titles
                    WHERE title = '$title'";

$results_select_title_id = $mysqli->query($select_title_id);


if(!empty ($tag)) {
    $tag_insert = "INSERT INTO tags (tag)
                   VALUES ('$tag')";

    $select_tag_id = "SELECT tag_id
                  FROM tags
                  WHERE tag LIKE '$tag'";
}

if(!empty ($tag)) {
    $results_tag_insert = $mysqli->query($tag_insert);
    $results_select_tag_id = $mysqli->query($select_tag_id);
    $row = mysqli_fetch_array($results_select_tag_id);
    $row2 = mysqli_fetch_array($results_select_title_id);

    $tt_insert = "INSERT INTO title_tag (title_id, tag_id)
              VALUES ('".$row2['title_id']."', '". $row['tag_id'] ."')";

    $results_tt_insert = $mysqli->query($tt_insert);
}

?>


<div id="insert_container">

    <?php
        $results = $mysqli->query($sql);

        if(!$results){
            exit("SQL Error: " . $mysqli->error);
        } else {
            echo "<br><strong>$title</strong> was successfully added.<br><br> You can add more tags <a href='zoo_edit.php?title_id=" . $row2['title_id'] . "'> HERE</a><br>";
        }



    ?><br>
</div>
