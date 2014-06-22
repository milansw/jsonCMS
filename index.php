<?php

// $f = file_get_contents("portfolio.json");

// $json = json_decode($f);

// $photo = new Photo("photo3","new photo");

// array_push($json,$photo);
// file_put_contents("portfolio.json", json_encode($json));

// require 'change.php';

// $c = new changeJSON("portfolio.json");

// $c->addPhoto("helloworld3","some caption");
// $c->removePhoto("helloworld");

// $c->editCaption("helloworld","some edited caption");


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>jsonPortfolio</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>

<body>
	<form class="form-inline" action="upload.php" method="post" enctype="multipart/form-data">
		<label for="file">Filename:</label>
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 
		<input type="file" name="upfile" id="upfile"><br>
		<input type="text" name="caption" class="form-control">
		<input type="submit" name="submit" value="Submit" class="btn btn-success">
	</form>

	<p><?php echo file_get_contents('portfolio.json'); ?></p>
</body>
</html>