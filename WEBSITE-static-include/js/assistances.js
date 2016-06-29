
var code_accumulator = "";  // if we appended directly the code, jquery would flatten the nested structure
var categoryFilter = [];  // note: only used in devices.php, NOT devices-mono-category.php
var typologyFilter = [];
var topicFilter = [];

var colors = ["DeepPink","DarkOrange","DarkGreen","MediumBlue","LightGreen","Sienna","RoyalBlue","Red"];
var colorindex = 0;
var lsdDeltaT = 10;
var lsdTime = 1000;

function lsdGetcolor(offset) {
   var color = colors[(colorindex + offset) % colors.length];
   return color;
}

function lsd() {
   $(".assis_category").css("background-color", lsdGetcolor(0));
   $(".assis_subcategory").css("background-color", lsdGetcolor(1));
   $(".assis_subtopic").css("background-color", lsdGetcolor(2));
   $(".assis_item").css("background-color", lsdGetcolor(3));

   colorindex++;
   if (colorindex > colors.length) {
      colorindex = 0;
   }

   if (lsdTime - lsdDeltaT > 0) {
      lsdTime -= lsdDeltaT;
   }
   window.setTimeout(lsd, lsdTime);
}


// interface with filter.js
function applyFilter(elem) {
   if (elem.attr("name") == "category") {
      categoryFilter.push(elem.val());
   } else if (elem.attr("name") == "type") {
      typologyFilter.push(elem.val());
   } else if (elem.attr("name") == "topic") {
      topicFilter.push(elem.val());
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
   } else if (elem.attr("name") == "type") {
      if (simpleArrayRemove(elem, typologyFilter)) return;
   } else if (elem.attr("name") == "topic") {
      if (simpleArrayRemove(elem, topicFilter)) return;
   }
}


function clearContent() {
   code_accumulator = "";
   $("#maincontent").html("");
}

function processItem(obj) {
   console.log(obj.name);
   code_accumulator += "<div class=\"assis_item\"><a href=\"file:///android_asset/www/pages/assistance-page.html?id=" + obj.id +"\">" + obj.name + "</a></div>";
}

function processSubTopic(name, obj) {
   console.log("open " + name);
   code_accumulator += "<div class=\"assis_subtopic\"><div class=\"assis_subtopic_label\">" + name + "</div>";
   obj.forEach(processItem);
   code_accumulator += "</div>";
   console.log("close " + name);
}

function processSubCategory(name, obj) {
   console.log("open " + name);
   code_accumulator += "<div class=\"assis_subcategory\"><div class=\"assis_subcategory_label\">" + name + "</div>";
   Object.keys(obj).forEach(function (key, index) {
      subobj = obj[key];
      processSubTopic(key, subobj);
   });
   code_accumulator += "</div>";
   console.log("close " + name);
}

function processCategory(name, obj) {
   console.log("open " + name);
   code_accumulator += "<div class=\"assis_category\"><div class=\"assis_category_label\">" + name + "</div>";
   Object.keys(obj).forEach(function (key, index) {
      subobj = obj[key];
      processSubCategory(key, subobj);
   });
   code_accumulator += "</div>";
   console.log("close " + name);
}

function postProcessDevices() {
   $("#maincontent").append(code_accumulator);
   $("#maincontent").append("<div class=\"doorstopper\"></div>");
}

function emptyResultHandler() {
   $.get(sitename + "file:///android_asset/www/ui-elements/no-results.html", function(data) {
      $("#maincontent").append(data);
   });
}

function fetchDevicesAllCategory() {
   $.post(sitename + "file:///android_asset/www/php/controllers/get-assistances.php", {
      "preview": true,
      "category": categoryFilter.join(","),
      "subcategory": typologyFilter.join(","),
      "subtopic": topicFilter.join(",")
   }, function(data) {
      var newmessages = JSON.parse(data);
      clearContent();
      if (newmessages.length == 0) {
         emptyResultHandler();
      }
      Object.keys(newmessages).forEach(function (key, index) {
         subobj = newmessages[key];
         processCategory(key, subobj);
      });
      postProcessDevices();
   });
}

function fetchDevicesSingleCategory() {
   $.post(sitename + "file:///android_asset/www/php/controllers/get-assistances.php", {
      "preview": true,
      "category": category_id,
      "subcategory": typologyFilter.join(","),
      "subtopic": topicFilter.join(",")
   }, function(data) {
      var newmessages = JSON.parse(data);
      clearContent();
      if (newmessages.length == 0) {
         emptyResultHandler();
      }
      Object.keys(newmessages).forEach(function (key, index) {
         subobj = newmessages[key];
         processCategory(key, subobj);
      });
      postProcessDevices();
   });
}

function reloadContent() {
   if (!is_monocategory) {  // is_monocategory is dynamically defined by the php code in the host page
      fetchDevicesAllCategory();
   } else {
      fetchDevicesSingleCategory();
   }
}

$(document).ready(function() {
   reloadContent();
});
