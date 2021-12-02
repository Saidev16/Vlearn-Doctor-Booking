<?php
    $code_inscription = $_GET["supprimer"]; 
    $code_cours = $_SESSION['cours'];
  	if ( isset($_SESSION['NidSession']) ) $idSession = $_SESSION['NidSession'] ;
	
	$sql="SELECT type_cours_id FROM tbl_inscription_cours
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
		
	
		
		//mise à jour du reste et de la somme payée
		$sql = "UPDATE tbl_finance SET `frais_etude` = frais_etude -$prix
				WHERE code_inscription = '$code_inscription' 
				AND annee = '$academic_year'";
		@mysql_query($sql) or die ('Erreur du mise à jour du paiement ');
		  //suppression depuis la liste l'inscripon
		  $sql="DELETE FROM $tbl_inscription_cours  
				  WHERE code_cours='$code_cours' 
				  AND code_inscription='$code_inscription'
				  AND idSession='$idSession' LIMIT 1"; 
		  @mysql_query($sql)or die ("Erreur lors de suppression de l'inscription");
		  
		  //suppression depuis la fiche de notes
		  $sql="DELETE FROM $tbl_note  
		  		  WHERE code_cours='$code_cours' 
				  AND code_inscription='$code_inscription'
				  AND idSession='$idSession'";
		  @mysql_query($sql) or die ("erreur lors de la suppression des notes");
  		
		  //suppression depuis la fiche d'absences
		  $sql="DELETE FROM $tbl_absence  WHERE code_cours='$code_cours' 
				  AND code_inscription='$code_inscription'
				  AND idSession='$idSession'";
		  @mysql_query($sql) or die ("erreur lors de la suppression des absences");
		  
		  // mise à jour du nombre d'inscription par cours dans une session
		  $sql="UPDATE $tbl_seance SET nbr_inscrit = nbr_inscrit -1 WHERE code_cours ='$code_cours' AND idSession='$idSession'";
		  @mysql_query($sql) or die("erreur lors de la mise à jour du nombre d'inscrit");
  
        //selection de l'annee
		

?>
		<script type="text/javascript" language="JavaScript1.2">
        <!--
        	window.location.replace('gestion_inscription.php?code_cours=<?=$code_cours?>&idSesion=<?=$idSession?>&type=<?=$type?>&code=<?=$code_cours?>&prix=<?=$prix?>&code_inscription=<?=$code_inscription?>');
        //-->
        </script>