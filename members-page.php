<?php 
session_start();
if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 0 ))
{
	header("Location: login.php");
	exit();
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Members page</title>
	<link rel="stylesheet" href="includes.css">
	<style type="text/css">l
		#mid-right-col {
			text-alighn: center; 
			margin: auto;
		}
		#midcol h3 {
			font-size: 130%;
			margin-top: 0;
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div id="container">
		<?php include('header-members.php'); ?> 
		<?php include('nav.php'); ?> 
		<?php include('info-col.php.php'); ?> 
		<div id="content"> <!-- Start of the member's page content. ---> 
			<?php 
			echo '<h2> Welcome to the Members Page';
			if(isset($_SESSION['fname'])){
				echo "{$_SESSION['fname']}";
			}
			echo '</h2>';
			?>
			<div id="midcol">
				<div id="mid-left-col">
					<h3>Members's Events</h3>
					<p>The members page content The members page content The members page content <br>The members page content The members page content The members page content <br>The members page content The members page content The members page content <br>
					</p>
				</div>
				<div id="mid-right-col">
					<h3>Special offers to members only.</h3>
					<p><b>T-shirt &pound;10.00</b></p>
					<img src="images/polo.png" alt="Polo Shirt" title="Polo SHirt" height="207">
				</div>
			</div>
		</div>

	</div>
</body>
</html>
