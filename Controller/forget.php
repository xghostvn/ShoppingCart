<?php 
session_start();
if(isset($_POST['submit'])){

    include("../Model/connect_db.php");
    include("validate.php");
    $conn = connect_db();


    $username   = isset($_POST['username']) ? mysqli_real_escape_string($conn,$_POST['username']) : '';
    $email      = isset($_POST['email'])    ? mysqli_real_escape_string($conn,$_POST['email']) : '';
    $new_password = $_POST['new-password'];
    $re_password = $_POST['re-new-password'];
 


    // include _ and – having a length of 3 to 16 characters –
    $pattern_username = '/^[a-z0-9_-]{3,16}$/';

    if (!validation($pattern_username, $username)){
        echo '<script language="javascript">alert("invalid username. include _ and – having a length of 3 to 16 characters –"); window.location="../View/forgetpass.php";</script>';
        die();
    }

    //Should have 1 lowercase letter, 1 uppercase letter, 1 number, and be at least 8 characters long
    $pattern_password = "/(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$/";


    if (!validation($pattern_password, $new_password, $matches)){
        echo '<script language="javascript">alert("invalid password.Should have 1 lowercase letter, 1 uppercase letter, 1 number, and be at least 8 characters long"); window.location="../View/forgetpass.php";</script>';
        die();
    }

    if (!validation($pattern_password, $re_password, $matches)){
        echo '<script language="javascript">alert("invalid re-password.Should have 1 lowercase letter, 1 uppercase letter, 1 number, and be at least 8 characters long"); window.location="../View/forgetpass.php";</script>';
        die();
    }



    $pattern_email = "/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})*$/";

    if (!preg_match($pattern_email, $email, $matches)){
        echo '<script language="javascript">alert("invalid email address"); window.location="../View/forgetpass.php";</script>';
        die();
    }



    $new_password = md5($new_password);
    $re_password = md5($re_password);

    if($new_password!=$re_password){
        echo '<script language="javascript">alert("password and re-password not match"); window.location="../View/forgetpass.php";</script>';
        die();
    }






    $sql = "SELECT * FROM members WHERE username = '$username' OR email = '$email'";


    $result = query($conn, $sql);


    if (num_rows($result) == 0)
    {
     
        echo '<script language="javascript">alert("username not exist"); window.location="../View/forgetpass.php";</script>';
          
        die ();
    }
    else {
     
        $sql = "UPDATE members SET password='$new_password' WHERE username ='$username'";
          
        if (query($conn, $sql)){
            echo '<script language="javascript">alert("reset password successful"); window.location="../View/forgetpass.php";</script>';
            die();
        }
        else {
            echo '<script language="javascript">alert("Error Handler"); window.location="../View/forgetpass.php";</script>';
            die();
        }
    }




    
















}





