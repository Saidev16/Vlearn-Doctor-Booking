<?php

  $code_inscription=addslashes($_GET["supprimer"]);
  $annee = addslashes($_GET['annee']);
  
	 //delete details data
	  $sql = "DELETE FROM tbl_finance_detail 
	  WHERE code_inscription='$code_inscription' 
	  AND idSession IN (SELECT DISTINCT idSession FROM tbl_session WHERE annee_academique = '$annee')"; 
	  @mysql_query($sql) or die("Error :: DELETE DETAILS");

	// delete principal fiche 
      $sql="DELETE FROM $tbl_finance  WHERE code_inscription='$code_inscription' AND annee = '$annee' LIMIT 1";
	  @mysql_query($sql) or die('Error :: Delete fiche');	
	   
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_finance.php');
//-->
</script>
     