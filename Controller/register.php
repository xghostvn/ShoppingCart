<?php 


if(isset($_POST['submit'])){  

    include("../Model/connect_db.php"); // include model
    include("validate.php");

    $conn = connect_db(); // connect database33


    $username   = isset($_POST['username']) ? mysqli_real_escape_string($conn,$_POST['username']) : '';
    $email      = isset($_POST['email'])    ? mysqli_real_escape_string($conn,$_POST['email']) : '';
    $password = $_POST['password'] ? mysqli_real_escape_string($conn,$_POST['password']) : '';
    $repassword = $_POST['re-password'] ? mysqli_real_escape_string($conn,$_POST['re-password']) : '';


    // include _ and – having a length of 3 to 16 characters –
    $pattern_username = '/^[a-z0-9_-]{3,16}$/';

    if (!validation($pattern_username, $username)){
        echo '<script language="javascript">alert("invalid username "); window.location="../View/index.php";</script>';
        die();
    }

    //Should have 1 lowercase letter, 1 uppercase letter, 1 number, and be at least 8 characters long
    $pattern_password = "/(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$/";


    if (!validation($pattern_password, $password)){
        echo '<script language="javascript">alert("invalid password.Should have 1 lowercase letter, 1 uppercase letter, 1 number, and be at least 8 characters long"); window.location="../View/index.php";</script>';
        die();
    }

    if (!validation($pattern_password, $repassword)){
        echo '<script language="javascript">alert("invalid re-password.Should have 1 lowercase letter, 1 uppercase letter, 1 number, and be at least 8 characters long"); window.location="../View/index.php";</script>';
        die();
    }



    $pattern_email = "/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})*$/";

    if (!validation($pattern_email, $email)){
        echo '<script language="javascript">alert("invalid email address"); window.location="../View/index.php";</script>';
        die();
    }

    //md6 encrypt

    $password = md5($password);
    $repassword = md5($repassword);

        // password and re-pass not match
    if($password!=$repassword){

        echo '<script language="javascript">alert("password and re-password not match"); window.location="../View/index.php";</script>';
        die();
    }





    $sql = "SELECT * FROM members WHERE username = '$username' OR email = '$email'";


    $result = query($conn, $sql);

    //check username exist
    if (num_rows($result) > 0)
    {
     
        echo '<script language="javascript">alert("username or email already exist"); window.location="../View/index.php";</script>';
          
        die ();
    }
    else {
        // not exist = > insert database
        $sql = "INSERT INTO members (username, password, email) VALUES ('$username','$password','$email')";
          
        if (query($conn, $sql)){
            echo '<script language="javascript">alert("register successful . Login now"); window.location="../View/index.php";</script>';
            die();
        }
        else {
            echo '<script language="javascript">alert("Error Handler"); window.location="../View/index.php";</script>';
            die();
        }
    }


    
















}





