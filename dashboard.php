<?php
	// dashboard
	$f = file_get_contents('portfolio.json');
	$json = json_decode($f);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Dashboard - jsonPortfolio</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<form class="form-inline" action="upload.php" method="post" enctype="multipart/form-data">
			<label for="file">Filename:</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 
			<input type="file" name="upfile" id="upfile"><br>
			<input type="text" name="caption" class="form-control">
			<input type="submit" name="submit" value="Submit" class="btn btn-success">
		</form>

		<p><?php echo $f ?></p>
		<p><?php print_r($json); ?></p>

		<?php
			foreach($json as $p){
				echo "<div class='photo'>";
				echo "<img src='photos/thumb-" . $p->filename . "'>";
				echo "<p>" . $p->caption . "</p>";
				echo "<p>" . $p->date_uploaded . "</p>";
				echo "</div>";
			}
		?>

	</div>
</body>
</html>