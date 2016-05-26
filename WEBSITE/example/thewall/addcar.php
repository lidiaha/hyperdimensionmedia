<html>
  <head>
    <title>Add a (un)cool car</title>
    <link rel="stylesheet" type="text/css" href="../style/cars.css">
  </head>
  <body>
    <?php
      include "../phplib/database.php";
      if (isset($_POST["name"]) && isset($_POST["url"]) && isset($_POST["cool"]) && $_FILES["pic"]["size"] > 0) {

        $tmpName  = $_FILES["pic"]["tmp_name"];
        $fp = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        fclose($fp);

        $coolness = intval($_POST["cool"]);
        if ($coolness < 0) $coolness = 0;
        else if ($coolness > 10) $coolness = 10;

        $conn = dbconn();
        $sql = "INSERT INTO testable (name, url, cool, pic) VALUES (?, ?, ?, ?)";
        $prepared = $conn->prepare($sql);
        $prepared->bind_param("ssis", $_POST["name"], $_POST["url"], $coolness, $content);
        $prepared->execute();
        $conn->close();

        echo "<h1>car added!</h1><br><a href=\"wall.php\">go see</a>";
      }
      else {
     ?>
    <h1>Insert data</h1>
    <form action="addcar.php" method="post" enctype="multipart/form-data">
      Name: <input type="textbox" name="name" required="true"><br>
      Url: <input type="textbox" name="url" required="true"><br>
      Coolness: <select name="cool" required="true">
        <?php
          for ($i=0; $i<=10; $i++) {
            echo "<option value=\"$i\">$i</option>\n";
          }
         ?>
      </select><br>
      Png Picture: <input name="pic" type="file" required="true" accept=".png"><br>
      <input type="submit" value="Submit">
    </form>
    <?php
      }
     ?>
  </body>
</html>
