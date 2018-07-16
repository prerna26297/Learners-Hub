<?php 
    session_start(); 
    require("connection.php"); 
    if(isset($_GET['page'])){ 
          
        $pages=array("products", "cart"); 
          
        if(in_array($_GET['page'], $pages)) { 
              
            $_page=$_GET['page']; 
              
        }else{ 
              
            $_page="products"; 
              
        } 
          
    }else{ 
          
        $_page="products"; 
          
    } 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Buy or Sell</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="reset.css" /> 
    <link rel="stylesheet" href="style1.css" /> 
<style>
.city {
    background-color:#524f4c;
    color: white;
    padding: 10px;
} 
a:link {
    background-color:white ;
	color:black;
}


a:hover {
    background-color: powderblue;
}

a:active {
    background-color: blue;
} 
h1{
background-color:white;
}

</style>
</head>
<body style= "background-color:#9e2b1c;">
<!--<div id="navigation">
  <ul>
    <li><a href="index.html">Home</a></li>
    <li class="active"><a href="#">Buy</a></li>
    <li><a href="#">Commercial Templates</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
</div>-->

<?php
// Echo session variables that were set on previous page
if(!isset($_SESSION["USER"]))
{
header("location:index.html");
}
else
{
echo "<h1 style='color:black; font-size:300%; padding-left:50px; padding-top:20px; padding-bottom:20px; margin-bottom: 15px'><b>Hello ". $_SESSION["USER"] ." !!</b></h1>";
echo "<H2 align='right' style='padding-right:50px;margin-right:10px;';><a  href='logout.php'>LOGOUT</a></H2>";
echo "<h2 align='center' style='color:black; font-size:200%; padding-left:50px; padding-top:50px;padding-bottom:20px;'><b>Sell</b></h2>";
}
?>
<form align='center' method='POST' action='getdata.php' enctype='multipart/form-data'>
<br><b><h2 align='center' style='color:white;'>Book Name:</h2></b>
<input type='text' name='bname' required>
<br><br><b><h2 align='center' style='color:white;'>Price:</h2></b>
<input type='number' name='price' required>
<br><br><b><h2 align='center' style='color:white;'>Contact Number:</h2></b>
  <input type="text" name='contactno' maxlength='10' required>
  <br><br><br>
<input type='file' name='myimage' required>
 <input type='submit' name='submit_image' value='Upload'>
</form>
<br>
<br>
<br>
<?php 
echo"<h2 align='center' style='color:black; font-size:200%; padding-left:50px; padding-top:50px;padding-bottom:20px;'><b>Add to cart</b></h2>"
?>
 <div id="container">
  
        <div id="main"> 
		
		 <?php require($_page.".php"); ?>
        </div><!--end of main--> 
          
        
            <h1>Cart</h1> 
<?php 
  
    if(isset($_SESSION['cart'])){ 
          
        $sql="SELECT * FROM products WHERE id_product IN ("; 
          
        foreach($_SESSION['cart'] as $id => $value) { 
            $sql.=$id.","; 
        } 
          
        $sql=substr($sql, 0, -1).") ORDER BY name ASC"; 
        $query=mysql_query($sql); 
        while($row=mysql_fetch_array($query)){ 
              
        ?> 
            <p><?php echo $row['name'] ?> x <?php echo $_SESSION['cart'][$row['id_product']]['quantity'] ?></p> 
        <?php 
              
        } 
    ?> 
        <hr /> 
        <a href="buysell.php?page=cart">Go to cart</a> 
    <?php 
          
    }else{ 
          
        echo "<p>Your Cart is empty. Please add some products.</p>"; 
          
    } 
  
?>  
      <!--end of sidebar--> 
    </div><!--end container--> 
<?php
echo "<h2 align='center' style='color:black; font-size:200%; padding-left:50px; padding-top:20px;padding-bottom:20px;'><b>Buy Now!!</b></h2>"
?>
<form method="POST" action="books.php" align="center">
<p style='color:white;'>Book name:</p><br>
<select name="bookname">
<option value="Harry Potter">Harry Potter</option>
<option value="Science Immunology">Science Immunology</option>
<option value="A Brief History of Time">A Brief History of Time</option>
<option value="Echo Park">Echo Park</option>
<option value="The World Is Flat">The World Is Flat</option>
<option value="Act of Treason">Act of Treason</option>
<option value="The Elegant Universe">The Elegant Universe</option>
<option value="Freakonomics">Freakonomics</option>
</select><br><br>
<p style='color:white;'>No. of copies:</p><br>
<input type="number" name="noc"><br><br>
<input type="Submit" value="Submit">
</form>
<br>

<p style='color:white;' align='center'>To buy second hand books <a href="display.php">Click Here</a></p>
<br>
<br>


	
<!--
<div id="content-wrapper">
  <div id="content">
   <p><class="drop-shadow"><img src="bookimages/hp.jpg" width="100" height="150" alt="The Mephisto Club by Tess Gerritsen" class="captionated" /></a></p>
    
	<p><class="drop-shadow"><img src="bookimages/scimu.jpg" width="100" height="150" alt="Dark Celebration by Christine Freehan" class="captionated" /></a></p>
    <p><class="drop-shadow"><img src="bookimages/sh.jpg" width="100" height="150" alt="Ricochet by Sandra Brown" class="captionated" /></a></p>
    <p><class="drop-shadow"><img src="bookimages/echo_park.jpg" width="100" height="150" alt="Echo Park by Michael Connelly" class="captionated" /></a></p>
    <hr />
    <p><class="drop-shadow"><img src="bookimages/the_world_is_flat.jpg" width="100" height="150" alt="The World is Flat by Thomas L. Friedman" class="captionated" /></a></p>
    <p><class="drop-shadow"><img src="bookimages/act_of_treason.jpg" width="100" height="150" alt="Act of Treason by Vince Flynn" class="captionated" /></a></p>
    <p><class="drop-shadow"><img src="bookimages/eu.jpg" width="100" height="150" alt="Rich Dad, Poor Dad" class="captionated" /></a></p>
    <p><class="drop-shadow"><img src="bookimages/freakonomics.jpg" width="100" height="150" alt="Freakonomics" class="captionated" /></a></p>
  </div>
</div>
-->


 </body>
 
</html>
