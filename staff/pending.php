<?php
global $mydb;
?>

<table id="table" class="table table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Contact No</th>
			<th>Room Type</th>
			<th>Booking Date</th>
			<th>Status</th>
			<th>Action</th>
			<th>Proof of Payment</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$query = "SELECT t.*, g.`full_name`, g.`phone`, g.`email` FROM `reservation` t JOIN `guest` g ON g.`id`=t.`guest_id` JOIN `homestay` h ON h.`id`=t.`homestay_id` WHERE t.`status` = 'Pending'";
		$mydb->set_query($query);
		$result = $mydb->load_result_list();
		if (count($result) === 0) {
			echo "<p class=\"text-center\"><b>You're all caught up!</b></p>";
		} else {
			foreach ($result as $val) {
		?>
				<tr>
					<td><?php echo $val->full_name ?></td>
					<td><?php echo $val->phone ?></td>
					<td><?php echo "Room Type" ?></td>
					<td><strong><?php if ($val->start_date <= date("Y-m-d", strtotime("+8 HOURS"))) {
									echo "<label style = 'color:#ff0000;'>" . date("M d, Y", strtotime($val->start_date)) . "</label>";
								} else {
									echo "<label style = 'color:#00ff00;'>" . date("M d, Y", strtotime($val->start_date)) . "</label>";
								} ?></strong></td>
					<td><?php echo $val->status ?></td>
					<td>
						<a class="btn btn-success" href="?p=confirm-booking&rsvn_id=<?php echo $val->id ?>"><i class="glyphicon glyphicon-check"></i> Confirm</a> <a class="btn btn-danger" onclick="confirmationDelete(); return false;" href="?p=reject-pending&rsvn_id=<?php echo $val->id ?>&guest=<?php echo $val->email ?>"><i class="glyphicon glyphicon-trash"></i> Reject</a>
					</td>
					<td><embed src="uploads/<?php echo $val->proof_of_payment ?>" width= "500" height= "375" type="application/pdf"></td>
				</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>
<!-- <script type="text/javascript">
	function confirmationDelete(anchor) {
		var conf = confirm("Are you sure you want to delete this record?");
		if (conf) {
			var reason = prompt("Please state your reason for rejecting this booking");
			if (reason === null) {
				return;
			} else {
				while (!reason) {
					reason = prompt("Please state your reason for rejecting this booking");

					if (reason === null) {
						break;
					}
				}

				if (reason) {
					window.location = anchor.attr("href");
				} else {
					return;
				}
			}
		}
	}
</script> -->