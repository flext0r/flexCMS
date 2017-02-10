<?php

require_once 'templates/flexDefault/layout.php';
$ShowErrors = null;
startblock('title');
echo 'Find User';
endblock();

startblock('thead');
echo 'Find User';
endblock();


startblock('content');
if(isset($_POST['Send']))
{
	$data = $_POST['data'];
	if($User->FindUser($data))
	{
		header('Location: viewprofile.php?id='.$User->FindUser($data).'');
	}else{
		echo "<center>We were unable to find a specific user in our database!</center>";
	}
}
echo'
		<center>
		<b>'.$ShowErrors.'</b>
		<br><br>
		<form method="POST" action="finduser.php">
		<br>
		Enter username or email to find specific user:
		<br>
		<input type="text" class="input2" style="width:25%;" name="data" placeholder="Username or email">
		<br>
		<input type="submit" class="button" style="width:15%;" name = "Send" value="Search">
		</form>
		</center>';

endblock();

?>
