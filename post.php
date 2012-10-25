<?php
include 'db.inc';
include 'secured.inc';

$boardname = $_GET["board"];


$uploadfile = $_FILES['userfile']['tmp_name'];
$message = $_POST['message'];
$mime = mime_content_type($uploadfile);
if (!$uploadfile || strpos($mime, 'image') !== false) {
    $escaped = pg_escape_bytea(file_get_contents($uploadfile));

    if ($escaped || $message) {

        $query = "insert into posts_$boardname (poster, image, message) values (" . $_SESSION['uid'] .", '{$escaped}', '$message')";
        $result = pg_query($db, $query);

        if($result)
        {
            $_SESSION['flash'] = "Post added.";
            unlink($uploadfile);
        }
        else
        {
            $_SESSION['flash'] = pg_errormessage($db);
            unlink($uploadfile);
        }
    }
    else {
        $_SESSION['flash'] = "Please provide either a message, an image, or both.";
    }
} 
else {
    $_SESSION['flash'] = "Only images may be uploaded.";
}

header("Location: posts.php?board=$boardname");
 ?>
