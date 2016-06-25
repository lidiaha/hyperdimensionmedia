<?php
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
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
         $image = imageAutoExtension("/pictures/products/devices/", $row["id"]);
         echo "<div class='dummyheader'></div>\n";
         echo "<div class='item'>";
         echo "<div class='pic' style='background-image: url(\"$image\")'></div>\n";
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