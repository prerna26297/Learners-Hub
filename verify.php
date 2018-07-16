<?php


// Create connection
$conn =  mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
	echo 'conn';
    die("connection failed: " . $conn->connect_error);
} 
             
if(isset($_GET['email']) && !empty($_



GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysql_escape_string($_GET['email']); // Set email variable
    $hash = mysql_escape_string($_GET['hash']); // Set hash variable
                 
    $search = mysql_query("SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error()); 
    $match  = mysql_num_rows($search);
                 
    if($match > 0){
        // We have a match, activate the account
        mysql_query("UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
        echo '<script language="javascript">';
echo 'alert("Your account has been created. you cn now login.");';
echo 'window.location.href="verify.php";';
echo '</script>'; 
	//	echo 'Your account has been activated, you can now login';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
    }
                 
}else{
    // Invalid approach
echo '<script language="javascript">';
echo 'alert("invalid approach");';
echo 'window.location.href="verify.php";';
echo '</script>'; 
    //echo 'Invalid approach, please use the link that has been send to your email.';
}

$conn->close();

?>
