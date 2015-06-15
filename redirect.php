<?php
include("config.php");
$name = test_input($_POST["name"]);
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);
$roll = test_input($_POST["roll"]);
$dep = test_input($_POST["dep"]);
$batch = test_input($_POST["batch"]);
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO " . $table_name . " (username,password,name,dep,batch,roll_no)
		VALUES ( '$username','$password','$name','$dep','$batch','$roll')";

if ($conn->query($sql) === TRUE) {
    echo "Account created successfully!!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript">
<!--
function Redirect() {
    window.location="log.html";
}
document.write("You will be redirected to main page in 5 sec.");
setTimeout('Redirect()', 5000);
//-->
</script>
</head>
<body>
</body>
</html>