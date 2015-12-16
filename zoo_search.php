<?php
require "zoo_connect.php";

session_start();

include "navigation.php";

$sql_genres = "SELECT *
                FROM genres";

//$sql_tags = "SELECT *
//            FROM tags";

$results_genres = $mysqli->query($sql_genres);
if(!$results_genres){
    exit("Genres SQL Error: " . $mysqli->error);
}

//$results_tags = $mysqli->query($sql_tags);
//if(!$results_tags){
//    exit("Tags SQL Error: " . $mysqli->error);
//}

?>

<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>


<style>

    strong{
        font-size: 16pt;
    }

</style>

<body>

<div id="search_container">
    <br>
    <strong style="margin: auto;text-align: center;margin-left: 75px;">SEARCH</strong><br><br>
<form method="get" action="zoo_results.php">
    <table id="search">
        <tr>
<!--        <td><strong>SEARCH A</strong></td>-->
        <td>Title: <input type="text" name="title" placeholder="All"></td>
        <br>
        </tr>
        <tr>
<!--        <td><Strong>AND</strong></td>-->
            <td>Genre:
                <select name="genre_id">
                    <option value="-1">All</option>
                    <?php
                    while($row = $results_genres->fetch_array(MYSQLI_ASSOC)){
                    echo "<option value='" . $row["genre_id"] . "'>" . $row["genre"] . "</option>";
                    }
                    ?>
                </select>
                </td>
                <br>
        </tr>
        <tr>
<!--            <td>-->
<!--        <strong>AND</strong></td>-->
            <td>Tag: <input type="text" name="tag" placeholder="All"> </td>
        </tr>
    </select>
<br>
        </table>
    <input type="submit" value="Search" id="search_button"><br>
</form>

</div>
</body>
</html>