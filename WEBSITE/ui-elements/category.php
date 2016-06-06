<link rel="stylesheet" type="text/css" href="style/category.css">
<?php
   include $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
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
         echo "<a class=\"category\" href=\ to do\">\n";
         echo "<div class=\"data\"><img class=\"image\" src=\"/ui-elements/images/device/category/$id.png\">\n";
         echo "<div class=\"name\">$name</div>\n";
         echo "</div></a>\n";
      }
   }
   $conn->close();
?>
