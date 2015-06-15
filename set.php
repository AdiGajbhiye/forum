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
$sql = "SELECT * FROM student_info WHERE username='$login_user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$prev_name = $row["name"];
$prev_password = $row["password"];
$prev_roll = $row["roll_no"];
$prev_dep = $row["dep"];
$prev_batch = $row["batch"];
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $password = test_input($_POST["password"]);
  $roll = test_input($_POST["roll"]);
  $dep = test_input($_POST["dep"]);
  $batch = test_input($_POST["batch"]);
  $sql = "UPDATE student_info SET name='$name' , password='$password' , roll_no='$roll' , dep='$dep' , batch='$batch' WHERE username='$login_user'";
  if ($conn->query($sql) === TRUE) {  
      echo "<script>
          function myFunction() {
            alert('Update Successfully!!');
          }
          myFunction();
          </script>";
  } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
  }
}  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
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
        		<li><a href="profile.php">Profile</a></li>
      		</ul>
      		<ul class="nav navbar-nav navbar-right">
        		<li class="active"><a href="set.php"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
        		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      		</ul>
    	</div>
  	</div>
	</nav>  
      <div class="container">
          <br><br>
          <form class="form-horizontal" role="form" method="post" action="">
          <div class="form-group">
              <label class="control-label col-sm-2" for="usr">Username:</label>
              <div class="col-sm-5"><input type="text" class="form-control" id="usr" placeholder=<?php echo "$login_user";?> name="username" disabled></div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">Password:</label>
              <div class="col-sm-5"><input type="password" class="form-control" id="pwd" value=<?php echo "$prev_password";?> name="password"></div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-2" for="name">Name:</label>
              <div class="col-sm-5"><input type="text" class="form-control" id="name" value=<?php echo "$prev_name";?> name="name"></div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-2" for="roll">Roll No.:</label>
              <div class="col-sm-5"><input type="number" class="form-control" id="roll" value=<?php echo "$prev_roll";?> name="roll"></div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-2" for="dept">Dept.:</label>
              <div class="col-sm-5"><input type="text" class="form-control" id="dept" value=<?php echo "$prev_dep";?> name="dep"></div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-2" for="batch">Batch:</label>
              <div class="col-sm-5"><input type="text" class="form-control" id="batch" value=<?php echo "$prev_batch";?> name="batch"></div>
          </div>
          <div class="form-group">        
              <div class="col-sm-offset-4 col-sm-5"><button type="submit" class="btn btn-default">Update</button></div>
          </div>
          </form>
      </div>
  </body>
</html>