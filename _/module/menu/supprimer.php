<?php
  $id=$_GET["supprimer"]; 
  $type=$_SESSION['menu_type'];
  
  $sql="update $tbl_menu set archive='oui' WHERE code_menu = '$id'";
  @mysql_query($sql)or die ("erreur lors de l'archivage");
  
  $sql1="update tbl_menu set archive = archive+1 where type = '$type'";
  @mysql_query($sql1);

?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_menu.php');
//-->
</script>
