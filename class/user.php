<?php
/* User.php *

Coded by flext0r © 2016

*/

class User
{
	private $db;
	
	public function __construct($DB_con)
	{
		$this->db = $DB_con;
	
	}
	
	public function Login($login,$password)
	{
			$Error = '';
			if(empty($login) OR empty($password))
			{
				$Error = 'Type your login and password';
			}else{
				try{
					$password = $this->hashpass($password);
					$SQL = $this->db->prepare("SELECT * from users WHERE user_login=:login AND user_password=:password");
					$SQL->bindParam(':login',$login,PDO::PARAM_STR);
					$SQL->bindParam(':password',$password,PDO::PARAM_STR);
					$SQL->execute();
					$Row = $SQL->fetch(PDO::FETCH_ASSOC);
					if($SQL->rowCount() == 1)
					{	
						$_SESSION['user_id'] = $Row['user_id'];
						header('Location: index.php');
					}else{
						$Error = 'Your login or password is wrong!';
					}
					}catch(PDOEXCEPTION $e)
					{
						echo $e->getMessage();
					}
			}
		if($Error != ''){ return $Error;}
	}
		
		
	public function Register($login,$password,$password2,$email)//needs to be reworked to show all the errors
	{
			$Error = [];
			if(empty($login) OR empty($password) OR empty($password2) OR empty($email))
			{
				$Error = "Form can't be empty!";
			}else{
				$SQL = $this->db->prepare("SELECT user_login FROM users WHERE user_login = :login LIMIT 1");
				$SQL->bindParam('login',$login);
				$SQL->execute();
				$Row = $SQL->fetch(PDO::FETCH_ASSOC);
				if($Row['user_login'] == $login)
				{
					$Error[] = "Login <b>".$login."</b> already exist!";
				}else{
					if($password != $password2)
					{
						$Error[] = "Passwords don't match!";
					}else{
						if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) 
						{
							$Error[] = "Email is invalid!";
						}else{
						try{
							$date = date("Y-m-d H:i:s");
							$password = $this->hashpass($password);
							$SQL = $this->db->prepare("INSERT INTO users (user_login,user_password,user_email,user_date) VALUES (:login,:password,:email,:date)");
							$SQL->bindParam(':login',$login,PDO::PARAM_STR);
							$SQL->bindParam(':password',$password,PDO::PARAM_STR);
							$SQL->bindParam(':email',$email,PDO::PARAM_STR);
							$SQL->bindParam(':date',$date,PDO::PARAM_STR);
							$SQL->execute();
							echo '<script>alert("Your account '.$login.' has been created!");</script>';
							}catch(PDOEXCEPTION $e)
							{
								echo $e->getMessage();
							}
						}
					}	
				}
			if(count($Error) > 0){return $Error;}
		}
	}
			
	
	public function get_Data($get)
	{
		$SQL = $this->db->prepare("SELECT * FROM users WHERE user_id=:user_id");
		$SQL->bindParam(':user_id',$_SESSION['user_id']);
		$SQL->execute();
		$Row = $SQL->fetch(PDO::FETCH_ASSOC);
		return $Row[$get];
		
	}
	public function hashpass($str) {
		return hash('sha256', $str);
	}

	public function logout()
	{
		session_destroy();
		$_SESSION['user_id'] = null;
		
	}
	
	public function is_logged(){
	return isset($_SESSION['user_id']);}
	
	public function UserLvl()
	{
		$Level = '';
		$Lvl = $this->get_Data('user_level');
		if($Lvl == 0)
		{
			$Level = 'Uzytkownik';
		}elseif($Lvl == 1)
		{
			$Level = 'Administrator';
		}elseif($Lvl == 2)
		{
			$Level = 'Head Administrator';
		}
		return $Level;
	}
		
}


?>