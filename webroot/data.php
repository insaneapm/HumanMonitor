<?php
require('db.php');
include('auth.php');
$file=intval($_SESSION['file_selected_logs']);
$data=$_GET['data'];
$date=date('d\-m\-y\ H:i:s');
$username=$_SESSION['username'];
if (data!=null){
	$query = "UPDATE `data` SET data = CONCAT(data,'$data','@','$date',';') WHERE username='$username' AND user_nb_file='$file'";
	$result = mysqli_query($con,$query) or die(mysql_error());
}
?>