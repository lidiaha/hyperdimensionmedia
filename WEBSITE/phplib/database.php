<?php
  function dbconn() {
    $servername = "localhost";
    $username = "timuser";
    $password = "timuser";
    $dbname = "timdb";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }
 ?>
