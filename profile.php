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

startblock('content');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


if(is_numeric($id))
{
	if(empty($User->get_DataID('user_id',$id)))
	{
		$echo = "<center><b>Nie znaleziono uzytkownika o ID:<b>".$id."</b>!";
	}else{
		var_dump($echo = '
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
				<br><br>');
		}
	}else{
		$echo = "<center>Podane ID nie jest liczba!</center>";
}
endblock();		

?>