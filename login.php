<?php 
	session_start();

	if(isset($_SESSION['logged_in'])){
		if($_SESSION['logged_in'] == 1){
			header("Location: dashboard.php");
		}
	} 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - jsonPortfolio</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="login.css">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<?php
		if(isset($_SESSION['flash'])){
			echo sprintf("<div class='alert alert-%s'>%s</div>",$_SESSION['flash']['type'],$_SESSION['flash']['message']);
			unset($_SESSION['flash']);
		}
	?>
	<form class="form-signin" role="form" method="post" action="login_process.php">
		<h2 class="form-signin-heading">Please sign in</h2>
		<input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
		<input type="password" class="form-control" placeholder="Password" name="password" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
</div>

</body>
</html>