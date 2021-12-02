<?php
if( (isset($_GET["action"])) && ($_GET["code_cours"]) && ($_GET["action"]!='') && ($_GET["code_cours"]!='') ){
 		 
		 $action=$_GET["action"];
		 $code_cours = $_SESSION['updated'] = htmlentities($_GET["code_cours"]);
		  
		if ($action==1){

		   //ouverture de l'inscription dans le cours

		   $sql="update $tbl_cours set inscription=0 where code_cours='$code_cours'";
		   @mysql_query($sql) or die('erreur lors de l activation du cours');
		   
		   //vérification si la session existe déja
           
		   $sql1="select count(*) as nbr 
		   from $tbl_seance 
		   where code_cours='$code_cours'
		   and idSession='$idSession'";
		   
		   $req=@mysql_query($sql1) or die ('erreur verification de session');
		   $row=mysql_fetch_assoc($req);
		   $nbr=$row['nbr'];
		   
		   if($nbr){
		   
		     //desarchivage du syllabys
	   
		    $sql2="update $tbl_syllabus set archive= 0 
			where code_cours='$code_cours' 
			and idSession='$idSession' limit 13 ";
 		    @mysql_query($sql2) or die("erreur lors du desarchivage des sylabus du cours");
 	
	  		 //desarchivage du descriptif
	
 	        $sql3="update $tbl_descriptif set archive= 0 
			where code_cours='$code_cours' 
			and idSession='$idSession' limit 1";
            @mysql_query($sql3) or die("erreur lors de la desarchivage du descriptif du cours");
	
			//desarchivage du seance

			$sql4="update $tbl_seance set archive= 0 
			where code_cours='$code_cours' 
			and idSession='$idSession' limit 1";
			@mysql_query($sql4) or die ('erreur lors du desarchivage du seance');
		        }
		   
		   else{
		   
	 		//insertion du syllabys
	   
		    $sql2="insert into $tbl_syllabus (`code_cours` , `idSession` , `week`)
			VALUES ";
            for($j=1; $j<13; $j++){
			$week=$j;
	        $sql2.="('$code_cours', '$idSession', '$week' ),";
								  }
			$sql2.="('$code_cours', '$idSession', '13');"; 
			
		    @mysql_query($sql2) or die("erreur lors de la création des syllabus du cours");
 	
	  		 //insertion du descriptif
	
 	        $sql3="INSERT INTO $tbl_descriptif ( `code_cours`, `idSession` ) 
			VALUES ('$code_cours', '$idSession');"; 
			
            @mysql_query($sql3) or die("erreur lors de la création du descriptif du cours");
	
			//insertion du seance


			$sql4="INSERT INTO $tbl_seance ( `code_cours`, `idSession` ) 
			VALUES ('$code_cours', '$idSession');";
            @mysql_query($sql4) or die("erreur lors de la création du séance du cours");
			
			}
			$_SESSION['insc']=0;
   
   
    ?>
              <script language="javascript1.2">
			<!--
		 		document.location.replace('gestion_cours.php?updated=<?=$code_cours?>');
			-->
			</script>
    <?php
    
                            }
		if ($action==0){
    
			//fermeture de l'inscription dans le cours
	
			$sql="update $tbl_cours set inscription = 0 
			where code_cours='$code_cours'";
			@mysql_query($sql) or die('erreur lors de désactivation du cours');
    
	 		//archivage du syllabys
	   
		    $sql1="update $tbl_syllabus set archive= 1 
			where  code_cours='$code_cours' 
			and idSession='$idSession' limit 13 ";
			
		    @mysql_query($sql1) or die("erreur lors de la suppression des sylabus du cours");
 	
	  		 //archivage du descriptif
	
 	        $sql2="update $tbl_descriptif set archive= 1 
			where code_cours='$code_cours' 
			and idSession='$idSession' limit 1";
			
            @mysql_query($sql2) or die("erreur lors de la suppression du descriptif du cours");
	
			//archivage du seance

			$sql3="update $tbl_seance set archive= 1 
			where code_cours='$code_cours' 
			and idSession='$idSession' limit 1"; 
			
            @mysql_query($sql3) or die("erreur lors de la suppression du séance du cours");
			
			$_SESSION['insc']=1;
   
    ?>
        <script language="javascript1.2">
		<!--
		 document.location.replace('gestion_cours.php?updated=<?=$code_cours?>');
		-->
		</script>
    <?php
     }
	 }
 	?>
