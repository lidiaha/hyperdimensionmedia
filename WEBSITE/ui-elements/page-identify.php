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
   function pageIdentifyReset($name) {
      $sitename = "ulTIM8";
      echo "<script>loadHistory();\n" .
         "resetBreadcrumbs()</script>\n";
      echo "<title>$sitename - $name</title>\n";
   }
   function pageIdentifyFromDB($_id, $_table) {
      $conn = dbconn();
      $id = mysqli_real_escape_string($conn, $_id);
      $table = mysqli_real_escape_string($conn, $_table);
      $sql = "SELECT * FROM `$table` WHERE id = '$id' ";
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
