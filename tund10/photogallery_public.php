<?php
  require("../tund6/usesession.php");
  require("../../../config_vp2020.php");
  require("../tund9/fnc_photo.php");
  
  $notice = "";

  $gallerypagelimit = 16;
  $page = 1;
  $photocount = countPublicPhotos(2);
  
  if(!isset($_GET["page"]) or $_GET["page"] < 1){
	  $page = 1;
  } elseif((intval($_GET["page"]) - 1) * $gallerypagelimit >= $photocount){
	  $page = ceil($photocount/$gallerypagelimit);
  } else {	  
	  $page = intval($_GET["page"]);
  }
  
  //$publicphotothumbshtml = readAllPublicPhotoThumbs(2);
  $publicphotothumbshtml = readAllPublicPhotoThumbsPage(2, $gallerypagelimit, $page);
  
  $tolink = '<link rel="stylesheet" type="text/css" href="styles/gallery.css">' ."\n";
  $tolink .= '<link rel="stylesheet" type="text/css" href="styles/modal.css">' ."\n";
  $tolink .= '<script src="../tund11/javascript/modal.js" defer></script>' ."\n";
    
  require("../tund3/header.php");
?>
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <ul>
   <li><a href="../tund3/home.php">Avalehele</a></li>
   <li><a href="?logout=1">Logi välja</a>!</li>
  </ul>

  <!--Modaalaken fotogalerii jaoks-->
  <div id="modalarea" class="modalarea">
	<!--sulgemisnupp-->
	<span id="modalclose" class="modalclose">&times;</span>
	<!--pildikoht-->
	<div class="modalhorizontal">
		<div class="modalvertical">
			<p id="modalcaption"></p>
      <img id="modalimg" src="../img/empty.png" alt="galeriipilt">
			 
      <br>
			<div id="rating" class="modalRating">
				<label><input id="rate1" name="rating" type="radio" value="1">1</label>
				<label><input id="rate2" name="rating" type="radio" value="2">2</label>
				<label><input id="rate3" name="rating" type="radio" value="3">3</label>
				<label><input id="rate4" name="rating" type="radio" value="4">4</label>
				<label><input id="rate5" name="rating" type="radio" value="5">5</label>
				<button id="storeRating">Salvesta hinnang!</button>
				<br>
				<p id="avgRating"></p>
			</div>
			
		</div>
	</div>
  </div>
      

  <hr>
  <h2>Fotogalerii</h2>
  <p>
	<?php
		if($page > 1){
			echo '<span><a href="?page=' .($page - 1) .'">Eelmine leht</a></span> | ' ."\n";
		} else {
			echo '<span>Eelmine leht</span> | ' ."\n";
		}
		if($page * $gallerypagelimit < $photocount){
			echo '<span><a href="?page=' .($page + 1) .'">Järgmine leht</a></span>' ."\n";
		} else {
			echo '<span>Järgmine leht</span>' ."\n";
		}
	?>
  </p>
  <?php
	echo $publicphotothumbshtml;
  ?>
  
  <hr>  
