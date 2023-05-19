<?php
global $mydb;

require_once 'validate.php';
require_once 'src/staff_navbar.php';

?>

<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="alert alert-info">Reservation / Homestay</div>
			<a class="btn btn-success" href="?p=add-homestay"><i class="glyphicon glyphicon-plus"></i> Add Room</a>
			<br />
			<br />
			<table id="table" class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Price</th>
						<!-- <th>Photo</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT * FROM `homestay`";
					$mydb->set_query($query);
					$result = $mydb->load_result_list() or die("Something wrong in staff/homestay.php around line 34");
					foreach ($result as $val) {
						$photo = "images/$val->photo";
					?>
						<tr>
							<td><?php echo $val->homestay_name ?></td>
							<td><?php echo $val->current_price ?></td>
							<!-- <td>
								<div class="img-container"><img src="images/<?php echo $val->photo ?>" class="hs_img"/></div>
								<div class="images"  onclick="open_modal(); return false;">&times;
									<img src="https://www.w3schools.com/howto/img_fjords.jpg" alt="" width="300" height="200">
									<img src="https://www.w3schools.com/howto/img_fjords.jpg" alt="" width="300" height="200">
									<img src="https://www.w3schools.com/howto/img_fjords.jpg" alt="" width="300" height="200">
								</div>

								<div id="image-viewer">
									<span class="close">&times;</span>
									<img class="modal-content" id="full-image">
								</div>
							</td> -->
							<td>
								<a class="btn btn-warning" href="?p=edit-homestay&homestay_id=<?php echo $val->id ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a class="btn btn-danger" onclick="confirmationDelete(this); return false;" href="?p=delete-homestay&homestay_id=<?php echo $val->id ?>"><i class="glyphicon glyphicon-remove"></i> Delete</a>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	function confirmationDelete(anchor) {
		var conf = confirm("Are you sure you want to delete this record?");
		if (conf) {
			window.location = anchor.attr("href");
		}
	}
	function open_modal() {
		const full_image = document.getElementById("full-image");
		full_image.src = <?php echo $photo ?>;
		const iv = document.getElementById("image-viewer");
		var visibility = iv.style.visibility;
		iv.style.visibility = visibility == "visible" ? 'hidden' : "visible";
	};

	function close_modal() {
		const iv = document.getElementById("image-viewer");
		iv.style.visibility = visibility == "visible" ? 'hidden' : "visible";
	};
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#table").DataTable();
	});
</script>