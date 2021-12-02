<?php

  $id=$_GET["desarchiver"]; 
  $sql="update tbl_cle_emploi set archive= 0 WHERE idCleEmploi = '$id'";
  @mysql_query($sql)or die ("erreur lors du desarchivage de l'emploi du temps");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestionCleEmploi.php');
//-->
</script>
