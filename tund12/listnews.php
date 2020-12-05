<?php
  require("../tund6/usesession.php");
  require("../../../config_vp2020.php");
  require("fnc_news.php");
  
  $tolink = '<link rel="stylesheet" type="text/css" href="../tund10/styles/news.css">' ."\n";

 // -------------------------------------------//uudiste ja fotode kustutamine----------------------------------

  if (isset($_GET['deletenews'])) {
    $newsToDelete = (int)$_GET['deletenews'];
    $newsToDeleteInfo = readNewsToEdit($newsToDelete);
    
    unlink($photouploaddir_news . $newsToDeleteInfo['filename']);
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $conn->query("DELETE FROM vpnews WHERE vpnews_id = ". $newsToDeleteInfo['id']);
    $conn->query("DELETE FROM vpnewsphotos WHERE vpnewsphotos_id = ". $newsToDeleteInfo['photoid']);

    header("Location: listnews.php");
    exit;
  }
 // ----------------------------------------------------------------------------------------------------------------------------

  require("../tund3/header.php");
?>
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
    <li><a href="?logout=1">Logi välja</a>!</li>
    <li><a href="../tund3/home.php">Avalehele</a></li>
  </ul>
  
  <hr>
  <h2>Toimeta uudiseid</h2>
  <div id="newslist">
	<?php
		echo listAllNewsToEdit();
	?>
  </div>
  
</body>
</html>