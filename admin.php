<?php

/* admin.php 

Coded by flext0r © 2016 - 2017

*/
require_once 'templates/flexDefault/layout.php';
startblock('title');
echo 'Panel Administracyjny';
endblock();

startblock('thead');
echo 'Panel Administracyjny';
endblock();

startblock('content');
if(!$User->get_Data('user_level') > 0)
{
	header('Location: index.php');
}else{
	if(isset($_POST['SendA']))
	{
		$title = $_POST['title'];
		$footer = $_POST['footer'];
		$tech_reason = $_POST['technicalbreak'];
		$tech_break = null;
		if(isset($_POST['tech_break']))
		{
			$tech_break = '1';
		}else{
			$tech_break = '0';
		}
		$registerS = null;
		$register = $_POST['register'];
		switch($register)
		{
			case '0':
				$registerS = '0';
			break;
			case '1':
				$registerS = '1';
			break;
		}
			$Admin->AdminUpdate($title,$footer,$tech_reason,$tech_break,$registerS);
		}
		echo'
		<div class="leftpanel">
		<br>
		<a href="admin.php?admin=global" class="leftpanelbutton">Podstawowe Ustawienia</a>
		<br><br>
		<a href="admin.php?admin=users" class="leftpanelbutton">Ustawienia Uzytkownikow</a>
		</div>
			<form method="POST" action="admin.php">
			<center>
			<br>
			Title<br>
			<input type="text" class="input2" name="title" placeholder="Tytul Strony" value="'.$Admin->getMain_Data('title').'">
			<br><br>
			Footer
			<br>
			<input type="text" class="input2" name="footer" placeholder="Sopka" value="'.$Admin->getMain_Data('footer').'">
			<br><br>
			
			Creating new accounts:
			<select name="register">
			<option value="0">Enabled</option>
			<option value="1">Disabled</option>
			</select>
			
			
			<br><br>
			Template:
			<select>
			<option value="flexDefault">flexDefault</option>
			</select>
			<br><br>
			Technical Break
			<br>
			<input type="text" class="input2" name="technicalbreak" placeholder="Powod przerwy technicznej" value="'.$Admin->getMain_Data('tech_reason').'">
			<br><br>
			<div class="onoffswitch">
			<input type="checkbox" name="tech_break" class="onoffswitch-checkbox" id="myonoffswitch" '.($Admin->getMain_Data('tech_break')=='1' ? 'checked' : '').'>
			<label class="onoffswitch-label" for="myonoffswitch">
			<span class="onoffswitch-inner"></span>
			<span class="onoffswitch-switch"></span>
			</label>
			</div>
			<br><br>
			<input type="submit" class="button" name = "SendA" value="Save changes">
			</center>';
		}
endblock();
	
?>