<html>
  <head>
    <title>Cool cars</title>
    <script src="../js/coolness.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/cars.css">
  </head>
  <body>
    <div class="titlearea">
      <div class="titleft">(Un)cool cars:</div>
      <div class="titleright"><a href="addcar.php">Add a car</a></div>
    </div>
    <?php
      include "../phplib/database.php";
      $conn = dbconn();
      $sql = "SELECT * FROM testable";
      $result = $conn->query($sql);
      if (!$result) {
        echo "query error";
      }
      else {
         while($row = $result->fetch_assoc()) {
           $name = $row["name"];
           $url = $row["url"];
           $id = $row["id"];
           $cool = $row["cool"];
           echo "<div class=\"carentry\">\n";
           echo "<div class=\"cardata\"><div class=\"carname\">$name:</div>\n";
           echo "<div class=\"coolness\"><script>showCoolness($cool);</script></div>\n";
           echo "<a class=\"carurl\" href=\"$url\">$url</a></div>\n";
           echo "<img class=\"carpic\" src=\"carpic.php?id=$id\"/>\n";
           echo "</div>\n";

        }
      }


      $conn->close();
     ?>
  </body>
</html>
