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
	
	/*$username = $_POST['uname'];
	$password = $_POST['paswd'];
*/
	$_SESSION["USER"] = $username ;
$password=md5($password);

if(isset($_POST['uname']) && !empty($_POST['uname']) AND isset($_POST['paswd']) && !empty($_POST['paswd'])){
    $username = mysql_escape_string($_POST['uname']);
    $password = mysql_escape_string(md5($_POST['paswd']));
                 
    $search = mysql_query("SELECT username, password, active FROM users WHERE username='".$username."' AND password='".$password."' AND active='1'") or die(mysql_error()); 
    $match  = mysql_num_rows($search);
            }
			
		if($match > 0){
							
header("location:buysell.php");		

//    $msg = 'Login Complete! Thanks';
    // Set cookie / Start Session / Start Download etc...
}else{
				echo '<script language="javascript">';
echo 'alert("Login failed.");';
echo 'window.location.href="login.php";';
echo '</script>'; 
   // $msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
}	
			
/*	$sql = "SELECT passwd FROM user WHERE username='$username'";
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