<?php
	session_start();
	
	if(!isset($_SESSION['logged_in'])){
		header("Location: index.php");
	}

	$f = file_get_contents('json/portfolio.json');
	$json = json_decode($f);
	$g = file_get_contents('json/content.json');
	$cjson = json_decode($g,true);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard - jsonCMS</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script>
		var container = $('#rowcontainer');
		container.masonry({
		  columnWidth: 200,
		  itemSelector: '.photo'
		});

		$(function(){
			$("#content textarea").each(function(){
				$(this).css("height", $(this).prop("scrollHeight")+20+"px");
			})
		})
	</script>
</head>

<body>
	<header>
		<div class="container">

			<h1>jsonCMS</h1>
			<div class="logout">Logged in as <strong><?php echo $_SESSION['user'] ?></strong>. <a href="logout.php">Logout</a></div>

			<?php
				if(isset($_SESSION['flash'])){
					echo sprintf("<div class='alert alert-%s'>%s</div>",$_SESSION['flash']['type'],$_SESSION['flash']['message']);
					unset($_SESSION['flash']);
				}
			?>
		</div>
	</header>

	<section id="portfolio">
		<div class="container">

			<div class="panel panel-default">
				<div class="panel-body">
					<form id="upload" class="form-horizontal" action="upload.php" method="post" enctype="multipart/form-data">
						<label for="file" class="control-label">Filename:</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 
						<input type="file" name="upfile" id="upfile"><br>

						<label for="caption" class="control-label">Caption: </label>
						<input type="text" name="caption" class="form-control">
						<input type="submit" name="submit" value="Upload" class="btn btn-primary">
					</form>
				</div>
			</div>

			<div class="row js-masonry" id="rowcontainer">
				<?php
					$count = 0;
					foreach($json as $p){
						echo "<div class='photo col-xs-6 col-sm-3'>"; //
							echo "<div class='thumbnail'>";
								echo "<a href='#'><img src='photos/thumb-" . $p->filename . "'></a>";
								echo "<div class='caption'>";
									echo "<p>" . $p->caption . "<br>";
									echo "<small>" . date("F j Y, g:i a", $p->date_uploaded) . "</small></p>";
									echo "<button class='btn btn-primary' data-toggle='modal' data-target='#modal".$count."'>Edit caption</button>";
									echo "<a href='remove.php?fn=".$p->filename."' class='btn btn-danger'>Remove photo</a>";
								echo "</div>";
							echo "</div>";

							include 'includes/editcaption_modal.php';

						echo "</div>";
						$count++;
					}
				?>
			</div>
		</div>
	</section>

	<section id="content">

		<!-- <div class="container"> -->
			<?php // print_r($cjson); ?>
		<!-- </div> -->

		<div class="container">

			<div class="panel panel-default">
				<div class="panel-body">
					<form action="addgroup.php" class="form-inline" id="addgroup" method="post">
						<input type="text" class="form-control" name="groupname" placeholder="Group name">
						<input type="submit" value="Add New Group" class="btn btn-info">
					</form>
				</div>
			</div>
		</div>

		<?php

			foreach($cjson as $group=>$info){
				echo "<div class='container'>";
					echo "<div class='panel panel-info'>";
						echo sprintf("<div class='panel-heading'>%s</div>",$group);
						echo "<div class='panel-body'>";
							foreach($info as $var=>$value){
								echo sprintf("<form action='editcontent.php' method='post' class='form-horizontal editvar' id='%s_%s'>",$group,$var);
									echo sprintf("<input type='hidden' name='group' value='%s'>",$group);
										echo "<div class='row'>";
											echo "<div class='col-sm-3'>";
												echo sprintf("<input class='form-control' type='text' name='var' value='%s'>",$var,$var);
											echo "</div>";
											echo "<div class='col-sm-8'>";
												echo sprintf("<textarea class='form-control' name='value' id='%s_%s_textarea'>%s</textarea>",$group,$var,$value);
											echo "</div>";
											echo "<div class='col-sm-1'>";
												echo "<input class='btn btn-info' type='submit' value='Submit'>";
											echo "</div>";
										echo "</div>";
								echo "</form>";
							}
						echo "</div>";
					echo "</div>";
				echo "</div>";
			}

		?>

	</section>
</body>
</html>