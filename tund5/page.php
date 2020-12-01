<?php
//session_start();

require("../tund9/classes/SessionManager.class.php");
//sessioonihaldus

SessionManager::sessionStart("vp", 0, "/~anassel", "localhost:5555");

require("../../../config_vp2020.php");
require ("fnc_user.php");
require ("fnc_common.php");
require ("../tund9/fnc_photo.php");
require ("../tund12/fnc_news.php");

$result = "";
$username = "";
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

$firstnameinput = "";
$lastnameinput = "";
$genderinput = "";
$emailinput = "";
$passwordinput = "";
$passwordsecondaryinput = "";

$firstnameinputerror = "";
$lastnameinputerror = "";
$genderinputerror = "";
$emailinputerror = "";
$passwordinputerror = "";
$passwordsecondaryinputerror = "";

$birthday = null;
$birthmonth = null;
$birthyear = null;
$birthdate = null; 
$birthdayerror = null;
$birthmontherror = null;
$birthyearerror = null;
$birthdateerror= null; 
$notice = "";


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
  $partofday = "lõuna";
}

if ($hournow >= 15 && $hournow < 17) {
  $partofday = "õhtu oode";
}

if ($hournow >= 17 && $hournow < 21) {
  $partofday = "õhtu";
}

if ($hournow >= 21 && $hournow <= 23) {
  $partofday = "chill";
}

if ($hournow == 0 || $hournow < 9) {
  $partofday = "öö";
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

//Kui päevad on labi siis utle et oppetoo on labi ja pane echo kasuga valja kuskile
$fromsemesterstart = $semesterstart->diff($today);
$fromsemesterstartdays = $fromsemesterstart->format("%r%a");
$semesterpercent = ($fromsemesterstartdays * 100)/$semesterdurationdays;

if ($fromsemesterstartdays < 0) {
  $fromsemesterstartdays = "semester veel peale hakanud";
}

if ($fromsemesterstartdays >= $semesterdurationdays) {
  $fromsemesterstartdays = "Semester on lõpenud";
}

if ($fromsemesterstartdays > 0) {
  $fromsemesterstartdays = $fromsemesterstartdays . " (semester täies hoos).";
}

if ($semesterpercent <= 0) {
  $semesterpercent = "Semester pole veel alanud";
}

if ($semesterpercent == 100) {
  $semesterpercent = "Semester sai labi";
}

if(isset($_POST["usersubmit"])){
if (!empty($_POST["emailinput"])){
//$email = test_input($_POST["emailinput"]);
  $email = filter_var($_POST["emailinput"], FILTER_SANITIZE_EMAIL);
if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $email = filter_var($email, FILTER_VALIDATE_EMAIL);
  } else {
  $emailinputerror = "Palun sisesta õige kujuga e-postiaadress!";
  }		
  } else {
    $emailinputerror = "Palun sisesta e-postiaadress!";
  }
    if (empty($_POST["passwordinput"])){
  $passwordinputerror = "Palun sisesta salasõna!";
  } else {
    if(strlen($_POST["passwordinput"]) < 8){
      $passwordinputerror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
    }
  }

  if(empty($emailinputerror) and empty($passwordinputerror)){
    echo "jass!" .$email .$_POST["passwordinput"];
    $notice = signin($email, $_POST["passwordinput"]);
  }
}

require("../tund3/header.php");
print_r($_SESSION);
?>

<img src="../tund3/img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
<h1><?php echo $username; ?> programmeerib veebi</h1> 
<p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
<ul>
<p><em> Web programming </em> refers to the writing, markup and coding involved in Web development, which includes Web content, Web client and server scripting and network security.</p>
<blockquote><p>“Truth can only be found in one place: the code.”</p></blockquote>

<hr>
<h1>Logi sisse siin</h1> 
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label for="emailinput">E-posti aadress</label>
  <input type="email" name="emailinput" id="emailinput" placeholder="E-posti aadress" value="<?php echo $emailinput;?>">
  <span><?php echo $emailinputerror; ?></span>
  <br>
  <label for="passwordinput">Salasõna</label>
  <input type="password" name="passwordinput" id="passwordinput" placeholder="Salasõna">
  <span><?php echo $passwordinputerror; ?></span>
  <br>
  <br>
  <input type="submit" name="usersubmit" value="Logi sisse"><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>

</form> 
  <hr>
<ul>
<li><a href="../tund4/users.php">Uue kasutaja loomine</a></li>
</ul>
<p>Lehe avamise aeg: <?php echo $weekdaynameset[$weekdaynow - 1] . ", " . $daynow . ". " . $monthnameset[$monthnow - 1] . " " . $yearnow . " " . $timenow; ?>.</p>
  <p><?php echo "parajasti on $partofday.";  ?></p>
  <hr>
  <p>Päevi semestris kokku: <?php echo $semesterdurationdays; ?></p>
  <p>Päevi semestri algusest: <?php echo $fromsemesterstartdays; ?></p>
  <p>Mitu protsenti õppetoost on tehtud: <?php echo $semesterpercent; ?> (%)</p>
<hr>

<?php
  //loeme kataloogist piltide nimekirja
  $allfiles = scandir("../tund3/vp_pics/");
  $picfiles = array_slice($allfiles, 2);
  $imghtml = "";
  $piccount = count($picfiles);
  $imghtml .= '<img src="../tund3/vp_pics/' . $picfiles[mt_rand(1,$piccount)-1] . '">'; 
  require("../tund3/header.php");
  ?>

  <?php echo $imghtml; ?>


</body>
</html>