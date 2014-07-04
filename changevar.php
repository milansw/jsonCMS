<?php

	require 'checklogin.php';
	require 'change.php';

	if(!isset($_POST['group']) || !isset($_POST['var']) || !isset($_POST['value'])){
		flashMessage('danger', 'Missing post variables');
		header("Location: dashboard.php");
	}

	try{
		$c = new changeContent("json/content.json");
		$c->changeVar($_POST['group'],$_POST['var'],$_POST['value']);
	} catch (RuntimeException $e){
		flashMessage('danger', $e->getMessage());
		header("Location: dashboard.php");
	}

	header("Location: dashboard.php");

?>