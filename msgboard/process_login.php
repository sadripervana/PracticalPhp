<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?> 

<?php
// Was the form submitted?
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
	// Connect to the database
	require ( 'mysqli_connect.php' ) ;
	// Load the validation functions
	require ( 'login_functions.php' ) ;
	// Check the login data
	list ( $check, $data ) = validate ( $dbcon, $_POST[ 'uname' ], $_POST[ 'psword' ] ) ;
	// If successful, set session data and display the forum.php page
	if ( $check )
	{
		// Access the session details
		session_start();
		$_SESSION[ 'member_id' ] = $data[ 'member_id' ] ;
		$_SESSION[ 'uname' ] = $data[ 'uname' ] ;
		load ( 'forum.php' ) ;
	}
	// If it fails, set the error messages
	else { $errors = $data; }
	// Close the database connection
	mysqli_close( $dbcon ) ;
}
// Because it failed, continue to display the login page
include ( 'login.php' ) ;
?>