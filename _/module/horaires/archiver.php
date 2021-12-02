<?php

  $id=(int)$_GET["archiver"]; 
  
  $sql="update $tbl_horaire set archive= 1 WHERE code_horaire = '$id'";
  
  
  @mysql_query($sql)or die ("erreur lors de la mise en archive d'horaire ");
  
?>
<script type="text/javascript" language="JavaScript1.2">
<!--

window.location.replace('gestion_horaires.php?archive=oui');

//-->
</script>


