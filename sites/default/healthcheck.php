<?php

include 'sites/default/environment.php';

$conn = new mysqli($drupal_db_host, $drupal_db_user, $drupal_db_pass, $drupal_db_name);
// Check connection
if ($conn->connect_error) {
  echo "Healthcheck | Connection failed: " . $conn->connect_error ."\n";
  exit(1);
}
$image_uid = ge("IMAGE_UID");

$sql = "SELECT value FROM variable where name = 'image_uid'";
$result = $conn->query($sql);
$var_value = unserialize($result->fetch_row()[0]);
$conn->close();

if ($result->num_rows > 1) {
  echo "Healthcheck | More than one values for image_uid\n";
  exit(2);
} elseif ($result->num_rows < 1) {
  echo "Healthcheck | No values for image_uid\n";
  exit(3);
} elseif ($var_value == $image_uid) {
  echo "Healthcheck | Correct value matched for image_uid!\n";
  exit(0);
} else {
  echo "Healthcheck | Invalid value for image_uid\n";
  exit(4);
}
