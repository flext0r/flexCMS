<?php
/* User.php *

Coded by flext0r © 2016

*/
class User
{
	protected $db;
	
	public function __construct($connection)
	{
		$this->db = $connection;
	
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
		

	public function Register($login,$password,$password2,$email)
	{
			$Error = [];
			if(empty($login) OR empty($password) OR empty($password2) OR empty($email))
			{
				$Error[] = "Form can't be empty!";
				
			}
			if($password != $password2)
			{
				$Error[] = "Passwords don't match!";
			}
			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) 
			{
				$Error[] = "Email is invalid!";
			}
				$SQL = $this->db->prepare("SELECT user_login,user_email FROM users WHERE user_login = :login OR user_email = :email LIMIT 1");
				$SQL->bindParam(':login',$login);
				$SQL->bindParam(':email',$email);
				$SQL->execute();
				$Row = $SQL->fetch(PDO::FETCH_ASSOC);
				if($Row['user_login'] == $login)
				{
					$Error[] = "Login <b>".$login."</b> already exist!";
				}
				if($Row['user_email'] == $email)
				{
					$Error[] = 'Email <b>'.$email.'</b> is already taken!';
				}
				if(count($Error) == 0)
				{
					try{
						$password = $this->hashpass($password);
						$SQL = $this->db->prepare("INSERT INTO users (user_login,user_password,user_email,user_date) VALUES (:login,:password,:email,:date)");
						$SQL->bindParam(':login',$login,PDO::PARAM_STR);
						$SQL->bindParam(':password',$password,PDO::PARAM_STR);
						$SQL->bindParam(':email',$email,PDO::PARAM_STR);
						$SQL->bindParam(':date',date("Y-m-d H:i:s"),PDO::PARAM_STR);
						$SQL->execute();
						echo '<script>alert("Your account '.$login.' has been created!");</script>';
						}catch(PDOEXCEPTION $e)
						{
							echo $e->getMessage();
						}
				}else{
					return $Error;
				}
	}
	
	public function EditProfile($username,$currentpassword,$newpassword,$confirmpassword,$email)//still needs loads of work ffs
	{
		$SQL = $this->db->prepare("SELECT user_login,user_email FROM users WHERE user_login = :login OR user_email = :email LIMIT 1");
		$SQL->bindParam(':login',$username);
		$SQL->bindParam(':email',$email);
		$SQL->execute();
		$Row = $SQL->fetch(PDO::FETCH_ASSOC);
		
		$Error = [];
		if(empty($username) OR empty($email))
		{
			$username = $this->get_Data('user_login');
			$email = $this->get_Data('user_email');
		}
		if($username == $Row['user_login'])
		{
			$Error[] = "<b>".$username."</b> is already taken";
		}
		if($this->get_Data('user_password') != $this->hashpass($currentpassword))
		{
			$Error[] = 'Your password is wrong!';
		}
		if($newpassword != $confirmpassword)
		{
			$Error[] = 'Passwords dont match!';
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) 
		{
			$Error[] = "Email is invalid!";
		}
		if($email == $Row['user_email'])
		{
			$Error[] = 'Email <b>'.$email.'</b> is already taken!';
		}
		if(count($Error) == 0)
		{
			try {
				
				$newpassword = $this->hashpass($newpassword);
				$SQL = $this->db->prepare("UPDATE users SET user_login = :username, user_password = :password, user_email = :email WHERE user_id = :id");
				$SQL->bindParam(':username',$username);
				$SQL->bindParam(':password',$newpassword);
				$SQL->bindParam(':email',$newemail);
				$SQL->bindParam(':id',$this->get_Data('user_id'));
				$SQL->execute();
				echo '<center>Your profile has been updated!</center>';
			}catch(PDOEXCEPTION $e)
			{
				echo $e->getMessage();
			}
		}else{
			return $Error;
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
	public function get_DataID($data,$userid)// get_Data will be probably replaced
	{
		$SQL = $this->db->prepare("SELECT * FROM users WHERE user_id=:user_id");
		$SQL->bindParam(':user_id',$userid);
		$SQL->execute();
		$Row = $SQL->fetch(PDO::FETCH_ASSOC);
		return $Row[$data];
		
	}
	public function hashpass($str) {
		return hash('sha256', $str);
	}

	public function logout()
	{
		session_destroy();
		$_SESSION['user_id'] = null;
		header("Location: index.php");
		
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