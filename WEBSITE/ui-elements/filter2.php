<link rel="stylesheet" type="text/css" href="/style/filter.css">
<script src="/js/filter.js"></script>

<div class="filter"><div class="title"> Filtri</div>
   <div class="choosen">

   </div>
   <?php
      include $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
      $conn = dbconn();
   ?>
   <?php
      if (!isset($filter_flavor) || $filter_flavor == "devices") {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/filter-lists/devices.php";
      } else if ($filter_flavor == "promotions") {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/filter-lists/promotions.php";
      } else {
         echo "unknown filter flavor";
      }
   ?>
   <?php $conn->close(); ?>
</div>
