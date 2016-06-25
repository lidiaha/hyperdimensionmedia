<?php
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
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
         $image = imageAutoExtension("/pictures/promoicons/", $row["id"]);
         echo "<div class='promotionitem'>";
         echo "<div class='promopic' style=\"background: url('$image') no-repeat; background-size: contain;\"></div>";
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