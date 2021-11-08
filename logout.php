<?php 
session_start();//access the current session 
//if no session variable exists then redirect the user
if(!isset($_SESSION['user_id'])){
	header("Location: index.php");
	exit();
	// cancel the session and redirect the user: 
} else {
	// cancel the session 
	$_SESSION = []; //Destroy the variables
	session_destroy(); //Destroy the session 
	setCookie('PHPSESSID', '', time()-3600, '/', '', 0, 0); //Destroy the cookie
	header("Location:index.php");
	exit();
}
?>