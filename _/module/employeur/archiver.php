<?php

  $id=$_GET["archiver"]; 
  $sql="update $tbl_employeur set archive= 1 WHERE idEmployeur = '$id' limit 1";
  @mysql_query($sql)or die ("erreur lors d'archivage du cv");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_employeur.php?archive=oui');
//-->
</script>


