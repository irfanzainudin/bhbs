<?php

global $mydb;

require_once 'validate.php';
require_once 'src/staff_navbar.php';

$rsvn_id = (isset($_GET['rsvn_id']) && $_GET['rsvn_id'] != '') ? $_GET['rsvn_id'] : die("Could not get $rsvn_id in staff/confirm_booking.php around line 9");

?>

<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="alert alert-info">Review Booking Details</div>
			<?php
			$query = "SELECT t.*, g.`full_name`, g.`email`, g.`phone`, g.`address` FROM `reservation` t JOIN `guest` g ON g.`id`=t.`guest_id` JOIN `homestay` h ON h.`id`=t.`homestay_id` WHERE t.`id` = '$rsvn_id'";
			$mydb->set_query($query);
			$result = $mydb->load_result_list();
			$result = $result[0];

			$days = date_differ($result->start_date, $result->end_date);
			$hs_count = strlen(strval($result->homestay_id));
			$total_price = ($hs_count * 200.00) * $days;
			?>
			<form class="row g-1" method="POST" action="?p=save-form&rsvn_id=<?php echo $result->id ?>&homestay_id=<?php echo $result->homestay_id ?>">
				<div class="mb-3">
					<label for="check_in">Check in:</label>
					<input readonly type="date" id="check_in" name="check_in" value="<?php echo $result->start_date ?>">
					<label for="check_out">Check out:</label>
					<input readonly type="date" id="check_out" name="check_out" value="<?php echo $result->end_date ?>">
				</div>
				<div class="mb-3">
					<label>Number of person:</label>
					<input readonly type="number" name="person_count" value="<?php echo $result->person_count ?>">
				</div>
				<div class="mb-3 row">
					<label for="full_name" class="col-sm-2 col-form-label">Full name:</label>
					<div class="col-sm-10">
						<input readonly type="text" class="form-control-plaintext" id="full_name" name="full_name" placeholder="Contoh: Siti Nurhaliza Tarudin" value="<?php echo $result->full_name ?>">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="email" class="col-sm-2 col-form-label">Email address:</label>
					<div class="col-sm-10">
						<input readonly type="email" class="form-control-plaintext" id="email" name="email" placeholder="nama@contoh.com" value="<?php echo $result->email ?>">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="phone" class="col-sm-2 col-form-label">Phone:</label>
					<div class="col-sm-10">
						<input readonly type="text" class="form-control-plaintext" id="phone" name="phone" placeholder="+60100000000" value="<?php echo $result->phone ?>">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="address" class="col-sm-2 col-form-label">Address:</label>
					<div class="col-sm-10">
						<input readonly type="text" class="form-control-plaintext" id="address" name="address" placeholder="Jalan Contoh, 43200, Kuala Lumpur" value="<?php echo $result->address ?>">
					</div>
				</div>
				<!-- TODO: check this out and see where in the database is this supposed to go -->
				<!-- TODO: in the case of no place to save `booking_note` in the database, update the database so that it has a place to be saved into -->
				<!-- <div class="mb-3 row">
					<label for="booking_note" class="col-sm-2 col-form-label">Booking note:</label>
					<div class="col-sm-10">
						<input readonly type="text" class="form-control-plaintext" id="booking_note" name="booking_note" placeholder="Contoh: Saya nak masak kalau boleh" value="<?php echo $booking_note ?>">
					</div>
				</div> -->
				<div class="mb-3 row">
					<label for="total_price" class="col-sm-2 col-form-label">Price for <?php echo $hs_count ?> homestay(s) for <?php echo $days ?> night(s)</label>
					<div class="col-sm-10">
						<input readonly type="text" readonly class="form-control-plaintext" id="total_price" name="total_price" value="<?php echo $total_price ?>">
					</div>
				</div>
				<div class="mb-3">
					<input type="submit" role="button" class="btn btn-primary form-control" id="submit-booking" name="add_form" value="Confirm Booking">
				</div>
			</form>
		</div>
	</div>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>