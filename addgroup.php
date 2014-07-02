<?php

	require 'checklogin.php';
	require 'change.php';

	try{
		$c = new changeContent("json/content.json");
		$c->addGroup($_POST['groupname']);
	} catch (RuntimeException $e){
		flashMessage('danger', $e->getMessage());
		header("Location: dashboard.php");
	}

	header("Location: dashboard.php");

?>