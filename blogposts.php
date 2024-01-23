<?php

require_once 'config.php';

$select_statment = "SELECT * FROM blogpost";

try {
    $db_connection = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASS);

    $statment = $db_connection->prepare($select_statment);
    $statment->execute();
    $blogposts = $statment->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>My Blog</title>
</head>
<body>
<h1>My Blogs</h1>
<?php
if (!empty($blogposts)):
    foreach($blogposts as $blogpost):
        $post_title = $blogpost["post_title"];
        $post_body = $blogpost["post_body"];
        $post_date = $blogpost["post_date"]; // String object
        $post_date = date_create($post_date); // DateTime object
        $post_date = date_format($post_date,"jS, F, Y.");
?>
<section class="blogpost">
    <div class="blogtitle"><?=$post_title?></div>
    <div><?=$post_body?></div>
    <div class="blogdate"><small>Posted on: <?=$post_date?></small></div>
</section>
<?php
endforeach;
endif;
?>

</body>
</html>