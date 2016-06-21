
var navHistory = [];
var cookieKey = "nav_history";

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

function breadcrumbCurrentPage(name, url) {
   var newentry = {name: name, url: url};
   var found = superIndexOf(navHistory, newentry);
   if (found >= 0) {
      navHistory.splice(found+1, navHistory.length - found - 1);
   } else {
      navHistory.push(newentry);
   }
   Cookies.set(cookieKey, JSON.stringify(navHistory), { path: '/' });
}

function getBreadcrumbHtmlBar() {
   var code = "<div class=\"bcbar\">";
   var curr;
   for (var i=0; i<navHistory.length; i++) {
      curr = navHistory[i];
      code += "<div class=\"bcitem\"><a href=\"" + curr.url + "\">" + curr.name + "</a></div>";
      if (i+1 < navHistory.length) {
         code += "<div class=\"bcsep\">/</div>";
      }
   }
   code += "</div>";
   return code;
}
