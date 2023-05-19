<?php

global $mydb;

$hs_count = isset($_GET['hs_count']) && $_GET['hs_count'] != '' ? $_GET['hs_count'] : die('couldn\'t get $hs_count');

$_SESSION['hs_count'] = $hs_count;

// getting the reservation details from $_POST
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$person_count = $_POST['person_count'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$address = isset($_POST['address']) ? $_POST['address'] : "";
$booking_note = isset($_POST['booking_note']) ? $_POST['booking_note'] : "";
$total_price = $_POST['total_price'];

$days = date_differ($check_in, $check_out);
?>

<!-- HTML -->
<div>
	<div id="header" class="center">
		<img src="images/payment.jpg" style="width: 50vw; height: 50vh; object-fit: contain;">
	</div>
	<div id="content" class="center">
		<p>For <?php echo $hs_count ?> homestay(s) for <?php echo $days ?> nights.</p>
		<p>Please transfer RM<?php echo $total_price ?> using the QR code above to confirm your booking.</p>
		<p>After that, upload your proof of payment using the file upload link below.</p>
		<p>Thank you!</p>
	</div>
	<form class="row g-1 center" method="POST" action="index.php?p=confirmed-booking" enctype="multipart/form-data">
		<div class="mb-3" style="width: 30vw; margin: auto;">
			<label for="form_file" class="form-label">Proof of Payment</label>
			<input class="form-control" type="file" id="form_file" name="form_file" required>
		</div>
		<div class="mb-3" style="width: 30vw; margin: auto;">
			<input type="submit" role="button" class="btn btn-primary form-control" id="submit-booking" value="Confirm Booking">
		</div>
		<div style="text-align: left;">
			<div class="mb-3">
				<label for="check_in">Check in:</label>
				<input readonly type="date" id="check_in" name="check_in" value="<?php echo $check_in ?>">
				<label for="check_out">Check out:</label>
				<input readonly type="date" id="check_out" name="check_out" value="<?php echo $check_out ?>">
			</div>
			<div class="mb-3">
				<label>Number of person:</label>
				<input readonly type="number" name="person_count" value="<?php echo $person_count ?>">
			</div>
			<div class="mb-3 row">
				<label for="full_name" class="col-sm-2 col-form-label">Full name:</label>
				<div class="col-sm-10">
					<input readonly type="text" class="form-control-plaintext" id="full_name" name="full_name" placeholder="Contoh: Siti Nurhaliza Tarudin" value="<?php echo $full_name ?>">
				</div>
			</div>
			<div class="mb-3 row">
				<label for="email" class="col-sm-2 col-form-label">Email address:</label>
				<div class="col-sm-10">
					<input readonly type="email" class="form-control-plaintext" id="email" name="email" placeholder="nama@contoh.com" value="<?php echo $email ?>">
				</div>
			</div>
			<div class="mb-3 row">
				<label for="phone" class="col-sm-2 col-form-label">Phone:</label>
				<div class="col-sm-10">
					<input readonly type="text" class="form-control-plaintext" id="phone" name="phone" placeholder="+60100000000" value="<?php echo $phone ?>">
				</div>
			</div>
			<div class="mb-3 row">
				<label for="address" class="col-sm-2 col-form-label">Address:</label>
				<div class="col-sm-10">
					<input readonly type="text" class="form-control-plaintext" id="address" name="address" placeholder="Jalan Contoh, 43200, Kuala Lumpur" value="<?php echo $address ?>">
				</div>
			</div>
			<div class="mb-3 row">
				<label for="booking_note" class="col-sm-2 col-form-label">Booking note:</label>
				<div class="col-sm-10">
					<input readonly type="text" class="form-control-plaintext" id="booking_note" name="booking_note" placeholder="Contoh: Saya nak masak kalau boleh" value="<?php echo $booking_note ?>">
				</div>
			</div>
			<div class="mb-3 row">
				<label for="total_price" class="col-sm-2 col-form-label">Price for <?php echo $hs_count ?> homestay(s) for <?php echo $days ?> night(s)</label>
				<div class="col-sm-10">
					<input readonly type="text" readonly class="form-control-plaintext" id="total_price" name="total_price" value="<?php echo $total_price ?>">
				</div>
			</div>
		</div>
	</form>
</div>