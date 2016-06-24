function includeResource(localurl, params, container) {
   $.get(localurl, params, function (data) {
      container.html(data);
   });
}

function getPageData(pagename, params, container) {
   includeResource("/php/controllers/specific/" + pagename, params, container);
}

function getMyData() {
   var filename = location.href.split(/(\\|\/)/g).pop();
   var identifier = filename.split("?")[0].split(".")[0];
   var params = {};
   if (location.search != "") {
      var search = location.search.substring(1);
      params = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
   }
   getPageData(identifier + ".php", params, $("#maincontent"));
}
