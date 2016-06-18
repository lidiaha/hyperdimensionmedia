
var dark_cutoff = 120.0;
var lightcolor = "#7cff70";


$(document).ready(function() {
   var brightness = $(".header").data("brightness");
   if (brightness < dark_cutoff) {
      $(".name").css("color", lightcolor);
      $(".description").css("color", lightcolor);
   }
});
