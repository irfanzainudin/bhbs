<?php

global $mydb;

require_once 'src/admin_navbar.php';

$username = (isset($_GET['username']) && $_GET['username'] != '') ? $_GET['username'] : die("Could not get $username in admin/delete_account_staff.php around line 3");

$query = "DELETE FROM `staff` WHERE `username` = '$username'";
$mydb->set_query($query);
$mydb->execute_query() or die("Something wrong in admin/delete_account_staff.php around line 11");


// notification of success
echo '<br><div class="alert alert-success" role="alert">Staff account deleted!</div>';
