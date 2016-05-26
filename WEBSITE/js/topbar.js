$(document).ready(function() {
  $(".hasdropdown").mouseover(function() {
    $(this).find(".lidropdown").stop( true, true ).slideDown("slow");
  });
  $(".hasdropdown").mouseout(function() {
    console.log("funge");
    $(this).find(".lidropdown").stop( true, true ).slideUp("slow");
  });
});
