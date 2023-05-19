<?php

global $mydb;

if (isset($_POST['edit_homestay'])) {
	$homestay_id = $_POST['homestay_id'];
	$homestay_name = $_POST['name'];
	$price = $_POST['price'];
	$photo_name = '';
	if (isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])) {
		$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$photo_name = addslashes($_FILES['photo']['name']);
		$photo_size = getimagesize($_FILES['photo']['tmp_name']);
		move_uploaded_file($_FILES['photo']['tmp_name'], "../photo/" . $_FILES['photo']['name']);
	}

	$query = "UPDATE `homestay` SET `homestay_name` = '$homestay_name', `current_price` = '$price', `photo` = '$photo_name' WHERE `id` = '$homestay_id'";
	$mydb->set_query($query);
	$mydb->execute_query() or die("Something wrong in staff/edit_query_homestay.php around line 19");

	// notification of success
	echo '<br><div class="alert alert-success" role="alert">Homestay details successfully changed!</div>';
}
