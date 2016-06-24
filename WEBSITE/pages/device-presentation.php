<!DOCTYPE html>
<html>
   <head>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/viewport.html"; ?>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/device.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <script src="/jslib/includer.js"></script>
      <script>
      <?php
         if (isset($_GET["device_id"])) {
            $dev_id_js = filter_var($_GET["device_id"], FILTER_SANITIZE_STRING);
            echo "var device_id = \"$dev_id_js\";\n";
         }
       ?>
      </script>
      <script src="/js/devicePage.js"></script>
      <?php
         include_once $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/page-identify.php";
         pageIdentifyFromDB($_GET["device_id"],"devices");
       ?>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="side">
               <div class="pre"> Presentazione</div>
               <div class="car"> Caratteristiche tecniche</div>
            </div>
            <div id="maincontent">
               <script>document.write(getBreadcrumbHtmlBar());</script>

            </div>
            <script>getMyData();</script>
         </div>
      <!-- <div id="footer"> -->
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
