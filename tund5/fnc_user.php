<?php
$database = "if20_anastasija_se";

  function signup($firstname, $lastname, $email, $gender, $birthdate, $password){
	$result = null;
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
	echo $conn->error;
//krüpteerime salasõna
	$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
$stmt->bind_param("sssiss", $firstname, $lastname, $birthdate, $gender, $email, $pwdhash);
if($stmt->execute()){
		$notice = "ok";
	} else {
		$notice = $stmt->error;
        }
        $stmt->close();
	$conn->close();
	return $result;
}
 function signin($email, $password){
	$result = null;
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT password FROM vpusers WHERE email = ?");
	echo $conn->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($passwordfromdb);
        if($stmt->execute()){
		//kui tehniliselt korras
                if($stmt->fetch()){
			//kasutaja on olemas
			if(password_verify($password, $passwordfromdb)){
				//parool õige,sisselogimine
				$stmt->close();
				$conn->close();
				header("Location: home.php");
				exit();

                        } else {
				$result = "Vale salasõna!";
			}
		} else {
			$result = "Sellist kasutajat (" .$email .") pole!";
		}
	} else {
		//tehniline viga
		$result = $stmt->error;
	}
	$stmt->close();
	$conn->close();
	return $result;
  }
