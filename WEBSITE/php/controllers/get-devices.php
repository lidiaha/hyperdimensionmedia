<?php
   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
   $conn = dbconn();
   if (isset($_POST["preview"])) {
      $sql = "SELECT id, name, price FROM devices";
   }
   else {
      $sql = "SELECT * FROM devices";
   }
   $result = $conn->query($sql);

   if (!$result) {
    echo "query error";
   }

   $rows = array();
   while($r = mysqli_fetch_assoc($result)) {
      if ($r["id"]) {
         $r["image"] = imageAutoExtension("/pictures/products/devices/", $r["id"]);
      }
      array_push($rows, $r);
   }
   print json_encode($rows);
 ?>
