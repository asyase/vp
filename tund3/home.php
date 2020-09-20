<?php

  //var_dump($_POST);
  require("../../../../config_vp2020.php");
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
  
$username = "Anastasija";
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$partofday = "";
$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
$weekdaynow = date("N");

// hommik 9 - 12
// louna 12 - 15
// ohtu oode 15 - 17
// ohtu  17 - 21
// chill 21 - <= 23 
// oo 0 - 9

if ($hournow >= 9 && $hournow < 12) {
  $partofday = "hommik";
}

if ($hournow >= 12 && $hournow < 15) {
  $partofday = "louna";
}

if ($hournow >= 15 && $hournow < 17) {
  $partofday = "ohtu oode";
}

if ($hournow >= 17 && $hournow < 21) {
  $partofday = "ohtu";
}

if ($hournow >= 21 && $hournow <= 23) {
  $partofday = "chill";
}

if ($hournow == 0 || $hournow < 9) {
  $partofday = "oo";
}

  
//vaatame semestri kulgemist
$semesterstart = new DateTime("2020-08-31");
$semesterend = new DateTime("2020-12-13");
//selgitame välja nende vahe ehk erinevuse
$semesterduration = $semesterstart->diff($semesterend);
//leiame selle päevade arvuna 
$semesterdurationdays = $semesterduration->format("%r%a");
//tänane päev
$today = new DateTime("now");
//if ($fromsemesterstartdays <0) (semester pole peale hakanud
//Kui päevad on labi siis utle et oppetoo on labi ja pane echo kasuga valja kuskile
$fromsemesterstart = $semesterstart->diff($today);
$fromsemesterstartdays = $fromsemesterstart->format("%r%a");
$semesterpercent = ($fromsemesterstartdays * 100)/$semesterdurationdays;

if ($fromsemesterstartdays < 0) {
  $fromsemesterstartdays = "semester veel peale hakanud";
}

if ($fromsemesterstartdays >= $semesterdurationdays) {
  $fromsemesterstartdays = "semester lõpenud";
}

if ($fromsemesterstartdays > 0) {
  $fromsemesterstartdays = $fromsemesterstartdays . " (semester täies hoos).";
}

if ($semesterpercent <= 0) {
  $semesterpercent = "semester pole veel alanud";
}

if ($semesterpercent == 100) {
  $semesterpercent = "semester sai labi"; 
}


//loeme kataloogist piltide nimekirja
  $allfiles = scandir("../vp_pics/");
  //echo $allfiles;
  //var_dump($allfiles);
  $picfiles = array_slice($allfiles, 2);
  //var_dump($picfiles);
  $imghtml = "";
  $piccount = count($picfiles);
  //$i = $i + 1;
  //$i ++;
  //$i += 3
  for($i = 0;$i < $piccount; $i ++){
	  //<img src="../img/pildifail" alt="tekst">
	  $imghtml .= '<img src="../vp_pics/' .$picfiles[$i] .'" alt="Tallinna Ülikool">';
  }
  require("header.php");
?>


<img src="../img/vp_banner (1).png" alt="Veebiprogrammeerimise kursuse logo">
  <h1>Anastasija Selevjorstova </h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
  <p> <em> Web programming </em> refers to the writing, markup and coding involved in Web development, which includes Web content, Web client and server scripting and network security.</p>
  <blockquote> <p>“Truth can only be found in one place: the code.”</p> <cite> "http://www.goodreads.com/quotes/tag/programming" </cite> </blockquote>
  <p>Lehe avamise hetkel oli: <?php echo $weekdaynameset[$weekdaynow - 1] .", " .$fulltimenow; ?>.</p>
  <p><?php echo "parajasti on $partofday.";  ?></p>
  <hr>
  <p>Paevi semestris kokku: <?php echo $semesterdurationdays; ?></p>
  <p>Paevi semestri algusest: <?php echo $fromsemesterstartdays; ?></p>
  <p>Mitu protsenti oppetoost on tehtud: <?php echo $semesterpercent; ?> (%)</p>
  <hr>
  <?php echo $imghtml; ?>
  <hr>
   <form method="POST">
    <label>Kirjutage oma esimene pähe tulev mõte!</label>
	<input type="text" name="ideainput" placeholder="mõttekoht">
	<input type="submit" name="ideasubmit" value="Saade mõte teele!">
  </form>
  <hr>
  <?php echo $ideahtml; ?>
  
</body>
<h2>love peace unity </h2>
</html>


