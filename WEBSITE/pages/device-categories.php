<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/category2.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
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
                        echo "<a class=\"category\" href=\"#todo\">\n";
                        echo "<div class=\"data\"><img class=\"image\" src=\"/ui-elements/images/device/category/$id.png\">\n";
                        echo "<div class=\"name\">$name</div>\n";
                        echo "</div></a>";
                     }
                     echo "\n";
                  }
                  $conn->close();
               ?>
               <div class="doorstopper"></div>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
