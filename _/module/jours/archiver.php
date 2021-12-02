<?php

  $id=(int)$_GET["archiver"]; 
  
  $sql="update $tbl_jours set archive= 1 WHERE code_jours = '$id'";
  
  
  @mysql_query($sql)or die ("erreur lors de la mise en archive du jours ");
  
?>
<script type="text/javascript" language="JavaScript1.2">
<!--

window.location.replace('gestion_jours.php?archive=oui');

//-->
</script>


