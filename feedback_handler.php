<?php 
/* Feedback form handler*/
//set to the email address of recipient
$mailto = "sadripervana@gmail.com";
$subject = "Message from website;";
// list the pages to be displayed
$formurl = "http://localhost/PHPProjects/PracticalPhp/feedback_form.html" ;
$errorurl = "http://localhost/PHPProjects/PracticalPhp/login.php" ;
$thankyouurl = "http://www.clients-isp.com/thankyou.html" ;
$emailerrurl = "http://www.clients-isp.com/emailerr.html" ;
$errorcommentturl = "http://www.clients-isp.com/commenterror.html" ;
$uself = 0;
// Set the information received from the form as short variables#2
$headersep = (!isset( $uself ) || ($uself == 0)) ? "\r\n" : "\n" ;
$username = $_POST['username'] ;
$useremail = $_POST['useremail'] ;
$phone = $_POST['phone'];
$brochure = $_POST['brochure'];
$addrs1 = $_POST['addrs1'];
$addrs2 = $_POST['addrs2'];
$city = $_POST['city'];
$postcode = $_POST['postcode'] ;
$letter = $_POST['letter'];
$comment = $_POST['comment'] ;
$http_referrer = getenv( "HTTP_REFERER" );
//Check that all four essential fields are filled out
if (empty($username) || empty($useremail) || empty($phone)|| empty($comment)) {
header( "Location: $errorurl" );
exit ; }
//check that no URLs have been inserted in the username text field #3
if (strpos ($username, '://')||strpos($username, 'www') !==false){
header( "Location: $errorsuggesturl" );
exit ; }
if (preg_match( "[\r\n]", $username ) || preg_match( "[\r\n]", $useremail )) {
header( "Location: $errorurl" );
exit ; }
#remove any spaces from beginning and end of email address#4
$useremail = trim($useremail);
#Check for permitted email address patterns
$_name = "/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}∼]+";
$_host = "([-0-9A-Z]+\.)+";
$_tlds = "([0-9A-Z]){2,4}$/i";
if(!preg_match($_name."@".$_host.$_tlds,$useremail)) {
header( "Location: $emailerrurl" );
exit ; }
// Has a phone number been entered?
if (!empty($_POST['phone'])) {
//Remove spaces, hyphens, letters and brackets.
$phone = preg_replace('/\D+/', '', ($_POST['phone']));
}
//Has the brochure box been checked? #5
if(!$brochure) {$brochure = "No";}
//check that no URLs have been inserted in the addrs1 text field
if (strpos ($addrs1, '://')||strpos($addrs1, 'www') !==false){
header( "Location: $errorsuggesturl" );
exit ; }
//Check whether URLs have been inserted in the addrs2 text field
if (strpos ($addrs2, '://')||strpos($addrs2, 'www') !==false){
header( "Location: $errorsuggesturl" );
exit ; }
//Check whether URLs have been inserted in the city text field
if (strpos ($city, '://')||strpos($city, 'www') !==false){
header( "Location: $errorsuggesturl" );
exit ; }
//Check whether URLs have been inserted in the pcode text field
if (strpos ($pcode, '://')||strpos($pcode, 'www') !==false){
header( "Location: $errorsuggesturl" );
exit ; }
//Check whether URLs have been inserted in the comment text area
if (strpos ($comment, '://')||strpos($comment, 'www') !==false){
header( "Location: $errorcommenturl" );
exit ; }
if($letter !=null) {$letter = $letter;}
$messageproper = #6
"This message was sent from:\n" .
"$http_referrer\n" .
"Name of sender: $username\n".
"Email of sender: $useremail\n" .
"Telephone: $phone\n" .
"brochure?: $brochure\n" .
"Address: $addrs1\n" .
"Address: $addrs2\n" .
"City: $city\n" .
"Postcode: $postcode\n" .
"Newsletter:$letter\n" .
"------------------------- MESSAGE -------------------------\n\n" .
$comment .
"\n\n------------------------------------------------------------\n" ;
mail($mailto, $subject, $messageproper, "From: \"$username\" <$useremail>" );
header( "Location: $thankyouurl" );
exit ;
?>