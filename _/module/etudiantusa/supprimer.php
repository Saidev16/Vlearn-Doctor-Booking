<?php

  $id=$_GET["supprimer"]; 
  
   $sql="delete from tbl_etudiant_usa  WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("Unable to archive student");
  
  
  $sql="DELETE FROM tbl_inscription_cours_usa WHERE code_inscription = '$id' ";
  @mysql_query($sql)or die ("unable to archive registrations");
  
  $sql="DELETE FROM tbl_note_usa WHERE code_inscription = '$id' ";
  @mysql_query($sql)or die ("unable to archive notes");
  

?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_des_etudiants_usa.php');
//-->
</script>


