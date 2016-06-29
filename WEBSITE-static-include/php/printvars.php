<?php
   echo set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().":".str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME']))) . " <br>\n";
   echo str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().":".str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])) . " <br>\n";
   echo $_SERVER["DOCUMENT_ROOT"] . " <br>\n";
 ?>
