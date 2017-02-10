<?php
/*
Layout.php

Coded by flext0r © 2016

still broken, needs to be fixed asap
*/

require_once 'templates/flexDefault/layout.php';

startblock('title');
echo 'View Profile';
endblock();

startblock('thead');
echo 'View Profile';
endblock();

startblock('content');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(isset($_POST['Ban']))
{
	if($User->get_DataID('banned',$id) == 0)
	{
		$Admin->BanUser($id,1);
	}else{
		$Admin->BanUser($id,0);
	}
}

if(is_numeric($id))
{
	if(empty($User->get_DataID('user_id',$id)))
	{
		echo "<center>We we're unable to find userID:<b>".$id."</b>!";
	}else{
		echo '
			<center>
			<br><br>
			Username: <b>'.$User->get_DataID('user_login',$id).'</b>
			<br>
			Email: <b>'.$User->get_DataID('user_email',$id).'</b>
			<br>
			Level: <b>'.$User->UserLvl($id).'</b>
			<br>
			Registered: <b>'.$User->get_DataID('user_date',$id).'</b>
			<br>
			Banned: <b>'.($User->get_DataID('banned',$id) == '0' ? 'No':'Yes').'</b>
			</center>
			<br>';
			if($User->get_DataID('user_id',$_SESSION['user_id']) > 0)
			{
				if($User->get_DataID('banned',$id) == 0)
				{
					echo '<form method="POST"><input type="submit" class="button" style="width:10%;" name = "Ban" value="Ban User"></form>';
				}else{
					echo '<form method="POST"><input type="submit" class="button" style="width:10%;" name = "Ban" value="Unban User"></form>';
				}
			}
			
		}
	}else{
		echo "<center>ID has to be a number!</center>";
}
endblock();		

?>