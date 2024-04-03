<?php
$text = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
galley of type and scrambled it to make a type specimen book. It has survived not only five
centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
and more recently with desktop publishing software like Aldus PageMaker including versions of
Lorem Ipsum.";

$words = explode(" ", $text);
$special_chars = ["'", '.', ','];
for ($i = 0; $i < count($words); $i++) {
	$has_special_char = false;
	foreach ($special_chars as $char) {
		if (strpos($words[$i], $char) !== false) {
			$has_special_char = true;
			break;
		}
	}
	
	if ($has_special_char) {
		$words[$i] = str_replace($special_chars, "", $words[$i]);
	}
}
$association_array = [];
foreach($words as $key => $value) {
	if($key % 2 == 0 && $key != count($words) - 1) {
		$association_array[$value] = $words[$key + 1];
	}
}

foreach($association_array as $key => $value) {
	echo $key . " => " . $value . "<br>";
}
?>
