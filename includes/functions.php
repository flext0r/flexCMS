<?php
/* Admin.php

Coded by flext0r © 2016 - 2017

*/

function check_username($username){
// accepted username length between 5 and 20
    if (preg_match('/^\w{5,20}$/', $username))
        return true;
    else
        return false;
}

function check_password($pwd){
// accepted password length between 5 and 20, start with character.
    if (preg_match("/^[a-zA-Z][0-9a-zA-Z_!$@#^&]{5,20}$/", $pwd))
        return true;
    else
        return false;
}

?>