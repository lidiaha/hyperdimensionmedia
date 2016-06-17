
var code_accumulator = "";  // if we appended directly the code, jquery would flatten the nested structure

function clearContent() {
   var code_accumulator = "";
   $("#maincontent").html("");
}

function processItem(obj) {
   console.log(obj.name);
   code_accumulator += "<div class=\"assis_item\"><a href=\"/pages/assistance-page.php?id=" + obj.id +"\">" + obj.name + "</a></div>";
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
   $.get("/ui-elements/no-results.html", function(data) {
      $("#maincontent").append(data);
   });
}

function fetchDevicesAllCategory() {
   $.post("/php/controllers/get-assistances.php", {
      "preview": true

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
   $.post("/php/controllers/get-assistances.php", {
      "preview": true,
      "category": category_id

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
