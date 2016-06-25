<!DOCTYPE html>
<!--
   interface:
      get parameters:
         section = "progetti", "testimonial", "innovation": section to show open
         after loading
-->
<html>
   <head>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/viewport.html";?>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/whoweare.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
		<script src="/jslib/includer.js"></script>
      <script>
      <?php
         if (isset($_GET["section"])) {
            $section = filter_var($_GET["section"], FILTER_SANITIZE_STRING);
            echo "var section = \"$section\";\n";
         }
       ?>
      </script>
      <script src="/js/whoweare.js"></script>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
               <div class='dummyheader'></div>
               <div class='menu'>
                  <div class='item pro'>Progetti</div>
                  <div class='item test'>Testimonial</div>
                  <div class='item inn'>Innovazione</div>
               </div>
               <div class='innovation'>
                  <div class='bar'>
                     <div class='subtitle'>Protagonista del cambiamento</div>
                  </div>
                  <div class='description'>Il futuro è un orizzonte che si sposta giorno dopo giorno.
                     La tecnologia permette alle persone di esprimersi e di cogliere le infinite opportunità di un presente in costante cambiamento.
                     La TIM di oggi è protagonista di questo cambiamento, perché porta in sé la solidità tecnologica di Telecom Italia e la visione dinamica e innovatrice che hanno da sempre caratterizzato TIM.
                     Perché è rivolta a chi nella tecnologia non vede solo uno scambio di dati, ma una condivisione di esperienze, pensieri ed emozioni.
                     Qualcosa che ci rende tutti più aperti, generosi, ispirati, umani.
                  </div>
                  <div class='discover'>
                     <div class='title'>Siamo leader responsabili</div>
                     <div class='pic' style='background-image: url("/pictures/innovation1.jpg")' ></div>
							<div class='more'>Essere leader significa possedere una visione che vada oltre gli orizzonti della conoscenza, dare il buon esempio, 
							   essere modelli di riferimento. Crediamo nella cultura dell’inclusione, considerando il confronto un’opportunità e ci impegniamo a 
							   incoraggiare il dialogo. 
							</div>
                  </div>
                  <div class='discover'>
                     <div class='title'>Desideriamo crescere</div>
                     <div class='pic'style='background-image: url("/pictures/innovation2.jpg")'></div>
							<div class='more'>Mantenere sempre viva la passione, alimentando la propria curiosità con la ferma volontà di migliorarsi è tra i
							   nostri impegni primari: restiamo aperti al mondo e protesi verso il futuro. 
							</div>
                  </div>
						<div class='discover'>
                     <div class='title'>Puntiamo all’eccellenza</div>
                     <div class='pic'style='background-image: url("/pictures/innovation3.jpg")' ></div>
							<div class='more'>Impegno e dedizione sono elementi imprescindibili per sviluppare progetti di assoluta qualità, realizzati 
							   con uno sguardo costante all’innovazione e alle esigenze dei nostri clienti.
                     </div>								
                  </div><div class='discover'>
                     <div class='title'>Viviamo il cliente</div>
                     <div class='pic' style='background-image: url("/pictures/innovation4.jpg")'></div>
							<div class='more'>Lavoriamo per far comunicare le persone, rendendo la loro vita più semplice, ricca di opportunità e relazioni.
 							   Tutto questo attraverso un cammino di cura, sviluppo e arricchimento reciproco che incontri i bisogni, le aspirazioni ed i sogni dei nostri clienti. 
				         </div>
                  </div>
               </div>
               <div class='testimonial'>
                  <div class='quote one'>				
						   <div class='text'><b>Tim Berners-Lee</b><br>"Quando si osserva il web è come se si osservasse l'intera umanità."</div>
						</div>
						<div class='quote two'> 
						   <div class='text'><b>Fabio Fazio</b><br>"Si può essere dovunque con un click,andare dappertutto."</div>
						</div>
               </div>
               <div class='progetti'> 
               </div>
               <div class="doorstopper"></div>
            </div>
				<script>getMyDataIn($(".progetti"));</script>
         </div>
      <!-- <div id="footer"> -->
      </div>
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
