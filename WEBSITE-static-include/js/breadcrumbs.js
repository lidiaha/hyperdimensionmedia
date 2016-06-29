
var navHistory = [];
var cookieKey = "nav_history";
var nameFromDb = "";
var scheduledInjectBC = false;

var landmarks = ["file:///android_asset/www/pages/SL-services.html","file:///android_asset/www/pages/smartlife-categories.html","file:///android_asset/www/pages/devices.html",
   "file:///android_asset/www/pages/device-categories.html","file:///android_asset/www/pages/promotions.html","file:///android_asset/www/pages/assistance-services.html","file:///android_asset/www/pages/assistance-categories.html"];

function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

function isLandmark(url) {
   var candidate;
   for (var i=0; i<landmarks.length; i++) {
      candidate = landmarks[i];
      if (endsWith(url, candidate)) {
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
   _breadcrumbCurrentPageFromDbQuery(id, table, url, function() {
      $(document).ready(function () {
         refreshTitle();
      });
   });
}

function _breadcrumbCurrentPageFromDbQuery(id, table, url, callback) {
   $.get(sitename + "file:///android_asset/www/php/controllers/identifyFomDb.php", {id: id, table: table}, function (data) {
      console.log(data);
      if (data != "query error") {
         nameFromDb = data;
         breadcrumbCurrentPage(data, url);
         callback();
         if (!scheduledInjectBC === false) {
            scheduledInjectBC();
         }
         scheduledInjectBC = false; // clear it so that it won't be called twice
      }
   });
}

function refreshTitle() {
   document.title = document.title + " - " + nameFromDb;
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

function reciveBCcode() {
   scheduledInjectBC = function () {
      $("#bcholder").html(getBreadcrumbHtmlBar());
   };
   $(document).ready(function () {
      if (!scheduledInjectBC === false) {
         scheduledInjectBC();
      }
   });
}
