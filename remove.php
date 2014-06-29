<?php
	require 'checklogin.php';
	require 'change.php';

	$c = new changeJSON("json/portfolio.json");
	$c->removePhoto($_GET['fn']);

	header("Location: dashboard.php")

?>