if (parseInt($(window).width()) <= 480) {
   $(document).ready(function() {
	   $(document).on("click", ".assis_category_label", function() {
      $(this).parent().find(".assis_subcategory").toggle();
	   });
	   $(document).on("click", ".assis_subcategory_label", function() {
      $(this).parent().find(".assis_subtopic").toggle();
	   });
	   $(document).on("click", ".assis_subtopic_label", function() {
      $(this).parent().find(".assis_item").toggle();
	   });
   });
}   