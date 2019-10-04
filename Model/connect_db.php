<?php 

  


    function connect_db(){    
        $servername = "localhost";
        $database = "demo";
        $username = "root";
        $password ="";
         $conn = mysqli_connect($servername,$username,$password,$database);

         if ($conn->connect_error) {
            die("Connection failed: " );
        }else  return $conn;

      
    }


    function query($conn,$sql){

        return mysqli_query($conn, $sql);
    }

    function num_rows($result){
        return mysqli_num_rows($result);
    }

    function fetch_array($result){
      return  mysqli_fetch_array($result,MYSQLI_ASSOC);
        // MYSQLI_ASSOC => Associative array
       // MYSQLI_NUM => Numeric array
       // MYSQLI_BOTH
    }





?>