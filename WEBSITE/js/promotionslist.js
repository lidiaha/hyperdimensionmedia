
var priceFilter = [];
var durationFilter = [];


function sameInterval(a, b) {
   /* check if two intervals are the same */
   if (a.hasOwnProperty("low") && !b.hasOwnProperty("low")) return false;
   if (a.hasOwnProperty("high") && !b.hasOwnProperty("high")) return false;
   if (!a.hasOwnProperty("low") && b.hasOwnProperty("low")) return false;
   if (!a.hasOwnProperty("high") && b.hasOwnProperty("high")) return false;
   if (a.hasOwnProperty("low") && (a["low"] != b["low"])) return false;
   if (a.hasOwnProperty("high") && (a["high"] != b["high"])) return false;
   return true;
}

function getIntervalObject(elem) {
   /* get a javascript object representing the interval range inside an <input name='price'> */
   var low = elem.data("low");
   var high = elem.data("high");
   if (low && high) {
      return {"low": low, "high": high};
   } else if (low) {
      return {"low": low};
   } else if (high) {
      return {"high": high};
   }
   return {};
}

// interface with filter.js
function applyFilter(elem) {
   if (elem.attr("name") == "price") {
      priceFilter.push(getIntervalObject(elem));
   } else if (elem.attr("name") == "duration") {
      durationFilter.push(getIntervalObject(elem));
   }
   reloadContent();
}

function simpleArrayRemove(elem, arr) {
   /* boilerplate code */
   index = arr.indexOf(elem.val());
   if (index > -1) {
      arr.splice(index, 1);
      reloadContent();
      return true;
   }
   return false;
}

function removeFilter(elem) {
   if (elem.attr("name") == "price") {
      data = getIntervalObject(elem);
      for (var i=0; i<priceFilter.length; i++) {
         if (sameInterval(data, priceFilter[i])) {
            priceFilter.splice(i, 1);
            reloadContent();
            return;
         }
      }
   } else if (elem.attr("name") == "duration") {
      data = getIntervalObject(elem);
      for (var i=0; i<durationFilter.length; i++) {
         if (sameInterval(data, durationFilter[i])) {
            durationFilter.splice(i, 1);
            reloadContent();
            return;
         }
      }
   }
}

function clearContent() {
   $("#maincontent").html("");
}

function processPromotion(obj) {
   $("#maincontent").append("<div class='promotionitem'>" +
   "<div class='promopic' style=\"background: url('" + obj.image + "') no-repeat; background-size: contain; background-position: center top;\"></div>" +
   "<div class='name'>" + obj.name + "</div>" +
   "<div class='subtitle'>" +obj.subtitle + "</div>" +
   "<div class='promoprice'> da " + obj.price + "€/mese</div>" +
   "<div class='scopri'><a class='more' href='/pages/promotion-description.php?promo_id=" + obj.id + "'> Scopri </a></div>" +
   "</div>");
}

function fitTileSize() {
   $(".name").each(function() {
      var textheight = parseFloat($(this).find("a").css("height"));
      var divheight = parseFloat($(this).css("height"));
      var fontsize = parseFloat($(this).css("font-size"));
      if (textheight > divheight) {
         $(this).css("font-size", (fontsize/1.5) + "px");
      }
   });
}

function postProcessPromotions() {
   $("#maincontent").append("<div class=\"doorstopper\"></div>");
   fitTileSize();
}

function emptyResultHandler() {
   $.get(sitename + "/ui-elements/no-results.html", function(data) {
      $("#maincontent").append(data);
   });
}

function fetchAllPomotions() {
   $.post(sitename + "/php/controllers/get-promotions.php", {
      "preview": true,
      "price_range": JSON.stringify(priceFilter),
      "duration_range": JSON.stringify(durationFilter)
   }, function(data) {
      if (isApp()) {
         data = localizeData(data);
      }
      var newmessages = JSON.parse(data);
      clearContent();
      if (newmessages.length == 0) {
         emptyResultHandler();
      }
      newmessages.forEach(processPromotion);
      postProcessPromotions();
   });
}

function reloadContent() {
   fetchAllPomotions();
}

$(document).ready(function() {
   reloadContent();
});
