<?php
/*
Layout.php

Coded by flext0r © 2016

*/
require 'includes/main.php';
require 'pages.php';

if(isset($_POST['Send']))
{
	$login = $_POST['login'];
	$password = $_POST['password'];
	$result = $User->Login($login,$password);
	if($result == true)
	{
		$ShowUserInfo = $result;
	}
	
}

?>

<html>
<head>

	<link rel="icon" href="./images/favicon.png" type="image/png" />
	<title><?php echo $Admin->getMain_Data('title');?></title>
	<link rel="stylesheet" type="text/css" href="./css/style.css" />

</head>

<body>
	
<div class="top">
	<div class="wrapper">
		<div class="left">
			<a href="index.php" class="button">Strona Glowna</a>
			<?php
			if(!$User->is_logged())
			{
				echo '<a href="index.php?register" class="button">Zarejestruj sie</a>';
			}
			if($User->get_Data('user_level') > 0)
			{
				echo '<a href="index.php?admin" class="button">Panel Administracyjny</a>';
			}
			?>
		</div>
			<div class="right">
			<?php 
				if(!$User->is_logged())
				{
					echo '<form method="POST" action="index.php">
					<input type="text" class="input" name="login" placeholder="Login/E-mail">
					<input type="password" class="input" name="password" placeholder="Haslo">
					<input type="submit" class="button" name = "Send" value="Zaloguj sie">
					</form>';
				}else{
					echo '<a href="index.php?logout" class="button">Wyloguj sie</a>';
					echo '<a href="index.php?myprofile">'.$User->get_Data('user_login').'</a>';
				}
				echo $ShowUserInfo;
			?>
			</div>
	</div>
</div>


<div class="content">
	<div class="thead">Strona Glowna</div>
		<?php echo $LeftPanel; ?>
		<?php echo $Content; ?>
<div class="footer"><?php echo $Admin->getMain_Data('footer');?></div>


</div>

</body>
</html>
	


	
	