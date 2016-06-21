<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/category2.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <?php
         include_once $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/page-identify.php";
         pageIdentify("smartlife categories");
       ?>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
               <?php
                  include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
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
                        echo "<a class=\"category\" href=\"/pages/SL-services-mono-category.php?category=$id\">\n";
                        echo "<div class=\"data\"><img class=\"image\" src=\"/pictures/category/smartlife/$id.png\">\n";
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
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
