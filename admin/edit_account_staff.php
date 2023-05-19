<?php

global $mydb;

require_once 'validate.php';
require_once 'src/admin_navbar.php';

?>

<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="alert alert-info">Account / Change Account</div>
			<?php
			$query = "SELECT * FROM `staff` WHERE `username` = '$_REQUEST[username]'";
			$mydb->set_query($query);
			$result = $mydb->load_result_list() or die("Something wrong in admin/edit_account_staff.php around line 17");
			foreach ($result as $val) {
			?>
				<br />
				<div class="col-md-4">
					<form method="POST">
						<div class="form-group">
							<label>Name </label>
							<input type="text" class="form-control" value="<?php echo $val->name ?>" name="name" />
						</div>
						<div class="form-group">
							<label>Username </label>
							<input type="text" class="form-control" value="<?php echo $val->username ?>" name="username" />
						</div>
						<div class="form-group">
							<label>Password </label>
							<input type="text" class="form-control" value="<?php echo $val->password ?>" name="password" />
						</div>
						<br />
						<div class="form-group">
							<button name="edit_account_staff" class="btn btn-warning form-control"><i class="glyphicon glyphicon-edit"></i> Save Changes</button>
						</div>
					</form>
				</div>
			<?php } ?>
			<?php require_once 'admin/edit_query_account_staff.php' ?>
		</div>
	</div>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>