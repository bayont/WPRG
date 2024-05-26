<?php
    $skip_counting = true;
    session_start();
    $sessionID = session_id();
    if(!file_exists("known_sessions.txt")) {
        file_put_contents("known_sessions.txt", "");
    }
    $contents = file_get_contents("known_sessions.txt");
    $knownSessions = explode("\n", $contents);
    if(!in_array($sessionID, $knownSessions)){
        $skip_counting = false;
        $knownSessions[] = $sessionID;
        file_put_contents("known_sessions.txt", implode("\n", $knownSessions));
    }

    if(!isset($_COOKIE['visits'])) {
        setcookie('visits', 1, time() + 60 * 60 * 24);
        $visits = 1;
    } else if(!$skip_counting) {
        $visits = ++$_COOKIE['visits'];
        setcookie('visits', $visits, time() + 60 * 60 * 24);
    }
    else {
        $visits = $_COOKIE['visits'];
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