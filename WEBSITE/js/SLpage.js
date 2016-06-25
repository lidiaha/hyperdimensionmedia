
var dark_cutoff = 170.0;
var lightcolor = "#FFDEAD";


function afterDataLoaded() {
   var brightness = $(".header").data("brightness");
   if (brightness < dark_cutoff) {
      $(".name").css("color", lightcolor);
		$(".name").css("text-shadow", "2px 1px #191970");
		$(".description").css("color", lightcolor);
		$(".description").css("text-shadow", "-1px -1px 0 #191970,1px -1px 0 #191970,-1px 1px 0 #191970,1px 1px 0 #191970");
   }
}
