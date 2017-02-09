<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" href="./images/favicon.png" type="image/png" />
	<title>flexCMS Installation</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<?php
require_once 'includes/main.php';
$ShowErrors = null;
if(isset($_POST['Send']))
{
	$login = $_POST['login'];
	$password = $_POST['pass'];
	$confirmpassword = $_POST['pass2'];
	$email = $_POST['email'];
	$title = $_POST['title'];
	$footer = $_POST['footer'];
	$result = $Admin->InstallCMS($login,$password,$confirmpassword,$email,$title,$footer);
	if($result == true)
	{
		$result = $ShowErrors;
	}
}

echo '
		<div class="content">
		<div class="thead">flexCMS Installation</div>
		<center>
		<form method="POST" action="install.php">
		<b>'.$ShowErrors.'</b>
		<br><br>
		Creating Head Admin Account
		<br><br>
		Username:
		<br>
		<input type="text" class="input2" name="login" placeholder="Username">
		<br><br>
		Password:
		<br>
		<input type="password" class="input2" name="pass" placeholder="Password">
		<br><br>
		Confirm Password:
		<br>
		<input type="password" class="input2" name="pass2" placeholder="Confirm password">
		<br><br>
		Email:
		<br>
		<input type="text" class="input2" name="email" placeholder="Email">
		<br><br>
		Basic Settings
		<br><br>
		Title of the Website:
		<br>
		<input type="text" class="input2" name="title" placeholder="Title">
		<br><br>
		Footer of the Website:
		<br>
		<input type="text" class="input2" name="footer" placeholder="Footer">
		<br><br>
		<input type="submit" class="button" name = "Send" value="Install">
		</form>
		</center>
		</div>';
?>

	