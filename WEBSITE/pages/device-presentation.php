<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/device.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <script>
         $(document).ready(function() {
            $(".pre").click(function() {
               $(this).parents().find(".presentazione").show();
               $(this).parent().find(".pre").css("background-color","white");
               $(this).parent().find(".pre").css("border-right","0px");
               $(this).parents().find(".caratteristiche").hide();
               $(this).parent().find(".car").css("background-color","grey");
               $(this).parent().find(".car").css("border-right","1px black solid");
            });
            $(".car").click(function() {
               $(this).parents().find(".caratteristiche").show();
               $(this).parent().find(".car").css("background-color","white");
               $(this).parent().find(".car").css("border-right","0px");
               $(this).parents().find(".presentazione").hide();
               $(this).parent().find(".pre").css("background-color","grey");
               $(this).parent().find(".pre").css("border-right","1px black solid");
            });
         });
      </script>
      <script>
      </script>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="side">
               <div class="pre"> Presentazione</div>
               <div class="car"> Caratteristiche tecniche</div>
            </div>
            <div id="maincontent">
               <?php
                  include $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
                  $conn = dbconn();

                  $device_id = mysqli_real_escape_string($conn, $_GET["device_id"]);

                  function printColors($conn, $device_id) {
                     $sql = "SELECT * FROM devicecolors WHERE dev_id='$device_id' ";
                     $result = $conn->query($sql);
                     if (!$result) {
                        echo "query error";
                     }
                     else {
                        while($row = $result->fetch_assoc()) {
                           $color= $row["color"];
                           echo "<div class=\"color\" style=\"background-color: $color;\"></div>";
                        }
                     }
                  }

                  $sql = "SELECT * FROM devices WHERE id='$device_id' ";
                  $result = $conn->query($sql);
                  if (!$result) {
                     echo "query error";
                  }
                  else {
                        while($row = $result->fetch_assoc()) {
                           $name = $row["name"];
                           $description= $row["description"];
                           $tech_specs= $row["tech_specs"];
                           $price= $row["price"];
                           echo "<div class=\"presentazione\">";
                           echo "<div class=\"info left\">";
                           echo "<img src=\"/pictures/products/devices/$device_id.jpg\" class=\"device-img\">";
                           echo "<div> Colore: ";
                           printColors($conn, $device_id);
                           echo "</div></div>";
                           echo "<div class=\"info right\">";
                           echo "<div class=\"name\"> $name </div><br>";
                           echo "<div class=\"price\"> $price € </div>";
                           echo "<p class=\"description\"> $description <br>";
                           echo "</p>";
                           echo "</div>";
                           echo "<div class=\"info buy\"> Acquista </div>";
                           echo "</div>";
                           echo "<div class=\"caratteristiche\">";
                           echo "<div class=\"name\"> $name </div>";
                           echo "<div class=\"specifiche\"> <p> $tech_specs </p><br>";
                           echo "</div>";
                           echo "</div>";

                        }
                     echo "\n";
                  }
                  $conn->close();
               ?>

            <div id="link">
               <a href="#"> Servizi Smart Life</a><br>
               <a href="#"> Servizio di assistenza dedicato</a>
            </div>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
