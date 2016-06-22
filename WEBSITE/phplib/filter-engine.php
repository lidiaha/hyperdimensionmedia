<?php
function generateFilterQueryFragmentSet($conn, $filterkey, $paramlist) {
   if (count($paramlist) == 0) {
      return "";
   }
   $query = "(";
   for ($i = 0; $i < count($paramlist); $i++) {
      $safeval = mysqli_real_escape_string($conn, $paramlist[$i]);
      if ($safeval == "") {
         continue;
      }
      $query = $query . $filterkey . " = '" . $safeval . "'";
      if ($i + 1 < count($paramlist)) {
         $query = $query . " OR ";
      }
   }
   $query = $query . ")";
   return $query;
}

function generateFilterQueryFragmentSetLike($conn, $filterkey, $paramlist) {
   if (count($paramlist) == 0) {
      return "";
   }
   $query = "(";
   for ($i = 0; $i < count($paramlist); $i++) {
      $safeval = mysqli_real_escape_string($conn, $paramlist[$i]);
      if ($safeval == "") {
         continue;
      }
      $query = $query . $filterkey . " LIKE '%" . $safeval . "%'";
      if ($i + 1 < count($paramlist)) {
         $query = $query . " OR ";
      }
   }
   $query = $query . ")";
   return $query;
}

function generateFilterQueryFragmentRange($conn, $filterkey, $paramlist) {
   if (count($paramlist) == 0) {
      return "";
   }
   $query = "(";
   for ($i = 0; $i < count($paramlist); $i++) {
      $elem = $paramlist[$i];
      if (array_key_exists("low", $elem) && array_key_exists("high", $elem)) {
         $safelow = mysqli_real_escape_string($conn, $elem["low"]);
         $safehigh = mysqli_real_escape_string($conn, $elem["high"]);
         $query = $query . "(" . $filterkey . " BETWEEN " . $safelow . " AND " . $safehigh . ")";
      } else if (array_key_exists("low", $elem)) {
         $safelow = mysqli_real_escape_string($conn, $elem["low"]);
         $query = $query . "(" . $filterkey . " >= " . $safelow . ")";
      } else if (array_key_exists("high", $elem)) {
         $safehigh = mysqli_real_escape_string($conn, $elem["high"]);
         $query = $query . "(" . $filterkey . " <= " . $safehigh . ")";
      }
      if ($i + 1 < count($paramlist)) {
         $query = $query . " OR ";
      }
   }
   $query = $query . ")";
   return $query;
}

function generateFilterQueryFragmentDeviceConn($conn, $paramlist) {
   if (count($paramlist) == 0) {
      return "";
   }
   $subquery = generateFilterQueryFragmentSet($conn, "ct.name", $paramlist);
   $query = "(id IN (SELECT dc.dev_id FROM connectiontypes AS ct JOIN deviceconnect AS dc ON ct.id = dc.conn_id" .
   " WHERE $subquery))";
   return $query;
}

function applyFilterSet($conn, $dbkey, $postkey, $filterlist) {
   /*
      applies a filter on the $dbkey database column, the filter parameter are
      taken from $postkey
   */
   if (isset($_POST[$postkey])) {
      if ($_POST[$postkey] == "") {
         return $filterlist;
      }
      $fragment = generateFilterQueryFragmentSet($conn, $dbkey, explode(",", $_POST[$postkey]));
      if ($fragment != "") {
         array_push($filterlist, $fragment);
      }
   }
   return $filterlist;
}

function applyFilterRange($conn, $dbkey, $postkey, $filterlist) {
   /*
      applies a filter on the $dbkey database column, $postkey contain the json
      representation of the interval
   */
   if (isset($_POST[$postkey])) {
      $intervals = json_decode($_POST[$postkey], true);
      if (!$intervals) {
         return $filterlist;
      }
      if (!is_array($intervals)) {
         return $filterlist;
      }
      $fragment = generateFilterQueryFragmentRange($conn, $dbkey, $intervals);
      if ($fragment != "") {
         array_push($filterlist, $fragment);
      }
   }
   return $filterlist;
}

function applyFilterDeviceConn($conn, $postkey, $filterlist) {
   /*
      applies a tailor-made subquery to filter a device based on its connections
   */
   if (isset($_POST[$postkey])) {
      if ($_POST[$postkey] == "") {
         return $filterlist;
      }
      $fragment = generateFilterQueryFragmentDeviceConn($conn, explode(",", $_POST[$postkey]));
      if ($fragment != "") {
         array_push($filterlist, $fragment);
      }
   }
   return $filterlist;
}

function applyFilterSetLike($conn, $dbkey, $postkey, $filterlist) {
   /*
      applies a filter on the $dbkey database column, the filter parameter are
      taken from $postkey; match is done by using "LIKE %keyword%"
   */
   if (isset($_POST[$postkey])) {
      if ($_POST[$postkey] == "") {
         return $filterlist;
      }
      $fragment = generateFilterQueryFragmentSetLike($conn, $dbkey, explode(",", $_POST[$postkey]));
      if ($fragment != "") {
         array_push($filterlist, $fragment);
      }
   }
   return $filterlist;
}
 ?>
