<?php
$id=(int)$_GET["desarchiver"]; 
  $sql="update $tbl_actualite set archive= 0 WHERE id_actualite = $id";
  @mysql_query($sql)or die ("erreur lors de la suppression");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_actualite.php');
//-->
</script>


