<?php
  require("../../../config_vp2020.php");
  $database = "if20_anastasija_se";
  if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	  //loome andmebaasiga ühenduse
	  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	  //valmistan ette SQL käsu andmete kirjutamiseks
	  $stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES(?)");
	  echo $conn->error;
	  //i - integer, d - decimal, s - string 
	  $stmt->bind_param("s", $_POST["ideainput"]);
	  $stmt->execute();
	  $stmt->close();
	  $conn->close();
  }

//loen andmebaasist senised mõtted
  $ideahtml = "";
  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
  $stmt = $conn->prepare("SELECT idea FROM myideas");
  //seon tulemuse muutujaga
  $stmt->bind_result($ideafromdb);
  $stmt->execute();
  while($stmt->fetch()){
	  $ideahtml .= "<p>" .$ideafromdb ."</p>";
  }
  $stmt->close();
  $conn->close();

  require("header.php");
?>
   <form method="POST">
    <label>Kirjutage oma esimene pähe tulev mõte!</label>
	<input type="text" name="ideainput" placeholder="mõttekoht">
	<input type="submit" name="ideasubmit" value="Saade mõte teele!">
  </form>
  <hr>
  <?php echo $ideahtml; ?>
  
</body>
</html>

