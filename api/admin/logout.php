<?php
// session_destroy();
$_SESSION['admin_id'] = NULL;
$_SESSION['admin_name'] = NULL;
header("location:index.php");
