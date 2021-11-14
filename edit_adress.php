<?php 
session_start();
if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1))
	header("Location: login.php"); 
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit an address or phone number</title>
	<style type="text/css">
		p{
			text-align: center;
		}input.fi-left {float: left;}
		#submit {float: left;}
	</style>
</head>
<body>
	<div id="container">
		<?php include("includes/header-admin.php"); ?>
		<?php include("includes/nav.php"); ?>
		<?php include("includes/info-col-cards.php"); ?>
		<div id="content"><!-- Start of the page-for editing addresses and phone numbers -->
			<h2>Edit an Address or Phone number</h2>
			<?php 
				//Click the Edit Link in view_found_address.php page and this editing interface appears
				//Look For a valid user ID, either through GET or POST
				if((isset($_GET['id'])) && (is_numeric($_GET['id']))){ // Form view_users.php
					$id = $_GET['id'];
				} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))){ Form submission
					$id = $_POST['id'];
				} else { //If no valid ID, quit the script
					echo '<p class="error"> This page has been accessed in error.</p>';
					include('includes/footer.php');
					exit();
				}
				require ('mysqli_connect.php');
				// Has the Form been submitted?
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$errors = array();
					// Look for the title 
					if(empty($_POST['title'])){
						$errors[] = 'You forgot to enter the title.';
					} else{
						$title = mysqli_real_escape_string($dbcon, trim($_POST['title']));
					}
					// 
					if(empty($_POST['fname'])){
						$errors[] = 'You forgot to enter the first name.';
					} else {
						$fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
					}
					// Look for the last name 
					if(empty($_POST['lname'])){
						$errors[] = 'You forgot to enter the last name.';
					} else {
						$ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
					}
					// Look firt the 1st addresss
					if(empty($_POST['addr1'])){
						$errors[] = 'You forgot to enter the first address.';
					} else {
						$addr1 = mysqli_real_escape_string($dbcon, trim($_POST['addr1'])); 
					}
 					// Look for the address 2 
					if(!empty($_POST['addr2'])){
						$addr2 = mysqli_real_escape_string($dbcon, trim($_POST['addr2']));
					} else {
						$addr2 = null;
					}
 					// Look for the city 
					if(empty($_POST['city'])){
						$errors[] = 'You forgot to change the city.';
					} else {
						$city = mysqli_real_escape_string($dbcon, trim($_POST['city'])); 
					}
 					// Look for the country 
					if(empty($_POST['country'])){
						$errors[] = 'You forgot to change the country.'; 
					} else {
						$country = mysqli_real_escape_string($$dbcon, trim($_POST['country'])); 
					}
 					// Look for the post code 
					if(empty($_POST['pcode'])){
						$errors[] = 'You forgot to enter the post code.'; 
					} else {
						$pcode = mysqli_real_escape_string($dbcon, trim($_POST['pcode'])); 
					} 
 					// Look for the phone number
					if(!empty($_POST['phone'])){
						$phone = mysqli_real_escape_string($dbcon, trim($_POST['phone'])); 
					} else {
						$phone = NULL;
					}
					if(empty($errors)){
 						//If the entries are OK
 						//Make the query
						$q = "SELECT user_id FROM users WHERE lname ='$ln' AND user_id != $id";
						$result = @mysqli_query($dbcon, $q);
						if(mysqli_num_rows($result) == 0){
 							// Make the update query
							$q = "UPDATE users SET title = '$title', $fname = '$fn', lname = '$ln', addr1= '$addr1',
							addr2 = '$addr2', city = '$city', country = '$country', pcode = '$pcode', phone = '$phone'
							Where user_id = $id Limit 1";
							$result = @mysqli_query($dbcon, $q);
 							if(mysqli_affected_rows($dbcon) == 1) {// If it ran OK
 								// Echo a message if the edit was satisfactory:
 								echo '<h3> The user has been edited. </h3>';
 							} else {
 								// Echo and error message if the query failed.
 								echo '<p class = "error" > The user was not edited due to a system error.
 								We apologize for the inconvenience</p>' //Error message 
 								echo '<p>' . mysqli_error($dbcon) . '<br/> Query: ' .$q .'</p>'; //Debugging message.
 							}
 						}else {// Display the errors
 							echo '<p class="error">THe following error(s) occurred : <br>';
 							foreach($errors as $msg) { //Echo each error.
 								echo " -$msg<br> \n";
 							} echo '</p> <p> Please Try again</p>';
 						}
 					}//End of id ($empty($errors))section.
 				}//End of the conditionals
 				$q = "SELECT title , fname , lname, addr1, addr2, city, country, pcode, phone FROM users WHERE user_id = $id";
 				$result = @mysqli_query($dbcon, $q);
 						if(mysqli_num_rows($result == 1)){ //Valid user ID, display the form.
 							// Get the user's information:
 							$row = mysqli_fetch_array($result, MYSQLI_NUM);
 							// Create the form
 							echo '<form action="edit_address.php" method="post">
 							<p><label class="label" for="title">Title:</label><input class="fl-left" id="title" 
 							type="text" name="title" size="30" maxlength="30" value="' . $row[0] . '"></p>
 							<p><label class="label" for="fname">First Name:</label><input class="fl-left" id="fname" 
 							type="text" name="fname" size="30" maxlength="30" value="' . $row[1] . '"></p>
 							<p><label class="label" for="lname">Last Name:</label><input class="fl-left" id="lname" 
 							type="text" name="lname" size="30" maxlength="40" value="' . $row[2] . '"></p>
 							<p><label class="label" for="addr1">Address:</label><input class="fl-left" id="addr1" 
 							type="text" name="addr1" size="30" maxlength="50" value="' . $row[3] . '"></p>
 							<p><label class="label" for="addr2">Address:</label><input class="fl-left" 
 							id="addr2"type="text" name="addr2" size="30" maxlength="50" value="' . $row[4] . '"></p>
 							<p><label class="label" for="city">City:</label><input class="fl-left" id="city" 
 							type="text" name="city" size="30" maxlength="30" value="' . $row[5] . '"></p>
 							<p><label class="label" for="county">County:</label><input class="fl-left" 
 							id="county"type="text" name="county" size="30" maxlength="30" value="' . $row[6] . '"></p>
 							<p><label class="label" for="pcode">Post Code:</label><input class="fl-left" 
 							id="pcode"type="text" name="pcode" size="15" maxlength="15" value="' . $row[7] . '"></p>
 							<p><label class="label" for="phone">Phone:</label><input class="fl-left" id="phone" 
 							type="text" name="phone" size="15" maxlength="15" value="' . $row[8] . '"></p>
 							<br><br><p><input id="submit" type="submit" name="submit" value="Edit"></p><br>
 							<input type="hidden" name="id" value="' . $id . '">
 							</form>';
 						} else { // The user could not be validated
 							echo '<p class="error">The page was accessed in error.</p>';
 						}
 						mysqli_close($dbcon);
 						include ('includes/footer.php');
 						?>
 		</div>
 	</div>
 </body>
</html>