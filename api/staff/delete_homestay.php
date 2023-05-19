<?php
global $mydb;

require_once 'src/staff_navbar.php';

$homestay_id = (isset($_GET['homestay_id']) && $_GET['homestay_id'] != '') ? $_GET['homestay_id'] : die("Could not get $homestay_id in staff/delete_homestay.php around line 4");

$query = "DELETE FROM `homestay` WHERE `id` = '" . $homestay_id . "'";
$mydb->set_query($query);
$mydb->execute_query() or die("Something wrong with staff/delete_homestay.php around line 6");

// notification of success
echo '<br><div class="alert alert-success" role="alert">Homestay successfully deleted!</div>';
