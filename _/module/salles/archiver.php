<?php

  $id=(int)$_GET["archiver"]; 
  
  $sql="update $tbl_salle set archive= 1 WHERE code_salle = '$id'";
  
  
  @mysql_query($sql)or die ("erreur lors de la mise en archive de la salle ");
  
?>
<script type="text/javascript" language="JavaScript1.2">
<!--

window.location.replace('gestion_salles.php?archive=oui');

//-->
</script>


