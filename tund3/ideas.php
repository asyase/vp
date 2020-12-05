<?php

  require("../../../config_vp2020.php");
  require("../tund6/usesession.php");
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
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
<p><li><a href="home.php">Avalehele</a></li></p>  
</ul>
<li><a href="?logout=1">Logi välja</a>!</li>
	</ul>

  <?php echo $ideahtml; ?>
  
</body>
</html>

