
function setupButtons() {
   $(".pre").click(function() {
      $(this).parents().find(".presentazione").show();
      $(this).css("background-color","white");
      $(this).css("border-right","0px");
      $(this).parents().find(".caratteristiche").hide();
      $(this).parent().find(".car").css("background-color","grey");
      $(this).parent().find(".car").css("border-right","1px black solid");
   });
   $(".car").click(function() {
      $(this).parents().find(".caratteristiche").show();
      $(this).css("background-color","white");
      $(this).css("border-right","0px");
      $(this).parents().find(".presentazione").hide();
      $(this).parent().find(".pre").css("background-color","grey");
      $(this).parent().find(".pre").css("border-right","1px black solid");
   });
}

function rankMe() {
   console.log("ranking..");
   $.post("/php/page-hitcounter.php", {
      "pageid": device_id,
      "pagetype": "devices"
   }, function(data) {
      console.log(data);
   });
}

$(document).ready(function() {
   setupButtons();
   if (!(typeof device_id === 'undefined')) {  // shows a specific section if required
      rankMe();
   }
});
