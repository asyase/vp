<?php

//require("../tund6/usesession.php");
require("../../../config_vp2020.php");
require("../tund5/fnc_common.php");
require("../tund5/fnc_user.php");
require("../tund3/header.php");



//kas vajutati salvestusnuppu
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
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

if(isset($_POST["usersubmit"])){

    if (empty($_POST["firstnameinput"])){
        $firstnameinputerror = "Eesnimi on sisestamata! ";
    } else {
        $firstnameinput = $_POST["firstnameinput"];
    }
    if (empty($_POST["lastnameinput"])){
        $lastnameinputerror = "Perekonnanimi on sisestamata! ";
    } else {
        $lastnameinput = $_POST["lastnameinput"];
    }
    if (empty($_POST["genderinput"])){
        $genderinputerror .= "Sugu on sisestamata! ";
    } else {
        $genderinput = $_POST["genderinput"];
    }
    if (strlen($_POST["passwordinput"]) < 8){
        $passwordinputerror = "Salasõna pikkus peab olema vähemalt 8 sümbolit! ";
    }
    if ($_POST["passwordsecondaryinput"] != $_POST["passwordinput"]){
        $passwordsecondaryinputerror = " Salasõnad ei klappi kokku! ";
    }
    if(!empty($_POST["birthdayinput"])){
        $birthday = intval($_POST["birthdayinput"]);
    } else {
        $birthdayerror = "Palun vali sünnikuupäev!";
    }
    if(!empty($_POST["birthmonthinput"])){
        $birthmonth = intval($_POST["birthmonthinput"]);
    } else {
        $birthmontherror = "Palun vali sünnikuu!";
    }
    if (empty($_POST["emailinput"])){
        $emailinputerror = "Email on sisestamata! ";
    } else {
        $emailinput = $_POST["emailinput"];
    }

    if(!empty($_POST["birthyearinput"])){
        $birthyear = intval($_POST["birthyearinput"]);
    } else {
        $birthyearerror = "Palun vali sünniaasta!";
    }
    //kontrollime kuupäeva kehtivust (valiidsust)
    if(!empty($birthday) and !empty($birthmonth) and !empty($birthyear)){
        if(checkdate($birthmonth, $birthday, $birthyear)){
            $tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday);
            $birthdate = $tempdate->format("Y-m-d");
        } else {
            $birthdateerror = "Kuupäev ei ole reaalne!";
        }
    }
     
      if(empty($firstnameinputerror) and empty($lastnameinputerror) and 
        empty($genderinputerror) and empty($birthdayerror) and empty($birthmontherror) and 
        empty($birthyearerror) and empty($birthdateinputerror) and empty($emailinputerror) and 
        empty($passwordinputerror) and empty($secondarypasswordinputerror)) {
            if (isset($_POST["passwordinput"])) {
                $passwordinput = $_POST["passwordinput"];
            }
           $result = signup($firstnameinput, $lastnameinput, $emailinput, $genderinput, $birthdate, $passwordinput);
        }
}
?>
<img src="../tund3/img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">

<ul>
<li><a href="../tund3/home.php">Avalehele</a></li>
</ul>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="firstnameinput">Eesnimi</label>
  <input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi" value="<?php echo $firstnameinput; ?>">
  <span><?php echo $firstnameinputerror; ?></span>
  <br>
  <label for="lastnameinput">Perekonnanimi</label>
  <input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php if (isset($_POST["lastnameinput"])){echo $_POST["lastnameinput"];} ?>">
  <span><?php echo $lastnameinputerror; ?></span>
  <br>
  <label for="genderinput">Sugu</label>
  <input type="radio" name="genderinput" id="gendermale" value="1" <?php if(isset($_POST["genderinput"]) && $_POST["genderinput"] == 1){echo 'checked="checked"';};?>><label for="gendermale">Mees</label>
  <input type="radio" name="genderinput" id="genderfemale" value="2" <?php if(isset($_POST["genderinput"]) && $_POST["genderinput"] == 2){echo 'checked="checked"';};?>><label for="genderfemale">Naine</label>
  <span><?php echo $genderinputerror; ?></span>
  <br>
  <label for="birthdayinput">Sünnipäev: </label>
    <?php 
			echo '<select name="birthdayinput" id="birthdayinput">' ."\n";
			echo '<option value="" selected disabled>päev</option>' ."\n";
			for ($i = 1; $i < 32; $i++){
				echo '<option value="' .$i .'"';
				if ($i == $birthday){
					echo " selected ";
				}
				echo ">" .$i ."</option> \n";
			}
            echo "</select> \n";
	?>
	  <label for="birthmonthinput">Sünnikuu: </label>
	  <?php
	    echo '<select name="birthmonthinput" id="birthmonthinput">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i++){
			echo '<option value="' .$i .'"';
			if ($i == $birthmonth){
				echo " selected ";
			}
            echo ">" .$monthnameset[$i - 1] ."</option> \n";
        
		}
		echo "</select> \n";
	  ?>
	  <label for="birthyearinput">Sünniaasta: </label>
<?php
  echo '<select name="birthyearinput" id="birthyearinput">' ."\n";
  echo '<option value="" selected disabled>aasta</option>' ."\n";
  for ($i = date("Y") - 10; $i >= date("Y") - 110; $i--){
      echo '<option value="' .$i .'"';
      if ($i == $birthyear){
          echo " selected ";
      }
      echo ">" .$i ."</option> \n";
  }
  echo "</select> \n";
?>

<br>
<span><?php echo $birthdateerror ." " .$birthdayerror ." " .$birthmontherror ." " .$birthyearerror; ?></span>
<br>	    
  <label for="emailinput">E-posti aadress</label>
  <input type="email" name="emailinput" id="emailinput" placeholder="E-posti aadress" value="<?php echo $emailinput;?>">
  <span><?php echo $emailinputerror; ?></span>
  <br>
  <label for="passwordinput">Salasõna</label>
  <input type="password" name="passwordinput" id="passwordinput" placeholder="Salasõna">
  <span><?php echo $passwordinputerror; ?></span>
  <br>
  <label for="passwordsecondaryinput">Korda salasõna</label>
  <input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput" placeholder="Korda salasõna">
  <span><?php echo $passwordsecondaryinputerror; ?></span>
  <br>
  <br>
  <input type="submit" name="usersubmit" value="Loo uus kasutaja">
</form>
<hr>
</body>
</html>