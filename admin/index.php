<?php

include 'adb.inc';
include 'admin.inc';
include '../header.inc';

if (isset($_SESSION['flash'])) {
    print "<p>" . $_SESSION['flash'] . "<p>";
    unset($_SESSION['flash']);
}

?>

<h3>Boards</h3>
<ul>
    <?php
    $boardsresult = pg_query($db, "select name from boards;");
    while($row = pg_fetch_row($boardsresult)) {
        print "<li><a href='../posts.php?board=" . $row[0] . "'>" . $row[0] . "</a></li>";      
    }
    ?>
</ul>

<h3>Add a board</h3>
<form action="addboard.php" method="POST">
    <label>Board Name: </label><input type="text" name="name"/>
    <input type="submit"/>
</form>

<p><a href="../logout.php">Logout</a><br/><a href="../index.php">Back to posts</a>
<br/><a href="/phppgadmin">Database admin</a></p>

<?php
include '../footer.inc';
?>