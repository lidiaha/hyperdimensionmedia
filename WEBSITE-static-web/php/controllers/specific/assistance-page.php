<?php
   set_include_path(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, get_include_path().PATH_SEPARATOR.str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'])));
   include_once "phplib/database.php";
   include_once "phplib/image-auto-extension.php";
   header('Access-Control-Allow-Origin: *');
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
	
	function getResults($conn, $assistance_id) {
      $sql = "SELECT tags FROM assistance WHERE id='$assistance_id'";
      $result = $conn->query($sql);
      if (!$result) {
         echo "query error";
      }
      else { 
		   while($row = $result->fetch_assoc()) {
            $tags= $row["tags"];
            $tags = explode(";",$tags);
            $sql2 = "SELECT * FROM devices";
            $result2 = $conn->query($sql2);
            if (!$result2) {
               echo "query error";
            }
            else {
               while($row2 = $result2->fetch_assoc()) {
                  $tags2 = explode(";", $row2["tags"]);
                  if(findMatch($tags, $tags2)){
						   return true;
					   }
               }
            }
         }
      return false;
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
			if(getResults($conn, $assistance_id)){
			   echo "<div class='products'><a href='/pages/devices-for-assis.html?assistance_id=$assistance_id'> Scopri i prodotti interessati </a></div>";
		   }
			else {
			   echo "<div class='products'><a> >Nessun prodotto interessato </a></div>";
			}
         echo "<div class='description'><p>$description</p></div>\n";
         printFaq($conn, $assistance_id);
         echo "<div class='doorstopper'></div>\n";
      }
      echo "\n";
      if (mysqli_num_rows($result) == 0) {
         include "ui-elements/no-results.html";
      }
   }
   $conn->close();
?>