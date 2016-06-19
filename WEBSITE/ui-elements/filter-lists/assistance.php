<?php
   if (isset($_GET["category"])) {
      $filter_category = mysqli_real_escape_string($conn, $_GET["category"]);
   }
 ?>
<?php
   if (!isset($filter_category)) {
 ?>
<div class="cate">
   <a href="#"> <div class="sub">Categoria </div></a>
   <div class= "element">
      <?php
         $sql = "SELECT * FROM category WHERE type='assistance'";
         $result = $conn->query($sql);
         if (!$result) {
            echo "query error";
         }
         else {
               while($row = $result->fetch_assoc()) {
                  $category = $row["name"];
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
    <a href="#"> <div class="sub">Tipologia </div></a>
    <div class= "element">
       <?php
          $sql = "SELECT * FROM assistance_subcategory";
          $result = $conn->query($sql);
          if (!$result) {
             echo "query error";
          }
          else {
             while($row = $result->fetch_assoc()) {
                $name = $row["name"];
                $id = $row["id"];
                echo "<span><input class=\"item\" type=\"checkbox\" name=\"type\" value=\"$id\"><label><span></span>$name</label><br></span>\n";
             }
          }
        ?>
    </div>
 </div>
 <div class="cate">
    <a href="#"> <div class="sub">Argomento </div></a>
    <div class= "element">
      <?php
          $sql = "SELECT * FROM assistance_subtopics";
          $result = $conn->query($sql);
          if (!$result) {
             echo "query error";
          }
          else {
             while($row = $result->fetch_assoc()) {
                $name = $row["name"];
                $id = $row["id"];
                echo "<span><input class=\"item\" type=\"checkbox\" name=\"topic\" value=\"$id\"><label><span></span>$name</label><br></span>\n";
             }
          }
        ?>
    </div>
 </div>