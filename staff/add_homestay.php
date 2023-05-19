<?php
require_once 'validate.php';
require_once 'src/staff_navbar.php';
?>

<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="alert alert-info">Reservation / Homestay / Add Homestay</div>
			<br />
			<div class="col-md-4">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Homestay Name</label>
						<input type="text" class="form-control" name="name" required />
					</div>
					<div class="form-group">
						<label>Price </label>
						<input type="number" min="0" max="999999999" class="form-control" name="price" required />
					</div>
					<div class="form-group">
						<label>Photo </label>
						<div id="preview" style="width:150px; height :150px; border:1px solid #000;">
							<center id="lbl">[Photo]</center>
						</div>
						<input type="file" id="photo" name="photo" />
					</div>
					<br />
					<div class="form-group">
						<button name="add_homestay" class="btn btn-info form-control"><i class="glyphicon glyphicon-save"></i> Add New Homestay</button>
					</div>
				</form>
				<?php require_once 'add_query_homestay.php' ?>
			</div>
		</div>
	</div>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$pic = $('<img id = "image" width = "100%" height = "100%"/>');
		$lbl = $('<center id = "lbl">[Photo]</center>');
		$("#photo").change(function() {
			$("#lbl").remove();
			var files = !!this.files ? this.files : [];
			if (!files.length || !window.FileReader) {
				$("#image").remove();
				$lbl.appendTo("#preview");
			}
			if (/^image/.test(files[0].type)) {
				var reader = new FileReader();
				reader.readAsDataURL(files[0]);
				reader.onloadend = function() {
					$pic.appendTo("#preview");
					$("#image").attr("src", this.result);
				}
			}
		});
	});
</script>