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
        		<li class="active"><a href="post.php">Problems</a></li>
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
<?php
include("config.php");
session_start();
$login_user = $_SESSION['login_user'];
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
$sql = "SELECT * FROM problem";
$result = $conn->query($sql);
$i = 0;
echo "<div class='container'>
      <table class='table'>
      <thead>
        <tr><th>No.</th><th>Problem</th><th>Answer</th></tr>
      </thead>
      <tbody>";
if ($result->num_rows > 0) {
   	while($row = $result->fetch_assoc()) {
       	echo  "<tr><td>" . $row["id"] . "</td><td>" . $row["que"] ."</td>" ;
       	$i++;
       	echo "<td><a href='ans.php?id=$i'>Answer it</a></td></tr>";
   	}
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$que = test_input($_POST["que"]);
	$sql = "INSERT INTO problem (que,date,asker) VALUES ('$que',CURDATE(),'$login_user')";
	if ($conn->query($sql) === TRUE) {  
		    $last_id = $conn->insert_id;
		    echo "<tr><td>" . $last_id . "</td><td>" . $que . "</td><td>" ;
        echo "<a href='ans.php?id=$last_id'>Answer it</a></td></tr>";	
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}	
}
echo "</tbody>
      </table>
      </div>";
?>
</div>
<div class="container">
	<br><br>
  	<div class="col-sm-offset-5"><h4>Post a problem</h4></div>
  		<br>
  		<form class="form-horizontal" role="form" method="post" action="">
    	<div class="form-group">
      		<label class="control-label col-sm-1" for="prob">Problem:</label>
      		<div class="col-sm-10"><input type="text" class="form-control" id="prob" name="que"></div>
    	</div>
    	<div class="form-group">
      		<label class="control-label col-sm-1" for="to">To:</label>
      		<div class="col-sm-10"><input type="text" class="form-control" id="to" placeholder="Default to ALL" name="to"></div>
    	</div>
    	<div class="form-group">        
      		<div class="col-sm-offset-5 col-sm-5"><button type="submit" class="btn btn-default">Submit</button></div>
    	</div>
  		</form>
	</div>
</body>
</html>