<?php
  include "../../phplib/database.php";
  if (isset($_POST["user"]) && isset($_POST["message"]) && isset($_POST["emote"])) {

    $username = filter_var($_POST["user"], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    $emote = filter_var($_POST["emote"], FILTER_SANITIZE_STRING);

    $conn = dbconn();
    $sql = "INSERT INTO testchat (user, time, message, emote) VALUES (?, NOW(), ?, ?)";
    $prepared = $conn->prepare($sql);
    $prepared->bind_param("sss", $username, $message, $emote);
    $prepared->execute();
    $conn->close();

    echo "ok";
  }
  else {
    echo "error: missing parameter";
  }
 ?>
