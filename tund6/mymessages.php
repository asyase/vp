<?php
 require("usesession.php");
 require("../tund3/header.php");
 require("../../../config_vp2020.php");
 $database = "if20_anastasija_se";
 require("../tund5/fnc_common.php");
 require("../tund5/fnc_user.php");
 ?>
 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>Minu sõnumid</h1>
	<hr>
    <li><a href="../tund6/userprofile.php">Tagasi oma profiili juurde</a></li>
    <li><a href="../tund3/home.php">Avalehele</a></li>
    <li><a href="?logout=1">Logi välja</a>!</li>