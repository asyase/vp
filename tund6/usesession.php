<?php
  //session_start();
  
  require("../tund9/classes/SessionManager.class.php");
  //sessioonihaldus
  SessionManager::sessionStart("vp", 0, "/~anassel/", "localhost:5555");

  //kas on sisse loginud, kui pole, siis saadame sisselogimise lehele.
  if(!isset($_SESSION["userid"])){
	  header("Location: ../tund5/page.php");
	  exit();
  }
  
  //logime välja
  if(isset($_GET["logout"])){
    //lopetame sessiooni
    session_destroy();
    //jõuga suunatakse sisselogimise lehele
	  header("Location: ../tund5/page.php");
	  exit();
  }
  
  
?>
