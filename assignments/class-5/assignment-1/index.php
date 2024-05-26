<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 1</title>
</head>

<body>
    <h1>Provide reservation details</h1>
    <form action="reservation.php" method="POST">
        <fieldset>
            <legend>Reservation details</legend>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
            <br>
            <label for="guests">How many guests?</label>
            <input type="number" name="guests" id="guests" required min="0">
            <br>
        </fieldset>
        <fieldset>
            <legend>Reservation date</legend>
            <label for="date_from">Date from</label>
            <input type="date" name="date_from" id="date_from" required>
            <br>
            <label for="date_to">Date to</label>
            <input type="date" name="date_to" id="date_to" required>
            <br>
        </fieldset>
        <fieldset>
            <legend>Payment details</legend>
            <label for="card_number">Card number</label>
            <input type="text" name="card_number" id="card_number" minlength="15" maxlength="19" required>
            <br>
            <label for="expiry_date">Expiry date (mm/yy)</label>
            <input type="text" name="expiry_date" required minlength="5" maxlength="5">
            <br>
            <label for="cvv">CVV</label>
            <input type="text" name="cvv" id="cvv" required>
            <br>
        </fieldset>
        <input type="submit" value="Make reservation">
    </form>
</body>

</html>