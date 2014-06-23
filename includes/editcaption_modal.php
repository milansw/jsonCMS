<div class='modal fade' id="modal<?php echo $count; ?>" tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Edit caption</h4>
			</div>
			<form id="editcaption" action="editcaption.php" method="post" class="form-horizontal">
				<div class="modal-body">
						<label for="caption" class="control-label">Caption:</label>
						<input type="text" name="caption" class="form-control" value="<?php echo $p->caption; ?>">
						<input type="hidden" name="pfn" value="<?php echo $p->filename; ?>">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="submit" value="Save changes" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>