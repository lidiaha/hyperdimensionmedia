
var priceFilter = [];

// Note: this function may be moved to some "library" in the future
function isEquivalent(a, b) {
   /* check if two objects are equal by value */
   var aProps = Object.getOwnPropertyNames(a);
   var bProps = Object.getOwnPropertyNames(b);
   if (aProps.length != bProps.length) {
      return false;
   }
   for (var i = 0; i < aProps.length; i++) {
      var propName = aProps[i];
      if (a[propName] !== b[propName]) {
         return false;
      }
   }
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
}

// interface with filter.js
function applyFilter(elem) {
   if (elem.attr("name") == "price") {
      priceFilter.push(getPriceObject(elem));
   }
   reloadContent();
}

function removeFilter(elem) {
   if (elem.attr("name") == "price") {
      data = getPriceObject(elem);
      for (var i=0; i<priceFilter.length; i++) {
         if (isEquivalent(data, priceFilter[i])) {
            priceFilter.splice(i, 1);
            reloadContent();
            return;
         }
      }
   }
}

function clearContent() {
   $("#maincontent").html("");
}

function processDevice(obj) {
   $("#maincontent").append("<div class='deviceitem'>" +
   "<div class='devicename'><a href='#nepu'>" + obj.name + "</a></div>" +  //TODO: make title link somewhere
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
      "price_range": JSON.stringify(priceFilter)
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
      "price_range": JSON.stringify(priceFilter)
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
