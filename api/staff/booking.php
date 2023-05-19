<?php

global $mydb;

require_once 'validate.php';
require_once 'src/staff_navbar.php';

$booking_content = 'staff/pending.php';
$staff_view = (isset($_GET['b']) && $_GET['b'] != '') ? $_GET['b'] : '';

switch ($staff_view) {
	case 'pending':
		$booking_content = 'staff/pending.php';
		break;

	case 'checkin':
		$booking_content = 'staff/checkin.php';
		break;

	case 'checkout':
		$booking_content = 'staff/checkout.php';
		break;

	default:
		$booking_content = 'staff/pending.php';
}
?>

<div class="container-fluid">
	<div class="panel panel-default">
		<?php
		$q_p = "SELECT COUNT(*) as pending_rvsns FROM `reservation` WHERE `status` = 'Pending'";
		$mydb->set_query($q_p);
		$f_p = $mydb->load_result_list() or die("Something wrong in staff/booking.php around line 14");
		$q_ci = "SELECT COUNT(*) as check_ins FROM `reservation` WHERE `status` = 'Check In'" or die("Something wrong in staff/booking.php around line 15");
		$mydb->set_query($q_ci);
		$f_ci = $mydb->load_result_list() or die("Something wrong in staff/booking.php around line 17");
		?>
		<div class="panel-body">
			<a class="btn btn-success" href="?p=staff-booking&b=pending"><span class="badge"><?php echo count($f_p) ?></span> Pendings</a>
			<a class="btn btn-info" href="?p=staff-booking&b=checkin"><span class="badge"><?php echo count($f_ci) ?></span> Check In</a>
			<a class="btn btn-warning" href="?p=staff-booking&b=checkout"><i class="glyphicon glyphicon-eye-open"></i> Check Out</a>
			<br />
			<br />
			<?php require_once $booking_content ?>
		</div>
	</div>
</div>