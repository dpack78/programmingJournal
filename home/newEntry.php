<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/init.php");

$Goal = new Goal($DB);
$a_goal = $Goal->getCurrentGoals();
?>

<!DOCTYPE html>
<html lang="en">
<header>
<?php include($_SERVER['DOCUMENT_ROOT']."/includes/headElements.php"); ?>

<script>
$(function(){
	$("#pageName").focus();
});
</script>
</header>
<body>
<!--////////////////////////////BEGINCONTENT/////////////////////////////-->
<?php include($_SERVER['DOCUMENT_ROOT']."/includes/header.php"); ?>
<div class="content">
	<div id="currentFrame">
		<form id="newEntryForm" action="r/newEntryAction.php" method="post">
			<h1>Make new entry</h1>
			<div class="formElement">
				<div class="elementTop">
					Current Page Name:
				</div>
				<div class="elementBottom">
					<input type="text" maxlength="256" placeholder="index.php" id="pageName" name="pageName"/>
				</div>
			</div>
			
			<div class="formElement">
				<div class="elementTop">
					Current Line Number:
				</div>
				<div class="elementBottom">
					<input type="text" maxlength="256" placeholder="78" id="lineNumber" name="lineNumber"/>
				</div>
			</div>
			<br>
			<div class="formElement">
				<div class="elementTop">
					Brain Dump:
				</div>
				<div class="elementBottom">
					<textarea placeholder="I am currently working on..." rows="7" cols="100" name="brainDump"></textarea>
				</div>
			</div>
			
			<div class="formElement">
				<div class="elementTop">
					What I got done:
				</div>
				<div class="elementBottom">
					<textarea placeholder="" rows="7" cols="100" name="accomplished"></textarea>
				</div>
			</div>
			
			<div class="formElement">
				<div class="elementTop">
					What I would like to get done tomorrow:
				</div>
				<div class="elementBottom">
					<textarea placeholder="" rows="7" cols="100" placeholder="Tomorrow I would like to..." name="tomorrowsGoals"></textarea>
				</div>
			</div>
			<br>
			<h2>Goals</h2>
			<?php foreach($a_goal as $thisGoal){ ?>
				<div class="formElement">
					<div class="elementTop">
						<?php echo $thisGoal['questionName']; ?>
					</div>
					<div class="elementBottom">
						<input type='radio' name='goal[<?php echo $thisGoal['goalID']; ?>]' id='goal_a_<?php echo $thisGoal['goalID']; ?>' value='1' required/>
						<label for='goal_a_<?php echo $thisGoal['goalID']; ?>'>A - <?php echo $thisGoal['a_name'] ?></label><br>
						<input type='radio' name='goal[<?php echo $thisGoal['goalID']; ?>]' id='goal_b_<?php echo $thisGoal['goalID']; ?>' value='2'/>
						<label for='goal_b_<?php echo $thisGoal['goalID']; ?>'>B - <?php echo $thisGoal['b_name'] ?></label><br>
						<input type='radio' name='goal[<?php echo $thisGoal['goalID']; ?>]' id='goal_f_<?php echo $thisGoal['goalID']; ?>' value='3'/>
						<label for='goal_f_<?php echo $thisGoal['goalID']; ?>'>F - <?php echo $thisGoal['f_name'] ?></label><br>
					</div>
				</div>
			<?php } ?>
			<button type="submit">Save Entry</button>
		</form>
	</div>
</div>

<!--////////////////////////////ENDCONTENT/////////////////////////////-->
</body>
</html>