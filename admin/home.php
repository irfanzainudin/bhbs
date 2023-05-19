<?php
require_once 'validate.php';
require_once 'src/admin_navbar.php';
?>
<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="alert alert-info">Accounts</div>
			<a class="btn btn-success" href="?p=add-account-staff"><i class="glyphicon glyphicon-plus"></i> Create New Staff Account</a>
			<br />
			<br />
			<table id="table" class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Username</th>
						<th>Password</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT * FROM `staff`";
					$mydb->set_query($query);
					$fetch = $mydb->load_result_list() or die("Something wrong in admin/home.php around line 25");
					foreach ($fetch as $val) {
					?>
						<tr>
							<td><?php echo $val->name ?></td>
							<td><?php echo $val->username ?></td>
							<td><?php echo md5($val->password) ?></td>
							<td>
								<a class="btn btn-warning" href="?p=edit-account-staff&username=<?php echo $val->username ?>">
									<i class="glyphicon glyphicon-edit"></i>
									Edit
								</a>
								<a class="btn btn-danger" onclick="confirmationDelete(this); return false;" href="?p=delete-account-staff&username=<?php echo $val->username ?>">
									<i class="glyphicon glyphicon-remove"></i>
									Delete
								</a>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	function confirmationDelete(anchor) {
		var conf = confirm("Are you sure you want to delete this record?");
		if (conf) {
			window.location = anchor.attr("href");
		}
	}
</script>