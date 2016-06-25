
var dark_cutoff = 170.0;
var lightcolor = "#FFDEAD";


function afterDataLoaded() {
   var brightness = $(".header").data("brightness");
   if (brightness < dark_cutoff) {
      $(".name").css("color", lightcolor);
		$(".name").css("text-shadow","-1px -1px black,-1px 1px black,1px -1px black,1px 1px black");
		$(".description").css("background-color", "rgba(255, 128, 114, 0.8)");
	}
}
