<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/promotionslist.css">
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

                  $device_id = mysqli_real_escape_string($conn, $_GET["device_id"]);
                ?>
               <div class="gobackbar" onclick="location.href='/pages/device-presentation.php?device_id=<?php echo $device_id; ?>'">
                  <div class="arrowback"></div>
                  <div class="labelback">Torna al prodotto</div>
               </div>
               <?php
                  $sql = "SELECT * FROM device_promo JOIN promotions WHERE device_id='$device_id' AND device_promo.promo_id=promotions.id ";
                  $result = $conn->query($sql);
                  if (!$result) {
                     echo "query error";
                  }
                  else {
                     while($row = $result->fetch_assoc()) {
                        $promo_id= $row["id"];
                        $name = $row["name"];
                        $price = $row["price"];
                        $subtitle = $row["subtitle"];
                        echo "<div class='promotionitem'>";
                        echo "<div class='promopic' style=\"background: url('/pictures/promoicons/$promo_id.jpg') no-repeat; background-size: contain;\"></div>";
                        echo "<div class='name'> $name </div>";
                        echo "<div class='subtitle'> $subtitle </div>";
                        echo "<div class='promoprice'> da $price €/mese</div>";
                        echo "<div class='scopri'><a class='more' href='/pages/promotion-description.php?promo_id=$promo_id'> Scopri </a></div>";
                        echo "</div>";
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
