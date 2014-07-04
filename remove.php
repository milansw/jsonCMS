<?php
	require 'checklogin.php';
	require 'change.php';

	if(!isset($_GET['fn'])){
		flashMessage('danger', 'Missing filename');
		header("Location: dashboard.php");
	}

	$c = new changeJSON("json/portfolio.json");
	$c->removePhoto($_GET['fn']);

	header("Location: dashboard.php")

?>