<?php

require_once 'src/staff_navbar.php';

$rsvn_id = (isset($_GET['rsvn_id']) && $_GET['rsvn_id'] != '') ? $_GET['rsvn_id'] : die("Could not get $rsvn_id in staff/delete_pending.php around line 5");

$guest = (isset($_GET['guest']) && $_GET['guest'] != '') ? $_GET['guest'] : die("Could not get $guest in staff/delete_pending.php around line 7");
?>

<!-- HTML -->

<form method="post" action="?p=reject-query-pending&rsvn_id=<?php echo $rsvn_id ?>&guest=<?php echo $guest ?>">
	<div class="mb-3">
		<label for="rejection-reason" class="form-label">Rejection Reason:</label>
		<textarea class="form-control" id="rejection-reason" name="rejection-reason" rows="3" required></textarea>
	</div>
	<button type="submit" name="rejection" class="btn btn-primary">Submit</button>
</form>