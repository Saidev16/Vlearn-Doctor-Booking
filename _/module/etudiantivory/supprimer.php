<?php

   $id=$_GET["supprimer"]; 
  $sql="DELETE FROM tbl_etudiant_ivory WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive student");
  
  
  
  $sql1="DELETE FROM tbl_inscription_cours_ivory WHERE code_inscription = '$id' ";
  @mysql_query($sql1)or die ("unable to archive registrations");
  
  $sql2="DELETE FROM tbl_note_ivory WHERE code_inscription = '$id' ";
  @mysql_query($sql2)or die ("unable to archive notes");

   $sql3="DELETE FROM tbl_finance_ivory WHERE code_inscription = '$id' ";
  @mysql_query($sql3)or die ("unable to archive notes");

   $sql4="DELETE FROM tbl_finance_paiement_ivory WHERE code_inscription = '$id' ";
  @mysql_query($sql4)or die ("unable to archive notes");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_des_etudiants_ivory.php');
//-->
</script>


