<?php
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   $conn = dbconn();
   $conn2 = dbconn();

   $device_id = mysqli_real_escape_string($conn, $_GET["device_id"]);

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

   function idToName($conn, $table, $id) {
      $sql = "SELECT * FROM $table WHERE id = '$id'";
      $result = $conn->query($sql);
      if (!$result) {
         echo "query error";
         return "error";
      }
      else {
         while($r = mysqli_fetch_assoc($result)) {
         return $r["name"];
         }
      }
   }
?>
<div class="gobackbar" onclick="location.href='/pages/device-presentation.php?device_id=<?php echo $device_id; ?>'">
   <div class="arrowback"></div>
   <div class="labelback">Torna al prodotto</div>
</div>
<?php
   $sql = "SELECT tags FROM devices WHERE id='$device_id'";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      while($row = $result->fetch_assoc()) {
         $tags= $row["tags"];
         $tags = explode(";",$tags);
         $sql2 = "SELECT * FROM assistance";
         $result2 = $conn2->query($sql2);
         if (!$result2) {
            echo "query error";
         }
         else {
            $ret = array();
            while($row2 = $result2->fetch_assoc()) {
               $cate = idToName($conn, "category", $row2["category"]);
               $subcate = idToName($conn, "assistance_subcategory", $row2["subcategory"]);
               $subtopic = idToName($conn, "assistance_subtopics", $row2["subtopic"]);

               if (!isset($ret[$cate])) { $ret[$cate] = array(); }
               if (!isset($ret[$cate][$subcate])) { $ret[$cate][$subcate] = array(); }
               if (!isset($ret[$cate][$subcate][$subtopic])) { $ret[$cate][$subcate][$subtopic] = array(); }

               array_push($ret[$cate][$subcate][$subtopic], $row2);

               $tags2= $row2["tags"];
               $id_as= $row2["id"];
               $name = $row2["name"];
               $tags2 = explode(";",$tags2);
               if(findMatch($tags, $tags2)){
                  echo "<div class='assis_item'><a href=\"/pages/assistance-page.php?id=$id_as\">$name</a></div>";
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
