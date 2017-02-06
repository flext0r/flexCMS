<?php
/* users.php 

Coded by flext0r © 2016 - 2017

*/
require_once 'templates/flexDefault/layout.php';

startblock('title');
echo 'Lista Użytkowników';
endblock();

startblock('thead');
echo 'Lista Użytkowników';
endblock();

startblock('content');
$User->Users();


endblock();

?>

	