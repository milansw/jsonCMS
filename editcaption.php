<?php
	require 'change.php';

	
	try{
		$c = new changeJSON("portfolio.json");
		$c->editCaption($_POST['pfn'],$_POST['caption']);
	} catch (RuntimeException $e){
		flashMessage('danger', $e->getMessage());
		header("Location: dashboard.php");
	}

	header("Location: dashboard.php");
?>