<?php
session_start();
$_SESSION['name'] = $_POST['name'];
$_SESSION['guests'] = $_POST['guests'];
$_SESSION['date_from'] = $_POST['date_from'];
$_SESSION['date_to'] = $_POST['date_to'];
$_SESSION['card_number'] = str_repeat('*', strlen($_POST['card_number']) - 4) . substr($_POST['card_number'], -4);
$guestsNumber = $_POST['guests'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
</head>

<body>
    <form action="summary.php" method="POST">
        <fieldset>
            <legend>Guests information details</legend>
            <?php
            for ($i = 1; $i <= $guestsNumber; $i++) {
            echo '
            <fieldset>
                <legend>Guest '.$i.'</legend>
                <label for="name">Name</label>
                <input type="text" name="name[]" id="name" required>
                <br>
                <label for="age">Age</label>
                <input type="number" name="age[]" id="age" required>
            </fieldset>
            ';
            }
            ?>
        </fieldset>
        <input type="submit" value="Confirm guests details">
    </form>
</body>

</html>