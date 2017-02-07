<?php
/*
layout.php

Coded by flext0r © 2016 - 2017


*/
require_once './includes/main.php';
require_once './classes/ti.class.php';

if($Admin->getMain_Data('tech_break') == 1 && $User->get_Data('user_level') == 0)
{
	header('Location: maintenance.php');
}

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" href="./images/favicon.png" type="image/png" />
	<title>
	<?php echo $Admin->getMain_Data('title');?> | <?php startblock('title') ?><?php endblock() ?></title>
	<link rel="stylesheet" type="text/css" href="./css/style.css" />

</head>

<body>
	
<div class="top">
	<div class="wrapper">
		<div class="left">
			<a href="index.php" class="button">Home</a>
			<a href="users.php" class="button">Users</a>
			<?php
			if(!$User->is_logged())
			{
				echo '<a href="register.php" class="button">Sign up</a>';
			}
			if($User->get_Data('user_level') > 0)
			{
				echo '<a href="admin.php" class="button">Administration Panel</a>';
			}
			?>
		</div>
			<div class="right">
			<?php 
				if(!$User->is_logged())
				{
					echo '<form method="POST" action="login.php">
					<input type="text" class="input" name="login" placeholder="Login/E-mail">
					<input type="password" class="input" name="password" placeholder="Haslo">
					<input type="submit" class="button" name = "Send" value="Log in">
					</form>';
				}else{
					echo '<a href="logout.php" class="button">Log out</a>';
					echo '<a href="profile.php?global">'.$User->get_Data('user_login').'</a>';
				}
			?>
			</div>
	</div>
</div>


<div class="content">
	<div class="thead"><?php startblock('thead') ?><?php endblock() ?></div>
		<?php 
		
		startblock('content');
		endblock();
		?>
		
		
<div class="footer"><?php echo $Admin->getMain_Data('footer');?></div>

</div>

</body>
</html>