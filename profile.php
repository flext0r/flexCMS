<?php
/*
Layout.php

Coded by flext0r © 2016

still broken, needs to be fixed asap
*/

require_once 'templates/flexDefault/layout.php';

startblock('title');
echo 'Profile';
endblock();

startblock('thead');
echo 'Profile';
endblock();

startblock('content');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$DisplayErrors = null;

if(!$User->is_logged())
{
	header("Location: index.php");
	}else{
echo'
	<div class="leftpanel">
	<br>
	<a href="profile.php?global" class="leftpanelbutton">Basic Information</a>
	<br><br>
	<a href="profile.php?editprofile" class="leftpanelbutton">Edit Profile</a>
	</div>';
if(isset($_GET['editprofile']))
{
	if(isset($_POST['SendEdit']))
	{
		$username = $_POST['loginM'];
		$currentpassword = $_POST['passC'];
		$newpassword = $_POST['passM1'];
		$confirmpassword = $_POST['passM2'];
		$email = $_POST['emailN'];
		$result = $User->EditProfile($username,$currentpassword,$newpassword,$confirmpassword,$email);
		if($result == true) 
		{
			$DisplayErrors = 'Error:<br>'.implode('<br>', $result).'';
		}
	}
		
		
	echo '
		<form method="POST" action="profile.php?editprofile">
		<center>
		<b>'.$DisplayErrors.'</b>
		<br><br>
		<input type="text" class="input2" name="loginM" placeholder="Nazwa uzytkownika" value='.$User->get_Data('user_login').'>
		<br><br>
		<input type="password" class="input2" name="passC" placeholder="Current password">
		<br><br>
		<input type="password" class="input2" name="passM1" placeholder="New password">
		<br><br>
		<input type="password" class="input2" name="passM2" placeholder="Repeat password">
		<br><br>
		<input type="text" class="input2" name="emailN" placeholder="Email" value='.$User->get_Data('user_email').'>
		<br><br>
		<input type="submit" class="button" name = "SendEdit" value="Save changes">
		</form>
		</center>';
}
if(isset($_GET['global']))
{
	echo'
	<center>
	<br><br>
	Nazwa Uzytkownika: <b>'.$User->get_Data('user_login').'</b>
	<br>
	Adres email: <b>'.$User->get_Data('user_email').'</b>
	<br>
	Poziom: <b>'.$User->UserLvl($_SESSION['user_id']).'</b>
	<br>
	Data rejestracji: <b>'.$User->get_Data('user_date').'</b>
	</center>
	<br><br>';
}
}
endblock();		

?>