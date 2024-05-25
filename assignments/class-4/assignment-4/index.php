<?php
$whitelist = file_get_contents("whitelist.txt");
$whitelist = explode("\n", $whitelist);
$ip = $_SERVER['REMOTE_ADDR'];
if (!in_array($ip, $whitelist)) {
    header("Location: unauthorized.html");
} else {
    header("Location: whitelist.html");
}
