
<?php
	require("../tund6/usesession.php");
	require("../../../config_vp2020.php");
	$database = "if20_anastasija_selevjorstova";
	$photoid = intval($_REQUEST["photo"]);
	$type = "image/png";
	$output = "../img/wrong.png";
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	$stmt = $conn->prepare("SELECT filename, userid, privacy FROM vpphotos WHERE vpphotos_id = ? AND deleted IS NULL");
	$stmt->bind_param("i",$photoid);
	$stmt->bind_result($filenamefromdb, $useridfromdb, $privacyfromdb);
	if($stmt->execute()){
		if($stmt->fetch()){
			if($useridfromdb == $_SESSION["userid"] or $privacyfromdb >= 2){
				$output = $photouploaddir_normal .$filenamefromdb;
				$check = getimagesize($output);
				$type = $check["mime"];
			} else {
				$type = "image/png";
				$output = "../img/no_rights.png";
			}
		}
	}
	$stmt->close();
	$conn->close();
	header("Content-type: " .$type);
    readfile($output);
    //header("Content-type: image/jpeg");
//readfile("/home/anassel/public_html/vp/photoupload_normal" .$_REQUEST["photo"]);
//require("usesession.php");  //see rikkus osadel tudengitel töö ära!?
	//$dir = "../photoupload_normal/";

	
