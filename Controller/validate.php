<?php 

function validation($pattern,$username){
    return preg_match($pattern, $username, $matches);
}



?>