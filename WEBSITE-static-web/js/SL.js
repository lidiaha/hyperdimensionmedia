
var categoryFilter = [];  // note: only used in devices.php, NOT devices-mono-category.php
var subCategoryFilter = [];

/*function sameInterval(a, b) {
   /* check if two intervals are the same
   if (a.hasOwnProperty("low") && !b.hasOwnProperty("low")) return false;
   if (a.hasOwnProperty("high") && !b.hasOwnProperty("high")) return false;
   if (!a.hasOwnProperty("low") && b.hasOwnProperty("low")) return false;
   if (!a.hasOwnProperty("high") && b.hasOwnProperty("high")) return false;
   if (a.hasOwnProperty("low") && (a["low"] != b["low"])) return false;
   if (a.hasOwnProperty("high") && (a["high"] != b["high"])) return false;
   return true;
}*/
/*
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
}*/

// interface with filter.js
function applyFilter(elem) {
   if (elem.attr("name") == "category") {
      categoryFilter.push(elem.val());
   } else if (elem.attr("name") == "subcategory") {
      subCategoryFilter.push(elem.val());
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
   if (elem.attr("name") == "category") {
      if (simpleArrayRemove(elem, categoryFilter)) return;
   } else if (elem.attr("name") == "subcategory") {
      if (simpleArrayRemove(elem, subCategoryFilter)) return;
   }
}

function clearContent() {
   $("#maincontent").html("");
}

function processService(obj) {
   if (isApp()) {
      $("#maincontent").append("<div class='serviceitem'>" +
      "<div class='serviceinfo'><div class='servicepic' style=\"background: url('" + localizeData(obj.image) + "') no-repeat; background-size: contain; background-position: center center;\"></div>" +
      "<div class='servicename'>" + obj.name + "</a></div>" +
      "<div class='description'>" + obj.description + "</div>" +
      "</div><div class='scopri'><a href='file:///android_asset/www/pages/service-presentation.html?service_id=" + obj.id + "'> Scopri di più </div>" +
      "</div>");
   } else {
      $("#maincontent").append("<div class='serviceitem'>" +
      "<div class='serviceinfo'><div class='servicepic' style=\"background: url('" + obj.image + "') no-repeat; background-size: contain; background-position: center center;\"></div>" +
      "<div class='servicename'>" + obj.name + "</a></div>" +
      "<div class='description'>" + obj.description + "</div>" +
      "</div><div class='scopri'><a href='/pages/service-presentation.html?service_id=" + obj.id + "'> Scopri di più </div>" +
      "</div>");
   }
}

function postProcessServices() {
   $("#maincontent").append("<div class=\"doorstopper\"></div>");
}

function emptyResultHandler() {
   $.get(sitename + "/ui-elements/no-results.html", function(data) {
      if (isApp()) {
         data = localizeData(data);
      }
      $("#maincontent").append(data);
   });
}

function fetchServicesAllCategory() {
   $.post(sitename + "/php/controllers/get-services.php", {
      "preview": true,
      "category": categoryFilter.join(","),
      "subcategory": subCategoryFilter.join(",")
   }, function(data) {
      console.log(data);
      var newmessages = JSON.parse(data);
      clearContent();
      if (newmessages.length == 0) {
         emptyResultHandler();
      }
      newmessages.forEach(processService);
      //postProcessServices();
   });
}

function fetchServicesSingleCategory() {
   $.post(sitename + "/php/controllers/get-services.php", {
      "preview": true,
      "category": category_id,
      "subcategory": subCategoryFilter.join(",")
   }, function(data) {
      console.log(data);
      var newmessages = JSON.parse(data);
      clearContent();
      if (newmessages.length == 0) {
         emptyResultHandler();
      }
      newmessages.forEach(processService);
      //postProcessServices();
   });
}

function reloadContent() {
   if (!is_monocategory) {  // is_monocategory is dynamically defined by the php code in the host page
      fetchServicesAllCategory();
   } else {
      fetchServicesSingleCategory();
   }
}

$(document).ready(function() {
   reloadContent();
});
