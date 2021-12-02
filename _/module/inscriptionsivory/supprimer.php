<?php
    $code_inscription = $_GET["supprimer"]; 
    $code_cours = $_SESSION['cours'];
  	if ( isset($_SESSION['NidSession']) ) $idSession = $_SESSION['NidSession'] ;
	
	$sql="SELECT type_cours_id FROM tbl_inscription_cours_burkina
				WHERE code_inscription = '$code_inscription' 
				AND code_cours = '$code_cours'
				AND idSession = '$idSession'";
		
		$res=mysql_query($sql);
		$row = mysql_fetch_assoc($res);
		$type= $row['type_cours_id'];
	
		//suppression des cours depuis la fiche de paiement
		
		  $sql = "SELECT prix FROM tbl_type_cours WHERE id = '$type'";
			  $res = mysql_query($sql);
			  $row = mysql_fetch_assoc($res);
			  $prix = (int)$row['prix'];
			  
			  $sql= "SELECT annee_academique,academic_year, annee FROM tbl_session WHERE idSession = '$idSession' LIMIT 1";
		$req = @mysql_query($sql);
		$row = mysql_fetch_assoc($req);
		$annee_academique = $row['annee_academique'];
		$annee = $row['annee'];
		$academic_year=$row['academic_year'];
		
	
		
		
		  //suppression depuis la liste l'inscripon
		  $sql="DELETE FROM tbl_inscription_cours_burkina  
				  WHERE code_cours='$code_cours' 
				  AND code_inscription='$code_inscription'
				  AND idSession='$idSession' LIMIT 1"; 
		  @mysql_query($sql)or die ("Erreur lors de suppression de l'inscription");
		  
		  //suppression depuis la fiche de notes
		  $sql="DELETE FROM tbl_note_burkina  
		  		  WHERE code_cours='$code_cours' 
				  AND code_inscription='$code_inscription'
				  AND idSession='$idSession'";
		  @mysql_query($sql) or die ("erreur lors de la suppression des notes");
  		
		
		
		

?>
		<script type="text/javascript" language="JavaScript1.2">
        <!--
        	window.location.replace('gestion_inscription_burkina.php?code_cours=<?=$code_cours?>&idSesion=<?=$idSession?>&type=<?=$type?>&code=<?=$code_cours?>&code_inscription=<?=$code_inscription?>');
        //-->
        </script>