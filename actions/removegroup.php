<?php

	require '../includes/checklogin.php';
	require '../change.php';

	if(!isset($_GET['group'])){
		flashMessage('danger', 'Missing get variables');
		header("Location: ../dashboard.php");
	}

	try{
		$c = new changeContent("../json/content.json");
		$c->removeGroup($_GET['group']);
	} catch (RuntimeException $e){
		flashMessage('danger', $e->getMessage());
		header("Location: ../dashboard.php");
	}

	header("Location: ../dashboard.php");

?>