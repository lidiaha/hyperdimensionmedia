<!DOCTYPE html>
<html>
   <head>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/viewport.html"; ?>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <script src="/js/home.js"></script>
      <?php
         include_once $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/page-identify.php";
         pageIdentifyNoTrack("home");
       ?>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
               <div class="banner"><div class="image"><div class="quote">Il futuro pensato Telecom Italia</div></div></div>
					<div class="trending">
					   <div class="top outlet">
						   <div class="pic"></div>
							<div class="name">Prodotti scontati</div>
						</div>
						<div class="top">
						   <div class="pic"></div>
							<div class="name">Internet senza limiti</div>
						</div>
						<div class="top">
						   <div class="pic"></div>
							<div class="name">Netflix</div>
						</div>
						<div class="top">
						   <div class="pic"></div>
							<div class="name">Tim Smart Fibra</div>
						</div>
				   </div> 
					<div class="util">
					</div>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
