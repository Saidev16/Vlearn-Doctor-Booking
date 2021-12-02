	<?php
	
	//session d'inscription 
	
	     $sqlsession="select idSession, session, annee_academique from $tbl_session where inscription=0";
		 $req=@mysql_query($sqlsession) or die ('erreur de selection de la session');
		 $row=mysql_fetch_assoc($req);
		 $idSession=$row['idSession'];
		 $session=$row['session'];
		 $annee_academique=$row['annee_academique'];
	

	if ( (isset($_POST['boxchecked'])) && (isset($_POST['token'])) ){
 	$code_inscription=$_SESSION['code_etudiant'];
 	$code_cours=$_POST['boxchecked'];
 	$date=date('Y-m-d').' '.date('H:m:s');
 	$sql="select count(*) as nbr from $tbl_inscription_cours where
              code_inscription='$code_inscription'
              and code_cours='$code_cours'
              and idSession='$idSession'"; 
             
        
         $req=@mysql_query($sql) or die('erreur lors de la vérification de votre inscription');
         $row=mysql_fetch_assoc($req);
		 $mesCours=$row['nbr'];
 
            if($mesCours){
 ?>
               <script language="javascript1.2">
                  <!-- 
					 alert('Vous etes deja inscrit dans ce cours');
					 document.location.replace('student.php?task=cours');
				  -->
		      </script>
                     <?php           
                           											 }
						 else{	
						 		
							$sql1="select nbr_inscrit from $tbl_seance 
							where code_cours='$code_cours'
							and idSession='$idSession'";
							$result=@mysql_query($sql1) or die('erreur lors de la verification');
							$ligne=mysql_fetch_assoc($result);
							$nbr_inscrit=$ligne['nbr_inscrit']; 
							  
	//enregistrement du nombre d'inscription
		 
	if($nbr_inscrit<25){
	
	$sql2="insert into  $tbl_inscription_cours   
	(`code_cours` , `code_inscription`,`date_inscription`,`liste_attente`, `idSession` )
 	VALUES ('$code_cours', '$code_inscription', '$date', '0','$idSession')"; 
 	@mysql_query($sql2) or die ("erreur de votre inscription.");
 
	 // mise a jour du nombre d'inscrit par cours

 	 $sql3="UPDATE $tbl_seance SET nbr_inscrit  = nbr_inscrit + 1 
 	 where code_cours ='$code_cours' 
 	 and idSession='$idSession' limit 1";
 	 @mysql_query($sql3) or die ("erreur lors de la mise &aacute; jour des inscrits.");
 
	// creation de la note 
 
	$sql4="INSERT INTO $tbl_note(`code_note`, `code_inscription`, `code_cours`, `idSession` ) 
 	VALUES (NULL, '$code_inscription', '$code_cours', '$idSession');"; 
 	@mysql_query($sql4) or die ("erreur lors de la creation de la note.");
 
        ?>
        <form name="retour" method="post" action="">
			<input type="hidden" value="inscrit_par_cours" name="task" />
			<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
			<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
		</form>

		<script language="javascript1.2">
		<!--
		 document.retour.submit();
		-->
		</script>
        <?php
 	                   }
					   
		 else if($nbr_inscrit>25){

			$sql2="insert into $tbl_inscription_cours 
			(code_cours, code_inscription, idSession, liste_attente, date_inscription) 
			values('$code_cours', '$code_inscription', '$idSession', 1, '$date')";
			@mysql_query($sql2) or die ('erreur de votre inscription');
			
			$sql4="insert into $tbl_note 
			(code_note, code_inscription, code_cours, idSession, archive) 
			values(NULL, '$code_inscription', '$code_cours', '$idSession', 1)";
			@mysql_query($sql4) or die('erreur lors de la création de la note');
 
			?>
			<form name="retour" method="post" action="">
			<input type="hidden" value="liste_attente" name="task" />
			<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
			<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
		</form>

		<script language="javascript1.2">
		<!--
		 document.retour.submit();
		-->
		</script>
			<?php
		   }
		   
		   }
           }
	?>
