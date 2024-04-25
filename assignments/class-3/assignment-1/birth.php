<?php

function getDayOfWeek($date)
{
    return date('l', strtotime($date));
}

function getAge($date)
{
    return date_diff(date_create($date), date_create('today'))->y;
}

function getDaysToNextBirthday($date)
{
    $today = date_create('today');
    $nextBirthday = date_create($date);
    $nextBirthday->setDate(date('Y'), date('m', strtotime($date)), date('d', strtotime($date)));
    if ($nextBirthday < $today) {
        $nextBirthday->modify('+1 year');
    }
    return date_diff($today, $nextBirthday)->days;
}

$birthDate = $_GET['dob'];

echo "Your birth date is: $birthDate <br>";
echo "You were born on: " . getDayOfWeek($birthDate) . "<br>";
echo "You are " . getAge($birthDate) . " years old <br>";
echo "There are " . getDaysToNextBirthday($birthDate) . " days to your next birthday <br>";
