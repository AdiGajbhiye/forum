<?php
include("config.php");
session_start();
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]); 
$sql = "SELECT * FROM student_info WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
	$_SESSION['login_user'] = $username;
	echo "<script type='text/javascript'>
	<!--
	function Redirect() {
		window.location='post.php';
	}
	setTimeout('Redirect()', 100);
	//-->
	</script>";
}
else {
	echo "Your Login Name or Password is invalid";
}
}
?>