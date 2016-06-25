function includeResource(localurl, params, container, callback) {
   $.get(localurl, params, function (data) {
      container.append(data);
      callback();
   });
}

function afterResource(localurl, params, container, callback) {
   $.get(localurl, params, function (data) {
      container.after(data);
      callback();
   });
}

function getPageData(pagename, params, container, callback) {
   includeResource("/php/controllers/specific/" + pagename, params, container, callback);
}

function getParams() {
   if (location.search != "") {
      var search = location.search.substring(1);
      return JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
   }
   return {};
}

function getMyData() {
   var filename = location.href.split(/(\\|\/)/g).pop();
   var identifier = filename.split("?")[0].split(".")[0];
   getPageData(identifier + ".php", getParams(), $("#maincontent"), function() {});
}

function getMyDataIn(inside) {
   var filename = location.href.split(/(\\|\/)/g).pop();
   var identifier = filename.split("?")[0].split(".")[0];
   getPageData(identifier + ".php", getParams(), inside, function() {});
}

function getMyDataAndCall(callback) {
   var filename = location.href.split(/(\\|\/)/g).pop();
   var identifier = filename.split("?")[0].split(".")[0];
   var params = {};
   if (location.search != "") {
      var search = location.search.substring(1);
      params = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
   }
   getPageData(identifier + ".php", params, $("#maincontent"), callback);
}

function getFilterSection(sectionName) {
   var params = {};
   if (location.search != "") {
      var search = location.search.substring(1);
      params = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
   }
   afterResource("/ui-elements/filter-lists/" + sectionName + ".php", params, $(".choosen"), afterFilterLoaded);
}