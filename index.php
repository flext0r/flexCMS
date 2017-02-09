<?php
echo phpversion();
require_once 'templates/flexDefault/layout.php';

startblock('title');
echo 'Home';
endblock();

startblock('thead');
echo 'Home';
endblock();


startblock('content');
$User->NewestUsers();
echo '<center><h1>someth1ng</h1></center>';

endblock();

?>

	