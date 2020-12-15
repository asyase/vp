<?php

$database = "if20_anastasija_se";

function sendmessage($message_to, $message_text) {
  $result = null;
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("INSERT INTO messages (message_to, message_from, message_text, added, message_unread) VALUES(?,?,?, NOW(), 1)");
  echo $conn->error;
  $stmt->bind_param("iis", $message_to, $_SESSION['userid'], $message_text);
  if($stmt->execute()){
    $notice = "Sonum on saadetud!";
  } else {
    $notice = "Sonumi saatmisel tekkis tehniline torge: " .$stmt->error;
  }

  $stmt->close();
  $conn->close();
  return $notice;  
}

function sendmessagereply($message_id, $message_text) {
  $result = null;
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("INSERT INTO messages_replies (message_id, message_from, message_text, added, message_unread) VALUES(?,?,?, NOW(), 1)");
  echo $conn->error;
  $stmt->bind_param("iis", $message_id, $_SESSION['userid'], $message_text);
  if($stmt->execute()){
    $notice = "Vastus on saadetud!";
  } else {
    $notice = "Vastuse saatmisel tekkis tehniline torge: " .$stmt->error;
  }

  $stmt->close();
  $conn->close();
  return $notice;
}

function listmessages() {
  $result = null;
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("SELECT message_id, message_to, message_from, added, message_unread FROM messages WHERE message_to = ? OR message_from = ?");
  echo $conn->error;
  $stmt->bind_param("ii", $_SESSION['userid'], $_SESSION['userid']);
  $stmt->bind_result($message_id, $message_to, $message_from, $message_added, $message_unread);
  $stmt->execute();
  $messageslist = "";
  while($stmt->fetch()){
    $messagefromname = getusernamebyid($message_from);
    $messagetoname = getusernamebyid($message_to);
    $newreply = checknewreplies($message_id);
    $newmessage = "";  
    if ($message_unread == 1) {
      $newmessage = '<strong style="color:red">UUS Sonum</strong>';
    }
    $messageslist .= "<tr><td>" . $messagetoname . "</td><td>" . $messagefromname . "</td><td>" . $message_added . 
	' ' . $newmessage . '</td><td><a href="messagereply.php?id=' . $message_id . '">vasta</a> ' . $newreply . '</td></tr>'."\n";
  }

  $stmt->close();
  $conn->close();
  return $messageslist;
}

function checknewmessages() {
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("SELECT COUNT(message_id) FROM messages WHERE message_id = ? AND message_from != ? AND message_unread = 1");
  echo $conn->error;
  $stmt->bind_param("ii", $message_id, $_SESSION['userid']);
  $stmt->bind_result($new_message_count);
  $stmt->execute();
  $stmt->fetch();
  $newmessages = "";
  if ($new_message_count > 0) {
     $newreply = '<strong style="color:red">UUS Sonum (' . $new_message_count . ')</strong>';
  }
  $stmt->close();
  $conn->close();
  return $newmessages;
}

function checknewreplies($message_id) {
 $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("SELECT COUNT(reply_id) FROM messages_replies WHERE message_id = ? AND message_from != ? AND message_unread = 1");
  echo $conn->error;
  $stmt->bind_param("ii", $message_id, $_SESSION['userid']);
  $stmt->bind_result($new_message_count);
  $stmt->execute();
  $stmt->fetch();
  $newreply = "";
  if ($new_message_count > 0) {
     $newreply = '<strong style="color:red">UUS Vastus (' . $new_message_count . ')</strong>';
  }
  $stmt->close();
  $conn->close();
  return $newreply;
}

function getmessagesreplies($message_id) {
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("SELECT message_from, message_text, added, message_unread FROM messages_replies WHERE message_id = ? ORDER BY reply_id ASC");
  echo $conn->error;
  $stmt->bind_param("i", $message_id);
  $stmt->bind_result($message_from, $message_text, $message_added, $message_unread);
  $stmt->execute();
  $messagesreplies = "";
  while($stmt->fetch()){
    $newreply = "";
    if ($message_unread == 1 && $message_from != $_SESSION['userid']) {
       $newreply = '<strong style="color:red">UUS Vastus</strong>';
    }
    if ($message_unread == 1 && $message_from == $_SESSION['userid']) {
       $newreply = '<strong style="color:red">Ei ole loetud</strong>';
    }
    $messagefromname = getusernamebyid($message_from);
    $messagesreplies .= "<tr><td><strong>" . $messagefromname . "</strong></td><td>" . $newreply . ' ' . $message_added . '</td></tr>'."\n";
    $messagesreplies .= '<tr><td colspan="2">' . $message_text . '</td></tr>'."\n";
  }

  $stmt = $conn->prepare("UPDATE messages_replies SET message_unread = 0 WHERE message_id = ? AND message_from != ?");
  $stmt->bind_param("ii", $message_id, $_SESSION['userid']);
  $stmt->execute();

  $stmt = $conn->prepare("UPDATE messages SET message_unread = 0 WHERE message_id = ? AND message_from != ?");
  $stmt->bind_param("ii", $message_id, $_SESSION['userid']);
  $stmt->execute();

  $stmt->close();
  $conn->close();
  return $messagesreplies;
}

function getmessagebyid($message_id) {
  $result = null;
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("SELECT message_id, message_from, message_text, added FROM messages WHERE message_id = ? AND (message_to = ? OR message_from = ?)");
  echo $conn->error;
  $stmt->bind_param("iii", $message_id, $_SESSION['userid'], $_SESSION['userid']);
  $stmt->bind_result($message_id, $message_from, $message_text, $message_added);
  $stmt->execute();
  $message = "";
  $stmt->fetch();
  $messagefromname = getusernamebyid($message_from);
  $message .= "<tr><td>" . $messagefromname . "</td><td>" . $message_added . '</td></tr>' . "\n";
  $message .= '<tr><td colspan="2">' . $message_text . '</td></tr>' . "\n";
  $stmt->close();
  $conn->close();
  return $message;
}
