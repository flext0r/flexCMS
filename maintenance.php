<?php

/* maintenance.php 

Coded by flext0r © 2016 - 2017

*/

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" href="./images/favicon.png" type="image/png" />
	<title>Maintenance</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<?php
require 'includes/main.php';
if($Admin->getMain_Data('tech_break') == 0)
{
	header('Location: index.php');
}

if(isset($_POST['Send']))
{
	$login = $_POST['login'];
	$password = $_POST['password'];
	$User->Login($login,$password);
	
}
		echo '
		<div class="content">
		<div class="thead">Maintenance</div>';
		echo '<center><h1>'.$Admin->getMain_Data('tech_reason').'</h1></center>';
		echo '<center><form method="POST" action="maintenance.php">
		<br>
		<input type="text" style="width:30%;" class="input" name="login" placeholder="Login">
		<br>
		<input type="password" style="width:30%;" class="input" name="password" placeholder="Password">
		<br>
		<input type="submit" style="width:10%;" class="button" name = "Send" value="Sign in">
		</form></center>';
		echo '</div>';
?>