<?php

  $id=$_GET["supprimer"]; 
  $sql="DELETE FROM tbl_etudiant_morocco WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to archive student");
   $sql="DELETE FROM tbl_etudiant_all WHERE code_inscription = '$id' and prefixe='MOR'";
  @mysql_query($sql)or die ("unable to archive student");
 $sql1="DELETE FROM tbl_etudiant_usa WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql1)or die ("unable to archive student");
  
  
  
  $sql="DELETE FROM tbl_inscription_cours_morocco WHERE code_inscription = '$id' ";
  @mysql_query($sql)or die ("unable to archive registrations");
 /* $sql2="DELETE FROM tbl_inscription_cours_usa WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql2)or die ("unable to archive registrations");*/
  
  $sql="DELETE FROM tbl_note_morocco WHERE code_inscription = '$id' ";
  @mysql_query($sql)or die ("unable to archive notes");
   $sql="DELETE FROM tbl_finance_morocco WHERE code_inscription = '$id' ";
  @mysql_query($sql)or die ("unable to archive finance");
    $sql="DELETE  FROM tbl_finance_paiement_morocco WHERE code_inscription = '$id' ";
  @mysql_query($sql)or die ("unable to archive finance payment");

   /*$sql3="DELETE FROM tbl_note_usa WHERE code_inscription = '$id' ";
  @mysql_query($sql3)or die ("unable to archive notes");*/
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_des_etudiants_morocco.php');
//-->
</script>


