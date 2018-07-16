<?php
 session_start(); 
$bookname=$_REQUEST['bookname'];
$noc=$_REQUEST['noc'];

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
if(!isset($_SESSION["USER"]))
{
	echo "<h3>You are not logged in<h3><br>";
	echo "<h2><a href='login.php'>LOG IN AGAIN?</a></h3>";
}
else
{
$sql1 = "SELECT cost,copies FROM book WHERE book_name='".$bookname."'";
	$result = $conn->query($sql1);
		if ($result->num_rows == 1)
			{
		$row = $result->fetch_assoc();
		
		if($row["copies"] >=$noc)
		{
$sql =  "UPDATE `book` 
SET copies=copies-'".$noc."'
where book_name='".$bookname."'";

$total_cost = $row["cost"]*$noc;
if (mysqli_query($conn,$sql)) {
			
			echo '<script language="javascript">';
echo 'alert("Your order has been placed. Your total cost is '.$total_cost.'");';
echo 'window.location.href="buysell.php";';
echo '</script>';
			/*echo'<script type="text/javascript">
			window.onload=function()
			{alert("Your order has been placed. Your total cost is '.$total_cost.'");}
			header("location:buysell.php");	}
			</script>';
			echo"<body><center><H2><a href='buysell.php'>Buy more!</a></h2><body>";
			 //my_alert(‘Hello’, ‘This is an OK message’, 1, ‘http://google.com‘);
			*/
}
 else 
 {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

			}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Sorry not enough copies!");';
			echo 'window.location.href="buysell.php";';
			echo '</script>';
			/* echo "<body><center><H2>SORRY..</H2>
			<P>NOT ENOUGH COPIES</P><br><p>Go to nearest bookstore or</p>
			<a href='buysell.php'>TRY AGAIN</a>";
			*/
		}
	
	}
	
}

$conn->close();

?>
