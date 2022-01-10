<?php 
// Get parameters
$roomname = $_GET['roomname'];

// Connecting to the database
include 'db_connect.php';

// Execute sql to check whether room exists
$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";

$result = mysqli_query($conn, $sql);
if($result)
{
	// Check if room exists
	if(mysqli_num_rows($result) == 0)
	{
		$message = "This room does not exists.Try creating a new one";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/chatroom";';
		echo '</script>';
	}
}
else
{
	echo "Error: ".mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  padding: 0 20px;
}

.hieee{
  max-width: 800px;
  margin: 0 auto;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #00BFFF;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass {
	height: 350px;
	overflow-y: scroll;
}

</style>
</head>
<body>
<header class="site-header sticky-top py-1">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <img src="img/favicons.png" width="32x32" height="32x32">
    <a class="navbar-brand" href="" >MyAnonymousChat</a></img>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">About</a>
        <a class="nav-link" href="#">Contact</a>
      </div>
    </div>
  </div>
</nav>
</header>

<div class="hieee">
<h2>Chat Messages - <?php echo $roomname; ?></h2>

<div class="container">
	<div class="anyClass">
 
</div>
</div>
<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add Messages"><br>
<button class="btn btn-primary" name="submitmsg" id="submitmsg">Send</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script type="text/javascript">

	// Check for new essage every 1 second
	setInterval(runFunction, 1000);
	function runFunction()
	{
		$.post("htcont.php", {room:'<?php echo $roomname ?>'},
			function(data, status)
			{
				document.getElementsByClassName('anyClass')[0].innerHTML = data;
			}
			)  
	}
	// Using enter key to submit
var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
	event.preventDefault();
  	if (event.keyCode === 13) {
    	document.getElementById("submitmsg").click();
  	}
});

	// if user submits this form
	$("#submitmsg").click(function(){
			var clientmsg = $("#usermsg").val();
  	$.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname ?>', ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
  	function(data, status){
  		document.getElementsByClassName('anyClass')[0].innerHTML = data;});
  	$("#usermsg").val("");
  	return false;
	});

</script>

</body>
</html>

