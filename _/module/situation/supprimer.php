<?php
 $id=$_GET["supprimer"]; 
  $sql="DELETE FROM $tbl_situation_financiere WHERE code_inscription ='$id'";
  @mysql_query($sql)or die ("erreur lors de la suppression de la situation");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_situation.php');
//-->
</script>