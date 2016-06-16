<?php
   /*
      interface:
      post parameters:
         "preview": if set, return only the columns required for the "list of services" page
         "category": contain a comma-separated list of inclusive filters to apply. If not set, the filter
            won't be applied. Values are the indexes of the device category to filter by

      return:
         json representation of the selected tuples
   */

   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/filter-engine.php";
   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
   $conn = dbconn();

   // apply "preview"
   if (isset($_POST["preview"])) {
      $sql = "SELECT id, name, description FROM sl_services";
   }
   else {
      $sql = "SELECT * FROM sl_services";
   }

   // apply filters
   $filterlist = array();
   $filterlist = applyFilterSet($conn, "category", "category", $filterlist);
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
         $r["image"] = imageAutoExtension("/pictures/products/services/", $r["id"]);
      }
      array_push($rows, $r);
   }
   print json_encode($rows);
 ?>
