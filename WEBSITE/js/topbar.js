// this function is tricky: when the mouse hovers, it does not only try to
// start the opening, but also aborts the closing of the dropdown, if the mouse
// landed on a "safe area"
function enableopen() {
  $(".ddstay").mouseover(function() {
    if (!$(this).find(".lidropdown").data("open") && !$(this).data("open")) {
      $(this).find(".lidropdown").stop( true, true ).slideDown("slow", function() {
        $(this).data("open", true);
      });
    }
    else if ($(this).data("open")) {
      $(this).stop( true, true );
      $(this).show();
    }
    else {
      $(this).find(".lidropdown").stop( true, true );
      $(this).find(".lidropdown").show();
    }
  });
}
// this function is easy, it simply attaches the event handler (close on mouseout)
function enableclose() {
  $(".ddstay").mouseout(function() {
      $(this).find(".lidropdown").stop( true, true ).slideUp("slow", function() {
        $(this).data("open", false);
      });
    });
}

$(document).ready(function() {
  enableopen();
  enableclose();
});
