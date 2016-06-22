

$(document).ready(function() {
   $(".faqitem").each(function() {
      var faqitem = $(this);
      faqitem.find(".faq_question").click(function() {
         faqitem.find(".faq_answer").toggle();
      });
   });
});
