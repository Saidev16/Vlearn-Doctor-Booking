<?php

  $id=$_GET["supprimer"]; 
  $sql="DELETE FROM tbl_etudiant_benin WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive student");
  
  
  
  $sql="DELETE FROM tbl_inscription_cours_benin WHERE code_inscription = '$id' ";
  @mysql_query($sql)or die ("unable to archive registrations");
  
  $sql="DELETE FROM tbl_note_benin WHERE code_inscription = '$id' ";
  @mysql_query($sql)or die ("unable to archive notes");

  $sql3="DELETE FROM tbl_finance_benin WHERE code_inscription = '$id' ";
  @mysql_query($sql3)or die ("unable to archive notes");

   $sql4="DELETE FROM tbl_finance_paiement_benin WHERE code_inscription = '$id' ";
  @mysql_query($sql4)or die ("unable to archive notes");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_des_etudiants_benin.php');
//-->
</script>


