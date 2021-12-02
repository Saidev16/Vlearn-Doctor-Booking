 <?php
  if (isset($_POST['code_cours'])){
  
  
  	  //récupération de variable postées
	  
	  $code_cours = $_POST['code_cours'];
	  $code_inscription=$_POST['code_inscription'];
	  $horaire = (int)$_POST['horaire'];
	  $nombre = (int) $_POST['nbr_absence'];
	  $date = $_POST['year_n'].'-'.$_POST['month_n'].'-'.$_POST['day_n'];
	   
      //vérification si il y a des absences dans la même date et le même code_cours
  
	  $sql = "select count(*) as nbr from $tbl_absence 
	  where code_cours = '$code_cours' 
	  and date = '$date' 
	  and idSession = '$idSession'"; 
	  
       $req=@mysql_query($sql) or die("erreur lors de la vérification des absences"); 
   
      //si le cours à déja enregistré un absence
	  
      $tuple= mysql_fetch_assoc($req); 
	  $abs=$tuple['nbr'];
	   
       if($abs){   
  
      //mise à jour de la table absence
  
	   $sql1="UPDATE $tbl_absence SET jeton='A',
 	   n_comptabilise= n_comptabilise+'$nombre'
	   WHERE code_cours='$code_cours' 
	   AND code_inscription='$code_inscription' 
	   AND date = '$date'
	   AND idSession = '$idSession'";  
	    
 	   @mysql_query($sql1) or die ("erreur lors de l'enregistrement de l'absence");	
		 
	   
	  
	  }
  
  else{
   //sinon
  
   $sql3="select code_inscription 
   from $tbl_inscription_cours 
   where code_cours='$code_cours'
   and idSession='$idSession'";
    
   $req=@mysql_query($sql3) or die("erreur lors de la selection des inscrits");
 
    while($row=mysql_fetch_assoc($req)){
   $coode=$row['code_inscription'];
   
   $sql4="INSERT INTO $tbl_absence 
   (`code_inscription` , `code_cours`,`date` , `idHoraire`, `idSession`) 
   VALUES ('$coode', '$code_cours', '$date', '$horaire', '$idSession') ;";
   
    @mysql_query($sql4) or die('erreur enregistrement :: Absence');
        } 
	   
      
 //mise à jour de la fiche de présence
 
   $sql5="UPDATE $tbl_absence 
   SET jeton='A',
   n_comptabilise = n_comptabilise+'$nombre'
   WHERE code_cours = '$code_cours' 
   AND code_inscription = '$code_inscription' 
   AND date = '$date'
   AND idSession = '$idSession'"; 
   
  @mysql_query($sql5) or die("erreur lors de l'update de la fiche de présence");
  
  }
   
 
 	  ?>
	  <form name="retour" method="post" action="">
		<input type="hidden" value="absence" name="task" />
 		<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
	  </form>
	
	  <script language="javascript1.2">
	   document.retour.submit();
	  </script>
	  <?php
 	   // fermeture test sur post
 		 }
		 //echo print_r($succes);
 	   ?> 