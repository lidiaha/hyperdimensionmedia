<?php
   /*
      interface:
      post parameters:
         "preview": if set, return only the columns required for the "list of promotions" page
         "price_range": serialized json object (string) specifying a series of price ranges, in the form:
            [{"low": 15, "high": 150 }, ...]
         "duration_range": same as the above, except with intervals on the duration

      return:
         json representation of the selected tuples
   */

   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));

   include "phplib/filter-engine.php";
   include "phplib/database.php";
   include "phplib/image-auto-extension.php";
   header('Access-Control-Allow-Origin: *');
   $conn = dbconn();

   // apply "preview"
   if (isset($_POST["preview"])) {
      $sql = "SELECT id, name, price, duration, subtitle FROM promotions";
   }
   else {
      $sql = "SELECT * FROM promotions";
   }

   // apply filters
   $filterlist = array();
   $filterlist = applyFilterRange($conn, "price", "price_range", $filterlist);
   $filterlist = applyFilterRange($conn, "duration", "duration_range", $filterlist);
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
         $r["image"] = imageAutoExtension("/pictures/promoicons/", $r["id"]);
      }
      array_push($rows, $r);
   }
   print json_encode($rows);
 ?>
