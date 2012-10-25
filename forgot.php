<?php
include 'header.inc';
?>
    <h1>Forgot your password?</h1>
    <p>Enter your username and we'll help you reset it:</p>
    <form action="forgot2.php" method="POST">
    <input type="text" name="username" value="" />
    <input type="submit" value="Submit" />
    </form>
<?php
include 'footer.inc';
?>