<?php
  $database = "if20_anastasija_se";
  
  function storenewsinfo($newstitle, $newstext){
	  $notice = null;
	  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("INSERT INTO vpnews (userid, title, content) VALUES(?,?,?)");
	  echo $conn->error;
	  $stmt->bind_param("issi", $_SESSION["userid"], $newstitle, $newstext);
	  if($stmt->execute()){
		  $notice = 1;
	  } else {
		  $notice = 0;
	  }
	  
	  $stmt->close();
	  $conn->close();
	  return $notice;
  }




?>