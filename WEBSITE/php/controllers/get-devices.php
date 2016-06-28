<?php
   /*
      interface:
      post parameters:
         "preview": if set, return only the columns required for the "list of devices" page
         filters:
            "category": contain a comma-separated list of inclusive filters to apply. If not set, the filter
               won't be applied. Values are the indexes of the device category to filter by
            "brands": same as above, but with brand names
            "oses": same as above, but with operating systems
            "connections": same as above, but with connection IDs (identifying a connection-type, i.e. Wi-Fi)
            "purchase": same as above, but with purchase modalities
            "typology": same as above, but with type-tags (i.e. smartphone, tablet)
            "price_range": serialized json object (string) specifying a series of price ranges, in the form:
               [{"low": 15, "high": 150 }, ...]
            "discount": in ["yes","no"]; wether to include/exclude discounted devices

      return:
         json representation of the selected tuples
   */

   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().":".str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));

   include "phplib/filter-engine.php";
   include "phplib/database.php";
   include "phplib/image-auto-extension.php";
   include "php/get-page-hits.php";

   function cmp_function($ra, $rb) {
      $hits_a = getHitNum($ra["id"], "devices");
      $hits_b = getHitNum($rb["id"], "devices");
      if ($hits_a == $hits_b) {
         return 0;
      }
      return ($hits_a < $hits_b) ? 1 : -1;
   }

   $conn = dbconn();

   // apply "preview"
   if (isset($_POST["preview"])) {
      $sql = "SELECT id, name, price, purchase, discount_price FROM devices";
   }
   else {
      $sql = "SELECT * FROM devices";
   }

   $price_db_key = "price";
   if (isset($_POST["discount"]) && $_POST["discount"] == "yes") {
      $price_db_key = "discount_price";
   }

   // apply filters
   $filterlist = array();
   $filterlist = applyFilterSet($conn, "type", "category", $filterlist);
   $filterlist = applyFilterRange($conn, $price_db_key, "price_range", $filterlist);
   $filterlist = applyFilterSet($conn, "brand", "brands", $filterlist);
   $filterlist = applyFilterSet($conn, "os", "oses", $filterlist);
   $filterlist = applyFilterDeviceConn($conn, "connections", $filterlist);
   $filterlist = applyFilterSetLike($conn, "purchase", "purchase", $filterlist);
   $filterlist = applyFilterSetLike($conn, "typetags", "typology", $filterlist);
   $filterlist = applyFilterDeviceDiscount($conn, "discount", $filterlist);
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

   usort($rows, "cmp_function");

   print json_encode($rows);
 ?>
