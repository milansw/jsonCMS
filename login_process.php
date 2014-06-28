<?php
	session_start();

	if(isset($_SESSION['logged_in'])){
		if($_SESSION['logged_in'] == 1){
			header("Location: dashboard.php");
		}
	}

	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username == 'user' && $password == 'pass'){
		$_SESSION['logged_in'] = 1;
		header("Location: dashboard.php");
	}else{
		include 'change.php';
		flashMessage('danger', 'Username and password combination not recognised');
		header("Location: login.php");
	}

?>