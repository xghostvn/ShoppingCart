<?php 
session_start();
if(isset($_POST['submit'])){

    include("../Model/connect_db.php");
    include("validate.php");
    $conn = connect_db();


    $username = $_SESSION['username'];
    $current_password = $_POST['current-password'];
    $new_password = $_POST['new-password'];
    $re_password = $_POST['re-new-password'];
 


    //Should have 1 lowercase letter, 1 uppercase letter, 1 number, and be at least 8 characters long
    $pattern_password = "/(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$/";


    if (!validation($pattern_password,$current_password)){
        echo '<script language="javascript">alert("invalid password"); window.location="../View/changepass.html";</script>';
        die();
    }


    if (!validation($pattern_password, $new_password)){
        echo '<script language="javascript">alert("invalid password"); window.location="../View/changepass.html";</script>';
        die();
    }


    if (!validation($pattern_password, $re_password )){
        echo '<script language="javascript">alert("invalid password"); window.location="../View/changepass.html";</script>';
        die();
    }



    // md5 encrypt
    $current_password = md5($current_password);
    $new_password = md5($new_password);
    $re_password = md5($re_password);


    
    if($new_password!=$re_password){
        echo '<script language="javascript">alert("new-password and re-password not match"); window.location="../View/changepass.php";</script>';
        die();
    }



    $sql = "SELECT * FROM members WHERE username = '$username'";


    $result = query($conn, $sql);



     
        $row = fetch_array($result);

        if ($current_password != $row['password']) {
            echo '<script language="javascript">alert("invalid password"); window.location="../View/changepass.php";</script>';
            exit;
        }else {


           $sql = "UPDATE members SET password='$new_password' WHERE username ='$username'";

           if(query($conn,$sql)){
                echo '<script language="javascript">alert("change password successful"); window.location="../View/changepass.php";</script>';
           }else {
                echo '<script language="javascript">alert("Error Handler"); window.location="../View/changepass.php";</script>';
           }

        }

    


    
















}





