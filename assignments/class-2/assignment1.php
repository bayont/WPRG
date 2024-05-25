<head>
    <style>
        .result {
            font-size: larger;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Simple calculator</h1>
    <form action="" method="GET">
        <input type="number" name="first_number" placeholder="Enter #1 number">
        <select name="operator" id="operator">
            <option value="plus">+</option>
            <option value="minus">-</option>
            <option value="divide">/</option>
            <option value="multiplicate">*</option>
        </select>
        <input type="number" name="second_number" placeholder="Enter #2 number">
        <br />
        <input type="submit" value="Submit">
    </form>

    <div class="result">
        <span>Wynik: </span>
        <span>
            <?php
            //sprawdzamy czy zmienne są ustawione
            if (isset($_GET['first_number']) && isset($_GET['second_number']) && isset($_GET['operator'])) {
                $num1 = $_GET['first_number'];
                $num2 = $_GET['second_number'];
                $res = 0;
                switch ($_GET['operator']) {
                    case 'plus':
                        $res = $num1 + $num2;
                        $operation = '+';
                        break;
                    case 'minus':
                        $res = $num1 + $num2;
                        $operation = '-';
                        break;
                    case 'divide':
                        $operation = '/';
                        if ($num2 == 0) {
                            $res = "nie dziel przez 0!";
                            break;
                        }
                        $res = $num1 / $num2;
                        break;
                    case 'multiplicate':
                        $operation = '*';
                        $res = $num1 * $num2;
                        break;
                    default:
                        $operation = 'NIEZNANA OPERACJA';
                        break;
                }
                echo $num1 . " " . $operation . " " . $num2 . " = ";
                echo $res;
            }

            ?>
        </span>
    </div>
</body>