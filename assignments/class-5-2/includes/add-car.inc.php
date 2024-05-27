<?php

$model = $_POST['model'];
$brand = $_POST['brand'];
$year = $_POST['year'];
$price = $_POST['price'];
$description = $_POST['description'];

require_once 'dbh.inc.php';

$query = 'INSERT INTO samochody (marka, model, rok_produkcji, cena, opis) VALUES (:marka, :model, :rok_produkcji, :cena, :opis)';
$stmt = $dbh->prepare($query);
$stmt->bindParam(':marka', $brand);
$stmt->bindParam(':model', $model);
$stmt->bindParam(':rok_produkcji', $year);
$stmt->bindParam(':cena', $price);
$stmt->bindParam(':opis', $description);
$stmt->execute();

header('Location: ../car-details.php?id=' . $dbh->lastInsertId());
die();