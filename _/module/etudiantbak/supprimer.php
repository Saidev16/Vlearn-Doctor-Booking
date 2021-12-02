<?php

  $id=$_GET["supprimer"]; 
  $sql="DELETE FROM $tbl_etudiant WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive student");
  
    $sql="DELETE FROM $tbl_absence WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive absences");
  
  $sql="DELETE FROM $tbl_demande WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive requests");
  
  $sql="DELETE FROM $tbl_inscription_cours WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive registrations");
  
  $sql="DELETE FROM $tbl_note WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive notes");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_des_etudiants.php');
//-->
</script>


