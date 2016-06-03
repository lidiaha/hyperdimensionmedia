<html>
  <head>
    <title>Add farm</title>
	<link rel="stylesheet" type="text/css" href="../style/farms.css">
  </head>
  <body>
    <?php
	
      include "../phplib/database.php";
      if (isset($_POST["name"]) && isset($_POST["url"]) && isset($_POST["location"]) &&
	  isset($_POST["animals"]) && isset($_POST["accomodation"]) && isset($_POST["job"]) && isset($_POST["rate"])> 0) {

        $conn = dbconn();
		
        $sql = "INSERT INTO farms (name, url, location, animals , accomodation , job , rate) VALUES (?, ?, ?, ? , ?, ?, ?)";
        $prepared = $conn->prepare($sql);
        $prepared->bind_param("ssssssi", $_POST["name"], $_POST["url"], $_POST["location"],
		                                      $_POST["animals"], $_POST["accomodation"], $_POST["job"], $_POST["rate"] );
        $prepared->execute();
        $conn->close();

        echo "<h1>Farm added!</h1><br><a href=\"muuuu.php\">GO SEE</a>";
      }
      else {
     ?>
    <h1>Insert data of a new awsome farm</h1>
	<div style="background-color:MintCream;width:50%;">
    <form action="addfarm.php" method="post" >
	<label for="name">Name</label>
    <input type="textbox" id="name" name="name" required="true"><br>
	<label for="url">Url</label>
    <input type="textbox" id="url" name="url" required="true"><br>
	<label for="location">Location</label>
	<input type="textbox" id= "location"name="location" required="true"><br>
	<label for="animals">Animals</label>
	<input type="textbox" id="animals" name="animals"><br>
	<label for="accomodation">Accomodation</label>
    <input type="textbox" id= "accomodation" name="accomodation" required="true"><br> 
	<label for="job">Job</label>
    <input type="textbox" id ="job" name="job" required="true"><br>	 
	<label for="rate">Rate</label>
    <input type="number" id= "rate" name="rate" required="true" min="1" max="10"><br>	   
      <input type="submit" value="Submit">
    </form>
	</div>
	<?php
      }
     ?>
  </body>
</html>
