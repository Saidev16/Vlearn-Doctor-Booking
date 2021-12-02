<?php

   $id=$_GET["supprimer"]; 
  $sql="DELETE FROM tbl_etudiant_GUES WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive student");
   $sql4="DELETE FROM tbl_etudiant_all WHERE code_inscription = '$id' and prefixe='GS'";
  @mysql_query($sql)or die ("unable to archive student");
  
  
  
  $sql1="DELETE FROM tbl_inscription_cours_GUES WHERE code_inscription = '$id' ";
  @mysql_query($sql1)or die ("unable to archive registrations");
  
  $sql2="DELETE FROM tbl_note_GUES WHERE code_inscription = '$id' ";
  @mysql_query($sql2)or die ("unable to archive notes");

   $sql3="DELETE FROM tbl_finance_GUES WHERE code_inscription = '$id' ";
  @mysql_query($sql3)or die ("unable to archive finances");

   $sql4="DELETE FROM tbl_finance_paiement_GUES WHERE code_inscription = '$id' ";
  @mysql_query($sql4)or die ("unable to archive finances paiement");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_des_etudiants_gues.php');
//-->
</script>


