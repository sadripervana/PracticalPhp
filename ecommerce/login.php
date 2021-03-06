<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?> 

<!doctype html>
<html lang=en>
<head>
<title>Login page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="transparent.css">
<style type="text/css">
#content h2 { width:60px; margin-left:-40px; }
p.error { color:red; font-size:105%; font-weight:bold; text-align:center;}
form { margin-left:130px; }
.submit { margin-left:215px; }

.cntr { text-align:center; margin-left:20px; }

</style>
</head>
<body>
<div id="container">
<header>
<?php include('includes/header_login.inc'); ?>
<div id="logo">
 <img alt="dove" height="170" src="images/dove-1.png" width="234">
</div>
</header><div id="content"><!--Start of the login page content-->
<div id="rightcol">
 <nav>
 <?php include('includes/menu.inc'); ?>
 </nav>
</div>
<?php
// Determine whether the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//Connect to database
require ('mysqli_connect.php');
// Was the email address entered?
if (!empty($_POST['email'])) {
 $e = mysqli_real_escape_string($dbcon, $_POST['email']);
 } else {
 $e = FALSE;
 echo '<p class="error">You forgot to enter your email address.</p>';
 }
// Was the password entered?
if (!empty($_POST['psword'])) {
 $p = mysqli_real_escape_string($dbcon, $_POST['psword']);
 } else {
 $p = FALSE;
 echo '<p class="error">You forgot to enter your password.</p>';
 }
 if ($e && $p){//If no problem was encountered
// Select the user_id, first_name and user_level for that email/password combination
$q = "SELECT user_id, fname, user_level FROM users WHERE (email='$e' AND 
psword=SHA1('$p'))";
 $result = mysqli_query ($dbcon, $q);
// Check the result
if (@mysqli_num_rows($result) == 1) {//The user input matched the database record
// Start the session, fetch the record and insert the three values in an array
 session_start();
 $_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
$_SESSION['user_level'] = (int) $_SESSION['user_level']; // Ensure the user level is an integer.
// The login page redirects the user either to the admin page or the user???s search page
// Use a ternary operation to set the URL
$url = ($_SESSION['user_level'] === 51) ? 'admin_page.php' : 'users_search_page.php';
header('Location: ' . $url); // The user is directed to the appropriate page
exit(); // Cancel the rest of the script
 mysqli_free_result($result);
 mysqli_close($dbcon);
 } else { // If no match was found
echo '<p class="error">Your email address and password combination does not match our 
records.<br>Perhaps you need to register. Click the Register button on the header menu</p>';
 }
 } else { // If there was a problem
 echo '<p class="error">Please try again.</p>';
 }
 mysqli_close($dbcon);
 } // End of submit conditionals
?>
<!--Display the form fields-->
<div id="loginfields">
<?php include ('includes/login_page.inc.php'); ?>
</div>
<p>&nbsp;</p>
<p class="cntr"><a href="forgot.php"><b>Forgotten your password?</b></a></p>
<footer>
<?php include ('includes/footer.inc'); ?>
</footer>
</div>
</div>
</body>
</html>