<?php

	require '../includes/checklogin.php';
	require '../change.php';

	if(!isset($_GET['group']) || !isset($_GET['var'])){
		flashMessage('danger', 'Missing get variables');
		header("Location: ../dashboard.php");
	}

	try{
		$c = new changeContent("../json/content.json");
		$c->removeVar($_GET['group'],$_GET['var']);
	} catch (RuntimeException $e){
		flashMessage('danger', $e->getMessage());
		header("Location: ../dashboard.php");
	}

	header("Location: ../dashboard.php");

?>