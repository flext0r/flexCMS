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
	$newpassword = $_POST['newpassword'];
	$confirmpassword = $_POST['confirmpassword'];
	$result = $User->NewPassword($email,$newpassword,$confirmpassword);
	if($result == true)
	{
		$ShowError = $result;
	}
}

startblock('title');
echo 'Change Password';
endblock();

startblock('thead');
echo 'Change Password';
endblock();


startblock('content');
echo '
	<form method="POST" action="change_password.php">
	<center>
	'.$ShowError.'
	<br><br>
	Email:
	<br>
	<input type="text" style="width:20%;" class="input" name="email" placeholder="Email">
	<br><br>
	New Password:
	<br>
	<input type="text" style="width:20%;" class="input" name="newpassword" placeholder="New Password">
	<br><br>
	Confirm Password:
	<br>
	<input type="text" style="width:20%;" class="input" name="confirmpassword" placeholder="Confirm Password">
	<br>
	<input type="submit" style="width:10%;" class="button" name = "Send" value="Send">
	</center>
	
	</form>';


endblock();

?>
