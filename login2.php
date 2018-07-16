<?php
  
// Start the session
session_start();


	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "learnershub";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$username = $_POST['uname'];
	$password = $_POST['paswd'];

	$_SESSION["USER"] = $username ;
$password=md5($password);
	$sql = "SELECT passwd FROM user WHERE username='$username'";
	$result = $conn->query($sql);
	
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		
		if($row["passwd"] == $password)
		{
			
header("location:buysell.php");
			}
		else
		{
			echo '<script language="javascript">';
echo 'alert("Invalid credentials. Please enter correct username and password");';
echo 'window.location.href="login.php";';
echo '</script>'; 
		}
	}
	
$conn->close();
?>