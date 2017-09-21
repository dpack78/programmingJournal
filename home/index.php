<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/init.php");

$Goal = new Goal($DB);
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
				<td>index.php</td>
				<td>78</td>
				<td>2</td>
				<td>1</td>
				<td>0</td>
			</tr>
		</tbody>
	</table>
	<h2>Brain Pickup</h2>
	<pre></pre>
	<h2>Goals for Today</h2>
	<pre></pre>
</div>

<!--////////////////////////////ENDCONTENT/////////////////////////////-->
</body>
</html>