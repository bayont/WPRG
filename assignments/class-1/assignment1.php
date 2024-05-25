<?php
$fruits = ['apple', 'banana', 'orange'];
for($i = 0; $i < count($fruits); $i++) {
	$word = '';
	for($j = strlen($fruits[$i]) - 1; $j >= 0; $j--) {
		$word .= $fruits[$i][$j];
	}
	echo $word.'<br />';
}
?>
