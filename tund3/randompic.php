<?php
//loeme kataloogist piltide nimekirja
  $allfiles = scandir("vp_pics/");
  $picfiles = array_slice($allfiles, 2);
  $imghtml = "";
  $piccount = count($picfiles);
  $imghtml .= '<img src="vp_pics/' . $picfiles[mt_rand(1,$piccount)-1] . '">'; 
?>

  <?php echo $imghtml; ?>
  
</body>
</html>
