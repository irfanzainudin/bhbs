<?php
require_once 'validate.php';
require_once 'src/admin_navbar.php';
?>
<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="alert alert-info">Account / Create Account</div>
			<div class="col-md-4">
				<form method="POST">
					<div class="form-group">
						<label>Name </label>
						<input type="text" class="form-control" name="name" />
					</div>
					<div class="form-group">
						<label>No. K/P </label>
						<input type="text" class="form-control" name="nokp" />
					</div>
					<div class="form-group">
						<label>Username </label>
						<input type="text" class="form-control" name="username" />
					</div>
					<div class="form-group">
						<label>Password </label>
						<input type="password" class="form-control" name="password" />
					</div>
					<br />
					<div class="form-group">
						<button name="add_account_staff" class="btn btn-info form-control"><i class="glyphicon glyphicon-save"></i> Create New Staff Account</button>
					</div>
				</form>
				<?php require_once 'add_query_staff.php' ?>
			</div>
		</div>
	</div>
</div>