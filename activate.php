<?php

require_once 'templates/flexDefault/layout.php';

startblock('title');
echo 'Activate';
endblock();

startblock('thead');
echo 'Activate';
endblock();


startblock('content');

$User->Activate();

endblock();

?>

	