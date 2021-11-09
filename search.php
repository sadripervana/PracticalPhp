<?php
session_start();
if (!isset($_SESSION['user_level']) or
	($_SESSION['user_level'] != 1))
{
	header("Location: login.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Search page</title>
	<link rel="stylesheet" href="includes.css">
	<style> 
		h3.red{
			color: red;
			font-size: 105%;
			font-weight: bold;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
		<?php include("header-admin.php"); ?>
		<?php include("nav.php"); ?>
		<?php include("info-col.php"); ?>
		<div id="content">
			<!--Start of search page content-->
			<h2>Search for a Record</h2>
			<h3 class="red">Both Names are required items</h3>
			<form action="view_found_record.php" method="post">
				<p>
					<label class="label" for="fname">First Name:</label>
					<input id="fname" type="text" name="fname" size="30" maxlength="30"
					value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">
				</p>
				<p>
					<label class="label" for="lname">Last Name:</label>
					<input id="lname" type="text" name="lname" size="30" maxlength="40"
					value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"></p>
					<p>
						<input id="submit" type="submit" name="submit" value="Search">
					</p>
				</form>\<?php include ('footer.php'); ?>
			<!--End of the search page content-->
			</div>
		</div>
	</body>
	</html>