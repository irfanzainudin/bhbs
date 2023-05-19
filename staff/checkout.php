<?php
global $mydb;
?>

<table id="table" class="table table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Homestay</th>
			<th>Check In</th>
			<th>Days</th>
			<th>Check Out</th>
			<th>Status</th>
			<th>Price</th>
			<th>Proof of Payment</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$query = "SELECT t.*, g.`full_name`, h.`homestay_name` FROM `reservation` t JOIN `guest` g ON g.`id`=t.`guest_id` JOIN `homestay` h ON h.`id`=t.`homestay_id` WHERE `status` = 'Check Out'";
		$mydb->set_query($query);
		$result = $mydb->load_result_list() or die("Something wrong in staff/checkout.php around line 23");
		foreach ($result as $val) {
			$days = date_differ($val->start_date, $val->end_date);
		?>
			<tr>
				<td><?php echo $val->full_name ?></td>
				<td><?php echo $val->homestay_name ?></td>
				<td><?php echo "<label style = 'color:#00ff00;'>" . date("M d, Y", strtotime($val->start_date)) . "</label>" . " @ " . "<label>" . date("h:i a", strtotime($val->start_date)) . "</label>" ?></td>
				<td><?php echo $days ?></td>
				<td><?php echo "<label style = 'color:#ff0000;'>" . date("M d, Y", strtotime($val->start_date . "+" . $days . "DAYS")) . "</label>" . " @ " . "<label>" . date("h:i A", strtotime($val->end_date)) . "</label>" ?></td>
				<td><?php echo $val->status ?></td>
				<td><?php echo "RM" . $val->total_price ?></td>
				<td><embed src="uploads/<?php echo $val->proof_of_payment ?>" width= "500" height= "375" type="application/pdf"></td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>
<!-- <script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#table").DataTable();
	});
</script> -->