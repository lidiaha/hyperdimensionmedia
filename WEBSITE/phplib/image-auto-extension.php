<?php

$docroot = str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME']);

function imageAutoExtension($rel_path, $id_num) {
   global $docroot;
   $extensions = array("png", "jpg");
   foreach ($extensions as $ext) {
      $candidate = $rel_path . $id_num . "." . $ext;
      if (is_file($docroot . $candidate)) {
         return $candidate;
      }
   }
   return $rel_path . $id_num; #TODO: thumbnail "not found"
}
 ?>
