<?php
require('db.php');
include('auth.php');
session_start();
$fileIDForStats=intval($_GET['fileidforstats']);
$username=$_SESSION['username'];

$query="SELECT CONVERT(data using UTF8) FROM `data` WHERE username='$username' AND fileID='$fileIDForStats)'";
$result = mysqli_query($con,$query) or die(mysql_error());
$row = mysqli_fetch_assoc($result);		

echo $row;
?>

