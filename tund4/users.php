<?php
require("../../../config_vp2020.php");

$firstnameinputerror = "";
$lastnameinputerror = "";
$genderinputerror = "";
$emailinputerror = "";
$passwordinputerror = "";
$passwordsecondaryinputerror = "";

//kas vajutati salvestusnuppu
if(isset($_POST["usersubmit"])){
    
    if (empty($_POST["firstnameinput"])){
        $firstnameinputerror = "Eesnimi on sisestamata! ";
    }
    if (empty($_POST["lastnameinput"])){
        $lastnameinputerror = "Perekonnanimi on sisestamata! ";
    }
    if (empty($_POST["genderinput"])){
        $genderinputerror .= "Sugu on sisestamata! "; 
    }
    if (strlen($_POST["passwordinput"]) < 8){
        $passwordinputerror = "Salasõna pikkus peab olema vähemalt 8 sümbolit! ";
    }
    if ($_POST["passwordsecondaryinput"] != $_POST["passwordinput"]){
        $passwordsecondaryinputerror = " Salasõnad ei klappi kokku! ";
    }

}

?>
<img src="../tund3/img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">

<ul>
 <li><a href="../tund3/home.php">Avalehele</a></li>
</ul>
<form method="POST">
  <label for="firstnameinput">Eesnimi</label>
  <input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi" value="<?php if (isset($_POST["firstnameinput"])){echo $_POST["firstnameinput"];} ?>">
  <span><?php echo $firstnameinputerror; ?></span>
  <br>
  <label for="lastnameinput">Perekonnanimi</label>
  <input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php if (isset($_POST["lastnameinput"])){echo $_POST["lastnameinput"];} ?>">
  <span><?php echo $lastnameinputerror; ?></span>
  <br>
  <label for="genderinput">Sugu</label>
  <input type="radio" name="genderinput" id="gendermale" value="1" <?php if(isset($_POST["genderinput"]) && $_POST["genderinput"] == 1){echo 'checked="checked"';};?>><label for="gendermale">Mees</label>
  <input type="radio" name="genderinput" id="genderfemale" value="2" <?php if(isset($_POST["genderinput"]) && $_POST["genderinput"] == 2){echo 'checked="checked"';};?>><label for="gendermale">Naine</label>
  <span><?php echo $genderinputerror; ?></span>
  <br>
  <label for="emailinput">E-posti aadress</label>
  <input type="email" name="emailinput" id="emailinput" placeholder="E-posti aadress" value="<?php if (isset($_POST["emailinput"])){echo $_POST["emailinput"];} ?>">
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
  <input type="submit" name="usersubmit" value="Loo uus kasutaja">
</form>
<hr>
</body>
</html>