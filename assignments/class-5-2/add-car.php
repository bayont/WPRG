<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj samochód</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php
    include_once './navbar.partial.php';
    ?>
    <main>
        <h1>Dodaj samochód</h1>
        <h2>Powiększ naszą flotę o swoją perełkę</h2>
        <form action="./includes/add-car.inc.php" method="post">
            <fieldset>
                <legend>Podstawowe informacje</legend>
                <label for="marka">Marka</label>
                <input type="text" name="brand" id="marka" required>
                <br>
                <label for="model">Model</label>
                <input type="text" name="model" id="model" required>
                <br>
                <label for="rok_produkcji">Rok produkcji</label>
                <input type="number" name="year" id="rok_produkcji" required min="1900" max="2021">
                <br>
                <label for="cena">Cena</label>
                <input type="number" name="price" id="cena" required min="0" step="0.01">
                <br>
            </fieldset>
            <fieldset>
                <legend>Opis</legend>
                <textarea name="description" id="opis" cols="30" rows="10" required></textarea>
            </fieldset>
            <input type="submit" value="Dodaj samochód">
        </form>
    </main>
</body>

</html>