

<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;


$uname=$_POST['uname'];
$cnum=$_POST['cnum'];
$eid=$_POST['eid'];
$paswd=$_POST['paswd'];

$servername = "localhost";
$dbname = "learnershub";
$username="root";
$password="";

// Create connection
/*$conn =  mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
	echo 'conn';
    die("connection failed: " . $conn->connect_error);
} */
/*
function addNewUser($username, $password){
   global $connection;
   $password = md5($password);
   $q = "INSERT INTO ".TBL_USERS." VALUES ('$username', '$password')";
   return mysql_query($q, $connection);
}
*/
mysql_connect("localhost", "root", "") or die(mysql_error()); // Connect to database server(localhost) with username and password.
mysql_select_db("learnershub") or die(mysql_error()); 
// Return Success - Valid Email
//$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
// Example output: f4552671f8909587cf485ea990207f3b

mysql_query("INSERT INTO users (username, contact, email, passwd,hash) VALUES(
'". mysql_escape_string($uname) ."', 
 
'". mysql_escape_string($cnum) ."',
'". mysql_escape_string($eid) ."',

'". mysql_escape_string(md5($paswd)) ."', 
'". mysql_escape_string($hash) ."') ") or die(mysql_error());


$mail->setFrom('2015prerna.baliga@ves.ac.in', 'Learners Hub');
$mail->addAddress($eid, 'My Friend');
$mail->Subject  = 'Signup | Verification';
$mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer. Please click this link to activate your account:
http://localhost/WT_Final/verify.php?email='.$eid.'&hash='.$hash.';';

if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}
/*
$to      = $eid; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$uname.'
Password: '.$paswd.'
------------------------
 
Please click this link to activate your account:
http://localhost/WT_Final/verify.php?email='.$eid.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:2015prerna.baliga@ves.ac.in' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

echo '<script language="javascript">';
echo 'alert("Your account has been created. go to mail and verify.");';

echo '</script>'; 

/*$paswd=md5($paswd);
$sql =  "INSERT INTO `user`(`username`, `contact`, `email`, `passwd`) 
VALUES ('".$uname."','".$cnum."','".$eid."','".$paswd."')";

if (mysqli_query($conn,$sql)) {
	
	echo'<script type="text/javascript">
			window.onload=function()
			{alert("Your account has been created. you can log in.");}
			</script>';
    header("location:login.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/


?>
