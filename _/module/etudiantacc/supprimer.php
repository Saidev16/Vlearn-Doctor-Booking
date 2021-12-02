<?php

  $id=$_GET["supprimer"]; 
   $prefixe= $_GET['foupasf'];
  $sql="DELETE FROM tbl_etudiant_all WHERE code_inscription = '$id' and prefixe='$prefixe' ";
  @mysql_query($sql)or die ("unable to archive student");
  
  
  
  
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_des_etudiants_all.php');
//-->
</script>


