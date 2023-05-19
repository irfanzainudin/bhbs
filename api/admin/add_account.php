<!DOCTYPE html>
<?php
require_once 'validate.php';
?>
<html lang="en">

<head>
	<title>Bonda Homestay Booking System</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css " />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body>
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="alert alert-info">Account / Create Account</div>
				<br />
				<div class="col-md-4">
					<form method="POST">
						<div class="form-group">
							<label>Name </label>
							<input type="text" class="form-control" name="name" />
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
							<button name="add_account" class="btn btn-info form-control"><i class="glyphicon glyphicon-save"></i> Saved</button>
						</div>
					</form>
					<?php require_once 'add_query_account.php' ?>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>

</html>