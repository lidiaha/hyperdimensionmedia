<?php
/*
   interface:
      POST parameters:
         "id": id of the product/item to identify
         "table": in ["category", "assistance", "devices", "promotions", "sl_services"]:
            name of the db table containing the product/item to identify
      returns:
         on success, the "name" field of the tuple corresponding to the provided
         id, table.
         on error, either "query error" or "forbidden"
*/
set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
include_once "phplib/database.php";
header('Access-Control-Allow-Origin: *');

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
