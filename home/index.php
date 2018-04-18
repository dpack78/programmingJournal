<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/init.php");

$Goal = new Goal($DB);
$Entry = new Entry($DB);
$a_yesterdaysEntry = $Entry->getYesterdayEntryText();
$a_goal = $Goal->getYesterdayGoalAnswers($a_yesterdaysEntry['entryID']);

$a_shouldBeSet = [
	"pageName",
	"tomorrowsGoals",
	"pageName", 
	"currentLineNumber"
];

foreach($a_shouldBeSet as $thisVar){
	if(!isset($a_yesterdaysEntry[$thisVar])){
		$a_yesterdaysEntry[$thisVar] = "";
	}
}

$aAmount = 0;
$bAmount = 0;
$fAmount = 0;
foreach($a_goal as $thisGoal){
	switch($thisGoal['goal_responseName']){
		case "A":
			$aAmount++;
			break;
		case "B":
			$bAmount++;
			break;
		case "F":
			$fAmount++;
			break;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<header>
<?php include($_SERVER['DOCUMENT_ROOT']."/includes/headElements.php"); ?>

<script>
</script>
</header>
<body>
<!--////////////////////////////BEGINCONTENT/////////////////////////////-->
<?php include($_SERVER['DOCUMENT_ROOT']."/includes/header.php"); ?>
<div class="content">
	<h1>From Yesterday</h1>
	<table>
		<thead>
			<tr>
				<th>Page Number</th>
				<th>Line Number</th>
				<th>A's</th>
				<th>B's</th>
				<th>F's</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php $Util->echoClean($a_yesterdaysEntry['pageName']); ?></td>
				<td><?php $Util->echoClean($a_yesterdaysEntry['currentLineNumber']); ?></td>
				<td><?php echo $aAmount; ?></td>
				<td><?php echo $bAmount; ?></td>
				<td><?php echo $fAmount; ?></td>
			</tr>
		</tbody>
	</table>
	<h2>Brain Pickup</h2>
	<pre><?php echo $Util->echoClean($a_yesterdaysEntry['brainDump']); ?></pre>
	<h2>Goals for Today</h2>
	<pre><?php echo $Util->echoClean($a_yesterdaysEntry['tomorrowsGoals']); ?></pre>
</div>

<!--////////////////////////////ENDCONTENT/////////////////////////////-->
</body>
</html>