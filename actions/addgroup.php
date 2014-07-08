<?php

	require '../includes/checklogin.php';
	require '../change.php';

	if(!isset($_POST['groupname'])){
		flashMessage('danger', 'Missing post variables');
		header("Location: ../dashboard.php");
	}

	try{
		$c = new changeContent("../json/content.json");
		$c->addGroup($_POST['groupname']);
	} catch (RuntimeException $e){
		flashMessage('danger', $e->getMessage());
		header("Location: ../dashboard.php");
	}

	header("Location: ../dashboard.php");

?>