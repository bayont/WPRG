<?php



//get n number of fibonacci sequence

function fibonacci_recursive($n)
{
    if ($n == 0) {
        return 0;
    } elseif ($n == 1) {
        return 1;
    } else {
        return fibonacci_recursive($n - 1) + fibonacci_recursive($n - 2);
    }

}

function fibonacci_iterative($n)
{
    $fibonacci = [0, 1];
    for ($i = 2; $i <= $n; $i++) {
        $fibonacci[$i] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
    }
    return $fibonacci[$n];
}


$user_input = $_GET['n'];

// measure time of execution

$start = microtime(true);

$fibonacci_recursive = fibonacci_iterative($user_input);

$end = microtime(true);

$execution_time_recursive = $end - $start;

$start = microtime(true);
$fibonacci_iterative = fibonacci_iterative($user_input);
$end = microtime(true);
$execution_time_iterative = $end - $start;

# tell which was faster and by how much
if ($execution_time_recursive < $execution_time_iterative) {
    $faster = 'recursive';
    $slower = 'iterative';
    $difference = $execution_time_iterative - $execution_time_recursive;
} else {
    $faster = 'iterative';
    $slower = 'recursive';
    $difference = $execution_time_recursive - $execution_time_iterative;
}


echo "Fibonacci number at position $user_input is $fibonacci_recursive <br><br>";
echo "Fibonacci " . $faster . " was faster than " . "Fibonacci " . $slower . " by " . $difference . " seconds";