<!DOCTYPE html>
<html>
   <head>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/viewport.html"; ?>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/homepage.css" media="screen and (min-width: 480px)">
		<link rel="stylesheet" type="text/css" href="/style/mobile/homepage.css" media="screen and (max-width: 480px)">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <script src="/js/home.js"></script>
      <?php
         include_once $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/page-identify.php";
         pageIdentifyReset("home");
       ?>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
               <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/ElasticSlideshow/index2.html"; ?>
               <div class="trending">
                  <div class="top outlet"><a href = "/pages/devices-outlet.php">
                     <div class="pic" style="background-image: url(/pictures/sconti.jpg)">
                        <div class="name">Prodotti scontati</div>
                     </div>
                  </a></div>
                  <div class="top">
                     <div class="pic" style="background-image: url(/pictures/top2.jpg)">
                        <div class="name">Internet senza limiti</div>
                     </div>
                  </div>
                  <div class="top">
                     <div class="pic" style="background-image: url(/pictures/top3.jpg)">
                        <div class="name">Netflix</div>
                     </div>
                  </div>
                  <div class="top">
                     <div class="pic" style="background-image: url(/pictures/top4.jpg)">
                        <div class="name">Tim Smart Fibra</div>
                     </div>
                  </div>
               </div>
               <div class="util">
					   <div class="link" style="background-image:url(/pictures/icons/home/icon1.png)">
						   Ricarica veloce
						</div>
						<div class="link" style="background-image:url(/pictures/icons/home/icon2.png)">
						   Guida all'acquisto
						</div>
						<div class="link" style="background-image:url(/pictures/icons/home/icon3.png)">
						   Trova negozio
						</div>
						<div class="link" style="background-image:url(/pictures/icons/home/icon4.png)">
						   Richiedi un esperto
						</div>
						<div class="link" style="background-image:url(/pictures/icons/home/icon5.png)">
						   My Tim
						</div>
						<div class="link" style="background-image:url(/pictures/icons/home/icon6.png)">
						   Per i consumatori
						</div>
               </div>
               <div class='doorstopper'></div>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
