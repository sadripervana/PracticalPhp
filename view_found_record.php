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
	<title>a temporary view_found_record page</title>
	<link rel="stylesheet" href="includes.css">
	<style>
		p {
			text-align: center;
		}
	</style>
</head>
<body>
	<div id="container">
		<?php include("header-admin.php"); ?>
		<?php include("nav.php"); ?>
		<?php include("info-col.php"); ?>
		<div id="content"><!--Start of the page content-->
			<h2>Search Result</h2>
			<p>
				<?php 
				// This script retrieves records from the users table.
						require ('mysqli_connect.php'); // Connect to the database
						echo '<p>If no record is shown, this is because you had an
						incorrect or missing
						entry in the search form.<br>Click the back button on the
						browser and try again</p>';
						$fname=$_POST['fname'];
						$lname=$_POST['lname'];
						$lname = mysqli_real_escape_string($dbcon,$lname);
						$q = "SELECT lname, fname, email, DATE_FORMAT(registration_date, '%M %d, %Y') 
						AS regdat, user_id FROM users WHERE lname ='$lname' AND 
						fname = '$fname' ORDER BY registration_date ASC";
					 $result = @mysqli_query($dbcon, $q); // Run the query 
					 if($result) {
					 	// If it ran , display the records, 
					 	// Display the table headings
					 	echo '<table>
					 	<tr><td><b>Edit</b></td>
					 	<td><b>Delete</b></td>
					 	<td><b>Last Name</b></td>
					 	<td><b>First Name</b></td><td><b>Email</b></td>
					 	<td><b>Date Registered</b></td>
					 	</tr>';
					 	// fetch and dsiplay the records
					 	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					 		echo '<tr>
					 		<td><a href="edit_user.php?id=' .
					 		$row['user_id'] . '">Edit</a></td>
					 		<td><a href="delete_user.php?id=' .
					 		$row['user_id'] . '">Delete</a></td>
					 		<td>' . $row['lname'] . '</td>
					 		<td>' . $row['fname'] . '</td>
					 		<td>' . $row['email'] . '</td>
					 		<td>' . $row['regdat'] . '</td>
					 		</tr>';
					 	}
					 	echo '</table>'; // Close the table
					 	mysqli_free_result ($result); // Free up the resources
					 }else { // If it did not run properly
						// Message
					 	echo '<p class="error">The current users could not
					 	be retrieved. We apologize for
					 	any inconvenience.</p>';
						// Debugging message
					 	echo '<p>' . mysqli_error($dbcon) . '<br>
					 	<br>Query: ' . $q . '</p>';
					 }// End of if ($result). Now display the figurefor total number of records/members
					 $q = "SELECT COUNT(user_id) FROM users";
					 $result = @mysqli_query ($dbcon, $q);
					 $row = @mysqli_fetch_array ($result, MYSQLI_NUM);
					 $members = $row[0];
						mysqli_close($dbcon); // Close the databaseconnection
						echo "<p>Total membership: $members</p>";?>
					</div><!--End of administration page content-->
					<?php include("footer.php"); ?>
				</div>
			</body>
			</html>