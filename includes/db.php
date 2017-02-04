<?php
/* db.php */

session_start();

try
{
     $connection = new PDO("mysql:host={$MYSQL_HOST};dbname={$MYSQL_DB}",$MYSQL_USER,$MYSQL_PASSWORD);
     $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e)
	{
		echo $e->getMessage();
	}


?>