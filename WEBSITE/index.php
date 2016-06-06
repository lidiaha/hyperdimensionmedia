<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="style/home.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="jslib/parallax.min.js"></script>
      <script src="js/home.js"></script>
   </head>
   <body>
      <div id="supercontainer">
         <?php include "ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
            <?php include "ui-elements/category.php"; ?>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
      <?php include "ui-elements/social-icons.html"; ?>
   </body>
</html>
