<?php
  $id=(int)$_GET["supprimer"];
  $sql="update tbl_type_cours set archive = 1 WHERE id = '$id' LIMIT 1";
  @mysql_query($sql)or die ("erreur lors de la mise en archive du type de cours ");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_type_cours.php');
//-->
</script>