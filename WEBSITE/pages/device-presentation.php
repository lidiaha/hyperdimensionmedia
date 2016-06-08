<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
			   <div id="side">
				   <a href="#presentazione"> Presentazione</a><br>
					<a href="#caratteristiche"> Caratteristiche tecniche</a>
				</div>
            <div id="maincontent">
				<div id="presentazione" class="item">
				   <span class="name"> Modem adsl wi-fi </span><br>
					<span class="price"> 69 € </span>
				</div>
				<div id="caratteristiche" class="item">
				   <span class="descrizione"> Tutto quello che vuoi </span>
				
				</div>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
