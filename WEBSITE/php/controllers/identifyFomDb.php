<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";

$conn = dbconn();
$allowed = array("category", "assistance", "devices", "promotions", "sl_services");
$id = mysqli_real_escape_string($conn, $_GET["id"]);
$table = mysqli_real_escape_string($conn, $_GET["table"]);
if (in_array($table, $allowed)) {
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
} else {
   echo "forbidden";
}

$conn->close();

 ?>
