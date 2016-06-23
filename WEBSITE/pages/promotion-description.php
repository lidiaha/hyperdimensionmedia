<!DOCTYPE html>
<html>
   <head>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/viewport.html"; ?>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/promotionpage.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <?php
         include_once $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/page-identify.php";
         pageIdentifyFromDB($_GET["promo_id"],"promotions");
       ?>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
               <script>document.write(getBreadcrumbHtmlBar());</script>
               <?php
                  include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
                  include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";

                  function getSLServiceID($conn, $promo_id) {
                     $sql = "SELECT * FROM service_promo WHERE promo_id='$promo_id' ";
                     $result = $conn->query($sql);
                     if (!$result) {
                        echo "query error";
                     }
                     else {
                        while($row = $result->fetch_assoc()) {
                           $service_id = $row["service_id"];
                           return $service_id;
                        }
                     }
                     return -1;
                  }

                  $conn = dbconn();

                  $promo_id = mysqli_real_escape_string($conn, $_GET["promo_id"]);
                  $sql = "SELECT * FROM promotions WHERE id='$promo_id' ";
                  $result = $conn->query($sql);
                  if (!$result) {
                     echo "query error";
                  }
                  else {
                     while($row = $result->fetch_assoc()) {
                        $name = $row["name"];
                        $price = $row["price"];
                        $duration = $row["duration"];
                        $description = $row["description"];
                        $subtitle = $row["subtitle"];
                        $table_code = $row["table_code"];
                        $image = imageAutoExtension("/pictures/promotionbanners/", $row["id"]);
                        echo "<div class='header' style='background-image: url(\"$image\")'>\n";
                        echo "<div class='name'>$name</div>\n";
                        echo "<a href='/pages/how-to-activate.php'><div class='rules'>Come si attiva</div></a>\n";
                        echo "<div class='mini-description'>$subtitle</div>\n";
                        echo "<div class='price'> $price €/mese ";
                        if ($duration!=0){
                           echo "per $duration mesi";
                        }
                        echo "</div>\n<div class='attiva'> ATTIVA </div>\n";
                        echo "</div>\n";
                        echo "<div class='description'><p>$description</p>\n";
                        echo "</div>";
                        $linked_sl = getSLServiceID($conn, $promo_id);
                        if ($linked_sl < 0) {
                           echo "<div class='SL'>Nessun servizio Smart Life associato</div>\n";
                        } else {
                           echo "<div class='SL'><a href='/pages/service-presentation.php?service_id=$linked_sl'> Scopri di più sul servizio</a></div>\n";
                        }
                        echo "<div class='table'>\n";
                        echo "$table_code";
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
