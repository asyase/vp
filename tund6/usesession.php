<?php
//session_start();
require("../tund9/classes/SessionManager.class.php");
SessionManager::sessionStart("vp", 0, "/~anassel/", "greeny.cs.tlu.ee");

    //logime välja
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: ../tund5/page.php");
	  exit();
  }
  
  //kas on sisseloginud, kui pole, saadame sisselogimise lehele
  if(!isset($_SESSION["userid"])){
	  header("Location:../tund5/page.php");
	  exit();
  }
