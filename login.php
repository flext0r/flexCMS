<?php
/*  login errors doesnt show up for some fucking reason..
	Recover password needs to be written shortly.
*/
require_once 'templates/flexDefault/layout.php';
$ShowErrors = null;
if(isset($_POST['Send']))
{
	$login = $_POST['login'];
	$password = $_POST['password'];
	$result = $User->Login($login,$password);
	if($result == true)
	{
		$result = $ShowErrors;
	}
	
}
startblock('title');
echo 'Log in';
endblock();

startblock('thead');
echo 'Log in';
endblock();


startblock('content');
if($User->is_logged())
{
	header('Location: index.php');
}

echo '
	<center>
	'.$ShowErrors.'
	<form method="POST" action="login.php">
	<br>
	Login:
	<br>
	<input type="text" style="width:20%;" class="input" name="login" placeholder="Login">
	<br>
	Password:
	<br>
	<input type="password" style="width:20%;" class="input" name="password" placeholder="Password">
	<br>
	<input type="submit" style="width:10%;" class="button" name = "Send" value="Sign in">
	</form>
	<a href="reset_password.php">I forgot my password</a>
	</center>';




endblock();

?>
