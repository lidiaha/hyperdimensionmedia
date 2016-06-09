<?php
function generateFilterQueryFragmentSet($conn, $filterkey, $filterlist) {
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

function generateFilterQueryFragmentRange($conn, $filterkey, $low, $high) {
   $query = "(";
   $safelow = mysqli_real_escape_string($conn, $low);
   $safehigh = mysqli_real_escape_string($conn, $high);
   $query = $query . $filterkey . " BETWEEN " . $safelow . " AND " . $safehigh;
   $query = $query . ")";
   return $query;
}

function applyFilterSet($conn, $dbkey, $postkey, $filterlist) {
   /*
      applies a filter on the $dbkey database column, the filter parameter are
      taken from $postkey
   */
   if (isset($_POST[$postkey])) {
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
      $interval = json_decode($_POST[$postkey]);
      if (!$interval) {
         return $filterlist;
      }
      $low = $interval->{"low"};
      $high = $interval->{"high"};
      $fragment = generateFilterQueryFragmentRange($conn, $dbkey, $low, $high);
      if ($fragment != "") {
         array_push($filterlist, $fragment);
      }
   }
   return $filterlist;
}
 ?>
