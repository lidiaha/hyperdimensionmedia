<?php
   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
   include_once "phplib/database.php";
   $conn = dbconn();

   $sql = "SELECT * FROM projects";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
         while($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $description= $row["description"];
            $url= $row["url"];
            echo "<a href='$url' style='text-decoration: none'><div class='project'>";
            echo "<div class='name'>$name</div>";
            echo "<div class='desc' >$description</div>";
            echo "</a></div>";
         }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include "ui-elements/no-results.html";
      }
   }
   $conn->close();
?>
