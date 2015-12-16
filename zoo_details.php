<?php
$title_id = $_GET['title_id'];
if(empty($title_id)){
    header("Location: zoo_search.php");
}

include "navigation.php";

require "zoo_connect.php";

$sql = "SELECT *, group_concat(DISTINCT tags.tag ORDER BY tags.tag DESC SEPARATOR ', ')
        FROM titles
        INNER JOIN genres ON titles.genre_id = genres.genre_id
        INNER JOIN title_tag ON titles.title_id = title_tag.title_id
        INNER JOIN tags ON tags.tag_id = title_tag.tag_id
        WHERE titles.title_id = $title_id
        GROUP BY titles.title_id";

$results = $mysqli->query($sql);
if(!$results){
    exit("SQL Error: " . $mysqli->error);
}

$row = $results->fetch_array(MYSQLI_ASSOC);

?>


<div id="details_container">
<table>
    <tr>
        <td><strong>Title:</strong></td>
        <td><?php echo $row['title']; ?></td>
    </tr>
    <tr>
        <td><strong>Audio:</strong></td>
        <td><?php echo "<audio controls preload = none>
                    <source src=" . $row["url1"] . $row["url2"] . ">
                </audio>"; ?></td>
    </tr>
    <tr>
        <td><strong>Genre:</strong></td>
        <td><?php echo $row['genre']; ?></td>
    </tr>
    <tr>
        <td><strong>Tags:</strong></td>
        <td><?php echo $row["group_concat(DISTINCT tags.tag ORDER BY tags.tag DESC SEPARATOR ', ')"] ?></td>
    </tr>
</table>
<strong>Transcript:</strong><br/> <?php echo $row['transcripts']; ?>
</div>
