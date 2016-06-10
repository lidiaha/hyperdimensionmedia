var filter_enabled_names = [];

/*
   to make this code reusable, we define those adapter functions:
   if applyFilter() and/or removeFilter() were defined somewhere in the
   page's code, we call them, otherwise, do nothing
*/
function applyFilterAdapter(elem) {
   if (typeof applyFilter == 'function') {
      applyFilter(elem);
   }
}
function removeFilterAdapter(elem) {
   if (typeof removeFilter == 'function') {
      removeFilter(elem);
   }
}


function putHigherCopy(name, value, numid) {
   /*
      add a 'copy' of the selector in the upper area, to show the filter is enabled
   */
   var newel = "<span class=\"spanblock\"><input class= \"item activefilter\" type=\"checkbox\" " +
   "name=\"" + name + "\" value=\"" + value + "\" id=\"selected-" + numid + "\" checked=\"checked\">" + value + "</span>"
   $(".choosen").append($(newel));
}

function deleteNameFromArray(index, arr) {
   /*
      the identity index->value in the array is fundamental for this system to work.
      this function allow to clear elemets from the array while preserving said identity.
      (this would not be achieved with a simple arr.splice(), as the index of following
      elements would be decreased after a deletion in the middle)
   */
   var empty = "";
   if (index == arr.length - 1) {
      arr.splice(index, 1);
   } else {
      arr[index] = empty;
      for (var i=index; i<arr.length; i++) {
         if (arr[i] != empty) return;
      }
      arr.splice(index, arr.length - index);
   }
}

function enabled(elem) {
   /*
      triggered when we apply a new filter
   */
   var value = elem.val();
   var name = elem.attr("name");
   filter_enabled_names.push(value);
   numid = filter_enabled_names.length - 1;
   putHigherCopy(name, value, numid);
   elem.attr("id", "selector-" + numid);
   elem.off("click");
   elem.click(function() {
      disabled($(this));
   });
   applyFilterAdapter(elem);
}

function disabled(elem) {
   /*
      triggered when we uncheck an already applied filter
      (using the checkbox in the "cate" part)
   */
   var value = elem.val();
   var found = filter_enabled_names.indexOf(value);
   if (found > -1) {
      deleteNameFromArray(found, filter_enabled_names);
      $("#selected-" + found).parent().remove();
      removeFilterAdapter(elem);
   }
   elem.off("click");
   elem.click(function() {
      enabled($(this));
   });
}

function disableFromTop(topelem) {
   /*
      triggered when we uncheck an already applied filter
      (using the checkbox in the "filters" (upper) part)
   */
   var value = topelem.val();
   var found = filter_enabled_names.indexOf(value);
   if (found > -1) {
      deleteNameFromArray(found, filter_enabled_names);
      topelem.parent().remove();

      var selector = $("#selector-" + found);
      selector.off("click");
      selector.attr("id", "");
      selector.prop("checked", false);
      selector.click(function() {
         enabled($(this));
      });
      removeFilterAdapter(selector);
   }
}

$(document).ready(function() {
   $(".cate").find("a").click(function() {
      $(this).parent().find(".element").toggle();  // hidable-panels
   });
   $(".cate").find("input").click(function() {
      enabled($(this));  // clickable checkboxes
   });
   $(".choosen").on("click", ".activefilter", function() {
      disableFromTop($(this));  // clickable checkboxes (for the not-yet-existing active filters)
   });
   $(".element").find("input").prop("checked", false);  // uncheck all the checkboxes
});
