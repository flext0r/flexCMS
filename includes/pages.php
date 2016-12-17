<?php
/* pages.php

Coded by flext0r © 2016

*/

if(isset($_GET['logout'])) 
{
	session_destroy();
	$_SESSION['user_id'] = null;
	header('Location: index.php');
} 

if(isset($_GET['register'])) 
{
	$DisplayErrors = '';

	if($User->is_logged())
	{
		header("Location: index.php");
	}else{
		if(isset($_POST['SendR']))
		{	
			$login = $_POST['loginR'];
			$password = $_POST['passR1'];
			$password2 = $_POST['passR2'];
			$email = $_POST['emailR'];
			$result = $User->Register($login,$password,$password2,$email);
			if($result == true) 
			{
				$DisplayErrors = 'Wystąpiły błędy:<br>'.implode('<br>', $result).'';
			}
	
	}
	$Content = '
		<center>
		<b>'.$DisplayErrors.'</b>
		<br><br>
		<form method="POST" action="index.php?register">
		<br>
		<input type="text" class="input2" name="loginR" placeholder="Nazwa uzytkownika">
		<br><br>
		<input type="password" class="input2" name="passR1" placeholder="Haslo">
		<br><br>
		<input type="password" class="input2" name="passR2" placeholder="Powtorz haslo">
		<br><br>
		<input type="text" class="input2" name="emailR" placeholder="Adres email">
		<br><br>
		<input type="submit" class="button" name = "SendR" value="Utworz konto">
		</form>
		</center>';
	} 
}

if(isset($_GET['myprofile']))
{
			
	if(!$User->is_logged())
	{
		header("Location: index.php");
	}else{
			$Content = '
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


if(isset($_GET['admin']))
{
	
	if(!$User->get_Data('user_level') > 0)
	{
		header('Location: index.php');
	}else{
		if(isset($_POST['SendA']))
		{
			$title = $_POST['title'];
			$footer = $_POST['footer'];
			$tech_reason = $_POST['technicalbreak'];
			$tech_break = '';
			if(isset($_POST['tech_break']))
			{
				$tech_break = '1';
			}else{
				$tech_break = '0';
			}
			$Admin->AdminUpdate($title,$footer,$tech_reason,$tech_break);
		}
		$LeftPanel = '<div class="leftpanel">
		<br>
		<a href="index.php?admin=global" class="leftpanelbutton">Podstawowe Ustawienia</a>
		<br><br>
		<a href="index.php?admin=users" class="leftpanelbutton">Ustawienia Uzytkownikow</a>
		</div>';
		$Content = '
				<form method="POST" action="index.php?admin">
				<center>
				<br>
				Tytul Strony<br>
				<input type="text" class="input2" name="title" placeholder="Tytul Strony" value="'.$Admin->getMain_Data('title').'">
				<br><br>
				Stopka
				<br>
				<input type="text" class="input2" name="footer" placeholder="Sopka" value="'.$Admin->getMain_Data('footer').'">
				<br><br>
				Przerwa Techniczna:
				<br><br>
				<input type="text" class="input2" name="technicalbreak" placeholder="Powod przerwy technicznej" value="'.$Admin->getMain_Data('tech_reason').'">
				<br><br>
				<div class="onoffswitch">
				<input type="checkbox" name="tech_break" class="onoffswitch-checkbox" id="myonoffswitch" '.($Admin->getMain_Data('tech_break')=='1' ? 'checked' : '').'>
				<label class="onoffswitch-label" for="myonoffswitch">
				<span class="onoffswitch-inner"></span>
				<span class="onoffswitch-switch"></span>
				</label>
				</div>
				<br><br>
				<input type="submit" class="button" name = "SendA" value="Zapisz zmiany">
				</center>';
			}
	}
	

/*$Content = '
			<center>
			<br><br>
			<form method="POST" action="index.php?myprofile">
			<br>
			<input type="text" class="input2" name="loginM" placeholder="Nazwa uzytkownika">
			<br><br>
			<input type="password" class="input2" name="passM1" placeholder="Haslo">
			<br><br>
			<input type="password" class="input2" name="passM2" placeholder="Powtorz haslo">
			<br><br>
			<input type="text" class="input2" name="emailM" placeholder="Adres email">
			<br><br>
			<input type="submit" class="button" name = "SendM" value="Zapisz zmiany">
			</form>
			</center>';*/
























?>