<!DOCTYPE html>
<html>
<head>
	<title>Message</title>
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
        		<li class="active"><a href="msg.php">Message</a></li>
        		<li><a href="profile.php">Profile</a></li>
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
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
$login_user = $_SESSION['login_user'];
$sql = "SELECT * FROM message WHERE user='$login_user' OR reciever='$login_user'";
$result = $conn->query($sql);
echo "<div class='container'>
      <table class='table'>
      <thead>
      <tr><th>From</th><th>To</th><th>Message</th><th>Date/Time</th></tr>
      </thead>
      <tbody>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["user"] . "</td><td>" . $row["reciever"] . "</td><td>" . $row["msg"] . "</td><td>" . $row["dt"] . "/" . $row["time"] ."</td></tr>" ;
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$to = test_input($_POST["to"]);
	$sql = "SELECT * FROM student_info WHERE username='$to'";
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$msg = test_input($_POST["msg"]);
		$t=time();
		$sql = "INSERT INTO message (user,reciever,msg,dt,time) VALUES ('$login_user','$to','$msg',CURDATE(),CURTIME())";
		if ($conn->query($sql) === TRUE) {  
			$last_id = $conn->insert_id;
			echo "<tr><td>" . $login_user . "</td><td>" . $to . "</td><td>" . $msg . "</td><td>" . date("Y-m-d/H:i:s",$t) ."</td></tr>"  ;
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else {
		echo "<script>
          function myFunction() {
            alert('User doesnot exist!');
          }
          myFunction();
          </script>";
	}
}
echo "</tbody>
      </table>
      </div>";
?>
</div>
<br><br>
  	<div class="col-sm-offset-5"><h4>Message a friend</h4></div>
  		<br>
  		<form class="form-horizontal" role="form" method="post" action="">
    	<div class="form-group">
      		<label class="control-label col-sm-2" for="to">To:</label>
      		<div class="col-sm-8"><input type="text" class="form-control" id="to" name="to"></div>
    	</div>
    	<div class="form-group">
      		<label class="control-label col-sm-2" for="msg">Message:</label>
      		<div class="col-sm-8"><input type="text" class="form-control" id="msg" name="msg"></div>
    	</div>
    	<div class="form-group">        
      		<div class="col-sm-offset-2 col-sm-5"><button type="submit" class="btn btn-default">Submit</button></div>
    	</div>
  		</form>
		</div>
</body>
</html>