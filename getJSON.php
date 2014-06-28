<?php
	$f = file_get_contents('portfolio.json');
	$json = json_decode($f);
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Content-type: application/json');
	echo json_encode($json);

?>