<?php

$dbconfigmode = "developement";

function dbconn() {
   global $dbconfigmode;
   if ($dbconfigmode == "developement"){
      $servername = "localhost";
      $username = "timuser";
      $password = "timuser";
      $dbname = "timdb";
   } else { // production
      $servername = "localhost";
      $username = "<username here>";
      $password = "<password here>";
      $dbname = "my_ultim8";
   }

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
   mysqli_set_charset($conn, 'utf8');
   return $conn;
}
 ?>
