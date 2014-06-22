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
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
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
					<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				</form>
			</div>
		</div>

		<?php /*
		<p><?php echo $f ?></p>
		<p><?php print_r($json); ?></p>
		*/ ?>

		<div class="row">
			<?php
				$count = 0;
				foreach($json as $p){
					echo "<div class='col-xs-6 col-sm-3'>";
						echo "<div class='thumbnail'>";
							echo "<a href='#'><img src='photos/thumb-" . $p->filename . "'></a>";
							echo "<div class='caption'>";
								echo "<p>" . $p->caption . "</p>";
								echo "<p>" . date("F j Y, g:i a", $p->date_uploaded) . "</p>";
								echo "<button class='btn btn-primary' data-toggle='modal' data-target='#modal".$count."'>Edit caption</button>";
								echo "<a href='remove.php?fn=".$p->filename."' class='btn btn-danger'>Remove photo</a>";
							echo "</div>";
						echo "</div>";

						echo "
							<div class='modal fade' id='modal".$count."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
						echo <<<X
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        <h4 class="modal-title" id="myModalLabel">Edit caption</h4>
							      </div>
							      <div class="modal-body">
							        ...
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        <button type="button" class="btn btn-primary">Save changes</button>
							      </div>
							    </div>
							  </div>
							</div>
X;
					echo "</div>";
					$count++;
				}
			?>
		</div>
	</div>
</body>
</html>