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

$ShowErrors = null;
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
				$ShowErrors = 'Error:<br>'.implode('<br>', $result).'';
			}
	
	}
	echo'
		<center>
		<b>'.$ShowErrors.'</b>
		<br><br>
		<form method="POST" action="register.php">
		<br>
		<input type="text" class="input2" name="loginR" placeholder="Username">
		<br><br>
		<input type="password" class="input2" name="passR1" placeholder="Password">
		<br><br>
		<input type="password" class="input2" name="passR2" placeholder="Repeat password">
		<br><br>
		<input type="text" class="input2" name="emailR" placeholder="Email">
		<br><br>
		<input type="submit" class="button" name = "SendR" value="Sign up">
		</form>
		</center>';
		
		

}
endblock();



?>