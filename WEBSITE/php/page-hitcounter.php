<?php
/*
   interface:
      POST parameters:
         "pageid": id of the product/item described on the page to hit-count
         "pagetype": in ["assistance", "devices"]: class of the item/product
   return:
      prints "done" once finished processing, with optional "query error" in case of error.
      please note that receiving "done" does not guarantee that the db update was successful
*/
include $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
$conn = dbconn();
$pagetypes = array("assistance", "devices");

function existsEntry($conn, $pageid, $pagetype) {
   $sql = "SELECT * FROM page_hits WHERE id='$pageid' AND type='$pagetype'";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      if (mysqli_num_rows($result) == 0) {
         return false;
      }
      return true;
   }
   return false;
}

function updateMoreVisit($conn, $pageid, $pagetype) {
   $sql = "UPDATE page_hits SET hits = hits + 1 WHERE id='$pageid' AND type='$pagetype'";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
}

function createPageEntry($conn, $pageid, $pagetype) {
   $sql = "INSERT INTO page_hits VALUES ('$pageid', '$pagetype', 1)";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
}

if (isset($_POST["pageid"]) && isset($_POST["pagetype"])) {
   $pageid = mysqli_real_escape_string($conn, $_POST["pageid"]);
   $pagetype = mysqli_real_escape_string($conn, $_POST["pagetype"]);
   if (in_array($pagetype, $pagetypes)) {
      if (existsEntry($conn, $pageid, $pagetype)) {
         updateMoreVisit($conn, $pageid, $pagetype);
      } else {
         createPageEntry($conn, $pageid, $pagetype);
      }
   }
}

echo "done";

 ?>
