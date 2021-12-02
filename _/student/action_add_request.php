<?php
if (isset($_SESSION['code_prof'])){
//$date=date('Y:m:d').' '.date('H:m:s');
$date=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];    
$nom=$_POST['nom'];
$fname='';
$code_prof=$_SESSION['code_prof'];
if(empty($_POST['objet'])){
$objet=addslashes($_POST['autre']);
}
else{
$objet=addslashes($_POST['objet']);
}
$explication=addslashes($_POST['explication']); 

       //     begin upload
	  if(isset($_FILES['fichier']) && ($_FILES['fichier']['size']!=0) ){ 
	  //print_r($_FILES['fichier']);die();
       
      $MAX_FILE_SIZE = 150000;
      $error = 0;
      $msg='';
	  $folder='module/demande/fichier/'; 
	  
       // Dossier de destination du fichier

      // Tableau array des différents types
	  
      $allowed_types = array("application/vnd.ms-excel", "application/msword", "application/pdf");

      // Variables récupérée par methode POST du formulaires

      $ftype = $_FILES['fichier']['type'];
      $fsize = $_FILES['fichier']['size'];
      $ftmp =  $_FILES['fichier']['tmp_name'];
	  
       // Recuperation de l'extension du fichier
	   
      $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
      $max="SELECT MAX( id ) as idmax  from $tbl_demande ";
		                                 $req=@mysql_query($max);
		                                 $ligne=@mysql_fetch_array($req);
		                                 $idmax=$ligne["idmax"];
										 $idmax=$idmax+1;
		                                 $fname='file_'.$idmax.'.'.$extension;

      // Diverses test afin de savoir si :
	  
      // Le format de fichier correspond à notre tableau array
      if(!in_array($ftype, $allowed_types)){$error = 1;}

      // La taille du fichier n'est pas dépassée
      if($fsize > $MAX_FILE_SIZE){$error = 2;}


      // Le fichier n'existe pas déjà
      if(file_exists($folder.''.$fname)){$error = 3;}

      // Si tout va bien, c'est bien déroulé
      if(copy($ftmp,''.$folder.''.$fname)) {$error = 0;}

      // Switch servant simplement à la gestion des erreures
     switch($error){
      case'0':
      $msg="Fichier correctement envoyé.";
      break;
      case'1':
      die("Format de fichier incorrecte.");
      break;
      case'2':
      die("Fichier trop volumineux.");
      break;
      case'3':
      die("Fichier déjà existant.");
      break;
            }
             }
//     end upload

 $sql="INSERT INTO $tbl_demande 
(`nom_prenom` , `date_requette` , `objet` , `explication` , `code_prof`, `fichier` ) 
VALUES ('$nom', '$date', '$objet', '$explication', '$code_prof', '$fname' );";   


@mysql_query($sql) or die("erreur lors de l'enregistrement de la requette");

// archivage des ancien demande

$inserted= mysql_insert_id();

(int)$to_archive=$inserted - 50;

$archive="update $tbl_demande set archive=1 where code_demande < $to_archive ";

$req=@mysql_query($archive);

?>
<script language="javascript1.2">
alert("Votre requête a été envoyé avec succes ");
window.location.replace("professeur.php?task=reponse");
</script>
<?php
}
?>
