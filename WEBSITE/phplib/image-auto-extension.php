<?php
function imageAutoExtension($rel_path, $id_num) {
   $extensions = array("png", "jpg");
   foreach ($extensions as $ext) {
      $candidate = $rel_path . $id_num . "." . $ext;
      if (is_file($_SERVER['DOCUMENT_ROOT'] . $candidate)) {
         return $candidate;
      }
   }
   return $rel_path . $id_num; #TODO: thumbnail "not found"
}
 ?>
