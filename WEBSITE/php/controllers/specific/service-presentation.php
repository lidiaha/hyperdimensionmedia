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
				$name= basename($link, ".html").PHP_EOL;
            echo "<a href='$link'><div class='link'>$name</div></a>";
         }
         echo "</div>";
      }
   }
	
	function getResults($conn, $service_id, $table) {
		$sql = "SELECT * FROM $table WHERE service_id='$service_id' ";
      $result = $conn->query($sql);
      if (!$result) {
         echo "query error";
      }
      else {
         if(mysqli_num_rows($result) != 0){
				return true;
         }
      }
      return false;
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
			if(getResults($conn, $service_id, 'device_service')){
			   echo "<div class='products scopri'><a href='/pages/devices-for-service.php?service_id=$service_id'> Scopri i prodotti</a></div>\n";
			}
			else{
			   echo "<div class='products scopri'><a> Nessun prodotto</a></div>";
			}
			if(getResults($conn, $service_id, 'service_promo')){
			   echo "<div class='offers scopri'><a href='/pages/promos-for-service.php?service_id=$service_id'> Scopri le offerte</a></div>\n";
			}
			else{
            echo "<div class='offers scopri'><a> Nessuna offerta</a></div>";
			}
         echo "<div class='doorstopper'></div>\n";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include "ui-elements/no-results.html";
      }
   }
   $conn->close();
?>
