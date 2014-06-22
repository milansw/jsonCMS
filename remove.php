<?php

	require 'change.php';

	$c = new changeJSON("portfolio.json");
	$c->removePhoto($_GET['fn']);

	header("Location: dashboard.php")

?>