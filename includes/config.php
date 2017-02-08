<?php
/* config.php 

Coded by flext0r © 2016

*/

$MYSQL_HOST = 'localhost';
$MYSQL_DB = 'project';
$MYSQL_PASSWORD = '';
$MYSQL_USER = 'root';

$ShowUserInfo = null;
$date = date("Y-m-d H:i:s");


/*
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_password` char(64) COLLATE utf8_bin NOT NULL,
  `user_level` INT(11) NOT NULL,
  `user_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified` INT(11) NOT NULL,
  `verification_code` varchar(255) COLLATE utf8_bin NOT NULL,
  `reset_key` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


*/


/*
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


*/

?>