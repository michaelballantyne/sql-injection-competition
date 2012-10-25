<?php

// Inialize session
session_start();

// Include database connection settings
include('db.inc');

$user = $_POST['username'];
$hash = md5($_POST['password']);
// Retrieve username and password from database according to user's input
$login = pg_query($db, "SELECT member_number, pass FROM users WHERE u_name = '$user';");

if ($login) {
    // Check username and password match
    if (pg_num_rows($login) == 1) {
        $row = pg_fetch_row($login);
        // Set username session variable
        if($row[1] == $hash)
        {
            $uid = $row[0];
            $adminresult = pg_query($db, "select * from administrators where admin_number = $uid");
            
            if (pg_num_rows($adminresult) > 0) {
                $_SESSION['admin'] = true;
            }
          
            
            $_SESSION['uid'] = $uid;
            // Jump to secured page
            header('Location: posts.php');
        }
        else {
            $_SESSION['flash'] = "Password incorrect. ";
            // Jump to login page
            header('Location: index.php');
        }

    }
    else {
        $_SESSION['flash'] = "Username not found. ";

        // Jump to login page
        header('Location: index.php');
    }
} else {
    $_SESSION['flash'] = pg_errormessage($db);
    header('Location: index.php');
}
?>
