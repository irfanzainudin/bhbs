<?php
$days = date_differ($_POST['check_in'], $_POST['check_out']);

$query = '';
$date_check = '';
if (isset($_POST['accommodation']) && $_POST['accommodation'] === 'Any') {
  $query = "SELECT * FROM `homestay` a WHERE a.`is_open`=1";
  $date_check = "SELECT * FROM `reservation` r WHERE (r.`start_date`='" . $_POST['check_in'] . "' OR r.`end_date`='" . $_POST['check_out'] . "')";
} else {
  $query = "SELECT * FROM `homestay` a WHERE a.`homestay_name`='" . $_POST['accommodation'] . "' AND a.`is_open`=1";
  $date_check = "SELECT * FROM `reservation` r WHERE (r.`start_date`='" . $_POST['check_in'] . "' OR r.`end_date`='" . $_POST['check_out'] . "')";
}
global $mydb;
$mydb->set_query($query);
$hs = $mydb->load_result_list() or die("Something wrong in search_availability.php around line 15");

// if any homestay is in this result list, then it's booked
$mydb->set_query($date_check);
$dcs = $mydb->load_result_list();
$available_homestays = array();
if (count($dcs) === 0) {
  foreach ($hs as $result) {
    array_push($available_homestays, $result);
  }
} else {
  $booked_homestays = array();
  foreach ($dcs as $val) {
    array_push($booked_homestays, $val->homestay_id);
  }

  foreach ($hs as $result) {
    if (!in_array($result->id, $booked_homestays)) {
      array_push($available_homestays, $result);
    }
  }
}
?>

<!-- HTML -->

<p>For <?php echo $days ?> days</p>
<h1>Welcome</h1>
<div>
  <?php
  if (count($available_homestays) === 0) {
    echo "Sorry, we are fully booked at that period in time. Would you consider <a href=\"index.php?p=home\">other dates?</a>";
  } else if (count($available_homestays) === 1) { // if there is only 1 result
    echo '<div class="card-container">';
    foreach ($available_homestays as $result) {
      echo '
  		<div class="card">
        <img src="images/' . $result->photo . '" class="card-img-top" alt="Bonda Homestay">
  			<div class="card-body">
          <h5 class="card-title">' . $result->homestay_name . '</h5>
          <p class="card-text">' . $result->description . '</p>
          <p class="card-text">RM' . $result->current_price . '/night</p>
          <a href="index.php?p=booking&homestay=' . $result->id . '" class="btn btn-primary">Book Now</a>
  			</div>
  		</div>
  		';
    };
    echo '</div>';
  } else {
    echo '<h3>Here are your options:</h3>';
    echo '
    <div>
    <h3>You can book multiple homestays:</h3>
    <form method="POST" action="index.php?p=booking&days=' . $days . '">';
    foreach ($available_homestays as $result) {
      echo '
      <input type="checkbox" id="homestay' . $result->id . '" name="check_list[]" value="' . $result->id . '">
      <label for="homestay' . $result->id . '">' . $result->homestay_name . '</label><br>
  		';
    };
    // if (isset($_POST['mycheckbox'])) {
    //   echo "checked!";
    // }
    echo '
    <input type="submit" role="button" class="btn btn-primary" value="Book Now">
    </form>
    </div>
    ';
    echo '<br>';
    echo '<h3>Or you can book individually:</h3>';
    echo '<div class="card-container">';
    foreach ($available_homestays as $result) {
      echo '
  		<div class="card">
  			<div class="card-body">
          <h5 class="card-title">' . $result->homestay_name . '</h5>
          <p class="card-text">' . $result->description . '</p>
          <p class="card-text">RM' . $result->current_price . '/night</p>
          <a href="index.php?p=booking&homestay=' . $result->id . '&days=' . $days . '" class="btn btn-primary">Book Now</a>
  			</div>
  		</div>
  		';
    };
    echo '</div>';
  }
  ?>
</div>