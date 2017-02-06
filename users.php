<?php
/* users.php 

Coded by flext0r © 2016 - 2017

*/
require_once 'templates/flexDefault/layout.php';

startblock('title');
echo 'Users';
endblock();

startblock('thead');
echo 'Users';
endblock();

startblock('content');
$User->Users();


endblock();

?>

	