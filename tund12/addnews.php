<?php
  require("../tund6/usesession.php");
  require("../../../config_vp2020.php");
  // require("fnc_photo.php");
  require("../tund5/fnc_common.php");
  require("fnc_news.php");
  // require("classes/Photoupload_class.php");

  $tolink = "\t" .'<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>' ."\n";
  $tolink .= "\t" .'<script>tinymce.init({selector:"textarea#newsinput", plugins: "link", menubar: "edit",});</script>' ."\n";

  $inputerror = "";
  $notice = null;
  $news = null;
  $newstitle = null;
  
  //kas vajutati salvestusnuppu
  if(isset($_POST["newssubmit"])){
	if(strlen($_POST["newstitleinput"]) == 0){
		$inputerror = "Uudise pealkiri on puudu!";
	} else {
		$newstitle = test_input($_POST["newstitleinput"]);
	}
	if(strlen($_POST["newsinput"]) == 0){
		$inputerror .= " Uudise sisu on puudu!";
	} else {
		$news = test_input($_POST["newsinput"]);
		//htmlspecialchars teisendab html noolsulud.
		//nende tagasisaamiseks htmlspecialchars_decode(uudis)
	}
	
	if(empty($inputerror)){
		//uudis salvestada
		$storenews = storenewsinfo($newstitle, $news);
		if($storenews == 1){
			$notice = "<p>Uudise salvestamine õnnestus! </p>";
		} else {
			$notice = "<p>Kahjuks uudise salvestamine ebaõnnestus! </p>";
		}
	}
  }

  require("../tund3/header.php");
?>
 <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<img src="../tund3/img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <ul>
	<li><a href="../tund3/home.php"> Avaleht </a></li> <br>
	<li><a href="?logout=1">Logi välja</a>!</li> <br>
  </ul>
  
  <hr>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <label for="newstitleinput">Sisesta uudise pealkiri</label>
	<input id="newstitleinput" name="newstitleinput" type="text" value="<?php echo $newstitle; ?>" required>
	<br>
	<label for="newsinput">Kirjuta uudis</label>
	<textarea id="newsinput" name="newsinput"><?php echo $news; ?></textarea>
	
	<br>
		
	<input type="submit" id="newssubmit" name="newssubmit" value="Salvesta uudis">
  </form>
  <p id="notice">
  <?php
	echo $inputerror;
	echo $notice;
  ?>
  </p>
  
</body>
</html>