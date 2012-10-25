<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION['uid']);
unset($_SESSION['admin']);
// Delete all session variables
// session_destroy();

// Jump to login page
header('Location: index.php');

?>
