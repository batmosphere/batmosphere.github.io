
<?php

	$test = array(1,2,3, "pizza");



	print_r($test);
	echo $test[3];

	echo "<br />";
	echo "<br />";

	$array[0] =  10;

	$array[1] = 11;

	print_r($array);

	echo "<br />";
	echo "<br />";

	$num = array(
		"france" => "french",
		"usa" => "engkish"
	);

	print_r($num);
 
 	echo "<br />";
 	echo "<br />";

 	$test[] = "salad";

 	print_r($test);

 	echo "<br />";
	echo "<br />";

	unset($num["usa"]);

	print_r($num);

	echo "<br />";
	echo "<br />";

	$abc = "mukund";

	unset($abc);

	echo $abc;
?>