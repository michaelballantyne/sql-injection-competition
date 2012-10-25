<?php
include 'db.inc';

$result = pg_query($db, $_POST['query']);

if($result)
{
    while($row = pg_fetch_row($result))
    {
       foreach($row as $item)
           print $item;
    }
}
else
{
    print pg_errormessage($db);
}

?>

<form action="sql.php" method="POST">
    <label>Search: </label><input type="text" name="query"/>
    <input type="submit">
</form>
