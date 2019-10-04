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

    <h2> Cart - Luu Xuan Tung - AT120458</h2>
    <br>
    <p>Hello <?php echo $_SESSION['username'] ?> <a href="../Controller/logout.php">Log out</a>  <a href="home.php">Shopping</a> </p> 

    </div>
    
   
    <div id="container"> 
        <div id="sidebar"> 
        <h1>Cart</h1> 
            <?php 
  
        if(isset($_SESSION['cart'])){ 
          
        $sql="SELECT * FROM products WHERE ID IN ("; 
          
        foreach($_SESSION['cart'] as $id => $value) { 
            $sql.=$id.","; 
        } 
          
        $sql=substr($sql, 0, -1).") ORDER BY name ASC"; 
        $query=query($conn,$sql);
        $total = 0; 
        if($query){
        while($row=fetch_array($query)){ 
            $prices = intval($_SESSION['cart'][$row['ID']]['quantity']) * intval($row['price']);
           $total +=$prices;
        ?> 
            
            <p><?php echo $row['name'] ?> x <?php echo $_SESSION['cart'][$row['ID']]['quantity'] . " = ".number_format($prices)." VND" ?> </p><a href ="../Controller/handlercart.php?action=clearone&id=<?php echo $row['ID'] ?>">Clear products</a> | <a href ="../Controller/handlercart.php?action=down&id=<?php echo $row['ID'] ?>">-</a>
        <?php 
              
        } 
    }
    ?> 
        <hr /> 
        <p>Total : <?php echo number_format($total)." VND" ?></p>
        <br>
        <a href ="../Controller/handlercart.php?action=clearall">Clear Cart</a>
    <?php 
          
    }else{ 
          
        echo "<p>Your Cart is empty. Please add some products.</p>"; 
          
    } 
  
?>
        </div><!--end sidebar-->
  
    </div><!--end container-->
  
</body> 
</html>