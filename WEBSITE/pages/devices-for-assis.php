<!DOCTYPE html>
<html>
   <head>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/viewport.html"; ?>
      <link rel="stylesheet" type="text/css" href="/style/home.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/mobile/home.css" media="screen and (max-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/transitionpage.css" media="screen and (min-width: 480px)">
      <link rel="stylesheet" type="text/css" href="/style/list.css" media="screen and (min-width: 480px)">
      <script src="/jslib/jquery-1.11.0.min.js"></script>
      <script src="/jslib/parallax.min.js"></script>
      <?php
         include_once $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/page-identify.php";
         pageIdentify("related devices");
       ?>
   </head>
   <body>
      <div id="supercontainer">
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/topbar.html"; ?>
         <div id="contentwrapper" class="parallax-window" data-parallax="scroll" data-image-src="/pictures/bg-scroll-sea-2.jpg">
            <div id="maincontent">
               <?php
                  include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
                  include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
                  $conn = dbconn();
                  $conn2 = dbconn();

                  $assistance_id = mysqli_real_escape_string($conn, $_GET["assistance_id"]);

                  function findMatch($tags, $tags2) {
                     if($tags!=null){
                        foreach($tags as $tag){
                           foreach($tags2 as $tag2){
                              if($tag==$tag2){
                                 return true;
                              }
                           }
                        }
                        return false;
                     }
                  }

               ?>
               <div class="gobackbar" onclick="location.href='/pages/assistance-page.php?id=<?php echo $assistance_id; ?>'">
                  <div class="arrowback"></div>
                  <div class="labelback">Torna al servizio di assistenza</div>
               </div>
               <?php
                  $sql = "SELECT typetags FROM assistance WHERE id='$assistance_id'";
                  $result = $conn->query($sql);
                  if (!$result) {
                     echo "query error";
                  }
                  else {
                     while($row = $result->fetch_assoc()) {
                        $typetags= $row["typetags"];
                        $tags = explode(";",$typetags);
                        $sql2 = "SELECT * FROM devices";
                        $result2 = $conn2->query($sql2);
                        if (!$result2) {
                           echo "query error";
                        }
                        else {
                           $ret = array();
                           echo "<div class='dummyheader'></div>\n";
                           while($row2 = $result2->fetch_assoc()) {
                              $typetags2= $row2["typetags"];
                              $device_id= $row2["id"];
                              $image = imageAutoExtension("/pictures/products/devices/", $row2["id"]);
                              $name = $row2["name"];
                              $tags2 = explode(";",$typetags2);
                              if(findMatch($tags, $tags2)){
                                 echo "<div class='item'>";
                                 echo "<div class='pic' style='background-image: url(\"$image\")'></div>\n";
                                 echo "<div class='name'><a href='/pages/device-presentation.php?device_id=$device_id' >$name</a></div>\n";
                                 echo "</div>\n";
                              }
                           }
                        }
                        echo "<div class='doorstopper'></div>\n";
                     }
                     echo "\n";
                     if (mysqli_num_rows($result) == 0) {
                        include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/no-results.html";
                     }
                  }
                  $conn->close();
               ?>
            </div>
         </div>
      <!-- <div id="footer"> -->
      </div>
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/social-icons.html"; ?>
   </body>
</html>
