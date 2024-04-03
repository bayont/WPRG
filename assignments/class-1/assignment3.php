<ol>
<?php
	$N = 12;
	$fib = array(0, 1);
	echo '<li>0</li><li>1</li>';
	for($i = 2; $i < $N; $i++) {
		$fib[] = $fib[$i-2] + $fib[$i-1];
		echo '<li>'.$fib[$i].'</li>';
	}
?>
</ol>
