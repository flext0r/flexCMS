<?php
/*
Main.php

Coded by flext0r © 2016 - 2017

*/

require 'config.php';
require 'db.php';
require 'functions.php';
require './classes/User.class.php';
require './classes/Admin.class.php';
require './classes/Articles.class.php';

$User = new User($connection);
$Admin = new Admin($connection);
$Article = new Articles($connection);



?>