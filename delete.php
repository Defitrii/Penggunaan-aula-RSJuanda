<?php
include "db_conn.php";
$kd_booking = $_GET["kd_booking"];
$sql = "DELETE FROM `crud` WHERE `crud`.`kd_booking` = '$kd_booking'";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: dashboard.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
