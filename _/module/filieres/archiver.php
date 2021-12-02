<?php

  $id=$_GET["archiver"]; 
  $sql="update $tbl_filiere set archive= 1 WHERE id_filiere = '$id'";
  @mysql_query($sql)or die ("erreur lors d'archivage de la filière");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_filieres.php?archive=oui');
//-->
</script>


