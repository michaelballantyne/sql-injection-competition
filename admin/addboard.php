<?php

include 'adb.inc';
include 'admin.inc';
include '../header.inc';

$name = $_POST['name'];


$result1 = pg_query($db, "insert into boards values ('$name')");

if (!$result)
    $_SESSION['flash'] = pg_errormessage($db);

$query = <<<EOF
create table posts_$name (
id serial primary key,
poster int references users(member_number) not null,
image bytea not null,
message text
);
grant select, update, insert on posts_$name, posts_{$name}_id_seq to contest;
EOF;

$result2 = pg_query($db, $query);

header('Location: index.php');

?>
