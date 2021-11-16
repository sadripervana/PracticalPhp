<?php
session_start();
if (!isset($_SESSION['user_id'])){
header('location:login.php');
exit();
}
?>
<!doctype html>
<html lang=en>
<head>
<title>The page for displaying the found paintings </title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="transparent.css">
	<style type="text/css">
	  body {    margin:auto; }
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