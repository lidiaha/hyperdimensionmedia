
function rankMe() {
   console.log("ranking..");
   $.post(sitename + "/php/page-hitcounter.php", {
      "pageid": assistance_id,
      "pagetype": "assistance"
   }, function(data) {
      console.log(data);
   });
}

function faqEnable() {
   $(".faqitem").each(function() {
      var faqitem = $(this);
      faqitem.find(".faq_question").click(function() {
         faqitem.find(".faq_answer").toggle();
      });
   });
}

$(document).ready(function() {
   if (!(typeof assistance_id === 'undefined')) {  // shows a specific section if required
      rankMe();
   }
});
