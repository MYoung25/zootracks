<?php
require_once "zoo_connect.php";
include "navigation.php";

?>

<div id="project_summary">
    <p>
        <h2>1) Explain how each requirement was satisfied. </h2><br>
        -Customization: I took the main ideas from the labs and assignments and added favorites, audio, and tags. <br><br>
        -Database: I added 28 entries to the database I created, I believe this is enough to show off the functionality adequately.  I effectively have five lookup tables, although two of them are join tables for the many-to-many relationships.<br><br>
        -Site Content: Narrative text and a description is in the about page, the rest of the site's content is based on the database.<br><br>
        -Site Design: I created a navigation that is included across all pages, and a consistent design that follows the needs of each page.<br><br>
        -Admin Functionality and Basic Security: Only Admins can edit, add, and delete pages.  Basic users can only query anc favorite the database. <br><br>
        -Extras: <br>1) I included Sessions so users can stay logged in across pages <br> 2) I included a membership system in order to allow users to save their favorites <br> 3) There are two many-to-many relationships. One for tags and one for favorites <br><Br>
        -Project Summary: This is my Project Summary <br><br>
    </p>
    <p>
        <h2>2) Instructions for how to use your website, security or admin credentials, etc.</h2><br>
        -When not logged in, users are only capable of searching the page.<br>
        -When logged in, users are capable of adding to their favorites.<br>
        -When logged in as an admin, users can add, edit, and delete records<br><br>
        -Admin credentials: username = uscitp password = Fall2015 (I would greatly appreciate it if you only delete entries you add)
        -Add Podcast: you can find actual 90-Second Naturalist episodes to add <a href="http://wvxu.org/programs/90-second-naturalist#stream/0">HERE</a>.  If you choose not to add an actual title from that site, the audio functionality won't work for that record.  This was done on purpose because the only entries are supposed to be 90-Second Naturalist Podcasts.
    </p>
    <p>
        <h2>3) Include database design & diagram.</h2><br>
        <img src="db_diagram.png">
    </p>
    <p>
        <h2>4) Any anomalies or exceptions the grader should be aware of (i.e. only works in certain browsers, some functionality doesn&#39;t work, etc.).</h2><br>
        The site has been tested thoroughly in Safari, basic testing in Firefox and Chrome have not shown any anomalies.  The only known difference is that the text of the navigation is only centered correctly in Firefox
    </p>
</div>
