
var priceFilter = [];
var brandFilter = [];
var osFilter = [];

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

function getPriceObject(elem) {
   /* get a javascript object representing the price range inside an <input name='price'> */
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
   }
   reloadContent();
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
      index = brandFilter.indexOf(elem.val());
      if (index > -1) {
         brandFilter.splice(index, 1);
         reloadContent();
         return;
      }
   } else if (elem.attr("name") == "os") {
      index = osFilter.indexOf(elem.val());
      if (index > -1) {
         osFilter.splice(index, 1);
         reloadContent();
         return;
      }
   }
}

function clearContent() {
   $("#maincontent").html("");
}

function processDevice(obj) {
   $("#maincontent").append("<div class='deviceitem'>" +
   "<div class='devicename'><a href='/pages/device-presentation.php?device_id=" + obj.id + "'>" + obj.name + "</a></div>" +  //TODO: make title link somewhere
   "<div class='devicepic' style=\"background: url('" + obj.image + "') no-repeat; background-size: contain;\"></div>" +
   "<div class='deviceprice'>" + obj.price + "€</div>" +
   "</div>");
}

function postProcessDevices() {
   $("#maincontent").append("<div class=\"doorstopper\"></div>")
}

function fetchDevicesAllCategory() {
   $.post("/php/controllers/get-devices.php", {
      "preview": true,
      "price_range": JSON.stringify(priceFilter),
      "brands": brandFilter.join(","),
      "oses": osFilter.join(",")
   }, function(data) {
      var newmessages = JSON.parse(data);
      clearContent();
      newmessages.forEach(processDevice);
      postProcessDevices();
   });
}

function fetchDevicesSingleCategory() {
   $.post("/php/controllers/get-devices.php", {
      "preview": true,
      "category": category_id,
      "price_range": JSON.stringify(priceFilter),
      "brands": brandFilter.join(","),
      "oses": osFilter.join(",")
   }, function(data) {
      var newmessages = JSON.parse(data);
      clearContent();
      newmessages.forEach(processDevice);
      postProcessDevices();
   });
}

function reloadContent() {
   if (!is_monocategory) {
      fetchDevicesAllCategory();
   } else {
      fetchDevicesSingleCategory();
   }
}

$(document).ready(function() {
   reloadContent();
});
