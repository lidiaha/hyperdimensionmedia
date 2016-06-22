<!DOCTYPE html>
<html>
   <head>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/viewport.html"; ?>
      <title>ulTIM8</title>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/thegroup.css">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <script>
         $(document).ready(function() {
            $(".pro").click(function() {
               $(this).parents().find(".progetti").show();
               $(this).parent().find(".pro").css("background-color","grey");
               $(this).parents().find(".testimonial").hide();
               $(this).parent().find(".test").css("background-color","white");
               $(this).parents().find(".innovation").hide();
               $(this).parent().find(".inn").css("background-color","white");
            });
            $(".test").click(function() {
               $(this).parents().find(".testimonial").show();
               $(this).parent().find(".test").css("background-color","grey");
               $(this).parents().find(".progetti").hide();
               $(this).parent().find(".pro").css("background-color","white");
               $(this).parents().find(".innovation").hide();
               $(this).parent().find(".inn").css("background-color","white");
            });
            $(".inn").click(function() {
               $(this).parents().find(".innovation").show();
               $(this).parent().find(".inn").css("background-color","grey");
               $(this).parents().find(".progetti").hide();
               $(this).parent().find(".pro").css("background-color","white");
               $(this).parents().find(".testimonial").hide();
               $(this).parent().find(".test").css("background-color","white");
            });
         });
      </script>
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
                     <div class='pic'></div>
                  </div>
                  <div class='discover'>
                     <div class='title'>Siamo leader responsabili</div>
                     <div class='pic'></div>
                  </div>
               </div>
               <div class='testimonial'>
                  <div class='quote'> <div class='text'>Tim Berners-Lee <br>"Quando si osserva il web è come se si osservasse l'intera umanità."
                  </div></div>
               </div>
               <div class='progetti'> TODO</div>
               <div class="doorstopper"></div>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
