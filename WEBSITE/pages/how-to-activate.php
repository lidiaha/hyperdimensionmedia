<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/howtoactivate.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <?php
         include_once $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/page-identify.php";
         pageIdentify("how to activate");
       ?>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
               <script>document.write(getBreadcrumbHtmlBar());</script>
               <div class='dummyheader'></div>
               <div class='title'>Come attivare una promozione</div>
               <div class='how'> Direttamente online <div class="pic" div style='background-image: url("/pictures/online.png")'></div></div>
               <div class='how'> Trova un negozio <div class="pic" style='background-image: url("/pictures/maps.png")'></div></div>
               <div class='how'> Contatta un esperto<div class="pic" style='background-image: url("/pictures/expert.png")'></div></div>
               <div class='doorstopper'></div>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
