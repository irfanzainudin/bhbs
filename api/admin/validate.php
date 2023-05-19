<?php
if (!isset($_SESSION['admin_id'])) {
	header("location:?p=admin");
}
