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
        $guestsFirstNames = $_POST['guest_name'];
        $guestsLastNames = $_POST['guest_surname'];
        $guestsAges = $_POST['guest_age'];
        $guests = array();
        // Stworzymy tablicę z danymi gości
        for ($i = 0; $i < count($guestsFirstNames); $i++) {
            $guests[] = array(
                'name' => $guestsFirstNames[$i],
                'surname' => $guestsLastNames[$i],
                'age' => $guestsAges[$i]
            );
        }

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

        echo "<h2>Guests Details</h2>";
        foreach ($guests as $index => $guest) {
            echo "<h3>Guest " . ($index + 1) . "</h3>";
            echo "Name: " . $guest['name'] . "<br>";
            echo "Surname: " . $guest['surname'] . "<br>";
            echo "Age: " . $guest['age'] . "<br>";
        }

        echo "<h2>Additional Options</h2>";
        echo "Smoking Room: " . $smoking . "<br>";
        echo "Baby Bed: " . $babyBed . "<br>";
        echo "Air Conditioning: " . $airConditioning . "<br>";
        ?>

    </div>

</body>

</html>