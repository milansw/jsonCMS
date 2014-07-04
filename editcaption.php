<?php

	require 'checklogin.php';
	require 'change.php';

	if(!isset($_POST['pfn']) || !isset($_POST['caption'])){
		flashMessage('danger', 'Missing post variables');
		header("Location: dashboard.php");
	}
	
	try{
		$c = new changeJSON("json/portfolio.json");
		$c->editCaption($_POST['pfn'],$_POST['caption']);
	} catch (RuntimeException $e){
		flashMessage('danger', $e->getMessage());
		header("Location: dashboard.php");
	}

	header("Location: dashboard.php");
?>