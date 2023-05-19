<?php
require_once 'validate.php';
require_once 'src/staff_navbar.php';

$homestay_id = (isset($_GET['homestay_id']) && $_GET['homestay_id'] != '') ? $_GET['homestay_id'] : die("Could not get $homestay_id in staff/homestay.php around line 6");
?>

<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="alert alert-info">Reservation / Homestay / Change Homestay</div>
			<br />
			<div class="col-md-4">
				<?php
				$query = "SELECT * FROM `homestay` WHERE `id`=" . $homestay_id . "";
				$mydb->set_query($query);
				$result = $mydb->load_result_list() or die("Something wrong in staff/homestay.php around line 34");
				foreach ($result as $val) {
				?>
					<form method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Homestay ID</label>
							<input type="number" class="form-control" name="homestay_id" value="<?php echo $homestay_id ?>" readonly />
						</div>
						<div class="form-group">
							<label>Homestay Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $val->homestay_name ?>" required />
						</div>
						<div class="form-group">
							<label>Price </label>
							<input type="number" min="0" max="999999999" class="form-control" name="price" value="<?php echo $val->current_price ?>" required />
						</div>
						<div class="form-group">
							<label>Photo </label>
							<div id="preview" style="width:150px; height :150px; border:1px solid #000;">
								<center id="lbl">[Photo]</center>
							</div>
							<input type="file" id="photo" name="photo" value="<?php echo $val->photo ?>" />
						</div>
						<br />
						<div class="form-group">
							<button name="edit_homestay" class="btn btn-info form-control"><i class="glyphicon glyphicon-save"></i> Save Changes</button>
						</div>
					</form>
				<?php } ?>
				<?php require_once 'edit_query_homestay.php' ?>
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