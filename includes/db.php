<?php
/* db.php 

Coded by flext0r © 2016 - 2017

*/

session_start();

try
{
	$connection = new PDO("mysql:host={$MYSQL_HOST};",$MYSQL_USER,$MYSQL_PASSWORD);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connection->query("CREATE DATABASE IF NOT EXISTS `{$MYSQL_DB}`");
	$connection->query("USE `$MYSQL_DB`");
	$connection->query("CREATE TABLE IF NOT EXISTS `users` (
		`user_id` int(11) NOT NULL AUTO_INCREMENT,
		`user_login` varchar(255) COLLATE utf8_bin NOT NULL,
		`user_password` char(64) COLLATE utf8_bin NOT NULL,
		`user_level` INT(11) NOT NULL,
		`user_email` varchar(255) COLLATE utf8_bin NOT NULL,
		`user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		`verified` INT(11) NOT NULL,
		`verification_code` varchar(255) COLLATE utf8_bin NOT NULL,
		`reset_key` varchar(255) COLLATE utf8_bin NOT NULL,
		`banned` INT(11) NOT NULL,
		PRIMARY KEY (`user_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

		CREATE TABLE IF NOT EXISTS `settings` (
		`title` varchar(255) COLLATE utf8_bin NOT NULL,
		`footer` varchar(255) COLLATE utf8_bin NOT NULL,
		`tech_reason` varchar(255) COLLATE utf8_bin NOT NULL,
		`tech_break` INT(11) NOT NULL,
		`register` INT(11) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

		CREATE TABLE IF NOT EXISTS `articles` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`title` text NOT NULL,
		`content` text NOT NULL,
		`author` varchar(255) COLLATE utf8_bin NOT NULL,
		`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");
	}catch(PDOException $e)
	{
		echo $e->getMessage();
	}


?>