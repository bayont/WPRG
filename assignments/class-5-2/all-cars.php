<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wszystkie samochody</title>
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <?php
    include_once './navbar.partial.php';
    require_once './includes/dbh.inc.php';
    $query = 'SELECT * FROM samochody ORDER BY rok_produkcji DESC';
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $cars = $stmt->fetchAll();
    ?>

    <main>
        <h1>Wszystkie samochody</h1>
        <h2>Cała nasza flota</h2>
        <table>
            <tr>
                <th>id</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Rok produkcji</th>
                <th>Cena</th>
                <th>Szczegóły</th>
            </tr>
            <?php
            foreach ($cars as $car) {
                echo '<tr>';
                echo '<td>' . $car['id'] . '</td>';
                echo '<td>' . $car['marka'] . '</td>';
                echo '<td>' . $car['model'] . '</td>';
                echo '<td>' . $car['rok_produkcji'] . '</td>';
                echo '<td>' . $car['cena'] . '</td>';
                echo '<td><a href="car-details.php?id=' . $car['id'] . '">Szczegóły</a></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </main>
</body>

</html>