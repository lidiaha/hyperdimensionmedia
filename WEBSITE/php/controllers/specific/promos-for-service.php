<?php
   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
   include_once "phplib/database.php";
   include_once "phplib/image-auto-extension.php";
   header('Access-Control-Allow-Origin: *');
   $conn = dbconn();

   $service_id = mysqli_real_escape_string($conn, $_GET["service_id"]);
?>
<div class="gobackbar" onclick="location.href='/pages/service-presentation.php?service_id=<?php echo $service_id; ?>'">
   <div class="arrowback"></div>
   <div class="labelback">Torna al servizio SL</div>
</div>
<?php
   $sql = "SELECT * FROM promotions JOIN service_promo WHERE service_id='$service_id' AND promotions.id=service_promo.promo_id ";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
		echo "<div class='dedicated'> Promozioni per questo servizio SL</div>";
      while($row = $result->fetch_assoc()) {
         $promo_id= $row["id"];
         $name = $row["name"];
         $image = imageAutoExtension("/pictures/promoicons/", $row["id"]);
         echo "<div class='dummyheader'></div>\n";
         echo "<div class='item'>";
         echo "<div class='pic' style='background-image: url(\"$image\")'></div>\n";
         echo "<div class='name'><a href='/pages/promotion-description.php?promo_id=$promo_id' >$name</a></div>\n";
         echo "</div>\n";
         echo "<div class='doorstopper'></div>\n";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include "ui-elements/no-results.html";
      }
   }
   $conn->close();
?>
