<?php

global $mydb;

require_once 'src/staff_navbar.php';

$rsvn_id = (isset($_GET['rsvn_id']) && $_GET['rsvn_id'] != '') ? $_GET['rsvn_id'] : die("Could not get $rsvn_id in staff/checkout_query.php around line 5");

$time = date("H:i:s", strtotime("+8 HOURS"));
$query = "UPDATE `reservation` SET `status` = 'Check Out' WHERE `id` = '$rsvn_id'";
$mydb->set_query($query);
$mydb->execute_query() or die("Something wrong in staff/checkout_query.php in line 10");

// notification of success
echo '<br><div class="alert alert-success" role="alert">Guest has been checked out!</div>';
