<?php

global $mydb;

if (isset($_POST['edit_account_staff'])) {
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "UPDATE `staff` SET `name` = '$name', `username` = '$username', `password` = '$password' WHERE `name` = '$username'";
	$mydb->set_query($query);
	$result = $mydb->execute_query() or die("Something wrong in admin/edit_query_account_staff.php around line 13");

	// notification of success
	echo '<br><div class="alert alert-success" role="alert">Staff account details successfully changed!</div>';
}
