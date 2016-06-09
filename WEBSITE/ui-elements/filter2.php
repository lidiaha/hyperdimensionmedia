<link rel="stylesheet" type="text/css" href="/style/filter.css">
<script src="/js/filter.js"></script>

<div class="filter"><span> Filtri </span> <br>
   <div class="choosen">

   </div>
   <?php
      if (!isset($filter_flavor) || $filter_flavor == "devices") {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/filter-lists/devices.html";
      }
      else {
         echo "unknown filter flavor";
      }
   ?>
</div>
