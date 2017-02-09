<?php
/* Admin.php

Coded by flext0r © 2016 - 2017

*/

class Admin extends User
{
	
	public function getMain_Data($get)
	{
		$SQL = $this->db->prepare("SELECT * FROM settings");
		$SQL->execute();
		$Row = $SQL->fetch(PDO::FETCH_ASSOC);
		return $Row[$get];
	}
	
	public function AdminUpdate($title,$footer,$tech_reason,$tech_break,$registerS)
	{
		try{
			
			$SQL = $this->db->prepare("UPDATE settings SET title = :title, footer = :footer, tech_reason = :reason, tech_break = :break, register = :register");
			$SQL->bindParam(':title',$title,PDO::PARAM_STR);
			$SQL->bindParam(':footer',$footer,PDO::PARAM_STR);
			$SQL->bindParam(':reason',$tech_reason,PDO::PARAM_STR);
			$SQL->bindParam(':break',$tech_break,PDO::PARAM_INT);
			$SQL->bindParam(':register',$registerS,PDO::PARAM_INT);
			$SQL->execute();
		}catch(PDOEXCEPTION $e)
		{
			echo $e->getMessage();
		}
	}
	public function is_installed()
	{
		$SQL = $this->db->prepare("SELECT user_id FROM users WHERE user_id = '1'");
		$SQL->execute();
		return $SQL->rowCount();
	}

	public function InstallCMS($login,$password,$confirmpassword,$email,$title,$footer)
	{
		$Error = [];
		if(empty($login) OR empty($password) OR empty($confirmpassword) OR empty($email) OR empty($title) OR empty($footer))
		{
			$Error[] = "Forms can't be empty!";
		}else{
			if(!check_username($login))
			{
				$Error[] = 'Username is invalid';
			}
			if($password != $confirmpassword)
			{
				$Error[] = "Passwords don't match!";
			}elseif(!check_password($password))
			{
				$Error[] = 'Password is invalid';
			}
			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) 
			{
				$Error[] = "Email is invalid!";
			}
		}
		if(count($Error) == 0)
		{
			$password = $this->hashpass($password);
			$SQL = $this->db->prepare("INSERT INTO users (user_login,user_password,user_level,user_email,verified,verification_code,reset_key) VALUES (:login,:password,'2',:email,'1',' ',' ')");
			$SQL->bindParam(':login',$login,PDO::PARAM_STR);
			$SQL->bindParam(':password',$password,PDO::PARAM_STR);
			$SQL->bindParam(':email',$email,PDO::PARAM_STR);
			$SQL->execute();

			$SQL = $this->db->prepare("INSERT INTO settings (title,footer,tech_reason,tech_break,register) VALUES (:title,:footer,' ',' ',' ')");
			$SQL->bindParam(':title',$title);
			$SQL->bindParam(':footer',$footer);
			$SQL->execute();
			header('Location: index.php');
			
		}else{
			return $Error;
		}
	}
}



?>