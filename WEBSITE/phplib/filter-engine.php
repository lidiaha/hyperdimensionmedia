<?php
//TODO: rename $filterlist in the generator, because it induces confusion
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

function generateFilterQueryFragmentRange($conn, $filterkey, $filterlist) {
   if (count($filterlist) == 0) {
      return "";
   }
   $query = "(";
   for ($i = 0; $i < count($filterlist); $i++) {
      $elem = $filterlist[$i];
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
      if ($i + 1 < count($filterlist)) {
         $query = $query . " OR ";
      }
   }
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
 ?>
