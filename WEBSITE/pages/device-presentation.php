<!DOCTYPE html>
<html>
   <head>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css">
      <link rel="stylesheet" type="text/css" href="/style/device.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
		<script> 
         function mostraP() { 
            if(document.getElementById('presentazione').style.display=='none') { 
               document.getElementById('presentazione').style.display='block';
					document.getElementById('caratteristiche').style.display='none';				
            }else{ 
               document.getElementById('presentazione').style.display='none'; 
            } 
          }
			 function mostraC() { 
            if(document.getElementById('caratteristiche').style.display=='none') { 
               document.getElementById('caratteristiche').style.display='block'; 
					document.getElementById('presentazione').style.display='none'; 
            }else{ 
               document.getElementById('caratteristiche').style.display='none'; 
            } 
          }
      </script>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
			   <div id="side">
				   <a href="#" onClick=mostraP()> Presentazione</a><br>
					<a href="#"onClick=mostraC() > Caratteristiche tecniche</a>
				</div>
            <div id="maincontent">
				<div id="presentazione">
				   <img src="/pictures/products/devices/1.jpg" class="device-img"></img>
				   <span class="name"> Modem adsl wi-fi </span><br>
					<span class="price"> 69 € </span>
					<p class="description"> Il nuovo modem  </p>  
				</div>
				<div id="caratteristiche">
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
