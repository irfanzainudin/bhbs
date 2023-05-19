<?php

global $mydb;

if (isset($_POST['add_account_staff'])) {
	$length_check = "SELECT MAX(`id`) AS max_id FROM `staff`";
	$mydb->set_query($length_check);
	$cur = $mydb->load_result_list() or die("Something wrong in admin/add_query_stuff.php around line 8");
	$s_count = $cur[0]->max_id;
	++$s_count;

	if ($s_count === 0) {
		++$s_count;
	}

	// check if username exists
	// insert into data if username is new
	$name = $_POST['name'];
	$nokp = $_POST['nokp'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "SELECT * FROM `staff` WHERE `username` = '" . $username . "'";
	$mydb->set_query($query);
	$result = $mydb->execute_query() or die("Something wrong in admin/add_query_stuff.php around line 24");
	$valid = $result->fetch_assoc();
	if (isset($valid)) {
		echo "<center><label style = 'color:red;'>Username already taken</center></label>";
	} else {
		$mydb->set_query("INSERT INTO `staff` (`id`, `name`, `nokp`, `username`, `password`) VALUES (" . $s_count . ", '" . $name . "', '" . $nokp . "', '" . $username . "', '" . $password . "')");
		$mydb->execute_query() or die("Something wrong in admin/add_query_stuff.php around line 29");
		echo '<br><div class="alert alert-success" role="alert">New staff account created!</div>';
	}
}
