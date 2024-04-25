<?php
function handleDirectory($path, $directory, $operation = 'read')
{
    if (substr($path, -1) !== '/') {
        $path .= '/';
    }
    if ($operation === 'read') {
        if (is_dir($path . $directory)) {
            $elements = scandir($path . $directory);
            $elements = array_diff($elements, ['.', '..']);
            return "Directories found: " . count($elements) . "<br>Directories: " . implode(", ", $elements) . "<br>";
        } else {
            return "Directory does not exist";
        }
    } elseif ($operation === 'delete') {
        if (is_dir($path . $directory)) {
            if (count(scandir($path . $directory)) === 2) {
                rmdir($path . $directory);
                return "Directory deleted";
            } else {
                return "Directory is not empty";
            }
        } else {
            return "Directory does not exist";
        }
    } elseif ($operation === 'create') {
        if (!is_dir($path . $directory)) {
            mkdir($path . $directory);
            return "Directory created";
        } else {
            return "Directory already exists";
        }
    }
}

$path = $_GET['path'];
$directory = $_GET['dir'];
$operation = $_GET['operation'];
echo handleDirectory($path, $directory, $operation);