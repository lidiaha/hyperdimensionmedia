<?php
  include "../../phplib/database.php";
  $conn = dbconn();
  if (isset($_POST["after"])) {
    $sql = "SELECT * FROM testchat WHERE time > ?";
    $prepared = $conn->prepare($sql);
    $prepared->bind_param("s", $_POST["after"]);
    $prepared->execute();
    $result = $prepared->get_result();
  }
  else {
    $sql = "SELECT * FROM testchat";
    $result = $conn->query($sql);
  }

  $rows = array();
  while($r = mysqli_fetch_assoc($result)) {
      array_push($rows, $r);
  }
  print json_encode($rows);
 ?>
