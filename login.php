<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>The Login page</title>
	<link rel="stylesheet" href="includes.css">
</head>
<body>
	<div id="container">
		<?php include("login-header.php");?>
		<?php include("nav.php");?>
		<?php include("info-col.php");?>

		<!-- Start of the login page content -->
		<div id="content"> 
			<?PHP 
			// Tthis section processes submission from the login form
			// Check if the form has been submitted:
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//connect to database 
				require("mysqli_connect.php"); 
				 //Validate the email address 
				if(!empty($_POST['email'])){
					$e = mysqli_real_escape_string($dbcon, $_POST['email']);
				} else {
					$e = FALSE; 
					echo '<p class="error"> You forgot to enter your email address.</p>';
				}
				 // Validate the password 
				if(!empty($_POST['psword'])){
					$p = mysqli_real_escape_string($dbcon, $_POST['psword']);
				} else {
					$p = FALSE; 
					echo '<p class="error">Your forgot to enter your password.</p>';
				 } if($e && $p){//if no problems 
				 //Retrieve the user_id, first_name and user-level From that email/password combination 
				 	$q = "SELECT user_id, fname, user_level FROM users WHERE (email='$e' AND psword=SHA1('$p'))"; 
				 	//Run the query and assign it to the variable 
				 	$result = mysqli_query($dbcon, $q);
				 	//Count the number of rows that match the email/password combination 
				 	if(@mysqli_num_rows($result) == 1) { //if one 
				 		// database row (record) matches the input :=
				 		// //Start the session, fetch the record and insert the three values in an array 
				 		session_start();
				 		$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
				 		// Ensure that the user level is an integer .
				 		$_SESSION['user_level'] = (int)
				 		$_SESSION['user_level'];

				 		//Use a ternary operation to set the URL
				 		$url = ($_SESSION['user_level'] === 1) ? 'admintable/admin-page.php' : 'members-page.php'; 
				 		header('Location: ' . $url); // Make the browser
				 		//load either the members’ or the admin page
						//exit(); // Cancel the rest of the script
				 		mysqli_free_result($result);
				 		mysqli_close($dbcon);
				 	} else {
				 		// No match was made. 
				 		echo '<p class="error"> The e-mail address and password entered do not matche our records  
				 		<br> Perhaps you need to register, just click the Register button on the header menu</p>';
				 	}
				 } else {
				 	// If there was a problem. 
				 	echo '<p class="error">Please try again.</p>';
				 }
				 mysqli_close($dbcon);
				}			
				?>
				<!-- Display the form fields -->
				<div id="loginfields">
					<?php include('login_page.inc.php'); ?> 
				</div> <br>
				<?php include('footer.php'); ?> 
			</div>
		</div>
	</body>
	</html>