<?php

global $mydb;

if (isset($_POST['add_homestay'])) {
	$homestay_name = $_POST['name'];
	$price = $_POST['price'];
	$photo_name = '';
	if (isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])) {
		$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$photo_name = addslashes($_FILES['photo']['name']);
		$photo_size = getimagesize($_FILES['photo']['tmp_name']);
		move_uploaded_file($_FILES['photo']['tmp_name'], "../photo/" . $_FILES['photo']['name']);
	}

	// to get the latest guest count
	$length_check = "SELECT MAX(`id`) AS max_id FROM `homestay`";
	$mydb->set_query($length_check);
	$cur = $mydb->load_result_list() or die("Something wrong in staff/add_query_homestay.php around line 19");
	$hs_count = $cur[0]->max_id;
	++$hs_count;

	$query = "INSERT INTO `homestay` (`id`, `homestay_name`, `description`, `city_id`, `is_open`, `category_id`, `current_price`, `photo`) VALUES (" . $hs_count . ", '" . $homestay_name . "', '', 1, 1, 1, 200.00, '" . $photo_name . "')";
	$mydb->set_query($query);
	$mydb->execute_query() or die("Something wrong with staff/add_query_homestay.php around line 25");

	// notification of success
	echo '<br><div class="alert alert-success" role="alert">New homestay successfully added!</div>';
}
