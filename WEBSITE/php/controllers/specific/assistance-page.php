<?php
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/database.php";
   include_once $_SERVER['DOCUMENT_ROOT'] . "/phplib/image-auto-extension.php";
   $conn = dbconn();

   function printFaq($conn, $assistance_id) {
      $sql = "SELECT * FROM assist_faq WHERE id_assistance='$assistance_id' ";
      $result = $conn->query($sql);
      if (!$result) {
         echo "query error";
      }
      else {
         if($result->num_rows!=0){
            echo "<fieldset class='faqbox'><legend>FAQ</legend><div class='faqinnerbox'>\n";
            while($row = $result->fetch_assoc()) {
               $question = $row["question"];
               $_answer = $row["answer"];
               $answer = preg_replace("/\n/", "<br>", $_answer);
               echo "<div class='faqitem'>\n";
               echo "<div class='faq_question'>$question</div>\n";
               echo "<div class='faq_answer'>$answer</div>\n</div>\n";
            }
         echo "</div></fieldset>\n";
         }
      }
   }

   $assistance_id = mysqli_real_escape_string($conn, $_GET["id"]);

   $sql = "SELECT * FROM assistance WHERE id='$assistance_id' ";
   $result = $conn->query($sql);
   if (!$result) {
      echo "query error";
   }
   else {
      while($row = $result->fetch_assoc()) {
         $name = $row["name"];
         $description = $row["description"];
         echo "<div class='name'>$name</div>\n";
         echo "<div class='products'><a href='/pages/devices-for-assis.php?assistance_id=$assistance_id'> Scopri i prodotti interessati </a></div>";
         echo "<div class='description'><p>$description</p></div>\n";
         printFaq($conn, $assistance_id);
         echo "<div class='doorstopper'></div>\n";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include $_SERVER['DOCUMENT_ROOT'] . "/ui-elements/no-results.html";
      }
   }
   $conn->close();
?>