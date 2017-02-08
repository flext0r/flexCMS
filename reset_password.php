<?php

require_once 'templates/flexDefault/layout.php';
if($User->is_logged())
{
	header('Location: index.php');
}
$ShowError = null;
if(isset($_POST['Send']))
{
	$email = $_POST['email'];
	$result = $User->ResetPassword($email);
	if($result == true)
	{
		$ShowError = $result;
	}
}

startblock('title');
echo 'Reset Password';
endblock();

startblock('thead');
echo 'Reset Password';
endblock();


startblock('content');
echo '
	<form method="POST" action="reset_password.php">
	<center>
	'.$ShowError.'
	<br><br>
	Enter email to reset your password:
	<br>
	<input type="text" style="width:20%;" class="input" name="email" placeholder="Email">
	<br>
	<input type="submit" style="width:10%;" class="button" name = "Send" value="Send">
	</center>
	
	</form>';


endblock();

?>

	