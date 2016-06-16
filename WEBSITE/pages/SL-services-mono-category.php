<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/SL.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <script>
         <?php
            echo "var category_id = " . $_GET["category"] . ";\n";
          ?>
         var is_monocategory = true;
      </script>
      <script src="/js/SL.js"></script>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>