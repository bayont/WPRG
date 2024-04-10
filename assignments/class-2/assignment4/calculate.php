<?php
function is_prime($number)
{
    $iterations = 0;
    $isPrime = true;

    if ($number <= 1) {
        $isPrime = false;
    } else {
        for ($i = 2; $i * $i <= $number; $i++) {
            $iterations++;
            if ($number % $i == 0) {
                $isPrime = false;
                break;
            }
        }
    }

    echo "Liczba iteracji: $iterations<br>";
    return $isPrime ? 'Podana liczba jest liczbą pierwszą' : 'Podana liczba nie jest liczbą pierwszą';
}

$number = intval($_GET['number']);
if (!is_integer($number) || $number <= 0) {
    echo 'Podana wartość nie jest liczbą całkowitą dodatnią';
    die();
}

echo is_prime($number);

