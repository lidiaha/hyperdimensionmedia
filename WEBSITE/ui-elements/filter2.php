<link rel="stylesheet" type="text/css" href="/style/filter.css" media="screen and (min-width: 480px)">
<link rel="stylesheet" type="text/css" href="/style/mobile/filter.css" media="screen and (max-width: 480px)">
<script src="/js/filter.js"></script>

<div class="filter"><div class="title"> Filtri</div>
   <div class="choosen">

   </div>
   <?php
      include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
      $conn = dbconn();
   ?>
   <?php
      if (!isset($filter_flavor) || $filter_flavor == "devices") {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/filter-lists/devices.php";
      } else if ($filter_flavor == "promotions") {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/filter-lists/promotions.php";
      } else if ($filter_flavor == "services") {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/filter-lists/services.php";
      } else if ($filter_flavor == "assistance") {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/filter-lists/assistance.php";
      } else {
         echo "unknown filter flavor";
      }
   ?>
   <?php $conn->close(); ?>
</div>
<div id="filteropen">apri filtro</div>
