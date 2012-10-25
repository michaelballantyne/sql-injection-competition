<?php
include 'db.inc';
include 'header.inc';

$user = pg_escape_string($_POST['username']);
$result = pg_query($db, "SELECT answer FROM users WHERE u_name = '$user';");
$row = pg_fetch_row($result);

if ($result && $row && $row[0] == $_POST['answer']) {
    $result2 = pg_query($db, "UPDATE users SET pass='" . md5($_POST['newpass']) . "' where u_name = '$user';");
    if ($result2) {
        print "<p>{$user}'s password changed.<p>";
    }
    else {
        print "<p>Error changing {$user}'s password.<p>";
    }
    print "<a href='index.php'>Back to login</a>";
}
else {
    ?>
    <p>Sorry, we couldn't change your password. You may have not have entered the right security answer, or there may be a problem with the server.</p>
    <a href="forgot.php">Go back</a>
    <?php
}

include 'footer.inc';
?>
