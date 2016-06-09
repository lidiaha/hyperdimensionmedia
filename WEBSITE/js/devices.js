
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
      "preview": true
   }, function(data) {
      console.log(data);
      var newmessages = JSON.parse(data);
      clearContent();
      newmessages.forEach(processDevice);
      postProcessDevices();
   });
}

function fetchDevicesSingleCategory() {
   $.post("/php/controllers/get-devices.php", {
      "preview": true,
      "category": category_id
   }, function(data) {
      var newmessages = JSON.parse(data);
      clearContent();
      newmessages.forEach(processDevice);
      postProcessDevices();
   });
}


$(document).ready(function() {
   if (!is_monocategory) {
      fetchDevicesAllCategory();
   } else {
      fetchDevicesSingleCategory();
   }
});
