
var navHistory = [];
var cookieKey = "nav_history";
var nameFromDb = "";
var scheduledInjectBC = false;

var landmarks = ["/pages/SL-services.html","/pages/smartlife-categories.html","/pages/devices.html",
   "/pages/device-categories.html","/pages/promotions.html","/pages/assistance-services.html","/pages/assistance-categories.html"];

function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

function storeData(key, value) {
   if (isApp()) {
      window.localStorage.setItem(key, value);
   } else {
      Cookies.set(key, value, { path: '/' });
   }
}

function loadData(key) {
   if (isApp()) {
      return window.localStorage.getItem(key);
   } else {
      return Cookies.get(key, { path: '/' });
   }
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
   var cookie = loadData(cookieKey);
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
   storeData(cookieKey, JSON.stringify(navHistory));
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
   storeData(cookieKey, JSON.stringify(navHistory));
}

function breadcrumbCurrentPageFromDbQuery(id, table, url) {
   _breadcrumbCurrentPageFromDbQuery(id, table, url, function() {
      $(document).ready(function () {
         refreshTitle();
      });
   });
}

function _breadcrumbCurrentPageFromDbQuery(id, table, url, callback) {
   $.get(sitename + "/php/controllers/identifyFomDb.php", {id: id, table: table}, function (data) {
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
