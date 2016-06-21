<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/nav-tracking.html"; ?>
<?php
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   function pageIdentify($name) {
      $sitename = "ulTIM8";
      echo "<script>loadHistory();\n" .
         "breadcrumbCurrentPage(\"$name\", location.href)</script>\n";
      echo "<title>$sitename - $name</title>\n";
   }
   function pageIdentifyNoTrack($name) {
      $sitename = "ulTIM8";
      echo "<title>$sitename - $name</title>\n";
   }
   function pageIdentifyFromDB($id, $table) {
      $conn = dbconn();
      $sql = "SELECT * FROM '$table' WHERE id='$id' ";
      $result = $conn->query($sql);
      if (!$result) {
         echo "query error";
      }
      else {
         while($row = $result->fetch_assoc()) {
            $name = $row["name"];
            pageIdentify($name);
         }
      }
      $conn->close();
   }
 ?>
