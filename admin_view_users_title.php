<?php 
// Make the query 
$q = "SELECT title, lname, fname, email, DATE_FORMAT(registtration_date, '%M %d, %Y')
AS regdat, class ,paid, user_id FROM users ORDER BY registration_date DESC 
LIMIT $start, $pagerows";
$result = @mysqli_query($dbcon, $q); //Run the query
$members = mysqli_num_rows($result);
if($result){ //If the query ran OK, display the records
	// Table headings
	echo '<table>
	<tr><td><b>Edit</b></td>
	<td><b>Delete</b></td>
	<td><b>Title</b></td>
	<td><b>Last Name</b></td>
	<td><b>First Name</b></td>
	<td><b>Email</b></td>
	<td><b>Date Registered</b></td>
	<td><b>Class</b></td>
	<td><b>Paid</b></td>
	</tr>';
	//Fetch and display all the records
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo '
		<tr>
			<td><a href="edit_record.php?id=' . $row['user_id'] . '">Edit</a></td>
		    <td><a href="delete_record.php?id=' . $row['user_id'] . '">Delete</a></td>
			<td>' . $row['title'] . '</td>
			<td>' . $row['lname'] . '</td>
			<td>' . $row['fname'] . '</td>
			<td>' . $row['email'] . '</td>
			<td>' . $row['regdat'] . '</td>
			<td>' . $row['class'] . '</td>
			<td>' . $row['paid'] . '</td>
		</tr>';
	}
	echo '</table>'; //Close the table 
	mysqli_free_result($result); //FREE up the resources

} else { // If the query did not run OK
	//Error message
	echo 'No changes were needed to the rest of the file.
	For you to be able to access the amended file, the menu button link in the file header_admin.php has been changed from 
	admin_view_users.php to admin_view_users_title.php.';
}
?>