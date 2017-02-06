<?php
/* User.php *

Coded by flext0r © 2016 - 2017

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
			if(!check_username($login))
			{
				$Error[] = 'Username is invalid';
			}
			if($password != $password2)
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
					echo '<center>Your account <b>'.$login.'</b> has been created!</center>';
					}catch(PDOEXCEPTION $e)
					{
						echo $e->getMessage();
					}
				}else{
					return $Error;
				}
		}
	
	public function EditProfile($username,$currentpassword,$newpassword,$confirmpassword,$email)//might be finished but needs to be tested for some time
	{
		$SQL = $this->db->prepare("SELECT user_id, user_login,user_email FROM users WHERE user_id != :id AND user_login = :login AND user_email = :email");
		$SQL->bindParam(':login',$username);
		$SQL->bindParam(':email',$email);
		$SQL->bindParam(':id',$this->get_Data('user_id'));
		$SQL->execute();
		$Row = $SQL->fetch(PDO::FETCH_ASSOC);
		$Error = [];
		if($username == '')
		{
			$username = $this->get_Data('user_login');
		}
		if(!check_username($username))
		{
			$Error[] = 'Username is invalid';
		}
		if($username == $Row['user_login'])
		{
			$Error[] = "<b>".$username."</b> is already taken!";
		}
		if($this->get_Data('user_password') != $this->hashpass($currentpassword))
		{
			$Error[] = 'Your password is wrong!';
		}
		if($newpassword != $confirmpassword)
		{
			$Error[] = 'Passwords dont match!';
		}elseif(!check_password($newpassword))
		{
			$Error[] = 'Password is invalid';
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
		{
			$Error[] = "Email is invalid!";
		}
		if($email == $Row['user_email'])
		{
			$Error[] = 'Email is already taken!';
		}
		if(count($Error) == 0)
		{
			try {
				if($newpassword == '')
				{
					$newpassword = $this->get_Data('user_password');
				}else{
					$newpassword = $this->hashpass($newpassword);
				}
				$SQL = $this->db->prepare("UPDATE users SET user_login = :username, user_password = :password, user_email = :email WHERE user_id = :id");
				$SQL->bindParam(':username',$username);
				$SQL->bindParam(':password',$newpassword);
				$SQL->bindParam(':email',$email);
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
	public function Users()// broken af
	{
		$results_per_page = 20;
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
		$start_from = ($page-1) * $results_per_page;
		$SQL = $this->db->prepare("SELECT user_id,user_login,user_level FROM users ORDER BY user_id LIMIT 10");
		$SQL->bindParam(':start',$start_from,PDO::PARAM_INT);
		$SQL->execute();
		
		echo'<table border="1" cellpadding="4">
		<tr>
		<td bgcolor="#CCCCCC"><strong>ID</strong></td>
		<td bgcolor="#CCCCCC"><strong>Name</strong></td><td bgcolor="#CCCCCC"><strong>Level</strong></td></tr>';

		while($Row = $SQL->fetch(PDO::FETCH_ASSOC)) {
 
            echo '<tr>
            <td>'.$Row['user_id'].'</td>
            <td>'.$Row['user_login'].'</td>
            <td>'.$Row['user_level'].'</td>
            </tr>';

		};
		$SQL = $this->db->prepare("SELECT COUNT(user_id) AS total FROM users");
		$SQL->execute();
		$Row = $SQL->fetch(PDO::FETCH_ASSOC);
		$total_pages = ceil($Row["total"] / $results_per_page); // calculate total pages with results
  
		for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='users.php?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
		}; 
		
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
	
	public function is_logged(){
	return isset($_SESSION['user_id']);}
	
	public function UserLvl()
	{
		$Level = null;
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