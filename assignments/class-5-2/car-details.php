<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car details</title>
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <?php
    include_once './navbar.partial.php';
    require_once './includes/dbh.inc.php';

    $id = $_GET['id'];
    $query = 'SELECT * FROM samochody WHERE id = :id';
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $car = $stmt->fetch();
    ?>
    <main>
        <div class="card">
            <h1><?php echo $car['marka'] . ' ' . $car['model']; ?></h1>
            <q><?php echo $car['opis']; ?></q>
            <div class="container">
                <div>
                    <b>Rok produkcji</b> <br> <?php echo $car['rok_produkcji']; ?>
                </div>
                <div>
                    <b>Cena</b> <br> <?php
                                        $price = number_format($car['cena'], 2, ',', ' ');
                                        echo $price . ' zł';
                                        ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>