<?php
require('db.php');
include('auth.php');
session_start();
$filesel=$_GET['filesel'];
$username = $_SESSION['username'];

$query = "SELECT fileID,date_created,user_nb_file FROM `data` WHERE username='$username' ORDER BY user_nb_file ASC";
$result = mysqli_query($con,$query) or die(mysql_error());
while( $row = mysqli_fetch_assoc( $result)){
$array[$row['user_nb_file']] = $row;}
$htmlstr= '';
for ($i=1; $i<=count($array);$i++){
	if($filesel!=$i){
		$htmlstr = $htmlstr . "<option value ='" . $array[$i]['user_nb_file'] . "'>File " . $array[$i]['fileID'] . " - " . $array[$i]['date_created'] . "</option>";
	}
	else {
		$htmlstr= '<select onchange="selectFile(this.value)"><option value="">Selected File ' . $array[$i]['fileID'] . " - " . $array[$i]['date_created']. '</option><option value="x">-----------------</option>' . $htmlstr;
	}
}
$htmlstr=$htmlstr."</select>";
$_SESSION['file_selected_logs']=intval($filesel);

echo $htmlstr;

?>