<?php
/* db.php */

session_start();

try
{
     $DB_con = new PDO("mysql:host={$MYSQL_HOST};dbname={$MYSQL_DB}",$MYSQL_USER,$MYSQL_PASSWORD);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e)
	{
		echo $e->getMessage();
	}


?>