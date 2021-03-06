
<?php
set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
include_once "ui-elements/nav-tracking.html";
 ?>
<?php
   function pageIdentify($name) {
      $sitename = "ulTIM8";
      echo "<script>loadHistory();\n" .
         "breadcrumbCurrentPage(\"$name\", location.href)</script>\n";
      echo "<title>$sitename - $name</title>\n";
   }
   function pageIdentifyNoTrack($name) {
      $sitename = "ulTIM8";
      echo "<title>$sitename - $name</title>\n";
   }
   function pageIdentifyReset($name) {
      $sitename = "ulTIM8";
      echo "<script>loadHistory();\n" .
         "resetBreadcrumbs()</script>\n";
      echo "<title>$sitename - $name</title>\n";
   }
   function pageIdentifyFromDB($_idkey, $_table) {
      $sitename = "ulTIM8";
      echo "<title>$sitename</title>\n";
      echo "<script>loadHistory();\n" .
         "breadcrumbCurrentPageFromDbQuery(getParams().$_idkey, \"$_table\", location.href);</script>\n";
   }
 ?>
