// this function is tricky: when the mouse hovers, it does not only try to
// start the opening, but also aborts the closing of the dropdown, if the mouse
// landed on a "safe area"
function enableopen() {
   $(".ddstay").mouseover(function() {
      if (!$(this).find(".lidropdown").data("open") && !$(this).data("open")) {
         $(this).find(".lidropdown").stop( true, true ).show("fast", function() {
            $(this).data("open", true);
         });
      }
      else if ($(this).data("open")) {
         $(this).stop( true, true );
         $(this).show();
      }
      else {
         $(this).find(".lidropdown").stop( true, true );
         $(this).find(".lidropdown").show();
      }
   });
}
// this function is easy, it simply attaches the event handler (close on mouseout)
function enableclose() {
   $(".ddstay").mouseout(function() {
      $(this).find(".lidropdown").stop( true, true ).hide("fast", function() {
      $(this).data("open", false);
      });
   });
}

function enableToggle() {
   $("#landmarktoggle").click(function () {
      var attropen = $("#landmarktoggle").attr("data-open");
      var open = (attropen == "true");
      if (!open) {
         $(".liparent:not(#landmarktoggle)").show();
         $(".listandalone:not(#landmarktoggle)").show();
         $(".lidropdown:not(#landmarktoggle)").show();
         $("#landmarktoggle").html("Nascondi Menu di navigazione");
         $("#landmarktoggle").attr("data-open", "true");
      } else {
         $(".lidropdown:not(#landmarktoggle)").hide();
         $(".listandalone:not(#landmarktoggle)").hide();
         $(".liparent:not(#landmarktoggle)").hide();
         $("#landmarktoggle").html("Mostra Menu di navigazione");
         $("#landmarktoggle").attr("data-open", "false");
      }

   });
}

$(document).ready(function() {
   if (parseInt($(window).width()) > 480) {
      enableopen();
      enableclose();
   } else {
      enableToggle();
   }
});
