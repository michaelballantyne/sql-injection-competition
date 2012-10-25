<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['uid'])) {
        header('Location: index.php');
}

?>