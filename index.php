<?php
include 'header.inc';
// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (isset($_SESSION['uid'])) {
        header('Location: posts.php');
}

?>

<h3>User Login</h3>

<?php
if (isset($_SESSION['flash'])) {
    print "<p>" . $_SESSION['flash'] . "<p>";
    unset($_SESSION['flash']);
}
?>
<form method="POST" action="loginproc.php">
    <label>Username: </label><input type="text" name="username">
    <label>Password: </label><input type="password" name="password">
    <input type="submit" value="Login">
</form>
<a href="forgot.php">forgot your password?</a>

<?php
include 'footer.inc'
?>
