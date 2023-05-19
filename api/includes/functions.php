<?php
function strip_zeros_from_date($marked_string = "")
{
  //first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  $cleaned_string = str_replace('*0', '', $no_zeros);
  return $cleaned_string;
}
function redirect_to($location = null)
{
  if ($location != null) {
    header("Location: {$location}");
    exit;
  }
}
function redirect($location = null)
{
  if ($location != null) {
    echo "<script>
					window.location='{$location}'
				</script>";
  } else {
    echo 'error location';
  }
}
function output_message($message = "")
{

  if (!empty($message)) {
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function date_to_text($datetime = "")
{
  $nicetime = strtotime($datetime);
  $formatter = new IntlDateFormatter('en_US', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
  return $formatter->format($nicetime);
}

// my own defined function, reference: https://stackoverflow.com/questions/59049372/how-to-fix-cannot-redeclare-spl-autoload-register
function my_autoload($class_name)
{
  $class_name = strtolower($class_name);
  $path = LIB_PATH . DS . "{$class_name}.php";
  if (file_exists($path)) {
    require_once($path);
  } else {
    die("The file {$class_name}.php could not be found.");
  }
}
spl_autoload_register('my_autoload');

function file_path()
{
  $pathinfo = pathinfo(__FILE__);
  echo $pathinfo['dirname'];
}

function current_page()
{
  $this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
  $bits = explode('/', $this_page);
  $this_page = $bits[count($bits) - 1]; // will return file.php, with parameters if case, like file.php?id=2
  $this_script = $bits[0]; // will return file.php, no parameters*/
  return $bits[3];
}

function unset_sessions()
{
  if (isset($_SESSION['from'])) {
    unset($_SESSION['from']);
  }
  if (isset($_SESSION['to'])) {
    unset($_SESSION['to']);
  }
  if (isset($_SESSION['adults'])) {
    unset($_SESSION['adults']);
  }
  if (isset($_SESSION['child'])) {
    unset($_SESSION['child']);
  }
  if (isset($_SESSION['roomid'])) {
    unset($_SESSION['roomid']);
  }
}

function date_differ($start, $end)
{
  $start_ts = strtotime($start);
  $end_ts = strtotime($end);
  $diff = $end_ts - $start_ts;
  return round($diff / 86400);
}
