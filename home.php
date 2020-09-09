<?php
 $username = "Anastasija";
 $fulltimenow = date("d.m.Y H:i:s");
 $hournow = date("H");
 $partofday = "lihtsalt aeg";
 if($hournow < 7){
	 $partofday = "uneaeg";
 }
 if ($hournow >= 8 and $hournow < 18){
	 $partofday = " akadeemilise aktiivsuse aeg";
 } 
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title><?php echo $username; ?> programmeerib veebi</title>

</head>
<body>
  <h1>Anastasija Selevjorstova </h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
  <p> <em> Web programming </em> refers to the writing, markup and coding involved in Web development, which includes Web content, Web client and server scripting and network security.</p>
  <blockquote> <p>“Truth can only be found in one place: the code.”</p> <cite> "http://www.goodreads.com/quotes/tag/programming" </cite> </blockquote>
  <p>Lehe avamise hetkel oli: <?php echo $fulltimenow; ?>.<p>
  <p><?php echo "parajasti on ".$partofday .".";  ?></p>
  

</body>
<h2>love peace unity </h2>
</html>
