<?php
require('db.php');
include('auth.php');
session_start();
$query = "SELECT * FROM `data` WHERE username='jhd' ORDER BY user_nb_file DESC LIMIT 1";
$result = mysqli_query($con,$query) or die(mysql_error());
$row = mysqli_fetch_assoc( $result);
$new_file_nb = intval($_SESSION['maxfile'])+1;
$date=date('d\-m\-y\ H:i:s');
$username = $_SESSION['username'];

$query = "INSERT INTO `data` (username,user_nb_file,date_created) VALUES ('$username','$new_file_nb','$date')";
$result = mysqli_query($con,$query) or die(mysql_error());
echo $new_file_nb;	
?>