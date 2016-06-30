<?php
   /*
      interface:
      post parameters:
         "preview": if set, return only the columns required for the "list of services" page
         "category": contain a comma-separated list of inclusive filters to apply. If not set, the filter
            won't be applied. Values are the indexes of the device category to filter by
         "subcategory": same as the above, but with sub-categories
         "subtopic": same as the above, but with sub-topics

      return:
         json representation of the selected tuples
   */

   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));

   include "phplib/filter-engine.php";
   include "phplib/database.php";
   include "phplib/image-auto-extension.php";
   include "php/get-page-hits.php";
   header('Access-Control-Allow-Origin: *');
   $conn = dbconn();

   function idToName($conn, $table, $id) {
      $sql = "SELECT * FROM $table WHERE id = '$id'";
      $result = $conn->query($sql);
      if (!$result) {
         echo "query error";
         return "error";
      } else {
         while($r = mysqli_fetch_assoc($result)) {
            return $r["name"];
         }
      }
   }

   function cmp_function($ra, $rb) {
      $hits_a = getHitNum($ra["id"], "assistance");
      $hits_b = getHitNum($rb["id"], "assistance");
      if ($hits_a == $hits_b) {
         return 0;
      }
      return ($hits_a < $hits_b) ? 1 : -1;
   }

   // apply "preview"
   if (isset($_POST["preview"])) {
      $sql = "SELECT id, name, category, subcategory, subtopic FROM assistance";
   }
   else {
      $sql = "SELECT * FROM assistance";
   }

   // apply filters
   $filterlist = array();
   $filterlist = applyFilterSet($conn, "category", "category", $filterlist);
   $filterlist = applyFilterSet($conn, "subcategory", "subcategory", $filterlist);
   $filterlist = applyFilterSet($conn, "subtopic", "subtopic", $filterlist);
   // more filters here ^^^^^^^^
   if (count($filterlist) > 0) {
      $sql = $sql . " WHERE " . implode(" AND ", $filterlist);
   }
   // run query
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }

   $ret = array();
   $temp = array();
   while($r = mysqli_fetch_assoc($result)) {
      array_push($temp, $r);
   }

   usort($temp, "cmp_function");

   foreach ($temp as $r) {
      $cate = idToName($conn, "category", $r["category"]);
      $subcate = idToName($conn, "assistance_subcategory", $r["subcategory"]);
      $subtopic = idToName($conn, "assistance_subtopics", $r["subtopic"]);

      if (!isset($ret[$cate])) { $ret[$cate] = array(); }
      if (!isset($ret[$cate][$subcate])) { $ret[$cate][$subcate] = array(); }
      if (!isset($ret[$cate][$subcate][$subtopic])) { $ret[$cate][$subcate][$subtopic] = array(); }

      array_push($ret[$cate][$subcate][$subtopic], $r);
   }

   print json_encode($ret);
 ?>
