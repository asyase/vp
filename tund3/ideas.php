<?php

  require("../../../config_vp2020.php");
  $database = "if20_anastasija_se";
  

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
<p><a href="home.php">Avalehele</a></p>  
  <?php echo $ideahtml; ?>
  
</body>
</html>

