<?php 
session_start(); 
if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1))
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
	<title>Page for administrator</title>
	<link rel="stylesheet" href="includes.css">
	<style type="text/css">
		p {text-align: center;}
	</style>
</head>
<body>
	<div id="container">
		<?php include("header-admin.php"); 
		include("nav.php");
		include("info-col.php");
		?>
		<div id="content">
			<!-- Start of the member;s page content. -->
			<?php echo '<h2> Welcome to the admin page ';
			if(isset($_SESSION['fname'])){
				echo "{$_SESSION['fname']}";
			}
			echo '</h2>';
			?>
			<div id="midcol">
				<h3> You have permission to:</h3>
				<p>&#9632;Edit and delete a record.
				</p>
				<p>&#9632;Use the View Members button to page through all
				the members.</p>
				<p>&#9632;Use the Search button to locate a particular
				member.</p>
				<p>&#9632;Use the Addresses button to locate a member's
				address and phone number. </p>
				<p>&nbsp;</p>
			</div>
		</div>
		<div id="footer">
			<?php include("footer.php"); ?>
		</div>
	</body>
	</html>