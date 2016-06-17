<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/SLpage.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
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

                  $service_id = mysqli_real_escape_string($conn, $_GET["service_id"]);
						
						function printUrls($url) {
                     $links = explode(";",$url);
                     foreach($links as $link){
                        echo "<a href='$link'><div class='link'></div></a>";
                     }
                  }
                  $sql = "SELECT * FROM sl_services WHERE id='$service_id' ";
                  $result = $conn->query($sql);
                  if (!$result) {
                     echo "query error";
                  }
                  else {
                     while($row = $result->fetch_assoc()) {
                        $name = $row["name"];
                        $description = $row["description"];
								$urls = $row["url"];
                        echo "<div class='dummyheader'></div>\n";
                        echo "<div class='header' style='background-image: url(\"/pictures/products/servicesbanners/$service_id.jpg\")'>\n";
                        echo "<div class='name'>$name</div>\n";
                        echo "<div class='description'><p>$description</p></div>\n";
                        echo "</div>";
								printUrls($urls);
                        echo "<div class='products scopri'><a href='#'> Scopri i prodotti</a></div>\n";
								echo "<div class='offers scopri'><a href='#'> Scopri le offerte</a></div>\n";
                        echo "<div class='doorstopper'></div>\n";
                     }
                     echo "\n";
                     if (mysqli_num_rows($result) == 0) {
                        include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/no-results.html";
                     }
                  }
                  $conn->close();
               ?>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
