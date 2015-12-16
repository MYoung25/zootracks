<?php
require_once "zoo_connect.php";
session_start();


$username =  $mysqli->real_escape_string($_POST['username']);
$password =  $mysqli->real_escape_string($_POST['password']);

if(empty($_SESSION['logged_in'])) {
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $password = hash('SHA512', $password);

    if (empty($username) || empty($password)){
//        echo "Please enter login information";
        include "zoo_login_form.php";
        exit();
    } else {
        $sql = "SELECT *
                FROM users
                WHERE username = '$username'";
        $results = $mysqli->query($sql);
        if(!$results){
            exit($mysqli->error);
        }

        $row = $results->fetch_array(MYSQLI_ASSOC);

        if ($password == $row['password']) {
            // Logged In
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['admin'] = $row['admin'];
        } else {
            include "zoo_login_form.php";
            echo "Invalid login information.";
            exit();
        }
    }
}

include "navigation.php";

$favorites_sql = "SELECT *, group_concat(DISTINCT tags.tag ORDER BY tags.tag DESC SEPARATOR ', ')
                  FROM users
                  INNER JOIN favorites ON users.user_id = favorites.user_id
                  INNER JOIN titles ON favorites.title_id = titles.title_id
                  INNER JOIN genres ON titles.genre_id = genres.genre_id
                  INNER JOIN title_tag ON titles.title_id = title_tag.title_id
                  INNER JOIN tags ON tags.tag_id = title_tag.tag_id
                  WHERE username = '$username'
                  GROUP BY titles.title_id";

$favorites_results = $mysqli->query($favorites_sql);
if(!$favorites_results){
    exit("SQL Error: " . $mysqli->error);
}

?>

<?php //echo "<strong>$username</strong>'s favorites are:'" ?>

<div id="favorites_container">
    <h1><?php echo "<strong>$username</strong>'s Favorites are:" ?></h1>

    <table class="table">
        <th>Title</th>
        <th>Audio</th>
        <th>Genre</th>
        <th>Tags</th>

        <?php while ($row = mysqli_fetch_array($favorites_results)){
            if ($fav_values[$row['title_id']] == true) $checked = ' checked';
            else $checked = '';
            echo "<tr class='display_data'>
                <td class='title'><a href='zoo_details.php?title_id=" . $row['title_id'] . "'>" . $row["title"] . "</a></td>
                <td class='audio'><audio controls preload = none>
                        <source src=" . $row["url1"] . $row["url2"] . ">
                    </audio></td>
                <td class='genre'>" . $row["genre"] . "</td>
                 <td class='tag'>" . $row["group_concat(DISTINCT tags.tag ORDER BY tags.tag DESC SEPARATOR ', ')"] . "</td>
        </tr>";

        } ?>
    </table>
</div>