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
   $sql = "SELECT * FROM sl_services JOIN device_service WHERE device_id='$device_id' AND sl_services.id=device_service.service_id ";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      while($row = $result->fetch_assoc()) {
         $service_id= $row["id"];
         $name = $row["name"];
         $description = $row["description"];
         $image = imageAutoExtension("/pictures/products/servicesbanners/", $row["id"]);
         echo "<div class='dummyheader'></div>\n";
         echo "<div class='serviceitem'>";
         echo "<div class='header' style='background-image: url(\"$image\")'>\n";
         echo "<div class='name'>$name</div>\n";
         echo "<div class='description'><p>$description</p></div>\n";
         echo "<div class=' info'><a class='more' href='/pages/service-presentation.php?service_id=$service_id'> Scopri </a></div>\n";
         echo "</div></div>\n";
         echo "<div class='doorstopper'></div>\n";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/no-results.html";
      }
   }
   $conn->close();
?>