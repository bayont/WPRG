<?php
$url = $_POST['url'];
$description = $_POST['description'];
if (empty($url) || empty($description)) {
    header("Location: index.php");
    exit();
}
$contents = file_get_contents("links.txt");
file_put_contents("links.txt", $contents . $url . ";" . $description . "\n");

header("Location: index.php");