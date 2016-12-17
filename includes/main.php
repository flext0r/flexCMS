<?php
/*
Main.php

Coded by flext0r © 2016

*/

require 'config.php';
require 'db.php';
require './class/user.php';
require './class/admin.php';

$User = new User($DB_con);
$Admin = new Admin($DB_con);



?>