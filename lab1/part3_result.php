<?php
header('Content-Type: text/plain');
function firstMondayOfYear($year){
	$date = date('Y-m-d', strtotime("first Monday of January $year"));
	$day = date('jS', strtotime($date));
	$month = date('F', strtotime($date));
	return "$day $month";
}
if(!$_POST["start"] || !$_POST["end"]){
	echo "start or end missing";
	exit();
}
$start = intval($_POST["start"]);
$end = intval($_POST["end"]);
if($start<1||$end<1||$end<$start){
	echo "invalid start or end";
	exit();
}
for($year=$start;$year<=$end;$year++){
	echo "The first monday of the year " . $year . " is " . firstMondayOfYear($year) . "\n";
}
?>
