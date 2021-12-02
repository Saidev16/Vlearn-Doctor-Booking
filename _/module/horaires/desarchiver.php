<?php

  $id=(int)$_GET["desarchiver"]; 
  $sql="update tbl_horaire set archive= 0 WHERE code_horaire = $id";
  @mysql_query($sql)or die ("erreur lors du désarchivage de l'horaire");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_horaires.php');
//-->
</script>
