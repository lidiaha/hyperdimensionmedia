<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/device.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
		<script>
         $(document).ready(function() {
            $(".pre").click(function() {
               $(this).parents().find(".presentazione").show();
					$(this).parent().find(".pre").css("background-color","white");
					$(this).parent().find(".pre").css("border-right","0px");
					$(this).parents().find(".caratteristiche").hide();
					$(this).parent().find(".car").css("background-color","grey");
					$(this).parent().find(".car").css("border-right","1px black solid");
            });
				$(".car").click(function() {
				   $(this).parents().find(".caratteristiche").show();
					$(this).parent().find(".car").css("background-color","white");
					$(this).parent().find(".car").css("border-right","0px");
               $(this).parents().find(".presentazione").hide();
					$(this).parent().find(".pre").css("background-color","grey");
					$(this).parent().find(".pre").css("border-right","1px black solid");
            });
         });
      </script>
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
				<div class="presentazione">
				   <img src="/pictures/products/devices/1.jpg" class="device-img"></img>
				   <span class="name"> Modem adsl wi-fi </span><br>
					<span class="price"> 69 € </span>
					<p class="description"> Il nuovo modem  </p>  
				</div>
				<div class="caratteristiche">
				   <span class="specifiche"> Tutto quello che vuoi </span>
				</div>
				<div id="link">
				   <a href="#"> Servizi Smart Life</a><br>
					<a href="#"> Servizio di assistenza dedicato</a>
				</div>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
