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
      $(this).parent().find(".test").css("background-color","grey")
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