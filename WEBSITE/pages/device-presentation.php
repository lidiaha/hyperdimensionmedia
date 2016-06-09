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
				   <div class="info left"> 
					   <img src="/pictures/products/devices/1.jpg" class="device-img">
						<div> Colore: <div class="color"></div></div>
					</div>
					<div class="info right">
				      <div class="name"> Modem adsl wi-fi </div><br>
					   <div class="price"> 69 € </div>
					   <p class="description">Navigazione veloce e senza fili<br>
                     Con il Modem ADSL Wi-Fi navighi ad alta velocità e senza fili, utilizzando l'interfaccia Wi-Fi o attraverso le 4 porte Ethernet.<br>
                     Navigazione più veloce grazie alla tecnologia senza fili Wi-Fi.
                     Protezione: la cifratura WPA e WPA2 impedisce l’accesso ai non autorizzati alla rete Wi-Fi. 
                     Tutta la famiglia connessa: collega tutti i PC, smartphone e tablet al nuovo modem ADSL Wi-Fi e inoltre condividi Hard Disk e stampanti collegati alla porta USB del modem.
                     Installazione no problem: il modem si configura automaticamente sulla tua linea ADSL, senza installare software.</p> 
               </div>
               <div class="info buy"> Acquista </div>					
				</div>
				<div class="caratteristiche">
				   <div class="name"> Modem adsl wi-fi </div>
				   <div class="specifiche"> <p>Tecnologia: ADSL/ADSL2+; velocità fino a 20 Mbps down/1 Mbps up</p><br>
                  <p>Wi-Fi: 802.11 b/g/n; velocità di trasferimento fino a 300Mbps</p><br>
                  <p>Interfacce:<br>
                  Interfacce USB alta velocità (480 Mbit/s) ad alta potenza (500 mA), 1 porta connettore tipo A Interfaccia Wi-FiStandard IEEE 802.11nInterfaccia radio 2.4Ghz, 2 antenne, velocità di trasmissione teorica 300 Mbps</p><br>
 
                  <p>Protezione Wireless: WPA, WPA-PSK, WEP - Supporto Wi-Fi Protected Setup - Controllo di accesso</p><br>
                  <p>Funzioni avanzate:<br>
                  Funzionalità di routing avanzate (DHCP server, NAT, NAPT, Virtual Server) - Firewall - Condivisione Hard Disk e Stampante USB</p><br>
                  <p>Assistenza tecnica: 2 anni di garanzia sul prodotto</p>
               </div>
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
