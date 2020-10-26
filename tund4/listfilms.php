<?php
  require("../../../config_vp2020.php");
  require("../tund6/usesession.php");
  require("../tund4/fnc_film.php");
  $database = "if20_anastasija_se";
//loen andmebaasist filmide info

  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
  $conn->query("SET NAMES 'utf8'");
  //$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
  $stmt = $conn->prepare("SELECT * FROM film");
  //seon tulemuse muutujaga
  $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
  $stmt->execute();
  $filmhtml = "\t <ol> \n";
  while($stmt->fetch()){
	  $filmhtml .= "\t \t <li>" .$titlefromdb ."\n";
	  $filmhtml .= "\t \t \t  <ul> \n";
	  $filmhtml .= "\t \t \t \t <li>Aasta: " .$yearfromdb ."</li> \n";
	  $filmhtml .= "\t \t \t \t <li>Kestus: " .$durationfromdb ." minutit</li> \n";
	  $filmhtml .= "\t \t \t \t <li>Žanr: " .$genrefromdb ."</li> \n";
	  $filmhtml .= "\t \t \t \t <li>Tootja: " .$studiofromdb ."</li> \n";
	  $filmhtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
	  $filmhtml .= "\t \t \t  </ul> \n";
	  $filmhtml .= "\t \t</li> \n";
  }
  $filmhtml .= "\t </ol> \n";
  $stmt->close();
  $conn->close();


  $username = "Anastasija";
  require("../tund3/header.php");
?>

  <img src="../tund3/img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <ul>
<p><li><a href="../tund3/home.php">Avalehele</a></li></p>  
</ul>
<li><a href="?logout=1">Logi välja</a>!</li>
</ul>
  <?php echo $filmhtml; ?>
</body>
</html>
