<?php
	// dashboard
	$f = file_get_contents('portfolio.json');
	$json = json_decode($f);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard - jsonPortfolio</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container">

		<h1>JSONPortfolio</h1>
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="upload" class="form-horizontal" action="upload.php" method="post" enctype="multipart/form-data">
					<label for="file" class="control-label">Filename:</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 
					<input type="file" name="upfile" id="upfile"><br>

					<label for="caption" class="control-label">Caption: </label>
					<input type="text" name="caption" class="form-control">
					<input type="submit" name="submit" value="Submit" class="btn btn-success">
				</form>
			</div>
		</div>
		
		<?php /*
		<p><?php echo $f ?></p>
		<p><?php print_r($json); ?></p>
		*/ ?>

		<div class="row">
			<?php
				foreach($json as $p){
					echo "<div class='col-xs-6 col-sm-3'>";
						echo "<div class='thumbnail'>";
							echo "<a href='#'><img src='photos/thumb-" . $p->filename . "'></a>";
							echo "<div class='caption'>";
								echo "<p>" . $p->caption . "</p>";
								echo "<p>" . $p->date_uploaded . "</p>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
				}
			?>
		</div>
	</div>
</body>
</html>