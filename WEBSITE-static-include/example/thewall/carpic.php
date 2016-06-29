<?php
  include "../phplib/database.php";

  function showerr() {
    $fname = "../images/fnf.png";
    $fp = fopen($fname, 'rb');
    header("Content-Type: image/png");
    header("Content-Length: " . filesize($fname));
    fpassthru($fp);
  }

  if (isset($_GET['id'])) {
    $carid = $_GET['id'];
    $conn = dbconn();
    $sql = "SELECT name,pic FROM testable WHERE id=?";
    $prepared = $conn->prepare($sql);
    $prepared->bind_param("i", $carid);
    $prepared->execute();

    if ($prepared) {
      $prepared->store_result();
      $prepared->bind_result($name, $pic);
      $content = "";
      header("Content-Type: image/png");
      while($prepared->fetch()) {
        $content = $pic;
        break;
      }
      if (strlen($content) == 0) {
        showerr();
      } else {
        header("Content-Length: " . strlen($content));
        echo $content;
      }
    }
    else {
      showerr();
    }
  } else {
    showerr();
  }


  $conn->close();
 ?>
