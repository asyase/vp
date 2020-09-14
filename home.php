<?php
$username = "Anastasija";
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$partofday = "";

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
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title><?php echo $username; ?> programmeerib veebi</title>

</head>
<body>
  <h1>Anastasija Selevjorstova </h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
  <p> <em> Web programming </em> refers to the writing, markup and coding involved in Web development, which includes Web content, Web client and server scripting and network security.</p>
  <blockquote> <p>“Truth can only be found in one place: the code.”</p> <cite> "http://www.goodreads.com/quotes/tag/programming" </cite> </blockquote>
  <p>Lehe avamise hetkel oli: <?php echo $fulltimenow; ?>.<p>
  <p><?php echo "parajasti on $partofday.";  ?></p>
  
  <hr>

  <p>Paevi semestris kokku: <?php echo $semesterdurationdays; ?></p>
  <p>Paevi semestri algusest: <?php echo $fromsemesterstartdays; ?></p>
  <p>Mitu protsenti oppetoost on tehtud: <?php echo $semesterpercent; ?> (%)</p>


</body>
<h2>love peace unity </h2>
</html>
