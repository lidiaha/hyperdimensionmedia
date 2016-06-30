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
         $sql = "SELECT * FROM category WHERE type='assistance'";
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
 <div class="cate">
    <a> <div class="sub">Tipologia </div></a>
    <div class= "element">
       <?php
          if (isset($_GET["category"])) {
             $sql = "SELECT * FROM timdb.assistance_subcategory WHERE id IN (SELECT ass.subcategory FROM assistance AS ass WHERE ass.category = '$filter_category')";
          } else {
             $sql = "SELECT * FROM assistance_subcategory";
          }
          $result = $conn->query($sql);
          if (!$result) {
             echo "query error";
          }
          else {
             while($row = $result->fetch_assoc()) {
                $name = ucfirst($row["name"]);
                $id = $row["id"];
                echo "<span><input class=\"item\" type=\"checkbox\" name=\"type\" value=\"$id\"><label><span></span>$name</label><br></span>\n";
             }
          }
        ?>
    </div>
 </div>
 <div class="cate">
    <a> <div class="sub">Argomento </div></a>
    <div class= "element">
      <?php
          if (isset($_GET["category"])) {
             $sql = "SELECT * FROM timdb.assistance_subtopics WHERE id IN (SELECT ass.subtopic FROM assistance AS ass WHERE ass.category = '$filter_category')";
          } else {
             $sql = "SELECT * FROM assistance_subtopics";
          }
          $result = $conn->query($sql);
          if (!$result) {
             echo "query error";
          }
          else {
             while($row = $result->fetch_assoc()) {
                $name = ucfirst($row["name"]);
                $id = $row["id"];
                echo "<span><input class=\"item\" type=\"checkbox\" name=\"topic\" value=\"$id\"><label><span></span>$name</label><br></span>\n";
             }
          }
        ?>
    </div>
 </div>
<?php $conn->close(); ?>
