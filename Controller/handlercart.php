<?php 
session_start();




if(isset($_GET['action'])){

    
    $action = $_GET['action'];

    if($action == 'clearall'){
        unset($_SESSION['cart']);
        header("location:../View/home.php");
     
    }else if($action == 'clearone'){
        $id = $_GET['id'];

        unset($_SESSION['cart'][$id]);
        header("location:../View/home.php");

    }else if($action == 'down'){
        $id = $_GET['id'];

   
        $_SESSION['cart'][$id]['quantity']--; 
        if($_SESSION['cart'][$id]['quantity']==0){
            unset($_SESSION['cart'][$id]);
        }
        header("location:../View/home.php");

    }


  
  
 
}





?>