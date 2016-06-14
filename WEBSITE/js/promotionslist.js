
/*
function sameInterval(a, b) {
   /* check if two intervals are the same 
   if (a.hasOwnProperty("low") && !b.hasOwnProperty("low")) return false;
   if (a.hasOwnProperty("high") && !b.hasOwnProperty("high")) return false;
   if (!a.hasOwnProperty("low") && b.hasOwnProperty("low")) return false;
   if (!a.hasOwnProperty("high") && b.hasOwnProperty("high")) return false;
   if (a.hasOwnProperty("low") && (a["low"] != b["low"])) return false;
   if (a.hasOwnProperty("high") && (a["high"] != b["high"])) return false;
   return true;
}

function getPriceObject(elem) {
   /* get a javascript object representing the price range inside an <input name='price'> 
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
      priceFilter.push(getPriceObject(elem));
   } else if (elem.attr("name") == "brand") {
      brandFilter.push(elem.val());
   } else if (elem.attr("name") == "os") {
      osFilter.push(elem.val());
   } else if (elem.attr("name") == "connect") {
      connectFilter.push(elem.val());
   } else if (elem.attr("name") == "category") {
      categoryFilter.push(elem.val());
   } else if (elem.attr("name") == "acquisto") {
      purchaseFilter.push(elem.val());
   }
   reloadContent();
}

function simpleArrayRemove(elem, arr) {
   /* boilerplate code 
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
      data = getPriceObject(elem);
      for (var i=0; i<priceFilter.length; i++) {
         if (sameInterval(data, priceFilter[i])) {
            priceFilter.splice(i, 1);
            reloadContent();
            return;
         }
      }
   } else if (elem.attr("name") == "brand") {
      if (simpleArrayRemove(elem, brandFilter)) return;
   } else if (elem.attr("name") == "os") {
      if (simpleArrayRemove(elem, osFilter)) return;
   } else if (elem.attr("name") == "connect") {
      if (simpleArrayRemove(elem, connectFilter)) return;
   } else if (elem.attr("name") == "category") {
      if (simpleArrayRemove(elem, categoryFilter)) return;
   } else if (elem.attr("name") == "acquisto") {
      if (simpleArrayRemove(elem, purchaseFilter)) return;
   }
}*/

function clearContent() {
   $("#maincontent").html("");
}

function processPromotion(obj) {
   $("#maincontent").append("<div class='promotionitem'>" +
	"<div class='promopic' style=\"background: url('" + obj.image + "') no-repeat; background-size: contain;\"></div>" +
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

function fetchAllPomotions() {
   $.post("/php/controllers/get-promotions.php", {
      "preview": true
   }, function(data) {
      var newmessages = JSON.parse(data);
      clearContent();
      newmessages.forEach(processPromotion);
      postProcessPromotions();
   });
}

$(document).ready(function() {
   fetchAllPomotions();
});
