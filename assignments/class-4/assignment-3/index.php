<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Odnośniki</h1>
    <h2>Lista</h2>
    <table>
        <tr>
            <th>Adres</th>
            <th>Opis</th>
        </tr>
        <?php
        $file = fopen("links.txt", "r");
        while (!feof($file)) {
            $line = fgets($file);
            if (empty($line)) {
                continue;
            }
            $line = explode(";", $line);
            echo "<tr>";
            echo "<td><a href='" . $line[0] . "'>" . $line[0] . "</a></td>";
            echo "<td>" . $line[1] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <h2>Dodaj odnośnik</h2>
    <form action="add-link.php" method="post">
        <label for="url">Adres:</label>
        <input type="text" name="url" id="url">
        <label for="description">Opis:</label>
        <input type="text" name="description" id="description">
        <input type="submit" value="Dodaj">
</body>

</html>