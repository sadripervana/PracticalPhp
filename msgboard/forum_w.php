<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?> 

<?php session_start() ;
// Redirect if not logged in
if ( !isset( $_SESSION[ 'member_id' ] ) ) { require ( 'login_functions.php' ) ; load() ; }
?>
<!doctype html>
<html lang=en>
<head>
<title>Wise quotes Forum page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="msgboard.css">
<style type="text/css">
table { background:white; color:black; }
th {padding:4px; border:1px black solid; }
#tab-navigation ul { margin-left:-107px; }
</style>
</head>
<body>
<div id='container'>
<?php
include ( 'includes/header_wise.php' ) ;
// Connect to the database
require ( 'mysqli_connect.php' ) ;
// Make the query
$q = "SELECT uname,post_date,subject,message FROM forum
WHERE subject = 'Wise Quotes' ORDER BY 'post_date' ASC";
$result = mysqli_query( $dbcon, $q ) ;
if ( mysqli_num_rows( $result ) > 0 )
{
echo '<h2>Wise Quotes</h2><table><tr><th>Posted By</th> 
<th>Forum</th><th id="msg">Quotation</th></tr>';
while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ))
{
echo '<tr><td>' . $row['uname'].'<br>'.$row['post_date'].'</td>
<td>'.$row['subject'].'</td><td>' . $row['message'] . '</td> </tr>';
}
echo '</table>' ;
}
else { echo '<p>There are currently no messages.</p>' ; }
//Close the database connection
mysqli_close( $dbcon ) ;
?>
</div>
<?php include ( 'includes/footer.php' ) ; ?>
</body>
</html>
