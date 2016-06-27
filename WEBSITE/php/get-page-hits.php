<?php
/*
   iterface: to be imported & called by other php code
*/
include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";

function getHitNum($_pageid, $_pagetype) {
   $conn = dbconn();
   $pageid = mysqli_real_escape_string($conn, $_pageid);
   $pagetype = mysqli_real_escape_string($conn, $_pagetype);
   $sql = "SELECT hits FROM page_hits WHERE id='$pageid' AND type='$pagetype'";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      if (mysqli_num_rows($result) == 0) {
         $conn->close();
         return 0;
      }
      while($row = $result->fetch_assoc()) {
         $hits = $row["hits"];
         $conn->close();
         return $hits;
      }
   }
   $conn->close();
   return 0;
}

 ?>
