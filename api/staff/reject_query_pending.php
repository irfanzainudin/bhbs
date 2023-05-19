<?php

require_once 'src/staff_navbar.php';

$rsvn_id = (isset($_GET['rsvn_id']) && $_GET['rsvn_id'] != '') ? $_GET['rsvn_id'] : die("Could not get $rsvn_id in staff/delete_pending.php around line 5");

$guest = (isset($_GET['guest']) && $_GET['guest'] != '') ? $_GET['guest'] : die("Could not get $guest in staff/delete_pending.php around line 7");

$message = $_POST['rejection-reason'];

$query = "DELETE FROM `reservation` WHERE `id` = '$rsvn_id'";
$mydb->set_query($query);
$mydb->execute_query() or die("Something wrong in staff/delete_pending.php around line 10");

// email rejection reason to guest
mail($guest, "Bonda Homestay Booking System", "Dear Honourable Guests,\n\n\nWe are very sorry to inform you that your booking has not been approved because of the following reason: " . $message . "\n\n\nSincerely,\nBonda Homestay Staff");

// notification of success
echo '<br><div class="alert alert-success" role="alert">Pending booking rejected!</div>';
