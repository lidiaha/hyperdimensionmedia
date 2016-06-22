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
         $sql = "SELECT * FROM category WHERE type='device'";
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
   <a> <div class="sub">Tipologia </div></a>
   <div class= "element">
      <?php
         if (isset($filter_category)) {
            $sql = "SELECT typetags FROM devices WHERE type = '$filter_category'";
         } else {
            $sql = "SELECT typetags FROM devices";
         }
         $tags = array();
         $result = $conn->query($sql);
         if (!$result) {
            echo "query error";
         }
         else {
            while($row = $result->fetch_assoc()) {
               $pieces = explode(";", $row["typetags"]);
               foreach ($pieces as $tag) {
                  if (!in_array($tag, $tags)) {
                     array_push($tags, $tag);
                  }
               }
            }
            foreach ($tags as $tag) {
               echo "<span><input class=\"item\" type=\"checkbox\" name=\"typology\" value=\"$tag\"><label><span></span>$tag</label><br></span>\n";
            }
         }
       ?>
   </div>
</div>
<div class="cate">
   <a> <div class="sub">Prezzo </div></a>
   <div class= "element">
      <span><input class="item price" data-high="150" type="checkbox" name="price" value="< 150 €"><label><span></span>< 150 €</label><br></span>
      <span><input class="item price" data-low="150" data-high="200" type="checkbox" name="price" value="150-200 €"><label><span></span>150-200 €</label><br></span>
      <span><input class="item price" data-low="200" data-high="300" type="checkbox" name="price" value="200-300 €"><label><span></span>200-300 €</label><br></span>
      <span><input class="item price" data-low="300" data-high="400" type="checkbox" name="price" value="300-400 €"><label><span></span>300-400 €</label><br></span>
      <span><input class="item price" data-low="400" data-high="500" type="checkbox" name="price" value="400-500 €"><label><span></span>400-500 €</label><br></span>
      <span><input class="item price" data-low="500" type="checkbox" name="price" value="> 500 €"><label><span></span>> 500 €</label><br></span>
   </div>
</div>
<div class="cate">
   <a> <div class="sub">Marca </div></a>
   <div class= "element">
      <?php
         if (isset($filter_category)) {
            $sql = "SELECT DISTINCT brand FROM devices WHERE type = '$filter_category'";
         } else {
            $sql = "SELECT DISTINCT brand FROM devices";
         }
         $result = $conn->query($sql);
         if (!$result) {
            echo "query error";
         }
         else {
            while($row = $result->fetch_assoc()) {
               $brand = $row["brand"];
               echo "<span><input class=\"item\" type=\"checkbox\" name=\"brand\" value=\"$brand\"><label><span></span>$brand</label><br></span>\n";
            }
         }
       ?>
   </div>
</div>
<div class="cate">
   <a> <div class="sub">Sistema Operativo </div></a>
   <div class= "element">
      <?php
         if (isset($filter_category)) {
            $sql = "SELECT DISTINCT os FROM devices WHERE type = '$filter_category'";
         } else {
            $sql = "SELECT DISTINCT os FROM devices";
         }
         $result = $conn->query($sql);
         if (!$result) {
            echo "query error";
         }
         else {
            while($row = $result->fetch_assoc()) {
               $os = $row["os"];
               echo "<span><input class=\"item\" type=\"checkbox\" name=\"os\" value=\"$os\"><label><span></span>$os</label><br></span>\n";
            }
         }
       ?>
   </div>
</div>
<div class="cate">
   <a> <div class="sub">Acquisto </div></a>
   <div class= "element">
      <span><input class="item" type="checkbox" name="acquisto" value="vendita"><label><span></span>vendita</label><br></span>
      <span><input class="item" type="checkbox" name="acquisto" value="a rate"><label><span></span>a rate</label><br></span>
   </div>
</div>
<div class="cate">
   <a> <div class="sub">Connessione </div></a>
   <div class= "element">
      <?php
         if (isset($filter_category)) {
            $sql = "SELECT DISTINCT ct.name FROM connectiontypes AS ct JOIN deviceconnect AS dc ON ct.id = dc.conn_id " .
            "WHERE dc.dev_id IN (SELECT id FROM devices WHERE type = '$filter_category')";
         } else {
            $sql = "SELECT DISTINCT ct.name FROM connectiontypes AS ct JOIN deviceconnect AS dc ON ct.id = dc.conn_id " .
            "WHERE dc.dev_id IN (SELECT id FROM devices)";
         }
         $result = $conn->query($sql);
         if (!$result) {
            echo "query error";
         }
         else {
            while($row = $result->fetch_assoc()) {
               $name = $row["name"];
               echo "<span><input class=\"item\" type=\"checkbox\" name=\"connect\" value=\"$name\"><label><span></span>$name</label><br></span>\n";
            }
         }
       ?>
   </div>
</div>
