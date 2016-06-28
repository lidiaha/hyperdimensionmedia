<?php
   set_include_path(get_include_path().":".str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME']));
   include_once "phplib/database.php";
   include_once "phplib/image-auto-extension.php";
   $conn = dbconn();
   $conn2 = dbconn();

   $assistance_id = mysqli_real_escape_string($conn, $_GET["assistance_id"]);

   function findMatch($tags, $tags2) {
      if($tags!=null){
         foreach($tags as $tag){
            foreach($tags2 as $tag2){
               if($tag==$tag2){
                  return true;
               }
            }
         }
         return false;
      }
   }

?>
<div class="gobackbar" onclick="location.href='/pages/assistance-page.php?id=<?php echo $assistance_id; ?>'">
   <div class="arrowback"></div>
   <div class="labelback">Torna al servizio di assistenza</div>
</div>
<?php
   $sql = "SELECT tags FROM assistance WHERE id='$assistance_id'";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      while($row = $result->fetch_assoc()) {
         $tags= $row["tags"];
         $tags = explode(";",$tags);
         $sql2 = "SELECT * FROM devices";
         $result2 = $conn2->query($sql2);
         if (!$result2) {
            echo "query error";
         }
         else {
            $ret = array();
            echo "<div class='dummyheader'></div>\n";
            while($row2 = $result2->fetch_assoc()) {
               $tags2= $row2["tags"];
               $device_id= $row2["id"];
               $image = imageAutoExtension("/pictures/products/devices/", $row2["id"]);
               $name = $row2["name"];
               $tags2 = explode(";",$tags2);
               if(findMatch($tags, $tags2)){
                  echo "<div class='item'>";
                  echo "<div class='pic' style='background-image: url(\"$image\")'></div>\n";
                  echo "<div class='name'><a href='/pages/device-presentation.php?device_id=$device_id' >$name</a></div>\n";
                  echo "</div>\n";
               }
            }
         }
         echo "<div class='doorstopper'></div>\n";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/no-results.html";
      }
   }
   $conn->close();
?>
