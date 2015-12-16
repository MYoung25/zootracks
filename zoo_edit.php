<?php
$title_id = $_GET['title_id'];
if(empty($title_id)){
    header("Location: zoo_search.php");
}

require_once "zoo_connect.php";
include "navigation.php";

$sql = "SELECT *, group_concat(DISTINCT tags.tag ORDER BY tags.tag DESC SEPARATOR ', ')
                  FROM titles
                  INNER JOIN genres ON titles.genre_id = genres.genre_id
                  INNER JOIN title_tag ON titles.title_id = title_tag.title_id
                  INNER JOIN tags ON tags.tag_id = title_tag.tag_id
                  WHERE titles.title_id = '$title_id'
                  GROUP BY titles.title_id";

$results = $mysqli->query($sql);
if(!$results) {
    exit("SQL Error: " . $mysqli->error);
}

$sql_genres = "SELECT *
               FROM genres";

$results_genres = $mysqli->query($sql_genres);
if(!$results_genres){
    exit("SQL Error: " . $mysqli->error);
}


$row = mysqli_fetch_array($results);
?>

<div id="edit_container">

<form method="get" action="zoo_update.php" id="edit">
    Title: <input type="text" name="title" value="<?php echo $row['title']; ?>">
    <br/>
    Genre:
    <select name="genre_id">

        <?php
        while($row_genres = mysqli_fetch_array($results_genres)){
            if($row_genres['genre_id'] == $row['genre_id']){
                echo "<option selected='1' value='" . $row_genres["genre_id"] . "'>" . $row_genres["genre"] . "</option>";
            } else {
                echo "<option value='" . $row_genres["genre_id"] . "'>" . $row_genres["genre"] . "</option>";
            }
        }
        ?>
    </select
    <br/><br/>
    Add a tag:
    <input type="text" name="tag" placeholder="Add a Tag Here">
    <input type="hidden" name="title_id" value="<?php echo $row['title_id'];?>">
    <input type="submit">
</form>
</div>