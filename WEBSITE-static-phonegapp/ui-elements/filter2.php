<link rel="stylesheet" type="text/css" href="file:///android_asset/www/style/filter.css" media="screen and (min-width: 480px)">
<link rel="stylesheet" type="text/css" href="file:///android_asset/www/style/mobile/filter.css" media="screen and (max-width: 480px)">
<script src="file:///android_asset/www/js/filter.js"></script>

<div class="filter"><div class="title"> Filtri</div>
   <div class="choosen">

   </div>
   <?php
      if (!isset($filter_flavor) || $filter_flavor == "devices") {
         echo "<script>getFilterSection(\"" . $filter_flavor . "filter\");</script>";
      }  else if ($filter_flavor == "dev_outlet") {
         echo "<script>getFilterSection(\"" . $filter_flavor . "filter\");</script>";
      } else if ($filter_flavor == "promotions") {
         echo "<script>getFilterSection(\"" . $filter_flavor . "filter\");</script>";
      } else if ($filter_flavor == "services") {
         echo "<script>getFilterSection(\"" . $filter_flavor . "filter\");</script>";
      } else if ($filter_flavor == "assistance") {
         echo "<script>getFilterSection(\"" . $filter_flavor . "filter\");</script>";
      } else {
         echo "unknown filter flavor";
      }
   ?>
</div>
<div id="filteropen">apri filtro</div>
