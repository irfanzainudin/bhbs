<?php
require_once("includes/initialize.php");
$content = 'src/home.php';
$view = (isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : '';

switch ($view) {
  case 'home':
    $title = "Home";
    $content = 'src/home.php';
    break;

  case 'about-us':
    $title = "About Us";
    $content = 'about-us/index.php';
    break;

  case 'contact-us':
    $title = "Contact Us";
    $content = 'contact-us/index.php';
    break;

  case 'gallery':
    $title = "Gallery";
    $content = 'images/index.php';
    break;

  case 'availability':
    $title = "Available Homestay";
    $content = 'search_availability.php';
    break;

  case 'booking':
    $title = "Book A Homestay";
    $content = 'booking/index.php';
    break;

  case 'review-details':
    $title = "Review Booking Details";
    $content = 'booking/review-details.php';
    break;

  case 'payment':
    $title = "Payment";
    $content = 'booking/payment-page.php';
    break;

  case 'confirmed-booking':
    $title = "Confirmed Booking";
    $content = 'booking/confirmed-booking.php';
    break;

    // ADMIN

  case 'admin':
    $title = "Admin";
    if (isset($_SESSION['admin_id'])) {
      $content = 'admin/index.php';
    } else {
      $content = 'admin/login.php';
    }
    break;

  case 'admin-logout':
    $title = "Admin Homestay page";
    $content = 'admin/logout.php';
    break;

  case 'add-account-staff':
    $title = "Add Account Staff";
    $content = 'admin/add_account_staff.php';
    break;

  case 'edit-account-staff':
    $title = "Edit Account Staff";
    $content = 'admin/edit_account_staff.php';
    break;

  case 'delete-account-staff':
    $title = "Delete Account Staff";
    $content = 'admin/delete_account_staff.php';
    break;

    // STAFF

  case 'staff':
    $title = "Staff";
    if (isset($_SESSION['staff_id'])) {
      $content = 'staff/home.php';
    } else {
      $content = 'staff/login.php';
    }
    break;

  case 'staff-booking':
    $title = "Staff Booking page";
    $content = 'staff/booking.php';
    break;

  case 'staff-homestay':
    $title = "Staff Homestay page";
    $content = 'staff/homestay.php';
    break;

  case 'confirm-booking':
    $title = "Confirm Booking";
    $content = 'staff/confirm_booking.php';
    break;

  case 'save-form':
    $title = "Save Form";
    $content = 'staff/save_form.php';
    break;

  case 'reject-pending':
    $title = "Staff Booking Pending Reject page";
    $content = 'staff/reject_pending.php';
    break;

  case 'reject-query-pending':
    $title = "Staff Booking Pending Reject Query page";
    $content = 'staff/reject_query_pending.php';
    break;

  case 'checkout-query':
    $title = "Staff Booking Check Out Query page";
    $content = 'staff/checkout_query.php';
    break;

  case 'add-homestay':
    $title = "Add Homestay";
    $content = 'staff/add_homestay.php';
    break;

  case 'edit-homestay':
    $title = "Edit Homestay";
    $content = 'staff/edit_homestay.php';
    break;

  case 'delete-homestay':
    $title = "Delete Homestay";
    $content = 'staff/delete_homestay.php';
    break;

  case 'staff-logout':
    $title = "Staff Logout";
    $content = "staff/logout.php";
    break;

  default:
    $title = "Home";
    $content = 'src/home.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bonda Homestay Booking System</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Our own stylesheet -->
  <link href="main.css" rel="stylesheet" />
  <!-- From staff/ -->
  <link href="https://fonts.googleapis.com/css?family=Heebo:400,700|IBM+Plex+Sans:600" rel="stylesheet">
  <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>

<body>
  <?php include_once 'src/navbar.php' ?>
  <div id="content">
    <?php require_once $content ?>
  </div>
  <?php include_once 'src/footer.php' ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>