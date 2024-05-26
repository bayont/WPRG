<?php
    if(!isset($_COOKIE['visits'])) {
        setcookie('visits', 1, time() + 60 * 60 * 24);
        $visits = 1;
    } else {
        $visits = ++$_COOKIE['visits'];
        setcookie('visits', $visits, time() + 60 * 60 * 24);
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 14px;
            background-color: #d0f0ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 72px;
        }
        div {
            margin-left: auto;
            margin-right: auto;
        }

        p {
            font-size: 24px;
            font-weight: semibold;
        }
    </style>
</head>
<body>
    <div>
        <?php


    echo 'Visits: ' . $visits;
    if($visits >= 10){
        echo "<br> <p>You're visiting this page for the {$visits} time! Get some help.</p>";
    }
    ?></div>
</body>
</html>