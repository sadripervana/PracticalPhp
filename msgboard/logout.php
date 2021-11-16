<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?> 

<?php
session_start() ;
// Redirect users if they are not logged in
if ( !isset( $_SESSION[ 'member_id' ] ) )
{
require ( 'login_functions.php' ) ; load() ;
}
?>
<!doctype html>
<html lang=en>
<head>
<title>Logout code</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="msgboard.css">
<style type="text/css">
#tab-navigation ul { margin-left:190px; }
h3 { text-align:center; margin-top:-10px; }
</style>
</head>
<body>
<div id='container'>
<?php
//Re-use the registration header that has only one menu button i.e. the Home Page button
include ( 'includes/header_register.php' ) ;
// Remove the session variables from the session
$_SESSION = array() ;
// Destroy the session
session_destroy() ;
// Display the thank you message
echo '<h2>Thank you for logging out!</h2>
<br><h3>Logging out is a very important security measure</h3> ';
include ( 'includes/footer.php' ) ;
?>
</div>
</body>
</html>