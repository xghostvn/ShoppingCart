<?php 
session_start();

// logout account 
if(isset($_SESSION['username'])){

    unset($_SESSION['username']);
    unset($_SESSION['cart']);
    header("Location: ../View/index.php");
    
}





