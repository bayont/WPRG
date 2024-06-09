<?php
require 'classes/NoweAuto.php';
require 'classes/AutoZDodatkami.php';
require 'classes/Ubezpieczenie.php';

$ubezpieczenie = new Ubezpieczenie('Audi A4', 50000, 4.5, 1000, 500, 2000, 0.01, 2); //2 years owned, price in EUR, exchange rate 4.5

echo $ubezpieczenie->ObliczCene() . ' PLN';
