<?php
   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
   include_once "phplib/database.php";
   include_once "phplib/image-auto-extension.php";
   header('Access-Control-Allow-Origin: *');
   $conn = dbconn();

   $device_id = mysqli_real_escape_string($conn, $_GET["device_id"]);
?>
<div class="gobackbar" onclick="location.href='/pages/device-presentation.html?device_id=<?php echo $device_id; ?>'">
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
		echo "<div class='dedicated'> Promozioni per questo prodotto</div>";
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
         echo "<div class='scopri'><a class='more' href='/pages/promotion-description.html?promo_id=$promo_id'> Scopri </a></div>";
         echo "</div>";
         echo "<div class='doorstopper'></div>\n";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include "ui-elements/no-results.html";
      }
   }
   $conn->close();
?>
