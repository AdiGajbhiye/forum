<!DOCTYPE html>
<html>
<head>
	<title>Post</title>
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
        		<li><a href="set.php"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
        		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      		</ul>
    	</div>
  	</div>
	</nav>  
	<div class="container">
		<div class="row">
		<div class="col-sm-1"><strong> Problem:<br>Solution:</strong></div>
		<div class="col-sm-4">
<?php
include("config.php");
session_start();
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
$que_id = $_GET['id'];
$sql = "SELECT * FROM problem WHERE id='$que_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo $row["que"] . "<br>";
echo $row["ans"] ;
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$ans = test_input($_POST["ans"]);
	echo  $ans;
	$mydate=getdate();
	echo "  $mydate[mon], $mydate[mday], $mydate[year] <br>";
	$ans = $row["ans"] . $ans . "  $mydate[mon], $mydate[mday], $mydate[year]" . "<br>";
	$sql = "UPDATE problem SET ans='$ans' WHERE id='$que_id'";
	if ($conn->query($sql) === TRUE) {  
		$last_id = $conn->insert_id;
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}	
}
echo "</div>
	  </div>";
?>
</div>
<div class="container">
	<br><br>
  	<div class="col-sm-offset-5"><h4>Submit a solution</h4></div>
  		<br>
  		<form class="form-horizontal" role="form" method="post" action="">
    	<div class="form-group">
      		<label class="control-label col-sm-1" for="prob">Solution:</label>
      		<div class="col-sm-10"><input type="text" class="form-control" id="prob" name="ans"></div>
    	</div>
    	<div class="form-group">        
      		<div class="col-sm-offset-5 col-sm-5"><button type="submit" class="btn btn-default">Submit</button></div>
    	</div>
  		</form>
	</div>
</body>
</html>