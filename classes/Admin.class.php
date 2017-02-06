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
}



?>