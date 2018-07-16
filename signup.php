
<?php

$uname=$_REQUEST['uname'];
$cnum=$_REQUEST['cnum'];
$eid=$_REQUEST['eid'];
$paswd=$_REQUEST['paswd'];

$servername = "localhost";
$dbname = "learnershub";
$username="root";
$password="";

// Create connection
$conn =  mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
	echo 'conn';
    die("connection failed: " . $conn->connect_error);
} 
/*
function addNewUser($username, $password){
   global $connection;
   $password = md5($password);
   $q = "INSERT INTO ".TBL_USERS." VALUES ('$username', '$password')";
   return mysql_query($q, $connection);
}
*/
$paswd=md5($paswd);
$sql =  "INSERT INTO `user`(`username`, `contact`, `email`, `passwd`) 
VALUES ('".$uname."','".$cnum."','".$eid."','".$paswd."')";

if (mysqli_query($conn,$sql)) {
	
	
	echo '<script language="javascript">';
echo 'alert("Your account has been created. you can log in.");';
echo 'window.location.href="login.php";';
echo '</script>'; 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
