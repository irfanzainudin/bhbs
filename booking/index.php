<?php

global $mydb;

$hs_count = 0;
$homestay_id = array();
echo 'For Homestay ID: ';
if (isset($_GET['homestay']) && $_GET['homestay'] != '') {
	$chosen_homestay = $_GET['homestay'];
	echo $chosen_homestay;
	$hs_count = 1;

	// to pass down to booking/confirmed-booking.php
	array_push($homestay_id, $chosen_homestay);
	$_SESSION['homestays'] = $homestay_id;
} else if (isset($_POST['check_list']) && !empty($_POST['check_list']) && count($_POST['check_list']) >= 1) {
	foreach ($_POST['check_list'] as $val) {
		echo $val . ' ';
		++$hs_count;

		// to pass down to booking/confirmed-booking.php
		array_push($homestay_id, $val);
	}
	$_SESSION['homestays'] = $homestay_id;
} else { // if guests only select 1 homestay through the multiple booking system (why would they? cause they're schtewpid)
	foreach ($_POST['check_list'] as $val) {
		echo $val . ' ';
		++$hs_count;
		array_push($homestay_id, $val);
	}

	// to pass down to booking/confirmed-booking.php
	$_SESSION['homestays'] = $_GET['homestay'];
}
?>

<!-- HTML -->

<h2>Booking Details</h2>
<form class="row g-1" method="POST" action="index.php?p=review-details&hs_count=<?php echo $hs_count ?>">
	<div class="mb-3">
		<label for="check_in">Check in: <span style="color: red;">*</span></label>
		<input type="date" id="check_in" name="check_in" required>
		<label for="check_out">Check out: <span style="color: red;">*</span></label>
		<input type="date" id="check_out" name="check_out" required>
	</div>
	<div class="mb-3">
		<label>Number of person: <span style="color: red;">*</span></label>
		<input type="number" name="person_count" required>
	</div>
	<div class="mb-3 row">
		<label for="full_name" class="col-sm-2 col-form-label">Full name: <span style="color: red;">*</span></label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Contoh: Siti Nurhaliza Tarudin" required>
		</div>
	</div>
	<div class="mb-3 row">
		<label for="email" class="col-sm-2 col-form-label">Email address: <span style="color: red;">*</span></label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="email" name="email" placeholder="nama@contoh.com" required>
		</div>
	</div>
	<div class="mb-3 row">
		<label for="phone" class="col-sm-2 col-form-label">Phone:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="phone" name="phone" placeholder="+60100000000">
		</div>
	</div>
	<div class="mb-3 row">
		<label for="address" class="col-sm-2 col-form-label">Address:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="address" name="address" placeholder="Jalan Contoh, 43200, Kuala Lumpur">
		</div>
	</div>
	<div class="mb-3 row">
		<label for="booking_note" class="col-sm-2 col-form-label">Booking note:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="booking_note" name="booking_note" placeholder="Contoh: Saya nak masak kalau boleh">
		</div>
	</div>
	<div class="mb-3">
		<input type="submit" role="button" class="btn btn-primary form-control" id="submit-booking" value="Review Details">
	</div>
</form>