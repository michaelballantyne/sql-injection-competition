<?php
include 'db.inc';
include 'header.inc';

// Injection vulnerability, allowing read of single entry
$result = pg_query($db, "SELECT question FROM users WHERE u_name = '" . $_POST['username'] . "';");
$row = pg_fetch_row($result);

if ($result && $row) {
    print "Your security question: ";
    print $row[0];
    
    ?>
    <form action="forgot3.php" method="post">
    <label>Security Answer:</label>
    <input name="answer" type="text">
    <label>New password to set: </label>
    <input name="newpass" type="text">
    <input type="submit" />
    <input type="hidden" name="username" value="<?php print $_POST['username'] ?>">
    </form>
    <?php
}
else {
    ?>
    <p>Couldn't find that user</p>
    <a href="forgot.php">Go back</a>
    <?php
}

include 'footer.inc';