<?php
	require 'change.php';

	$c = new changeJSON("portfolio.json");
	$c->editCaption($_POST['pfn'],$_POST['caption']);

	header("Location: dashboard.php");
?>