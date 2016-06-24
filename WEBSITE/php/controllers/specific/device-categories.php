<?php
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
   $conn = dbconn();
   $sql = "SELECT * FROM category WHERE type='device' ";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      while($row = $result->fetch_assoc()) {
         $name = $row["name"];
         $id=$row["id"];
         $image = imageAutoExtension("/pictures/category/device/", $row["id"]);
         echo "<a class=\"category\" href=\"/pages/devices-mono-category.php?category=$id\">\n";
         echo "<div class=\"data\"><img class=\"image\" src=\"/pictures/category/device/$id.png\">\n";
         echo "<div class=\"name\">$name</div>\n";
         echo "</div></a>";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/no-results.html";
      }
   }
   $conn->close();
?>
<div class="doorstopper"></div>
