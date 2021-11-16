<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?> 
<?php
// Start the session
session_start();
// Include the login functions to check for errors
require ( 'login_functions.php' ) ;
// If users are not logged in, redirect them
if ( !isset( $_SESSION[ 'member_id' ] ) ) { load() ; }
//Connect to the database
require ( 'mysqli_connect.php' ) ;
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
// Check that the user has entered a subject and a message #1
if ( empty($_POST['subject'] ) ) { echo '<p>You forgot to enter a subject.</p>'; }
if ( empty($_POST['message'] ) ) { echo '<p>You forgot to enter a message.</p>'; }
if ( !empty( $_POST['message']))
{
$message = mysqli_real_escape_string( $dbcon, strip_tags(trim( $_POST['message'] )) ) ;#2
}
// If successful, insert the post into the database table. This check is not essential, but it
// does ensure that the page has not been compromised by a hacker.
if( !empty($_POST['subject']) && !empty($_POST['message']) )
{
//Make the insert query#2
$q = "INSERT INTO forum(uname, subject, message, post_date)
VALUES ('{$_SESSION['uname']}', '{$_POST['subject']}','$message',NOW() )";
$result = mysqli_query ( $dbcon, $q ) ;
// If it fails, display an error message
if (mysqli_affected_rows($dbcon) != 1) { echo '<p>Error</p>'.mysqli_error($dbcon); } else { load('forum.php'); }
// Close the database connection
mysqli_close( $dbcon ) ;
}
}
// Create a link back to the forum page
echo '<p><a href="forum.php">Forum</a>' ;
include ( 'includes/footer.php' ) ;
?>