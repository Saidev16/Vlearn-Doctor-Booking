<?php

  $id=$_GET["desarchiver"]; 
  $sql="update $tbl_filiere set archive= 0 WHERE id_filiere = '$id'";
  @mysql_query($sql)or die ("erreur lors du d�sarchivage de la fili�re");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_filieres.php');
//-->
</script>
