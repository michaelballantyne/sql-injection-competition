<?php
include 'db.inc' ;
include 'secured.inc';

$name = $_GET['board'];
$result = pg_query("select image from posts_$name where id = " . $_GET['id'] . ";");

$bytes = pg_fetch_result($result, 'image');
        
header('Content-type: image');
echo pg_unescape_bytea($bytes);
?>
