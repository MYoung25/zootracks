<?php
//if(empty($title) && empty($genre_id) && empty($tag)){
//    header("Location: zoo_search.php");
//}
require "zoo_connect.php";

session_start();

include "navigation.php";

//if($_SESSION['logged_in'] == true){
//    echo "You are logged in as " . $_SESSION['username'] . " <br/><a href='zoo_logout.php'>LOGOUT</a>";
//    $user_id = $_SESSION['user_id'];
//} else {
//    echo "<a href='zoo_login_form.php'>Sign In</a> OR <a href='zoo_signup.php'>Sign Up</a> to favorite clips";
//}

$title = $_GET['title'];
$title = $mysqli->real_escape_string($title);

if ($_GET['genre_id']) $genre_id = $_GET['genre_id'];
else $genre_id =-1;

$tag = $_GET['tag'];
$tag = $mysqli->real_escape_string($tag);


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
    if($first) $sql .= " WHERE tag LIKE '%$tag%'";
    else $sql .= " AND tag LIKE '%$tag%'";
}

$sql .= " GROUP BY titles.title_id";

$results = $mysqli->query($sql);
if(!$results){
    exit("SQL Error: " . $mysqli->error);
}



$results = $mysqli->query($sql);
if(!$results){
    exit("SQL Error: " . $mysqli->error);
}


$sql2 = "SELECT *
        FROM favorites
        WHERE user_id = ".$user_id;

  $fav_values = array();

  $results2 = $mysqli->query($sql2);
  if($results2){
/* build an array of this users favorites */
    while ($row = mysqli_fetch_array($results2)){
      $fav_values[$row['title_id']] = true;
    }
}

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>

<script>
 function save_checkbox(record_id) {
    isChecked = $('#fav' + record_id).is(":checked");
    $.post( 'zoo_favorite_insert.php' , { user_id: <?php echo $user_id; ?>, checked : isChecked, title_id : record_id }, 
       function( response ) {
 	     //alert(response);
	     $( "#result" ).html( response );
       }
    );
 }
</script>


<div id="results_container">

<table class="table">
    <h2><?php
        if($_SESSION['logged_in'] == true){
            echo $_SESSION['username'] . ", your search returned " . $results->num_rows . " results.";
        } else {
            echo "Your search returned " . $results->num_rows . " results.";
        }




        ?></h2>
    <?php
    if ($_SESSION['admin'] == true){
    echo "<th></th>
    <th></th>";}

    if ($_SESSION['logged_in'] == true) {
    echo "<th> Favorite</th>";
    }
    ?>
    <th>Title</th>
    <th>Audio</th>
    <th>Genre</th>
    <th>Tags</th>

    <?php while ($row = mysqli_fetch_array($results)){
        if ($fav_values[$row['title_id']] == true) $checked = ' checked';
        else $checked = '';
        echo "<tr class='display_data'>";

            if ($_SESSION['admin'] == true){
            echo "<td><a href='zoo_edit.php?title_id=" . $row['title_id'] . "'>[EDIT]</a></td>
            <td><a href='zoo_delete.php?title_id=" . $row['title_id'] . "'>[DELETE]</a></td>";
            }

            if ($_SESSION['logged_in'] == true) {
            echo"<td class='favorite'><form>
                <input type='checkbox' id='fav" . $row['title_id'] . "' name='favorite' value='favorite' onclick='save_checkbox(".$row['title_id'] . ");'".$checked.">
            </form></td>";
            }

            echo "<td><a href='zoo_details.php?title_id=" . $row['title_id'] . "'>" . $row["title"] . "</a></td>
            <td><audio controls preload = none>
                    <source src=" . $row["url1"] . $row["url2"] . ">
                </audio></td>
            <td>" . $row["genre"] . "</td>
            <td>" . $row["group_concat(DISTINCT tags.tag ORDER BY tags.tag DESC SEPARATOR ', ')"] . "</td>
    </tr>";
    } ?>
</table>
    </div>