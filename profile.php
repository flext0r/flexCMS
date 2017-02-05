<?php
/*
Layout.php

Coded by flext0r © 2016

still broken, needs to be fixed asap
*/

require_once 'templates/flexDefault/layout.php';

startblock('title');
echo 'Profil';
endblock();

startblock('thead');
echo 'Profil';
endblock();

startblock('content');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$DisplayErrors = null;
/*

if(is_numeric($id))
{
	if(empty($User->get_DataID('user_id',$id)))
	{
		echo "<center>Nie znaleziono uzytkownika o ID:<b>".$id."</b>!";
	}else{
			echo '
				<center>
				<br><br>
				Nazwa Uzytkownika: <b>'.$User->get_DataID('user_login',$id).'</b>
				<br>
				Adres email: <b>'.$User->get_DataID('user_email',$id).'</b>
				<br>
				Poziom: <b>'.$User->UserLvl().'</b>
				<br>
				Data rejestracji: <b>'.$User->get_DataID('user_date',$id).'</b>
				</center>
				<br><br>';
		}
	}else{
		echo "<center>Podane ID nie jest liczba!</center>";
}*/
if(!$User->is_logged())
{
	header("Location: index.php");
	}else{
echo'
	<div class="leftpanel">
	<br>
	<a href="profile.php?global" class="leftpanelbutton">Podstawowe informacje</a>
	<br><br>
	<a href="profile.php?editprofile" class="leftpanelbutton">Edytuj Profil</a>
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
			$DisplayErrors = 'Wystąpiły błędy:<br>'.implode('<br>', $result).'';
		}
	}
		
		
	echo '
		<form method="POST" action="profile.php?editprofile">
		<center>
		<b>'.$DisplayErrors.'</b>
		<br><br>
		<input type="text" class="input2" name="loginM" placeholder="Nazwa uzytkownika" value='.$User->get_Data('user_login').'>
		<br><br>
		<input type="password" class="input2" name="passC" placeholder="Obecne Haslo">
		<br><br>
		<input type="password" class="input2" name="passM1" placeholder="Nowe Haslo">
		<br><br>
		<input type="password" class="input2" name="passM2" placeholder="Powtorz haslo">
		<br><br>
		<input type="text" class="input2" name="emailN" placeholder="Adres email" value='.$User->get_Data('user_email').'>
		<br><br>
		<input type="submit" class="button" name = "SendEdit" value="Zapisz zmiany">
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
	Poziom: <b>'.$User->UserLvl().'</b>
	<br>
	Data rejestracji: <b>'.$User->get_Data('user_date').'</b>
	</center>
	<br><br>';
}
}
endblock();		

?>