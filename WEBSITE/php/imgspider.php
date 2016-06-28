<?php

set_include_path(get_include_path().":".str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME']));

include "phplib/simple_html_dom.php";
include "phplib/database.php";

$docroot = str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME']);

function downloadPic($ass_id, $img_id, $img_url) {
   global $docroot
   $storage = $docroot . "/pictures/assistance/";

   $folder = $storage . $ass_id . "/";
   if (!is_dir($folder)) {
      mkdir($folder);
   }

   $imgdata = file_get_contents($img_url);
   $info = getimagesizefromstring($imgdata);
   $extension = image_type_to_extension($info[2]);

   $savename = $folder . $img_id . $extension;
   $savefile = fopen($savename, "w") or die("Unable to open file!");
   fwrite($savefile, $imgdata);
   fclose($savefile);

   return "/pictures/assistance/" . $ass_id . "/" . $img_id . $extension;
}

function updateDb($conn, $_newdesc, $id) {
   $newdesc = mysqli_real_escape_string($conn, $_newdesc);
   $sql = "UPDATE assistance SET description = '$newdesc' WHERE id = '$id'";
   $result = $conn->query($sql);
   if (!$result) {
      echo "  query error <br>\n";
   }
   else {
      echo "  done updating db <br>\n";
   }
}

$conn = dbconn();
$sql = "SELECT * FROM assistance";
$result = $conn->query($sql);
if (!$result) {
   echo "query error";
}
else {
   while($row = $result->fetch_assoc()) {
      $description = $row["description"];
      $ass_id = $row["id"];
      $name = $row["name"];
      $html = str_get_html($description);
      $img_count = 0;
      echo "checking $name <br>\n";
      foreach($html->find('img') as $inline_image) {
         $src = $inline_image->src;
         if ($src[0] != "/") {
            echo "  non-local image: $src <br>\n";
            $localname = downloadPic($ass_id, $img_count, $src);
            echo "  saved as: $localname <br>\n";
            $inline_image->src = $localname;
            updateDb($conn, $html, $ass_id);
            $img_count++;
         } else {
            echo "  nothing to change. <br>\n";
         }
      }
   }
}

 ?>
