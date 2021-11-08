<?php
// Create a connection to the logindb database andto MySQL.
// Set the encoding and the access details as
constants:
DEFINE ('DB_USER', 'admin');
DEFINE ('DB_PASSWORD', 'admin');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'simpleIdb');
// Make the connection:
$dbcon = @mysqli_connect (DB_HOST, DB_USER,
DB_PASSWORD, DB_NAME)OR die ('Could not connect to MySQL: ' .
mysqli_connect_error() );
// Set the encoding...
mysqli_set_charset($dbcon, 'utf8');
