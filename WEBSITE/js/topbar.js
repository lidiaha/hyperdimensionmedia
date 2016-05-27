function enableopen() {
  $(".hasdropdown").mouseover(function() {
    if (!$(this).find(".lidropdown").data("open"))
      $(this).find(".lidropdown").stop( true, true ).slideDown("slow", function() {
        enableclose();
        $(this).find(".lidropdown").data("open", true);
      });
  });
}
function enableclose() {
  $(".hasdropdown").unbind("mouseover");
  $(".hasdropdown").find(".lidropdown").unbind("mouseout");
  $(".hasdropdown").find(".lidropdown").mouseout(function() {
    $(this).stop( true, true ).slideUp("slow", function() {
      enableopen();
      $(this).find(".lidropdown").data("open", false);
    });
  });
}

$(document).ready(function() {
  enableopen();
});
