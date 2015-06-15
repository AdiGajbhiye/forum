<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
  	<div class="container-fluid">
    	<div>
      		<ul class="nav navbar-nav">
        		<li><a href="post.php">Problems</a></li>
        		<li><a href="msg.php">Message</a></li>
        		<li class="active"><a href="profile.php">Profile</a></li>
      		</ul>
      		<ul class="nav navbar-nav navbar-right">
        		<li><a href="set.php"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
        		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      		</ul>
    	</div>
  	</div>
	</nav>  
	<div class="container">
<?php
include("config.php");
session_start();
$login_user = $_SESSION['login_user'];
$sql = "SELECT * FROM student_info WHERE username='$login_user'";
$result = $conn->query($sql);
if($result->num_rows == 1) {
	$row = $result->fetch_assoc();
  echo "<br><br><br>";
  echo "<div class='row'>
          <div class='col-sm-4'>
            USERNAME<br>PASSWORD<br>Name<br>Roll No.<br>DEPT.<br>Batch<br>
          </div>";
	echo  "<div class='col-sm-6'>" . $row["username"] . "<br>" . $row["password"] . "<br>" . $row["name"] . "<br>" . $row["roll_no"] . "<br>" . $row["dep"] . "<br>" . $row["batch"] . "<br></div>";
}
?>
</div>
</body>
</html>
