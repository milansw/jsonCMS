<?php session_start(); ?>
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
	<form class="form-signin" role="form" method="post" action="login_process.php">
		<h2 class="form-signin-heading">Please sign in</h2>
		<input type="email" class="form-control" placeholder="Email address" required autofocus>
		<input type="password" class="form-control" placeholder="Password" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
</div>

</body>
</html>