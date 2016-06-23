

function showSection(sectionclass, buttonclass) {
   $(sectionclass).show();
   $(buttonclass).css("background-color","grey");
}

function hideSection(sectionclass, buttonclass) {
   $(sectionclass).hide();
   $(buttonclass).css("background-color","white");
}

function switchPanel(ident) {
   if (ident == "progetti") {
      showSection(".progetti", ".pro");
      hideSection(".testimonial", ".test");
      hideSection(".innovation", ".inn");
   } else if (ident == "testimonial") {
      hideSection(".progetti", ".pro");
      showSection(".testimonial", ".test");
      hideSection(".innovation", ".inn");
   } else if (ident == "innovation") {
      hideSection(".progetti", ".pro");
      hideSection(".testimonial", ".test");
      showSection(".innovation", ".inn");
   }
}

$(document).ready(function() {
   // setup click events
   $(".pro").click(function() {
      switchPanel("progetti");
   });
   $(".test").click(function() {
      switchPanel("testimonial");
   });
   $(".inn").click(function() {
      switchPanel("innovation");
   });
   if (!(typeof section === 'undefined')) {  // shows a specific section if required
      switchPanel(section);
   }
});
