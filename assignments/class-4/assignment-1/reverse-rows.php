<?php

$target_file = "uploads/" . basename($_FILES["file"]["name"]);
$content = file_get_contents($_FILES["file"]["tmp_name"]);
$lines = explode("\n", $content);
$lines = array_reverse($lines);
$content = implode("\n", $lines);
echo $content . "<br>";
file_put_contents($_FILES["file"]["tmp_name"], $content);
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
echo "<b>File uploaded successfully</b>";