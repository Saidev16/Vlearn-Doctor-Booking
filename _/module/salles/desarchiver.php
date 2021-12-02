<?php

  $id=(int)$_GET["desarchiver"]; 
  $sql="update tbl_salle set archive= 0 WHERE code_salle = '$id'";
  @mysql_query($sql)or die ("erreur lors du désarchivage de la salle");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_salles.php');
//-->
</script>
