<?php
 session_start(); 
 
 $bname=$_REQUEST['bname'];
$price=$_REQUEST['price'];
$contactno=$_REQUEST['contactno'];

 
$servername = "localhost";
$dbname = "learnershub";
$username="root";
$password="";

$imagename=$_FILES["myimage"]["name"]; 

// Create connection
$conn =  mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
	echo 'conn';
    die("connection failed: " . $conn->connect_error);
} 
$uname=$_SESSION["USER"];
$sql = "SELECT userid FROM user WHERE username='$uname'";
	$result = $conn->query($sql);
	
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$user_id=$row["userid"];
	}
if(!isset($_SESSION["USER"]))
{echo "<h3>You are not logged in<h3><br>";
echo "<h2><a href='login.php'>LOG IN AGAIN?</a></h3>";
}
else
{
//$sql =  "INSERT INTO `second`(`bookname`, `price`, `contact`, `userid`) 
//VALUES ('".$bname."','".$price."','".$contactno."','".$user_id."')";

$imagename=$_FILES["myimage"]["name"]; 

//Get the content of the image and then add slashes to it 
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

//Insert the image name and image content in table
$insert_image="INSERT INTO `second`(`bookname`, `price`, `contact`,`img_name`, `img`, `userid`) 
VALUES('".$bname."','".$price."','".$contactno."','".$imagename."','".$imagetmp."','".$user_id."')";
mysql_query($insert_image);
if (mysqli_query($conn,$insert_image)) 
{
echo '<script language="javascript">';
echo 'alert("Your data has been uploaded! Buyer will contact you if interested.");';
echo 'window.location.href="buysell.php";';
echo '</script>'; 
} 
else 
{
    echo "Error: " . $insert_image . "<br>" . $conn->error;
}
}
$conn->close();
?>


