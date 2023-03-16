<?php
header("Content-Type: text/plain");
echo "Part 2, subtask 1\n";
$letters = array("a", "ā", "b", "c", "č", "d", "e", "ē", "f", "g", "ģ","h", "i", "ī", "j", "k", "ķ", "l", "ļ", "m", "n", "ņ", "o", "p", "r", "s", "š", "t", "u", "ū", "v", "z", "ž");
for ($x=0;$x<count($letters);$x++) {
	for($y=0;$y<=$x;$y++){
		echo $letters[$y];
	}
	echo "\n";
}

echo "Part 2, subtask 2\n";
function firstMondayOfYear($year){
	$date = date('Y-m-d', strtotime("first Monday of January $year"));
	$day = date('jS', strtotime($date));
	$month = date('F', strtotime($date));
	return "$day $month";
}
$years = [2023, 2030, 2016, 2017];
foreach($years as $year){
	echo "The first monday of the year " . $year . " is " . firstMondayOfYear($year) . "\n";
}

?>
