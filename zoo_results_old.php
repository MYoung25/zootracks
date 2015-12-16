<?php

$user_id = 1;

$title = $_GET['title'];
$genre_id = $_GET['genre_id'];
$tag = $_GET['tag'];

require "zoo_connect.php";

$sql = "SELECT *, group_concat(DISTINCT tags.tag ORDER BY tags.tag DESC SEPARATOR ', ')
        FROM titles
        INNER JOIN genres ON titles.genre_id = genres.genre_id
        INNER JOIN title_tag ON titles.title_id = title_tag.title_id
        INNER JOIN tags ON tags.tag_id = title_tag.tag_id";

$first = true;

if ($title !=""){
    $sql .= " WHERE title LIKE '%$title%'";
    $first = false;
}

if ($genre_id !=-1){
    if($first) $sql .= " WHERE titles.genre_id = $genre_id";
    else $sql .= " AND titles.genre_id = $genre_id";
    $first = false;
}

if ($tag !=""){
    $sql .= " WHERE tag LIKE '%$tag%'";
}

$sql = $sql . " GROUP BY titles.title_id";

$results = $mysqli->query($sql);
if(!$results){
    exit("SQL Error: " . $mysqli->error);
}


/* build an array of this users favorites, possibly only the ones that are also in the results of this query */
  $fav_values = array();
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>

<script>
 function save_checkbox(checkbox_id, record_id) {
    isChecked = $('#fav' + record_id).is(":checked");
    //alert(isChecked);  
    // use test.php below just for testing
    $.post( 'zoo_favorite_insert.php' , { user_id: <?php echo $user_id; ?>, checked : isChecked, title_id : record_id }, 
       function( response ) {
 	     //alert(response);
	     $( "#result" ).html( response );
       }
    );
 }
</script>

<div id="result"></div>  <!-- div to hold results from ajax for testing -->

<table>
    <th></th>
    <th></th>
    <th>Favorite</th>
    <th>Title</th>
    <th>Audio</th>
    <th>Genre</th>
    <th>Tags</th>


    <!--    <tr>-->
    <!--        <td>Save the forest</td>-->
    <!--        <td>-->
    <!--            <audio controls>-->
    <!--                <source src="http://soundserver.cinradio.org/90_Second_Naturalist/110915.mp3" type="audio/mpeg">-->
    <!--                Your browser does not support the audio element.-->
    <!--            </audio>-->
    <!--        </td>-->
    <!--    </tr>-->

    <?php while ($row = mysqli_fetch_array($results)){
        echo "<tr>
            <td><a href='zoo_edit.php?title_id=" . $row['title_id'] . "'>[EDIT]</td>
            <td>[DELETE]</td>
            <td><form>
                <input type='checkbox' id='fav" . $row['title_id'] . "' name='favorite' value='favorite' onclick='save_checkbox(\"to_print\"," . $row['title_id'] . ");'>
            </form></td>
            <td><a href='zoo_details.php?title_id=" . $row['title_id'] . "'>" . $row["title"] . "</a></td>
            <td><audio controls preload = none>
                    <source src=" . $row["url1"] . $row["url2"] . ">
                </audio></td>
            <td>" . $row["genre"] . "</td>
            <td>" . $row["group_concat(DISTINCT tags.tag ORDER BY tags.tag DESC SEPARATOR ', ')"] . "</td>
    </tr>";

    } ?>
</table>