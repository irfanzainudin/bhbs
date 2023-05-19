<?php

global $mydb;

require_once 'src/staff_navbar.php';

$rsvn_id = (isset($_GET['rsvn_id']) && $_GET['rsvn_id'] != '') ? $_GET['rsvn_id'] : die("Could not get $rsvn_id in staff/save_form.php around line 3");
$homestay_id = (isset($_GET['homestay_id']) && $_GET['homestay_id'] != '') ? $_GET['homestay_id'] : die("Could not get $homestay_id in staff/save_form.php around line 3");

if (isset($_POST['add_form'])) {
	$checkin = $_POST['check_in'];
	$checkout = $_POST['check_out'];
	$person_count = $_POST['person_count'];
	$f_name = $_POST['full_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$t_price = $_POST['total_price'];
	$days = date_differ($checkin, $checkout);
	// $extra_bed = $_POST['extra_bed'];
	$query = "SELECT COUNT(1) AS is_there_rsvn FROM `reservation` WHERE `homestay_id` = '$homestay_id' AND `status` = 'Check In'";
	$mydb->set_query($query);
	$result = $mydb->execute_query() or die("Something wrong in staff/save_form.php around line 21");
	$result = $mydb->fetch_array($result);
	$time = date("Y-m-d H:i:s", strtotime("+8 HOURS"));
	if ($result['is_there_rsvn'] > 0) {
		echo "<script>alert('Homestay not available')</script>";
	} else {
		$q2 = "SELECT * FROM `reservation` t JOIN `guest` g ON g.`id`=t.`guest_id` JOIN `homestay` h ON h.`id`=t.`homestay_id` WHERE t.`id` = '$rsvn_id'";
		$mydb->set_query($q2);
		$r2 = $mydb->load_result_list() or die("Something wrong in staff/save_form.php around line 21");
		$checkout = date("Y-m-d", strtotime($checkin . "+" . $days . "DAYS"));
		$q3 = "UPDATE `reservation` SET `status` = 'Confirmed', `ts_created` = '$time', `end_date` = '$checkout', `total_price` = '$t_price' WHERE `id` = '$rsvn_id'";
		$mydb->set_query($q3);
		$mydb->execute_query() or die("Something wrong in staff/save_form.php around line 28");

		// notification of success
		echo '<br><div class="alert alert-success" role="alert">Guest booking has been confirmed!</div>';
	}
}
