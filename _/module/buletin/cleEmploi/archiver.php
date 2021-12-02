<?php

  $id=$_GET["archiver"]; 
  $sql="update tbl_cle_emploi set archive= 1 WHERE idCleEmploi = '$id'";
  @mysql_query($sql)or die ("erreur lors d'archivage du titre d'emploi du temps");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestionCleEmploi.php?archive=oui');
//-->
</script>


