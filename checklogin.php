<?php

	if(isset($_SESSION['logged_in'])){
		if($_SESSION['logged_in'] == 1){
			header("Location: dashboard.php");
		}else{
			header("Location: login.php");
		}
	}else{
		header("Location: login.php");
	}

?>