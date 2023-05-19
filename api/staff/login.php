<?php

global $mydb;

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "SELECT * FROM `staff` WHERE `username` = '$username' && `password` = '$password'";
	$mydb->set_query($query);
	$fetch = $mydb->fetch_array($mydb->execute_query());
	$row = $mydb->num_rows($mydb->execute_query());

	if ($row > 0) {
		$_SESSION['admin_id'] = NULL;
		$_SESSION['admin_name'] = NULL;
		$_SESSION['staff_id'] = $fetch['id'];
		$_SESSION['staff_name'] = $fetch['name'];
		// to refresh the page
		header("Refresh:0");
	} else {
		echo "<center><label style = 'color:red;'>Invalid username or password</label></center>";
	}
}
?>

<!-- HTML -->

<div class="container">
	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h4>Staff</h4>
			</div>
			<div class="panel-body">
				<form method="POST">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" required="required" />
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required="required" />
					</div>
					<br />
					<div class="form-group">
						<button name="login" class="form-control btn btn-primary"><i class="glyphicon glyphicon-log-in"> Login</i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>