<?php
  require("../tund6/usesession.php");
  require("../../../config_vp2020.php");
  require("../tund9/fnc_photo.php");
  
  $notice = "";
  $fileuploaddir_orig = "../tund8/photoupload_orig/";
  $fileuploaddir_normal = "../tund8/photoupload_normal/";
  $fileuploaddir_thumb = "..tund9/classes/photoupload_thumb/";
  
  $publicphotothumbshtml = readAllPublicPhotoThumbs();
    
  require("../tund3/header.php");
?>
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <ul>
   <li><a href="../tund3/home.php">Avalehele</a></li>
   <li><a href="?logout=1">Logi välja</a>!</li>
  </ul>
  <hr>
  <h2>Fotogalerii</h2>
  <?php
	echo $publicphotothumbshtml;
  ?>
  
  <hr>  
</body>
</html>

