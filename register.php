<?php
/* register.php 

Coded by flext0r © 2016

*/
require_once 'templates/flexDefault/layout.php';

startblock('title');
echo 'Register';
endblock();

startblock('thead');
echo 'Register';
endblock();

$DisplayErrors = null;
startblock('content');
if($Admin->getMain_Data('register') == 1)
{
	echo '<center>Creating new accounts is temporarily disabled!</center>';
	endblock();
	exit;
}
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
	echo'
		<center>
		<b>'.$DisplayErrors.'</b>
		<br><br>
		<form method="POST" action="register.php">
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
endblock();



?>