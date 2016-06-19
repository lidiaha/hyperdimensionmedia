<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/devicelist.css">
      <link rel="stylesheet" type="text/css" href="/style/transitionpage.css">
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
                ?>
               <div class="gobackbar" onclick="location.href='/pages/service-presentation.php?service_id=<?php echo $service_id; ?>'">
                  <div class="arrowback"></div>
                  <div class="labelback">Torna al servizio SL</div>
               </div>
               <?php
                  $sql = "SELECT * FROM devices JOIN device_service WHERE service_id='$service_id' AND devices.id=device_service.device_id ";
                  $result = $conn->query($sql);
                  if (!$result) {
                     echo "query error";
                  }
                  else {
                     while($row = $result->fetch_assoc()) {
                        $device_id= $row["id"];
                        $name = $row["name"];
								echo "<div class='dummyheader'></div>\n";
								echo "<div class='deviceitem'>";
                        echo "<div class='devicepic' style='background-image: url(\"/pictures/products/devices/$device_id.jpg\")'></div>\n";
                        echo "<div class='name'><a href='/pages/device-presentation.php?device_id=$device_id' >$name</a></div>\n";
                        echo "</div>\n";
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