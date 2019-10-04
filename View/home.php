<?php 
    session_start();


    if(!isset($_SESSION['username'])){

        header("location:index.php");
    }
    



    include("../Model/connect_db.php");
    $conn = connect_db();


    if(isset($_GET['action'])&&$_GET['action']=="add"){
        $id=intval($_GET['id']); 
        if(isset($_SESSION['cart'][$id])){ 
              
            $_SESSION['cart'][$id]['quantity']++; 
              
        }else{ 
              
            $sql_s="SELECT * FROM products WHERE ID={$id}"; 
            $query_s=query($conn,$sql_s); 
            if($query_s){
                if(num_rows($query_s)!=0){ 
                    $row_s=fetch_array($query_s); 
                      
                    $_SESSION['cart'][$row_s['ID']]=array( 
                            "quantity" => 1, 
                            "price" => $row_s['price'] 
                        ); 
                      
                      
                }else{ 
                      
                    $message="This product id it's invalid!"; 
                      
                } 
            }
          
    }
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="css/reset.css" /> 
    <link rel="stylesheet" href="css/home.css" /> 
      
    <title>Shopping cart</title> 

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

    <h2>Shopping Cart - Luu Xuan Tung - AT120458</h2>
    <br>
    <p>Hello <?php echo $_SESSION['username'] ?> <a href="../Controller/logout.php">Log out</a> <a href="changepass.php">Change Password</a>  <a href="cart.php">Cart</a></p> 

    </div>
    
   
    <div id="container"> 

        <div id="main"> 
                <h1>Product List</h1> 
                <?php 
         if(isset($message)){ 
                echo "<h2>$message</h2>"; 
            } 
        ?>
                <table> 
                    <tr> 
                        <th>Name</th> 
                        <th>Description</th> 
                        <th>Price</th> 
                        <th>Measure</th>
                        <th>Amount</th>
                        <th>Action</th> 
                    </tr> 
                  <?php 
                  $sql = "SELECT * FROM products ORDER BY name ASC";
                  $query = query($conn,$sql);
                    while($row = fetch_array($query))
                    {

                  ?>
                    <tr>
                            <td><a href ="product.php?id=<?php  echo $row['ID']?>"><?php echo $row['name']; ?></a></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['measure']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><a href ="home.php?action=add&id=<?php  echo $row['ID']?>">Add to cart</a></td>

                    </tr>

                <?php 
                
                    }

                
                ?>
                </table>
               
        </div><!--end main-->
          
  
    </div><!--end container-->
  
</body> 
</html>