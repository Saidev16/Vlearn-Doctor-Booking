<?php
$id=$_GET["supprimer"]; 
  $sql="DELETE FROM $tbl_empreinte WHERE code_empreinte= '$id'";
  @mysql_query($sql)or die ("erreur lors de la suppression");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_livres.php');
//-->
</script>


