<div class="cate">
   <a href="#"> <div class="sub">Categoria </div></a>
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
                  echo "<span><input class=\"item\" type=\"checkbox\" name=\"category\" value=\"$id\">$category<br></span>\n";
               }
         }
       ?>
   </div>
</div>
<div class="cate">
   <a href="#"> <div class="sub">Prezzo </div></a>
   <div class= "element">
      <span><input class="item price" data-high="150" type="checkbox" name="price" value="< 150 €">< 150 €<br></span>
      <span><input class="item price" data-low="150" data-high="200" type="checkbox" name="price" value="150-200 €">150-200 €<br></span>
      <span><input class="item price" data-low="200" data-high="300" type="checkbox" name="price" value="200-300 €">200-300 €<br></span>
      <span><input class="item price" data-low="300" data-high="400" type="checkbox" name="price" value="300-400 €">300-400 €<br></span>
      <span><input class="item price" data-low="400" data-high="500" type="checkbox" name="price" value="400-500 €">400-500 €<br></span>
      <span><input class="item price" data-low="500" type="checkbox" name="price" value="> 500 €">> 500 €<br></span>
   </div>
</div>
<div class="cate">
   <a href="#"> <div class="sub">Marca </div></a>
   <div class= "element">
      <?php
         $sql = "SELECT DISTINCT brand FROM devices";
         $result = $conn->query($sql);
         if (!$result) {
            echo "query error";
         }
         else {
               while($row = $result->fetch_assoc()) {
                  $brand = $row["brand"];
                  echo "<span><input class=\"item\" type=\"checkbox\" name=\"brand\" value=\"$brand\">$brand<br></span>\n";
               }
         }
       ?>
   </div>
</div>
<div class="cate">
   <a href="#"> <div class="sub">Sistema Operativo </div></a>
   <div class= "element">
      <?php
         $sql = "SELECT DISTINCT os FROM devices";
         $result = $conn->query($sql);
         if (!$result) {
            echo "query error";
         }
         else {
               while($row = $result->fetch_assoc()) {
                  $os = $row["os"];
                  echo "<span><input class=\"item\" type=\"checkbox\" name=\"os\" value=\"$os\">$os<br></span>\n";
               }
         }
       ?>
   </div>
</div>
<div class="cate">
   <a href="#"> <div class="sub">Connessione </div></a>
   <div class= "element">
      <?php
         $sql = "SELECT name FROM connectiontypes";
         $result = $conn->query($sql);
         if (!$result) {
            echo "query error";
         }
         else {
               while($row = $result->fetch_assoc()) {
                  $name = $row["name"];
                  echo "<span><input class=\"item\" type=\"checkbox\" name=\"connect\" value=\"$name\">$name<br></span>\n";
               }
         }
       ?>
   </div>
</div>
