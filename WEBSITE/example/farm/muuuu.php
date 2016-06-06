<html>
   <head>
      <title> Farm </title>
      <link rel="stylesheet" type="text/css" href="../style/farms.css">
   </head>
    <body>
     <div class="title"> Farm project summer 2016 </div>
     <div class="menu">
         <div class="add"> <a href="addfarm.php"> Add farm </a></div>
     </div>

    <?php
      include "../phplib/database.php";
      $conn = dbconn();
      $sql = "SELECT * FROM farms";
      $result = $conn->query($sql);
      if (!$result) {
        echo "query error";
      }
      else {
        // create table
        echo "<table><tr><th>Name</th><th>Url</th><th>Location</th><th>Animals</th><th>Accomodation</th><th>job</th><th>Rate</th></tr>";
         while($row = $result->fetch_assoc()) {
           $name = $row["name"];
           $url = $row["url"];
           $id = $row["id"];
           $location = $row["location"];
         $animals = $row["animals"];
         $accomodation = $row["accomodation"];
         $job = $row["job"];
         $rate = $row["rate"];

          // output data of each row
        echo "<tr><td>" . $name. "</td>
        <td><a style=\"color:Snow;text-decoration:underline;\" href=" . $url . "> Visita la pagina </a></td>
        <td>" . $location . "</td>
        <td>" . $animals  . "</td>
        <td>" . $accomodation . "</td>
        <td>" . $job . "</td>
        <td>" . $rate . "</td>
        </tr>";
     }
     echo "</table>";

}


      $conn->close();
     ?>
    </body>
</html>
