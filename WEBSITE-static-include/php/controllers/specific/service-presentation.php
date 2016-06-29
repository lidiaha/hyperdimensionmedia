<?php
   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
   include_once "phplib/database.php";
   include_once "phplib/image-auto-extension.php";
   include_once "phplib/image-mean-color.php";
   header('Access-Control-Allow-Origin: *');
   $conn = dbconn();

   $service_id = mysqli_real_escape_string($conn, $_GET["service_id"]);

   function printUrls($url) {
      if($url!=null){
         $links = explode(";",$url);
         echo "<div class='links'>";
         foreach($links as $link){
            echo "<a href='$link'><div class='link'></div></a>";
         }
         echo "</div>";
      }
   }
   $sql = "SELECT * FROM sl_services WHERE id='$service_id' ";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      while($row = $result->fetch_assoc()) {
         $name = $row["name"];
         $description = $row["description"];
         $urls = $row["url"];
         $image = imageAutoExtension("/pictures/products/servicesbanners/", $row["id"]);
         $meanimg = imageMeanColor($image);
         $meancolor = $meanimg["color"];
         $imgbrightness = $meanimg["brightness"];
         echo "<div class='dummyheader'></div>\n";
         echo "<div data-meancolor=\"$meancolor\" data-brightness=\"$imgbrightness\" class='header' style='background-image: url(\"$image\")'>\n";
         echo "<div class='name'>$name</div>\n";
         echo "<div class='description'><p>$description</p></div>\n";
         echo "</div>";
         printUrls($urls);
         echo "<div class='products scopri'><a href='file:///android_asset/www/pages/devices-for-service.html?service_id=$service_id'> Scopri i prodotti</a></div>\n";
         echo "<div class='offers scopri'><a href='file:///android_asset/www/pages/promos-for-service.html?service_id=$service_id'> Scopri le offerte</a></div>\n";
         echo "<div class='doorstopper'></div>\n";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include "ui-elements/no-results.html";
      }
   }
   $conn->close();
?>
