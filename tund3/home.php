<?php
require("../tund6/usesession.php");
require("../tund3/header.php");

//kui pole sisseloginud
//if(!isset($_SESSION["userid"])){
  //jõugu sisselogimise lehele
  //header("Location:../tund5/page.php");
//}
//väljalogimine
//if(isset($_GET["logout"])){
  //session_destroy();
  // header("Location:../tund5/page.php");
  // exit();
//}

//require("../tund5/page.php");


$username = "Anastasija";
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$monthnow= date("n");
$partofday = "";
$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
$weekdaynow = date("N");
$daynow = date("d");
$yearnow = date("Y");
$timenow = date("H:i:s");


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

  require("header.php");

?>

<img src="./img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">

  <h1> <?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> programmeerib veebi </h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
  <p><a href="?logout=1">Logi välja</a>!</p>
  <ul>


<li><a href="postideas.php">Postita oma idee</a></li>
<li><a href="ideas.php">Ideed</a></li>
<li><a href="../tund4/listfilms.php">Filmide nimekirja vaatamine</a></li>
<li><a href="../tund4/addfilms.php">Filmide lisamine</a></li>
<li><a href="../tund4/users.php">Uue kasutaja loomine</a></li>
<li><a href="../tund6/userprofile.php">Minu kasutajaprofiil</a></li>
<li><a href="../tund6/datarelations.php">Filmiseosed</a></li>
</ul>

  <p> <em> Web programming </em> refers to the writing, markup and coding involved in Web development, which includes Web content, Web client and server scripting and network security.</p>
  <blockquote> <p>“Truth can only be found in one place: the code.”</p> <cite> "http://www.goodreads.com/quotes/tag/programming" </cite> </blockquote>
  <p>Lehe avamise hetkel oli: <?php echo $weekdaynameset[$weekdaynow - 1] . ", " . $daynow . ". " . $monthnameset[$monthnow - 1] . " " . $yearnow . " kell on " . $timenow; ?>.</p>
  <p><?php echo "parajasti on $partofday.";  ?></p>
  <hr>
  <p>Paevi semestris kokku: <?php echo $semesterdurationdays; ?></p>
  <p>Paevi semestri algusest: <?php echo $fromsemesterstartdays; ?></p>
  <p>Mitu protsenti oppetoost on tehtud: <?php echo $semesterpercent; ?> (%)</p>

 <?php require "randompic.php"; ?>

</body>
</html>
