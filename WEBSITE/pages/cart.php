<!DOCTYPE html>
<html>
   <head>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/viewport.html"; ?>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
		<link rel="stylesheet" type="text/css" href="/style/chart.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
				   <div class='dummyheader'></div>
               <div class="progress">
					   <div class="step one">
						   <div class="label">STEP 1</div>
							<div class="circle"></div>
							<div class="name">verifica il tuo ordine</div>
						</div>
						<div class="bar"></div>
						<div class="step two">
						   <div class="label">STEP 2</div>
							<div class="circle"></div>
							<div class="name">inserisci i tuoi dati</div>
						</div>
						<div class="step three">
						   <div class="label">STEP 3</div>
							<div class="circle"></div>
							<div class="name">conferma acquisto</div>
					   </div>
					</div>
					<div class="items"></div>
					<div class="goto"></div>
					<div class="doorstopper"></div>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
