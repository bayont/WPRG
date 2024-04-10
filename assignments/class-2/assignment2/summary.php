<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation summary</title>
    <style>
        .card {
            border: 1px solid black;
            padding: 10px;
            margin: 10px;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }

        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Reservation Summary</h1>
        <?php
        // Zbieramy dane z POST'a
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $cardNumber = $_POST['card_number'];
        $cardDate = $_POST['card_date'];
        $cardCvc = $_POST['card_cvc'];
        $people = $_POST['people'];
        $stayDate = $_POST['stay_date'];
        $stayDays = $_POST['stay_days'];
        $arrivalTime = $_POST['arrival_time'];
        $smoking = isset($_POST['smoking']) ? 'Yes' : 'No';
        $babyBed = isset($_POST['baby_bed']) ? 'Yes' : 'No';
        $airConditioning = isset($_POST['air_conditioning']) ? 'Yes' : 'No';

        // Wyświetlamy dane z formularza w podsumowaniu z kategoriami
        echo "<h2>Personal Information</h2>";
        echo "Name: " . $name . "<br>";
        echo "Surname: " . $surname . "<br>";
        echo "Address: " . $address . "<br>";
        echo "Email: " . $email . "<br>";

        echo "<h2>Payment Information</h2>";
        echo "Card Number: " . $cardNumber . "<br>";
        echo "Card Expiry Date: " . $cardDate . "<br>";
        echo "Card CVC: " . $cardCvc . "<br>";

        echo "<h2>Reservation Details</h2>";
        echo "Number of People: " . $people . "<br>";
        echo "Stay Date: " . $stayDate . "<br>";
        echo "Number of Stay Days: " . $stayDays . "<br>";
        echo "Arrival Time: " . $arrivalTime . "<br>";

        echo "<h2>Additional Options</h2>";
        echo "Smoking Room: " . $smoking . "<br>";
        echo "Baby Bed: " . $babyBed . "<br>";
        echo "Air Conditioning: " . $airConditioning . "<br>";
        ?>

    </div>

</body>

</html>