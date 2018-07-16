<?php
//echo '<img src="fetch.php?id=' . htmlspecialchars($_GET["img_id"]) . '"border ="0" height="250" width="250" />';
mysql_connect("localhost","root","")or die("Cannot connect to database"); 

//keep your db name
mysql_select_db("learnershub") or die("Cannot select database");
//$sql = "SELECT * FROM `second` where `bid` = 1"; 
// manipulate id ok 
//$sth = mysql_query($sql);
//$result=mysql_fetch_array($sth);
// this is code to display 
//echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['img'] ).'"/ width="200" height="200">"';
?>
 <html>
<head>
<style>
 body {
	 background-color:FireBrick ;
	 background-image: url("backgrnd6.jpg");
	  background-repeat: no-repeat;
	  background-size: 100% 100%;
	
} 
table, td, th {    
    border: 1px solid #ddd;
    text-align: left;
}

table {
	padding-top: 50px
    border-collapse: collapse;
    width: 50%;
	color:Ivory 
}

th, td {
    padding: 15px;
}
tr:hover {background-color: black }
</style>
 <body>
 <br><br>
 <br><br><br><br><br><p align="center" style='color:white;'>To purchase a book,Contact the corresponding contact provided. </p>
 <br>
 <br>
 <br>
 
			<table border=.1 align='center' > 
        <tr> 
			 <th>Image</th>
            <th>Name</th> 
            <th>Price</th> 
            <th>Contact</th> 
			 
        </tr> 
			
  <?php 
  
    $sql="SELECT * FROM second ORDER BY bookname ASC"; 
    $query=mysql_query($sql); 
      
    while ($row=mysql_fetch_array($query)) { 
          
?> 
        <tr> 
		 <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'"/ width="150" height="250">'; ?></td> 
            <td ><?php echo $row['bookname'] ?></td> 
            <td width=20%><?php echo $row['price'] ?></td> 
            <td width=20%><?php echo $row['contact'] ?></td> 
           
        </tr> 
<?php 
          
    } 
  
?>
</table>
</body>
</html>