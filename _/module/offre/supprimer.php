<?php

  $id=$_GET["archiver"]; 
  $sql="DELETE FROM $tbl_offre_emploi  WHERE id = '$id' limit 1";
  @mysql_query($sql)or die ("erreur lors de suppression de cette offre");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_offre_emploi.php');
//-->
</script>


