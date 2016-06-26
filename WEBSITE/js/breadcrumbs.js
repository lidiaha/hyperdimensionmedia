
var navHistory = [];
var cookieKey = "nav_history";
var nameFromDb = "";

var landmarks = ["/pages/SL-services.php","/pages/smartlife-categories.php","/pages/devices.php",
   "/pages/device-categories.php","/pages/promotions.php","/pages/assistance-services.php","/pages/assistance-categories.php"];

function isLandmark(url) {
   var candidate;
   for (var i=0; i<landmarks.length; i++) {
      candidate = landmarks[i];
      if (url.endsWith(candidate)) {
         return true;
      }
   }
   return false;
}

function loadHistory() {
   var cookie = Cookies.get(cookieKey, { path: '/' });
   if (cookie) {
      navHistory = JSON.parse(cookie);
   }
}

function superIndexOf(arr, histObj) {
   var curr;
   for (var i=0; i<arr.length; i++) {
      curr = arr[i];
      if ((curr.name == histObj.name) && (curr.url == histObj.url)) {
         return i;
      }
   }
   return -1;
}

function resetBreadcrumbs() {
   navHistory = [];
   Cookies.set(cookieKey, JSON.stringify(navHistory), { path: '/' });
}

function breadcrumbCurrentPage(name, url) {
   var newentry = {name: name, url: url};
   var found = superIndexOf(navHistory, newentry);
   if (found >= 0) {
      navHistory.splice(found+1, navHistory.length - found - 1);
   } else {
      if (isLandmark(url)) {
         navHistory = []; // the root of the history must always be a landmark
      }
      navHistory.push(newentry);
   }
   Cookies.set(cookieKey, JSON.stringify(navHistory), { path: '/' });
}

function breadcrumbCurrentPageFromDbQuery(id, table, url) {
   $.get("/php/controllers/identifyFomDb.php", {id: id, table: table}, function (data) {
      console.log(data);
      if (data != "query error") {
         nameFromDb = data;
         breadcrumbCurrentPage(data, url);
      }
   });
}

function refreshTitle() {
   $(document).ready(function () {
      document.title = document.title + " - " + nameFromDb;
   });
}

function getBreadcrumbHtmlBar() {
   var code = "<div class=\"bcbar\">";
   var curr;
   var extraclass = "";
   for (var i=0; i<navHistory.length; i++) {
      curr = navHistory[i];
      if (i+1 >= navHistory.length) {
         code += "<div class=\"bcitem bclast" + extraclass +"\"><span>" + curr.name + "</span></div>";
      } else {
         code += "<div class=\"bcitem" + extraclass +"\"><a href=\"" + curr.url + "\">" + curr.name + "</a></div>";
      }
      if (i+1 < navHistory.length) {
         code += "<div class=\"bcsep\">/</div>";
      }
   }
   code += "</div>";
   return code;
}
