<?php

global $mydb;

// save the uploaded file
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["form_file"]["name"]);
$upload_ok = 1;
$image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$file_parts = pathinfo($target_file);

$extension = $file_parts['extension'];
$filename = $file_parts['filename'];

// check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
	$check = getimagesize($_FILES["form_file"]["tmp_name"]);
	if ($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$upload_ok = 1;
	} else {
		echo "File is not an image.";
		die('<br>Please <a href="index.php">try again</a>.');
		$upload_ok = 0;
	}
}

// check if file already exists
if (file_exists($target_file)) {
	$i = '1';
	$target_file = $target_dir . $filename . $i . '.' . $extension;
	while (file_exists($target_file)) {
		++$i;
		$target_file = $target_dir . $filename . $i . '.' . $extension;
	}
}

// name of proof_of_payment
$pop = basename($target_file);

// check file size
// if ($_FILES["form_file"]["size"] > 500000) {
// 	echo "Sorry, your file is too large.";
// 	die('<br>Please <a href="index.php">try again</a>.');
// 	$upload_ok = 0;
// }

// allow certain file formats
$allowed_file_type = 'pdf';
if ($image_file_type != $allowed_file_type) {
	echo "Sorry, only PDF files are allowed.";
	die('<br>Please <a href="index.php">try again</a>.');
	$upload_ok = 0;
}

// check if $upload_ok is set to 0 by an error
if ($upload_ok == 0) {
	echo "Sorry, your file was not uploaded.";
	die('<br>Please <a href="index.php">try again</a>.');
} else { // if everything is ok, try to upload file
	if (move_uploaded_file($_FILES["form_file"]["tmp_name"], $target_file)) {
		echo "The file " . htmlspecialchars($pop) . " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
		die('<br>Please <a href="index.php">try again</a>.');
	}
}

// getting the payment details from $_POST
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$person_count = $_POST['person_count'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$address = isset($_POST['address']) ? $_POST['address'] : "";
$booking_note = isset($_POST['booking_note']) ? $_POST['booking_note'] : "";
$total_price = $_POST['total_price'];

// registering the guest, if they are new
// otherwise, fetching their guest_id from the database
$guest_id = 0;

$query = "SELECT * FROM `guest` g WHERE g.`email`='" . $email . "'";
$mydb->set_query($query);
$cur = $mydb->load_result_list();

// FUTURE: think of a faster (better) way of registering new guests
if (count($cur) === 0) {
	// to get the latest guest count
	$length_check = "SELECT MAX(`id`) AS max_id FROM `guest`";
	$mydb->set_query($length_check);
	$cur = $mydb->load_result_list();
	$g_count = $cur[0]->max_id;
	++$g_count;

	// insert into database
	$request = "INSERT INTO `guest` (`id`, `full_name`, `email`, `phone`, `address`, `details`) VALUES (" . $g_count . ", '" . $full_name . "', '" . $email . "', '" . $phone . "', '" . $address . "', '');";
	$mydb->set_query($request);
	$mydb->execute_query();

	// getting $guest_id assigned to the new guest
	$query = "SELECT * FROM `guest` g WHERE g.`email`='" . $email . "'";
	$mydb->set_query($query);
	$cur = $mydb->load_result_list();
	if (count($cur) === 0) {
		$guest_id = $g_count;
	} else {
		$guest_id = $cur[0]->id;
	}
} else {
	$guest_id = $cur[0]->id;
}

// to get the latest reservation count
$length_check = "SELECT MAX(`id`) as max_id FROM `reservation`";
$mydb->set_query($length_check);
$cur = $mydb->load_result_list();
$r_count = $cur[0]->max_id;
++$r_count;

if ($r_count === 0) {
	++$r_count;
}

// a better approach according to: https://stackoverflow.com/questions/50447172/auto-generate-id-in-sql-php
// printf("New record has ID %d.\n", $mysqli->insert_id);

// creating a reservation and saving it in the database
$t = time();
$hs_count = $_SESSION['hs_count'];
$hs_ids = $_SESSION['homestays'];
foreach ($hs_ids as $homestay_id) {
	$request = "INSERT INTO `reservation` (`id`, `guest_id`, `homestay_id`, `person_count`, `start_date`, `end_date`, `status`, `ts_created`, `ts_updated`, `discount_percent`, `total_price`, `proof_of_payment`) VALUES (" . $r_count . ", " . $guest_id . ", " . $homestay_id . ", " . $person_count . ", '" . $check_in . "', '" . $check_out . "', 'Pending', '" . date("Y-m-d H:m:s", $t) . "', '" . date("Y-m-d H:m:s", $t) . "', 0.0, " . ($total_price / $hs_count) . ", '" . $pop . "');";
	$mydb->set_query($request);
	$mydb->execute_query();

	// in case $hs_ids > 1
	++$r_count;
}

// reset
$_SESSION['homestays'] = NULL;
$_SESSION['hs_count'] = NULL;

?>

<div>
	<div id="header" class="center">
		<i class="bi bi-calendar-check text-success" id="confirmed-booking-logo" style="font-size: 10em;"></i>
	</div>
	<div id="content" class="center">
		<p>Your booking is confirmed!</p>
		<p>Please keep an eye for our email for more information.</p>
	</div>
</div>