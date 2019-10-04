<?php 
    session_start();
    if(!isset($_SESSION['username'])){

        header("location:index.php");
    }  
    include("../Model/connect_db.php");
    $conn = connect_db();  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="css/reset.css" /> 
    <link rel="stylesheet" href="css/home.css" /> 
      
    <title>Cart</title> 

    <style>
    
    .header {
        text-align: center;
        width:100%;
        margin-top : 100px;
    }
  
    
    </style>
  
</head> 
  
<body> 
    <div class = "header">

    <h2> Product - Luu Xuan Tung - AT120458</h2>
    <br>
    <p>Hello <?php echo $_SESSION['username'] ?> <a href="../Controller/logout.php">Log out</a>  <a href="home.php">Shopping</a> </p> 

    </div>
    
   
    <div id="container"> 
        <div id="sidebar"> 
        <h1>Product</h1> 
            <?php 
  
        if(isset($_GET['id'])){ 
            $id = $_GET['id'];
          
            $sql="SELECT * FROM products WHERE ID={$id}"; 
        $query=query($conn,$sql);

        if($query){
        while($row=fetch_array($query)){  
        ?> 
            
        <p><?php echo "NAME : ".$row['name']; ?></p>
        <p><?php echo "Description : ".$row['description']; ?></p>
        <p><?php echo "Price : ".$row['price']; ?></p>
        <p><?php echo "Measure : ".$row['measure']; ?></p>
        <p><?php echo "Amount : ".$row['amount']; ?></p>
        <?php 
              
        } 
    }
    ?> 
      
    <?php 
          
    }
  
?>
        </div><!--end sidebar-->
  
    </div><!--end container-->
  
</body> 
</html>