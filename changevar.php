<?php

	require 'checklogin.php';
	require 'change.php';

	try{
		$c = new changeContent("json/content.json");
		$c->changeVar($_POST['group'],$_POST['var'],$_POST['value']);
	} catch (RuntimeException $e){
		flashMessage('danger', $e->getMessage());
		header("Location: dashboard.php");
	}

	header("Location: dashboard.php");

?>