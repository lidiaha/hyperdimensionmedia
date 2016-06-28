<!DOCTYPE html>
<?php
set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().":".str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
 ?>
<html>
   <head>
      <meta charset="UTF-8">
      <?php include "ui-elements/viewport.html"; ?>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/assistances.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/assistances.css" media="screen and (max-width: 480px)">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <script src="/jslib/includer.js"></script>
      <script src="/js/toggle.js"></script>
      <?php
         include_once "ui-elements/page-identify.php";
         pageIdentify("all assistance services");
       ?>
      <script>
         var is_monocategory = false;
      </script>
      <script src="/js/assistances.js"></script>
   </head>
   <body>
      <div id="supercontainer">
         <?php include "ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
      <?php $filter_flavor = "assistance"; ?>
      <?php include "ui-elements/filter2.php"; ?>
      <?php include "ui-elements/social-icons.html"; ?>
   </body>
</html>
