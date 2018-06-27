<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
	$password = stripslashes($_REQUEST['password']);
	$constellation_access_key = stripslashes($_REQUEST['constellation_access_key']);
	$constellation_friendly_name = stripslashes($_REQUEST['constellation_friendly_name']);
	$constellation_url = stripslashes($_REQUEST['constellation_url']);	
	
	$username = mysqli_real_escape_string($con,$username); 
	$password = mysqli_real_escape_string($con,$password);
	$constellation_access_key = mysqli_real_escape_string($con,$constellation_access_key);
	$constellation_friendly_name = mysqli_real_escape_string($con,$constellation_friendly_name);
	$constellation_url = mysqli_real_escape_string($con,$constellation_url);

	$trn_date = date("Y-m-d H:i:s");

    $query = "INSERT into `users` (username, password, trn_date, constellation_access_key, constellation_friendly_name, constellation_url)
VALUES ('$username', '".md5($password)."', '$trn_date','$constellation_access_key','$constellation_friendly_name','$constellation_url')";

    $result = mysqli_query($con,$query);
    if($result){
		echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input type="password" name="constellation_access_key" placeholder="Constellation Access Key" required />
<input type="text" name="constellation_url" placeholder="Constellation URL" required />
<input type="text" name="constellation_friendly_name" placeholder="Friendly Name" required />
<input type="submit" name="submit" value="Register" />
</form>
<p>Registered? <a href='login.php'>Back to login</a>.</p>
</div>
<?php } ?>
</body>
</html>