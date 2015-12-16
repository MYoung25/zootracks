<?php
require "zoo_connect.php";
include "navigation.php";

$genre_sql = "SELECT *
         FROM genres";
$genre_results = $mysqli->query($genre_sql);

?>

<div id="add_container">
    <br>
    <strong style="margin: auto;text-align: center;font-size: 18px;">Add a Podcast</strong>
    <br><br>
    <form method="get" action="zoo_insert.php">
        <input type="text" name="title" placeholder="Title">
            <br>
        Genre:
        <select name="genre_id">
            <?php
            while($row = mysqli_fetch_array($genre_results)) {
                echo "<option value='" . $row["genre_id"] . "'>" . $row["genre"] . "</option>";
            }
            ?>
        </select>
            <br>
        <input type="text" name="filename" placeholder="File eg.'110915.mp3'" required>
            <br>
        <input type="text" name="airdate" placeholder="YYYY-MM-DD" required>
            <br>
        <input type="text" name="transcript" placeholder="Transcript" required>
            <br>
        <input type="text" name="tag" placeholder="Add the FIRST tag" required>
            <br>
        <input type="submit" value="Add Podcast">
            <br><br>
    </form>
</div>
