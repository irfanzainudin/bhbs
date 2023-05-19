<?php
if (!isset($_SESSION['staff_id'])) {
	header("location:?p=staff");
}
