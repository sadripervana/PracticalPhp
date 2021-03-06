
<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Safer-register-page.php</title>
	<link rel="stylesheet" type="text/css"href="includes.css">
	<style type="text/css">
		#midcol { width:98%; margin:auto; }
		input, select { margin-bottom:5px; }
		h2 { margin-bottom:0; margin-top:5px; }
		h3.content { margin-top:0; }
		.cntr { text-align:center; }
</style>
</head>
<body>
	<div id="container">
		<?php include ("includes/register-header.php");?>
		<?php include ("includes/nav.php");?>
		<?php include ("includes/info-col-cards.php");?>
		<div id="content">
			<!-- Start of the registration page content -->
			<?php
			require ('mysqli_connect.php'); // Connect to thedatabase
			// This code inserts a record into the users table
			// Has the form been submitted?
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$errors = array(); // Start an array namederrors
				$tle = trim($_POST['title']);
				// Strip out HTML code and apply escaping 
				$stripped = mysqli_real_escape_string($dbcon, strip_tags($tle));
				// Get string lenths
				$strlen = mb_strelen($stripped, 'utf8');
				// Chekc stripped string
				if($strlen < 1){
					$errors[] = 'You forgot to enter your title.';
				} else {
					$title = $stripped;
				}
				// Trim the first name
				$name = trim($_POST['fname']);
				// Strip out HTML code and apply escaping 
				$stripped = mysqli_real_escape_string($dbcon, strip_tags($name));
				// Get string lengths
				$strlen = mb_strlen($stripped, 'utf8');
				// Check stripped string
				if( $strlen < 1 ) {
					$errors[] = 'You forgot to enter your first name.';
				}else{
				$fn = $stripped;
				}
				// Trim the last name
				$lnme = trim($_POST['lname']);
				// Strip HTML and apply escaping
				$stripped = mysqli_real_escape_string($dbcon, strip_tags($lnme));
				// Get string lengths
				$strlen = mb_strlen($stripped, 'utf8');
				// Check stripped string
				if( $strlen < 1 ) {
				$errors[] = 'You forgot to enter your last name.';
				}else{
				$ln = $stripped;
				}
				//Set the email variable to FALSE
				$e = FALSE;
				// Check that an email address has been entered
				if (empty($_POST['email'])) {
				$errors[] = 'You forgot to enter your email address.';
				}
				//remove spaces from beginning and end of the email address and validate it
				if (filter_var((trim($_POST['email'])), FILTER_VALIDATE_EMAIL))
				{
				//A valid email address is then registered
				$e = mysqli_real_escape_string($dbcon,(trim($_POST['email'])));
				}else{
					$errors[] = 'Your email is not in the correct format.';
				}
				// Check that a password has been entered, if so, does it match the confirmed password
				if (empty($_POST['psword1'])){
					$errors[] ='Please enter a valid password';
				}
				if(!preg_match('/^\w{8,12}$/', $_POST['psword1']))
				{
					$errors[] = 'Invalid password, use 8 to 12 characters and no spaces.';
				} else{
					$psword1 = $_POST['psword1'];
				}
				if($_POST['psword1'] == $_POST['psword2'])
				{
					$p = mysqli_real_escape_string($dbcon, trim($psword1));
				}else{
					$errors[] = 'Your two password do not match.';
				}
				// Trim the username
				$unme = trim($_POST['uname']);
				// Strip HTML and apply escaping
				$stripped = mysqli_real_escape_string($dbcon, strip_tags($unme));
				// Get string lengths
				$strlen = mb_strlen($stripped, 'utf8');
				// Check stripped string
				if( $strlen < 1 ) {
					$errors[] = 'You forgot to enter your secret username.';
				}else{
					$uname = $stripped;
				}
				// Check for a membership class
				if (empty($_POST['class'])) {
					$errors[] = 'You forgot to choose your membership class.';
				} else {
					$class = trim($_POST['class']);
				}
				// Trim the first address
				$add1 = trim($_POST['addr1']);
				// Strip HTML and apply escaping
				$stripped = mysqli_real_escape_string($dbcon, strip_tags($add1));
				// Get string lengths
				$strlen = mb_strlen($stripped, 'utf8');
				// Check stripped string
				if( $strlen < 1 ) {
					$errors[] = 'You forgot to enter your address.';
				}else{
					$ad1 = $stripped;
				}
				// Trim the second address
				$ad2 = trim($_POST['addr2']);
				// Strip HTML and apply escaping
				$stripped = mysqli_real_escape_string($dbcon, strip_tags($ad2));
				// Get string lengths
				$strlen = mb_strlen($stripped, 'utf8');
				// Check stripped string
				if( $strlen < 1 ) {
					$ad2 = NULL;
				}else{
					$ad2 = $stripped;
				}
				// Trim the city
				$ct = trim($_POST['city']);
				// Strip HTML and apply escaping
				$stripped = mysqli_real_escape_string($dbcon, strip_tags($ct));
				// Get string lengths
				$strlen = mb_strlen($stripped, 'utf8');
				// Check stripped string
				if( $strlen < 1 ) {
					$errors[] = 'You forgot to enter your city.';
				}else{
					$cty = $stripped;
				}
				// Trim the county
				$conty = trim($_POST['county']);
				// Strip HTML and apply escaping
				$stripped = mysqli_real_escape_string($dbcon, strip_tags($conty));
				// Get string lengths
				$strlen = mb_strlen($stripped, 'utf8');
				// Check stripped string
				if( $strlen < 1 ) {
					$errors[] = 'You forgot to enter your county.';
				}else{
					$cnty = $stripped;
				}
				// Trim the post code
				$pcod = trim($_POST['pcode']);
				// Strip HTML and apply escaping
				$stripped = mysqli_real_escape_string($dbcon, strip_tags($pcod));
				// Get string lengths
				$strlen = mb_strlen($stripped, 'utf8');
				// Check stripped string
				if( $strlen < 1 ) {
					$errors[] = 'You forgot to enter your county.';
				}else{
					$pcode = $stripped;
				}
				// Has a phone number been entered?
				if (empty($_POST['phone'])){
					$ph=($_POST['phone']);
				}
				elseif (!empty($_POST['phone'])) {
				// Strip out everything that is not a number
					$phone = preg_replace('/\D+/', '', ($_POST['phone']));
					$ph = $phone;
				}
				if (empty($errors)) { // If no problems occurred
				//Determine whether the email address has alreadybeen registered for a user
					$q = "SELECT user_id FROM users WHERE email = '$e'";
					$result = mysqli_query ($dbcon, $q) ;
				if (mysqli_num_rows($result) == 0){//The mail
				//address was not already registered
				//therefore register the user in the users table
				$q = "INSERT INTO users (user_id, title, fname,
				lname, email, psword, registration_date,
				uname, class, addr1, addr2, city, county, pcode,
				phone, paid) VALUES (null, '$title',
				'$fn', '$ln', '$e', SHA1('$p'), NOW(),
				'$uname','$class', '$ad1', '$ad2', '$cty',
				'$cnty', '$pcode', '$ph', '$pd ' )";
				$result = @mysqli_query ($dbcon, $q); // Run the query
				if ($result) { // If the query ran OK
					header ("location: register-thanks.php");
					exit();
				} else { // If the query did not run OK
				// Errosr message
				echo '<h2>System Error</h2>
				<p class="error">You could not be registered due
				to a system error. We apologize for
				the inconvenience.</p>';
				// Debugging message
				echo '<p>' . mysqli_error($dbcon) . '<br>
				<br>Query: ' . $q . '</p>';
				} // End of if ($result)
					mysqli_close($dbcon); // Close the database connection
				// Include the footer and stop the script
				include ('includes/footer.php');
				exit();
				} else {//The email address is already registered
				echo '
					<p class="error">The email address is not acceptable 
					 because it is already
					registered</p>';
				}
				}else{ // Display the errors
					echo '<h2>Error!</h2>))
					<p class="error">The following error(s) occurred:
					<br>';
					foreach ($errors as $msg) { // Echo each error
						echo " - $msg<br>\n";
					}
					echo '</p><h3>Please try again.</h3><p><br></p>';
				}// End of if (empty($errors))
			} // End of the main Submit conditional
		?>
			<div id="midcol">
				<h2>Membership Registration</h2>
				<h3 class="content"> Items marked with an asterisk * are essential</h3>
				<h3 class="content"> When you click the 'Register' button, you will be switche to a page <br>
					for paying your membership fee with PayPal or a Credit/Debit card 
				</h3>
				<p class="cntr"><b> Membership classess:<b></p>
					Standard 1 year: &pound;30, Standard 5years:
					&pound;125, Armed Forces 1 year: &pound;5,
					<br>Under 21 one year: &pound;2,&nbsp;
					Other: If you can't afford &pound;30 please give
					what you can, minimum &pound;15 
				</p>
				<form action="safer-register-page.php" method="post">
					<label class="label" for="title">Title*</label>
					<input id="title" type="text" name="title" size="15" maxlength="12"
					value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
					<br>
					<label class="label" for="fname">First Name*</label>
					<input id="fname" type="text" name="fname" size="30" maxlength="30" 
					value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">

					<br>
					<label class="label" for="lname">Last Name*</label>
					<input id="lname" type="text" name="lname" size="30" maxlength="40" 
					value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>">

					<br><label class="label" for="email">Email Address*</label>
					<input id="email" type="text" name="email" size="30" maxlength="60" 
					value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">

					<br><label class="label" for="psword1">Password*</label>
					<input id="psword1" type="password" name="psword1" size="12" maxlength="12" 
					value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>">
					&nbsp;8 to 12 characters

					<br><label class="label" for="psword2">Confirm Password*</label>
					<input id="psword2" type="password" name="psword2" size="12" maxlength="12" 
					value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>">
					<!--The pull-down menu-->
					<br>
					<label class="label" for="class">Membership Class*</label>
					<select name="class">
						<option value="">- Select -</option>
						<option value="30"<?php if (isset($_POST['class']) AND ($_POST['class'] == '30'))
						echo ' selected="selected"'; ?>>Standard 1 year 30</option>
						<option value="125"<?php if (isset($_POST['class']) AND ($_POST['class'] == '125'))
						echo ' selected="selected"'; ?>>Standard 5 years 125</option>
						<option value="5"<?php if (isset($_POST['class']) AND ($_POST['class'] == '5'))
						echo ' selected="selected"'; ?>>Armed Forces 1 year 5</option>
						<option value="2"<?php if (isset($_POST['class']) AND ($_POST['class'] == '2'))
						echo ' selected="selected"'; ?>>Under 22 1 year 2**</option>
						<option value="15"<?php if (isset($_POST['class']) AND ($_POST['class'] == '15'))
						echo ' selected="selected"'; ?>>Minimum 1 year 15</option>
					</select>
						<br>
						<label class="label" for="addr1">Address*</label>
						<input id="addr1" type="text" name="addr1" size="30" maxlength="30"
						value="<?php if (isset($_POST['addr1'])) echo $_POST['addr1']; ?>">

						<br>
						<label class="label" for="addr2">Address</label>
						<input id="addr2" type="text" name="addr2" size="30" maxlength="30"
						value="<?php if (isset($_POST['addr2'])) echo $_POST['addr2']; ?>">

						<br><label class="label" for="city">City*</label>
						<input id="city" type="text" name="city" size="30" maxlength="30"
						value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>">

						<br><label class="label" for="county">County*</label>
						<input id="county" type="text" name="county" size="30" maxlength="30"
						value="<?php if (isset($_POST['county'])) echo $_POST['county']; ?>">

						<br><label class="label" for="pcode">Post Code*</label>
						<input id="pcode" type="text" name="pcode" size="15" maxlength="15"
						value="<?php if (isset($_POST['pcode'])) echo $_POST['pcode']; ?>">

						<br><label class="label" for="phone">Telephone</label>
						<input id="phone" type="text" name="phone" size="30" maxlength="30"
						value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>">
						<p><input id="submit" type="submit" name="submit" value="Register"></p>
					
				</form>
			</div>
		</div>
	</div>
<?php include ('footer.php'); ?>
<!-- End of the page content -->

</body>
</html>