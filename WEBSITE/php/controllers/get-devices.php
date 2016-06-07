<?php
   /*
      interface:
      post parameters:
         "preview": if set, return only the columns required for the "list of devices" page
         filters: contain a comma-separated list of inclusive filters to apply. If not set, the filter
            won't be applied.
            "category": indexes of the device category to filter by
      return:
         json representation of the selected tuples
   */

   function generateFilterQueryFragment($conn, $filterkey, $filterlist) {
      if (count($filterlist) == 0) {
         return "";
      }
      $query = "(";
      for ($i = 0; $i < count($filterlist); $i++) {
         $safeval = mysqli_real_escape_string($conn, $filterlist[$i]);
         if ($safeval == "") {
            continue;
         }
         $query = $query . $filterkey . " = '" . $safeval . "'";
         if ($i + 1 < count($filterlist)) {
            $query = $query . " OR ";
         }
      }
      $query = $query . ")";
      return $query;
   }

   function applyFilter($conn, $dbkey, $postkey, $filterlist) {
      if (isset($_POST[$postkey])) {
         $fragment = generateFilterQueryFragment($conn, $dbkey, explode(",", $_POST[$postkey]));
         if ($fragment != "") {
            array_push($filterlist, $fragment);
         }
      }
      return $filterlist;
   }

   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
   $conn = dbconn();

   // apply "preview"
   if (isset($_POST["preview"])) {
      $sql = "SELECT id, name, price FROM devices";
   }
   else {
      $sql = "SELECT * FROM devices";
   }

   // apply filters
   $filterlist = array();
   $filterlist = applyFilter($conn, "type", "category", $filterlist);
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
         $r["image"] = imageAutoExtension("/pictures/products/devices/", $r["id"]);
      }
      array_push($rows, $r);
   }
   print json_encode($rows);
 ?>
