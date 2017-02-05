<?php
/*
Main.php

Coded by flext0r © 2016

*/

require 'config.php';
require 'db.php';
require './classes/User.class.php';
require './classes/Admin.class.php';
require './classes/Articles.class.php';
require 'functions.php';

$User = new User($connection);
$Admin = new Admin($connection);
$Article = new Articles($connection);



?>