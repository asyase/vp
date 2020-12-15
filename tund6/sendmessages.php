<?php
 require("usesession.php");
 require("../tund3/header.php");
 require("../../../config_vp2020.php");
 $database = "if20_anastasija_se";
 require("../tund5/fnc_common.php");
 require("../tund5/fnc_user.php");
  $notice = null;

  
  if (isset($_POST["submitMessage"])){
	if ($_POST["message"] != "Kirjuta siia oma sõnum ..." and !empty($_POST["message"])) {
	  $notice = "Sõnum olemas!";
      $notice = saveAMsg($_POST["message"]);	  
	} else {
	  $notice = "Palun kirjutage sõnum!";
	}
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>Sõnumite saatmine</h1>
	<hr>
    <li><a href="../tund6/userprofile.php">Tagasi oma profiili juurde</a></li>
    <li><a href="../tund3/home.php">Avalehele</a></li>
    <li><a href="?logout=1">Logi välja</a>!</li>
		
		</a>
        </ul>
 
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Sõnum (max 256 märki):</label>
	  <br>
	  <textarea rows="4" cols="64" name="message" id="messagesinput" placeholder="Sisesta siia oma sõnum"></textarea>
	  <br>
	  <input name="submitMessage" type="submit" value="Saada sõnum">
	</form>
	<br>
	<p>
	<?php
	  echo $notice;
	?>
    </p>
	<hr>
	
	
  </body>
</html>