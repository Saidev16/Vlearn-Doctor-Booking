	<?php

	if ( (isset($_POST['boxchecked'])) && (isset($_POST['token'])) ){

	$code_inscription=$_SESSION['code_etudiant'];
	$code_cours=$_POST['boxchecked'];
	
	     $sqlsession="select idSession, session, annee_academique from $tbl_session where inscription=0";
		 $req=@mysql_query($sqlsession) or die ('erreur de selection de la session');
		 $row=mysql_fetch_assoc($req);
		 $idSession=$row['idSession'];
		 $session=$row['session'];
		 $annee_academique=$row['annee_academique'];
	
	$validate="select code_inscription, liste_attente
		  	   from $tbl_inscription_cours 
		       where code_inscription='$code_inscription'
		       and code_cours='$code_cours'
		       and idSession='$idSession' limit 1";
    $req=@mysql_query($validate) or die('erreur vérification inscription');
	
	if(mysql_num_rows($req)){
	
	$row=mysql_fetch_assoc($req);
 		$liste_attente=$row['liste_attente'];
			
	//suppression de l'inscription

	$sql="delete from $tbl_inscription_cours where 
 	code_inscription='$code_inscription' 
 	and code_cours='$code_cours'
 	and idSession='$idSession' limit 1";
 	
 	@mysql_query($sql) or die ("erreur lors de la suppression de l'inscription");
 
	//suppression de la note
 
	 $sql1="delete from $tbl_note where 
 	 code_inscription='$code_inscription'
 	 and code_cours='$code_cours'
 	 and idSession='$idSession' limit 1"; 
 	  
 	 @mysql_query($sql1) or die ("erreur lors de la suppression de l'inscription");

	 if(!$liste_attente){
	 
	 //mise à jour du jour du nombre d'inscrit
	 
	 $sql2="update  $tbl_seance set nbr_inscrit=nbr_inscrit-1 
 	 where code_cours='$code_cours' 
 	 and idSession='$idSession' limit 1";  
 	 @mysql_query($sql2) or die ("erreur lors de la mise &aacute; jour du nombre d'inscrit");
	 
	 					}

	 //verification liste d'attente 
	 
	 $sql3="select code_inscription from $tbl_inscription_cours 
	 where code_cours='$code_cours'
	 and idSession='$idSession'
	 and liste_attente=1 order by date_inscription limit 1"; 
	 
	 $req=@mysql_query($sql3) or die ('erreur lors de la vérification de la liste attente');
	 $row=mysql_fetch_assoc($req);
	 
	 if(mysql_num_rows($req)){
	 
	 $code_inscription_to_update=$row['code_inscription'];
     
	 $sql4="update $tbl_inscription_cours set liste_attente=0  
	 where code_cours='$code_cours'
	 and code_inscription='$code_inscription_to_update' 
	 and idSession='$idSession' limit 1"; 
 	 @mysql_query($sql4) or die ('erreur lors de la reinscription');
	 
	 // creation de la note
	 
	 $sql5="update $tbl_note set archive=0 
	 where code_inscription='$code_inscription_to_update'
	 and code_cours='$code_cours'
	 and idSession='$idSession'";
 	 @mysql_query($sql5) or die ("erreur lors de la cr&eacute;ation de la note");
							 	 
	// la redirection

							  }

	?>

		<script language="javascript1.2">
		<!--
		 	document.location.replace('student.php?task=cours');
		-->
		</script>

	<?php
        }
		
		else{
		?>
		<script language="javascript1.2">
		   <!--
		   	document.location.replace('student.php?task=cours');
		   -->
		</script>
		<?php
	        }
	 								 }
	?>
