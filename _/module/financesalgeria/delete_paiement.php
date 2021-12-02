<?php
  $id=(int)$_GET["delete_paiement"];
  //select data
 
  $sql = "SELECT code_inscription, annee, somme  FROM tbl_finance_paiement_algeria WHERE id='$id' LIMIT 1";  
  $req = @mysql_query($sql) or die("Error :: Select DATA");
  $row = @mysql_fetch_assoc($req);
    $code_inscription = $row['code_inscription'];
	$annee = $row['annee']; 
	$somme = (int)$row['somme']; 
	 
	/*
	$sql="UPDATE tbl_finance_morocco SET payee = payee-$somme
	WHERE code_inscription='$code_inscription' AND annee='$annee'";
	@mysql_query($sql) or die('Error :: Update situation');*/
	
    $sql="DELETE FROM tbl_finance_paiement_algeria WHERE id='$id'";
	@mysql_query($sql) or die('Error :: Delete fiche');	
	   
?>
<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_finance_algeria.php?detail=<?=$code_inscription;?>');
			//-->
			</script>
