<?php 
session_start();
if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)){
	header("Location:login.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View found address page</title>
	<style type="text/css">
		p{
			text-align: center;
		}
		table, tr { width: 850px; }
	</style>
</head>
<body>
	<div id="container">
		<?php include("includes/header-admin.php"); ?>
		<?php include("includes/nav.php"); ?>
		<?php include("includes/info-col.php"); ?>
		<div id="content"><!--Start of the page content-->
			<h2>Search Result</h2>
			<?php
		// This script fetches selected records from the users table
		require ('mysqli_connect.php'); // Connect to the database
		echo '<p>If no record is shown, this is because of an incorrect or missing entry in 
		the search form.<br>Click the Search button and try again</p>';
		$fname = $_POST['fname'];
		$fname = mysqli_real_escape_string($dbcon, $fname);
		$lname = $_POST['lname'];
		$lname = mysqli_real_escape_string($dbcon, $lname);
		$q = "SELECT title, lname, fname, addr1, addr2, city, county, pcode, phone, user_id 
		FROM users WHERE lname='$lname' AND fname='$fname' ";
		$result = @mysqli_query ($dbcon, $q); // Run the query
		if ($result) { // If it ran, display the records
		// Table headings
			echo '<table>
			<tr><td><b>Edit</b></td>
			<td><b>Title</b></td>
			<td><b>Last Name</b></td>
			<td><b>First Name</b></td>
			<td><b>Addrs1</b></td>
			<td><b>Addrs2</b></td>
			<td><b>City</b></td>
			<td><b>County</b></td>
			<td><b>Pcode</b></td>
			<td><b>Phone</b></td>
			</tr>';
		// Fetch and display the records
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo '<tr>
				<td><a href="edit_address.php?id=' . $row['user_id'] . '">Edit</a></td>
				<td>' . $row['title'] . '</td>
				<td>' . $row['lname'] . '</td>
				<td>' . $row['fname'] . '</td>
				<td>' . $row['addr1'] . '</td>
				<td>' . $row['addr2'] . '</td>
				<td>' . $row['city'] . '</td>
				<td>' . $row['county'] . '</td>
				<td>' . $row['pcode'] . '</td>
				<td>' . $row['phone'] . '</td>
				</tr>';
		}echo '</table>'; // Close the table
		mysqli_free_result ($result); // Free up the resources
		} else { // If it failed to run
		// Display message
			echo '<p class="error">The current users could not be retrieved. We apologize for  any inconvenience.</p>';
			// Debugging message
			echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
			} // End of the if ($result)
			//Now display a figure for the total number of records/members
			$q = "SELECT COUNT(user_id) FROM users";
			$result = @mysqli_query ($dbcon, $q);
			$row = @mysqli_fetch_array ($result, MYSQLI_NUM);
			$members = $row[0];
			mysqli_close($dbcon); //Close the database connection
			echo "<p>Total membership: $members</p>";
			?>
		</div><!-- End of found address page -->
		<?php include("includes/footer.php"); ?>
	</div>
</body>
</html>
