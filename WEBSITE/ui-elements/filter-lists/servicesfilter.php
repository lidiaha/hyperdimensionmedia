<?php
   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
   include_once "phplib/database.php";
   $conn = dbconn();
?>
<?php
   if (isset($_GET["category"])) {
      $filter_category = mysqli_real_escape_string($conn, $_GET["category"]);
   }
 ?>
<?php
   if (!isset($filter_category)) {
 ?>
<div class="cate">
   <a> <div class="sub">Categoria </div></a>
   <div class= "element">
      <?php
         $sql = "SELECT * FROM category WHERE type='smartlife'";
         $result = $conn->query($sql);
         if (!$result) {
            echo "query error";
         }
         else {
            while($row = $result->fetch_assoc()) {
               $category = ucfirst($row["name"]);
               $id = $row["id"];
               echo "<span><input class=\"item\" type=\"checkbox\" name=\"category\" value=\"$id\"><label><span></span>$category</label><br></span>\n";
            }
         }
       ?>
   </div>
</div>
<?php
   }
 ?>
<?php

   function getSubcate($conn, $cat_id) {
      $sql = "SELECT DISTINCT sub.id, sub.name FROM sl_services AS sl JOIN sl_subcategory AS sub ON sl.subcategory = sub.id WHERE sl.category = '$cat_id'";
      $result = $conn->query($sql);
      if (!$result) {
         echo "query error";
      } else {
         while($row = $result->fetch_assoc()) {
            $subid = $row["id"];
            $subname = ucfirst($row["name"]);
            echo "<span><input class=\"item\" type=\"checkbox\" name=\"subcategory\" value=\"$subid\"><label><span></span>$subname</label><br></span>\n";
         }
      }
   }

   $sql = "SELECT * FROM category WHERE type='smartlife'";
   if (isset($filter_category)) {
      $sql = $sql . " AND id = '$filter_category'";
   }
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      while($row = $result->fetch_assoc()) {
         $category = ucfirst($row["name"]);
         $cat_id = $row["id"];
 ?>
 <div class="cate">
    <a> <div class="sub"><?php echo $category; ?> </div></a>
    <div class= "element">
 <?php
         getSubcate($conn, $cat_id);
 ?>
   </div>
</div>
 <?php
      }
   }
 ?>
 <?php $conn->close(); ?>
