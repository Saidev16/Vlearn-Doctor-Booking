<?php
  $id=$_GET["supprimer"]; 
  $sql="delete  from $tbl_demande WHERE code_demande = '$id'";
  @mysql_query($sql)or die ("erreur lors de l'archivage de cette requette");

?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_demande.php');
//-->
</script>


