<?php

  $id=$_GET["supprimer"]; 
  $sql="UPDATE $tbl_etudiant SET archive = 0 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to unarchive student");
  
  $sql="UPDATE $tbl_absence SET archive = 0 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to unarchive absences");
  
  $sql="UPDATE $tbl_demande SET archive = 0 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to unarchive requests");
  
  $sql="UPDATE $tbl_inscription_cours SET archive = 0 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to unarchive registrations");
  
  $sql="UPDATE $tbl_note SET archive = 0 WHERE code_inscription = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to unarchive notes");
?>
	<script type="text/javascript" language="JavaScript1.2">
    <!--
    window.location.replace('gestion_des_etudiants.php');
    //-->
    </script>


