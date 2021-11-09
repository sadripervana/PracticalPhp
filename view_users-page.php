<?php 
session_start();
if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1))
{
	header('Location: login.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>An Administrator's View-members page</title>
	<link rel="stylesheet" href="includes.css">
</head>
<body>
	<div id="container">
		<?php 
		include 'header-admin.php';
		include('nav.php');
		include('info-col.php');
		?>
		<div id="content">
			<!-- Start of the view_user_page content -->
			<h2>These are the registered users</h2>
			<p>
				<?php 
 				// This script retrives all the records from the users table
 				require('mysqli_connect.php'); //Connect to the database
 				// Make the query 
 				$q = "SELECT lname, fname, email,
 				DATE_FORMAT(registration_date, '%M %d, %Y')
 				AS regdat, user_id FROM users ORDER BY
 				registration_date ASC";
				$result = @mysqli_query ($dbcon, $q); //Run the query 
				if($result) {
 					// If it ran without a problem, display the records 
 					// table headings
					echo '<table>
					<tr>
					<td><b>Edit</b></td>
					<td><b>Delete</b></td>
					<td><b>Last Name</b></td>
					<td><b>First Name</b></td>
					<td><b>Email</b></td>
					<td><b>Date Registered</b></td>
					</tr>';
					// Fetch and print all therecords
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						echo
						'<tr>
						<td><a href="edit_user.php?id=' . $row['user_id'] .
						'">Edit</a></td>
						<td><a href="delete_user.php?id=' . $row['user_id'] .
						'">Delete</a></td>
						<td>' . $row['lname'] .
						'</td>
						<td>' . $row['fname'] . '</td>
						<td>' . $row['email'] . '</td>
						<td>' . $row['regdat'] . '</td></tr>';
					}
 					echo '</table>'; // Close thetable
					mysqli_free_result ($result); // Free up the resources
					} else { // If it failed to run
					// Error message
						echo '<p class="error">The current users could not
						be retrieved. We apologize
						for any inconvenience.</p>';
						// Debugging message
						echo '<p>' . mysqli_error($dbcon) . '<br><br/>Query: ' . $q . '</p>';
					} //End of if ($result)
					mysqli_close($dbcon); //close the database connection

					?>
				</p>
			</div>
		</div>

	</body>
	</html>