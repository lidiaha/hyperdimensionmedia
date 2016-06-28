<?php
/*
   iterface: to be imported & called by other php code
*/

set_include_path(get_include_path().":".str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME']));

include_once "phplib/database.php";

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
