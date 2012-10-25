<?php

$hostname = 'localhost';        // Your MySQL hostname. Usualy named as 'localhost', so you're NOT necessary to change this even this script has already online on the internet.
$dbname   = 'contest'; // Your database name.
$username = 'postgres';             // Your database username.
$password = 'batman';                 // Your database password. If your database has no password, leave it empty.

// Let's connect to host
$db = pg_connect("host=$hostname user=$username password=$password dbname=$dbname") or DIE('Connection to host is failed, perhaps the service is down!');

?>
