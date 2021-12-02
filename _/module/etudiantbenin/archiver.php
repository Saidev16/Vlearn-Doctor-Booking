<?php
  $id=$_GET["archiver"]; 
  $sql="UPDATE $tbl_etudiant SET archive = 1 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive student");
  
    $sql="UPDATE $tbl_absence SET archive = 1 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive absences");
  
  $sql="UPDATE $tbl_demande SET archive = 1 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive requests");
  
  $sql="UPDATE $tbl_inscription_cours SET archive = 1 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive registrations");
  
  $sql="UPDATE $tbl_note SET archive = 1 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive notes");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_des_etudiants.php?archive=oui');
//-->
</script>


