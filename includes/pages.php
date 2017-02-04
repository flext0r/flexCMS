<?php
/* pages.php

Coded by flext0r © 2016

*/

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

?>