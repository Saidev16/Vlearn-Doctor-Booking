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
	
		
	
		  //suppression depuis la liste l'inscripon
		  $sql="DELETE FROM tbl_inscription_cours_benin  
				  WHERE code_cours='$code_cours' 
				  AND code_inscription='$code_inscription'
				  AND idSession='$idSession' LIMIT 1"; 
		  @mysql_query($sql)or die ("Erreur lors de suppression de l'inscription");
		  
		  //suppression depuis la fiche de notes
		  $sql="DELETE FROM tbl_note_benin  
		  		  WHERE code_cours='$code_cours' 
				  AND code_inscription='$code_inscription'
				  AND idSession='$idSession'";
		  @mysql_query($sql) or die ("erreur lors de la suppression des notes");
  		
		 
		

?>
		<script type="text/javascript" language="JavaScript1.2">
        <!--
        	window.location.replace('gestion_inscription_benin.php?code_cours=<?=$code_cours?>&idSesion=<?=$idSession?>&type=<?=$type?>&code=<?=$code_cours?>&prix=<?=$prix?>&code_inscription=<?=$code_inscription?>');
        //-->
        </script>