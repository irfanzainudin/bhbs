<?php
require_once 'validate.php';
require_once 'src/staff_navbar.php';

$staff_name = $_SESSION['staff_name'];
?>

<!-- HTML -->
<h3 class="text-center">Welcome <?php echo $staff_name; ?></h3>