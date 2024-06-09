<?php
$hostname = "mysql";
$port = 3306;
$database = "mojaBaza";
$username = "root";
$password = "password";

try {
    $dbh = new PDO("mysql:host=$hostname;port=$port;dbname=$database", $username, $password);
} catch (PDOException $e) {
    die("Unable to connect: " . $e->getMessage());
}
