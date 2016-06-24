<?php
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
   $conn = dbconn();

   $device_id = mysqli_real_escape_string($conn, $_GET["device_id"]);

   function formatText($_tech_specs) {
      $tech_specs = preg_replace("/\n\n\n/", "\r\n\r\n\r\n", $_tech_specs);
      $paragr = explode("\r\n\r\n\r\n",$tech_specs);
      foreach($paragr as $_piece){
         $piece = preg_replace("/\n\n/", "\r\n\r\n", $_piece);
         list($title,$text) = explode("\r\n\r\n",$piece);
         echo "<p style=\"font-weight:bold\"> $title </p>";
         echo "<p> $text </p><br>";
      }
   }

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

   function printRate($conn, $device_id) {
      $sql = "SELECT * FROM device_installments WHERE dev_id='$device_id' ";
      $result = $conn->query($sql);
      if (!$result) {
         echo "query error";
      }
      else {
         while($row = $result->fetch_assoc()) {
            $num= $row["inst_num"];
            $amount= $row["inst_amount"];
            $landline= $row["require_landline"];
            echo "<div class=\"rate\"> A rate: $amount €/mese per $num mesi</div>";
            if($landline){
               echo "<div>Se hai una linea di casa TIM </div>";
            }
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
            $image = imageAutoExtension("/pictures/products/devices/", $row["id"]);
            $discount_price = $row["discount_price"];
            echo "<div class=\"presentazione\">";
            echo "<div class=\"info left\">";
            echo "<img src=\"$image\" class=\"device-img\">";
            echo "<div> Colore: ";
            printColors($conn, $device_id);
            echo "</div></div>";
            echo "<div class=\"info right\">";
            echo "<div class=\"name\"> $name </div><br>";
            echo "<div class=\"price\"> Unica soluzione: $price € </div>";
            if($discount_price!=null){
               echo "<div class=\"price\" style=\"color:red; text-decoration:underline;\"><b> In promozione a: $discount_price € </b></div>";
            }
            printRate($conn, $device_id);
            echo "<br><p class=\"description\"> $description <br>";
            echo "</p>";
            echo "</div>";
            echo "<div class=\"info buy\"> Acquista </div>";
            echo "</div>";
            echo "<div class=\"caratteristiche\">";
            echo "<div class=\"name\"> $name </div>";
            echo "<div class=\"specifiche\">";
            formatText($tech_specs);
            echo "<br></div>";
            echo "</div>";
            echo "<div id='link'>";
            echo "<a href='/pages/SL-for-device.php?device_id=$device_id'> Servizi Smart Life</a><br>";
            echo "<a href='/pages/assis-for-device.php?device_id=$device_id'> Servizio di assistenza dedicato</a><br>";
            echo "<a href='/pages/promos-for-device.php?device_id=$device_id'> Altre promozioni </a>";
            echo "</div>";
         }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/no-results.html";
      }
   }
   $conn->close();
?>
