<?php

$admin_content = 'admin/home.php';
$admin_view = (isset($_GET['a']) && $_GET['a'] != '') ? $_GET['a'] : '';

switch ($admin_view) {
	case 'accounts':
		$admin_content = 'admin/home.php';
		break;

	case 'logout':
		$admin_content = 'admin/logout.php';
		break;

	default:
		$admin_content = 'admin/home.php';
}

global $mydb;

// HTML
require_once 'src/admin_navbar.php';
require_once $admin_content;
