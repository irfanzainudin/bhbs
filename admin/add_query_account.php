<?php
if (isset($_POST['add_account'])) {
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	// $query = $conn->query("SELECT * FROM `admin` WHERE `username` = '$username'") or die(mysqli_error());
	$query = $conn->query("SELECT * FROM `admin` WHERE `username` = '$username'") or die("Something wrong in bhbs/admin/add_query_account.php around line 7");
	$valid = $conn->num_rows;
	if ($valid > 0) {
		echo "<center><label style = 'color:red;'>Username already taken</center></label>";
	} else {
		$conn->query("INSERT INTO `admin` (name, username, password) VALUES('$name', '$username', '$password')") or die("Something wrong in bhbs/admin/add_query_account.php around line 12");
		header("location:account.php");
	}
}
