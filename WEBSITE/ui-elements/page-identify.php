<?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/nav-tracking.html"; ?>
<?php
   function pageIdentify($name) {
      $sitename = "ulTIM8";
      echo "<script>loadHistory();\n" .
         "breadcrumbCurrentPage(\"$name\", location.href)</script>\n";
      echo "<title>$sitename - $name</title>\n";
   }
 ?>
