<title>The page for displaying the found paintings</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="transparent.css">
  <style type="text/css">
	  body { margin:auto; }
	  p{ text-align:center; }
	  table, td, th { width:930px; border-collapse:collapse; border:1px black solid; 
	  background:white;}
	  td, th { padding-left:5px; padding-right:5px; text-align:center; }
	  td.narrow, th.narrow { width:45px;}
	  td.descr { text-align:left; }
	  td.medium, th.medium { width:100px;}
	  td.artist, th.artist { width:210px;}
	  td.thumb, th.thumb { width:125px; text-align:center;}
	  #content h3 { text-align:center; font-size:130%; font-weight:bold;}
	  img { display:block;}
	  #header-button { margin-top:-5px;}
  </style>
</head>
<body>
<div id="container">
<header>
<?php include('includes/header_found_pics.inc'); ?>
<div id="logo">
     <img alt="dove" height="170" src="images/dove-1.png" width="234">
     </div>
</header>
<div id="content"><!--Start of table display content-->
<h3>To buy a painting please click its Add to Cart button</h3>
<p>
<?php
$type=$_POST['type'];
$price=$_POST['price'];
require ('mysqli_connect.php'); // Connect to the database
// Fetch the records that match the search criteria
$q = "SELECT art_id, thumb, type, price, medium, artist, mini_descr, ppcode 
FROM art WHERE type='$type' AND price <= '$price' ORDER BY price ASC ";
$result = @mysqli_query ($dbcon, $q);
if ($result) { // If the query encountered no problems, display the records
// Table header
echo '<table>
         <th class="thumb"><b>Thumb</b></th>
         <th class="narrow"><b>Type</b></th>
         <th class="medium"><b>Medium</b></th>
         <th class="artist"><b>Artist</b></th>
         <th class="descr"><b>Details</b></th>
         <th class="narrow"><b>Price</b></th>
         <th class="medium"><b>Add to Cart</b></th>
     </tr>';
// Fetch and echo the matching records
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo '<tr>
        <td class="thumb"><img src='.$row['thumb'] . '></td>
        <td class="narrow">' . $row['type'] . '</td>
        <td class="medium">' . $row['medium'] . '</td>
        <td class="artist">' . $row['artist'] . '</td>
        <td class="descr">' . $row['mini_descr'] . '</td>
        <td class="narrow">' . $row['price'] . '</td>
        <td class="medium">' . $row['ppcode'] . '</td>
        </tr>';
     }
echo '</table>'; // Close the table
     mysqli_free_result ($result); // Free up the resources
     } else { // If the query encountered a problem
// Error message
     echo '<p class="error">The records could not be retrieved. We apologize for any 
inconvenience.</p>';
// Debugging error message:
     echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
     } // End of if ($result)
mysqli_close($dbcon); // Close the database connection
?>
<p>No paintings displayed? Either we have nothing that matches your requirements 
at the moment OR<br>you may have forgotten to select BOTH the search fields. Please 
click the Home Page button and try again.</p>
</div><!--End of table display content-->
<?php include("includes/footer.inc"); ?>
</div>
</body>
</html>