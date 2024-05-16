<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (file_exists("counter.txt")) {
        $contents = file_get_contents("counter.txt");
        $contents++;
        file_put_contents("counter.txt", $contents);
    } else {
        $contents = 1;
        file_put_contents("counter.txt", $contents);
    }

    echo "You are visitor number " . $contents;
    ?>
</body>

</html>