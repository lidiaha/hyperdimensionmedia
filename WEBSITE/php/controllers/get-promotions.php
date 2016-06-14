<?php
   /*
      interface:
      post parameters:
         "preview": if set, return only the columns required for the "list of devices" page
         
      return:
         json representation of the selected tuples
   */

   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/filter-engine.php";
   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
   $conn = dbconn();

   // apply "preview"
   if (isset($_POST["preview"])) {
      $sql = "SELECT id, name, price , duration , subtitle FROM promotions";
   }
   else {
      $sql = "SELECT * FROM devices";
   }

   // apply filters
   $filterlist = array();
   // more filters here ^^^^^^^^
   if (count($filterlist) > 0) {
      $sql = $sql . " WHERE " . implode(" AND ", $filterlist);
   }
   // run query
   $result = $conn->query($sql);
   if (!$result) {
    echo "query error";
   }
   $rows = array();
   while($r = mysqli_fetch_assoc($result)) {
      if ($r["id"]) {
         $r["image"] = imageAutoExtension("/pictures/promo/", $r["id"]);
      }
      array_push($rows, $r);
   }
   print json_encode($rows);
 ?>
