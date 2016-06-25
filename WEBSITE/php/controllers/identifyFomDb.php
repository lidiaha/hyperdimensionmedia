<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";

$conn = dbconn();
$id = mysqli_real_escape_string($conn, $_GET["id"]);
$table = mysqli_real_escape_string($conn, $_GET["table"]);
$sql = "SELECT * FROM `$table` WHERE id = '$id' ";
$result = $conn->query($sql);
if (!$result) {
   echo "query error";
}
else {
   while($row = $result->fetch_assoc()) {
      $name = $row["name"];
      echo $name;
   }
}
$conn->close();
 ?>
