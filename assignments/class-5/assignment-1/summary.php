<?php
session_start();
$name = $_SESSION['name'];
$guestsNumber = $_SESSION['guests'];
$date_from = $_SESSION['date_from'];
$date_to = $_SESSION['date_to'];
$card_number = $_SESSION['card_number'];

$guests = array();
$guestsNames = $_POST['name'];
$guestsAges = $_POST['age'];
for ($i = 0; $i < count($guestsNames); $i++) {
    $guests[] = array('name' => $guestsNames[$i], 'age' => $guestsAges[$i]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>
</head>
<body>
    <h1>Reservation summary</h1>
    <p>Name: <?php echo $name; ?></p>
    <p>Guests: <?php echo $guestsNumber; ?></p>
    <p>Date from: <?php echo $date_from; ?></p>
    <p>Date to: <?php echo $date_to; ?></p>
    <p>Card number (hidden for security): <?php echo $card_number; ?></p>

    <h2>Guests information</h2>
    <ul>
        <?php
        foreach ($guests as $guest) {
            echo '<li>Name: '.$guest['name'].', Age: '.$guest['age'].'</li>';
        }
        ?>
    </ul>

    
</body>
</html>