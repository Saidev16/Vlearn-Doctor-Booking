<?php
$id=(int)$_GET["archiver"]; 
  $sql="update $tbl_actualite set archive= 1 WHERE id_actualite = $id";
  @mysql_query($sql)or die ("erreur lors de la mise en archive");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_actualite.php?archive=oui');
//-->
</script>


