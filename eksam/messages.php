<?php
 require("../tund6/usesession.php");
 require("../tund3/header.php");
 require("../../../config_vp2020.php");
 $database = "if20_anastasija_se";
 require("../tund5/fnc_common.php");
 require("../tund5/fnc_user.php");
 require("./fnc_messages.php");

if (isset($_POST['message_submit'])) {
  if (!empty($_POST['message_to']) && !empty($_POST['message_text'])) {
    $notice=  sendmessage($_POST['message_to'], $_POST['message_text']);
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Minu sõnumid</title> 
  </head>
  <body>
    <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
    <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
    <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
    <ul>
      <li><a href="../tund3/home.php">Avalehele</a></li>
      &thinsp;
      <li><a href="messages.php">Minu sõnumid</a></li>
      &thinsp;
      <li><a href="?logout=1">Logi välja</a>!</li>
    </ul>

    <h1>Minu sonumid</h1>
    <table border="1" width="50%">
      <tr><th>Kellele</th><td>Kellelt</td><th>Millal</th><th></th></tr>
      <?php echo listmessages(); ?>
    </table>
    <hr>
    <?php if (!empty($notice)){ echo "<h3>". $notice . "<h3>"; } ?><br>
    <h1>Saada sõnum</h1>
    <form method="POST">
      <label>Kellele:</label><br>
        <select name="message_to">
          <?php echo getuserslist(); ?>
        </select>
      <br><br>
      <label>Tekst:</label><br>
      <textarea name="message_text" rows="10" cols="100"></textarea>
      <br><br>
      <input type="submit" name="message_submit" value="Saada">
    </form>
  </body>
</html>
