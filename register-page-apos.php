<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register page for apostrophes</title>
	<link rel="stylesheet" href="includes.css">
</head>
<body>
	<div id="container">
		<?php include("header.php");  ?>
		<?php include("nav.php");  ?>
		<?php include("info-col.php");  ?>
		<div id="content">
			<p>
				<?php 
				//The link to the database is moved here to the top of the php code. 
				require('mysqli_connect.php'); //Connect tho the db.
				//This query Inserts a records in the users table.
				// Scroll down to find the piece of code listed next, and change the line 
				// as show im bold type:
				// Check for a last name:
				if(empty($_Post['lname'])){
					$errors[] = 'You forgot to enter your last name.';
				} else {
					$ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
				}

				if(empty($errors)){
					// If everything's OK,register the user in the database
				//require ('mysqli_connect.php'); // Connect tothe database.
			}
			?>
		</p>
	</div>
</div>
</body>
</html>