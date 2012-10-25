<?php
include 'db.inc';
include 'secured.inc';
include 'header.inc';

if (isset($_SESSION['flash'])) {
    print "<p>" . $_SESSION['flash'] . "<p>";
    unset($_SESSION['flash']);
}

$search = $_POST['search'];
if ($search == null) {
    $search = "%";
}

$boardname = $_GET["board"];
if ($boardname == null) {
    $boardname = "default";
}
?>

Boards:
<ul id="menu">
    <?php
    $boardsresult = pg_query($db, "select name from boards;");
    while($row = pg_fetch_row($boardsresult)) {
        print "<li><a href='posts.php?board=" . $row[0] . "'>" . $row[0] . "</a></li>";      
    }
    ?>
</ul>


<h3>Posts: <?php print $boardname ?></h3>
<form action="posts.php?board=<?php print $boardname ?>" method="POST">
    <label>Search: </label><input type="text" name="search"/>
    <input type="submit">
</form>
<?php


$query = <<<EOF
select 
    u.u_name, 
    p.message, 
    p.id, 
    p.image, 
    a.admin_number 
from posts_$boardname p 
    inner join users u on u.member_number = p.poster 
    left outer join administrators a on u.member_number = a.admin_number
where p.message like '$search';
EOF;
$result = pg_query($db, $query);

if (pg_num_rows($result) == 0) {
    ?>
    <p>No posts yet.</p>
    <?php
}

while ($row = pg_fetch_row($result)) {
    ?>
    <div class="post">
        <h4><?php 
            print $row[0]; 
            if ($row[4]) {
                print " (admin)";
            } 
            ?></h4>
        <p><?php print $row[1] ?><p>
        <?php
        if ($row[3]) {
            ?>
            <img src="image.php?board=<?php print $boardname ?>&id='<?php print $row[2] ?>'"/>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
    
    
<h3>Add a Post</h3>

<form enctype="multipart/form-data" action="post.php?board=<?php print $boardname ?>" method="POST">
    <label>Message: </label><textarea name="message"></textarea>
    <label>File: </label><input name="userfile" type="file" size="25"/>
   
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
    <input type="submit" value="Upload" />
</form>


<p>
<a href="logout.php">Logout</a>
<br/>
<?php
if (isset($_SESSION['admin'])) {
?>
<a href="admin/index.php">Board Administration</a>
<?php
}
?>
</p>

<?php
include 'footer.inc';
?>