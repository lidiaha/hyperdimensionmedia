<?php
   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
   include_once "phplib/database.php";
   include_once "phplib/image-auto-extension.php";
   $conn = dbconn();
   $sql = "SELECT * FROM category WHERE type='smartlife' ";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      while($row = $result->fetch_assoc()) {
         $name = $row["name"];
         $id=$row["id"];
         $image = imageAutoExtension("/pictures/category/smartlife/", $row["id"]);
         echo "<a class=\"category\" href=\"file:///android_asset/www/pages/SL-services-mono-category.html?category=$id\">\n";
         echo "<div class=\"data\"><img class=\"image\" src=\"$image\">\n";
         echo "<div class=\"name\">$name</div>\n";
         echo "</div></a>";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include "ui-elements/no-results.html";
      }
   }
   $conn->close();
?>
<div class="doorstopper"></div>
