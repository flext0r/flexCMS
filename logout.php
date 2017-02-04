<?php
/* logout.php 

Coded by flext0r © 2016

*/
session_start();
unset($_SESSION['user_id']);
session_destroy();

header('Location: index.php');

?>