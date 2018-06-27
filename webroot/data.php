<?php
require('db.php');
include('auth.php');
$file=$_SESSIO['filesel'];
$data=$_GET['data'];
$date=date('d\-m\-y\ H:i:s');
$username=$_SESSION['username'];
if (data!=null){
	$query = "UPDATE `data` SET data = CONCAT(data,'$data','@','$date',';') WHERE username='$username' AND fileID='$file'";
	$result = mysqli_query($con,$query) or die(mysql_error());
}
?>