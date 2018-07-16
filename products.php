<?php 
  
    if(isset($_GET['action']) && $_GET['action']=="add"){ 
          
        $id=intval($_GET['id']); 
          
        if(isset($_SESSION['cart'][$id])){ 
              
            $_SESSION['cart'][$id]['quantity']++; 
              
        }else{ 
              
            $sql_s="SELECT * FROM products 
                WHERE id_product={$id}"; 
            $query_s=mysql_query($sql_s); 
            if(mysql_num_rows($query_s)!=0){ 
                $row_s=mysql_fetch_array($query_s); 
                  
                $_SESSION['cart'][$row_s['id_product']]=array( 
                        "quantity" => 1, 
                        "price" => $row_s['price'] 
                    ); 
                  
                  
            }else{ 
                  
                $message="This product id it's invalid!"; 
                  
            } 
              
        } 
          
    } 
  
?>

<h1>Books List</h1> 

<?php
if(isset($message))
{
echo "<h2>$message</h2>";
}
?>
            
			<table> 
        <tr> 
            <th>Name</th> 
            <th>Author's name</th> 
            <th>Price</th> 
            <th>Add to cart</th> 
        </tr> 
			
  <?php 
  
    $sql="SELECT * FROM products ORDER BY name ASC"; 
    $query=mysql_query($sql); 
      
    while ($row=mysql_fetch_array($query)) { 
          
?> 
        <tr> 
            <td><?php echo $row['name'] ?></td> 
            <td><?php echo $row['description'] ?></td> 
            <td><?php echo $row['price'] ?>₹</td> 
            <td><a href="buysell.php?page=products&action=add&id=<?php echo $row['id_product'] ?>">Add to cart</a></td> 
        </tr> 
<?php 
          
    } 
  
?>
</table>