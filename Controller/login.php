<?php 
session_start();
if(isset($_POST['submit'])){

    include("../Model/connect_db.php"); // include model
    include("validate.php");
    $conn = connect_db();


    $username   = isset($_POST['username']) ? mysqli_real_escape_string($conn,$_POST['username']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn,$_POST['password']) : '';
 

    // include _ and – having a length of 3 to 16 characters –
    $pattern_username = '/^[a-z0-9_-]{3,16}$/';

    if (!validation($pattern_username, $username)){
        echo '<script language="javascript">alert("invalid username. Include _ and – having a length of 3 to 16 characters – "); window.location="../View/index.php";</script>';
        die();
    }

    //Should have 1 lowercase letter, 1 uppercase letter, 1 number, and be at least 8 characters long
    $pattern_password = "/(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$/";


    if (!validation($pattern_password, $password)){
        echo '<script language="javascript">alert("invalid password .Should have 1 lowercase letter, 1 uppercase letter, 1 number, and be at least 8 characters long"); window.location="../View/index.php";</script>';
        die();
    }
    $password = md5($password);

    $sql = "SELECT * FROM members WHERE username = '$username'";


    $result = query($conn, $sql);
    //check username exist

    if (num_rows($result)  ==  0)
    {
     
        echo '<script language="javascript">alert("username not exist "); window.location="../View/index.php";</script>';
          
        die ();
    }
    else {
        
        $row = fetch_array($result);

        if ($password != $row['password']) {
            echo '<script language="javascript">alert("invalid username or password "); window.location="../View/index.php";</script>';
            exit;
        }else {

            //login success => create session
            $_SESSION['username'] = $username;
           
            if(isset($_SESSION['username'])){
                header("Location: ../View/home.php"); // redirect => changepass.php
            }
        }

    }


    
















}





