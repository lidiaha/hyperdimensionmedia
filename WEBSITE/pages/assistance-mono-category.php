<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/assistances.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <?php
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/page-identify.php";
         pageIdentify("single assistance category");
       ?>
      <script>
      <?php
         echo "var category_id = " . $_GET["category"] . ";\n";
         echo "var is_monocategory = true;\n";
         //TODO: redirect to devices.php if $_GET["category"] is not set
      ?>
      </script>
      <script src="/js/assistances.js"></script>
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
      <?php $filter_flavor = "assistance"; ?>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/filter2.php"; ?>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
