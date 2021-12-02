<script language="javascript1.2">

function valid_form(){

document.f_ajout.submit();

return true;

}

</script>

    <?php

      if (isset($_POST['titre'])){

      // Taille maximum

      $MAX_FILE_SIZE = 150000;

      $error = 0;

      $msg='';

      // Dossier de destination du fichier

 

      // Tableau array des différents types

      $allowed_types = array("application/vnd.ms-excel", "application/msword", "application/pdf");



      // Variables récupérée par methode POST du formulaires

      

      $ftype = $_FILES['fichier']['type'];

      $fsize = $_FILES['fichier']['size'];

      $ftmp =  $_FILES['fichier']['tmp_name'];

       // Recuperation de l'extension du fichier

             $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

       $max="SELECT MAX( id ) as idmax  from $tbl_document ";

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

      $titre=$_POST['titre'];

      $processus=$_POST['processus'];

      $acces=$_POST['acces'];





      	$sql="INSERT INTO $tbl_document( `id` , `titre` , nom , `processus`, `groupe` )

         VALUES (NULL, '$titre' , '$fname', '$processus', 'enregistrement');";

        @mysql_query($sql) or die($msg);

    			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--

			window.location.replace('gestion_enregistrement.php?option=<?=$_SESSION['parametre']?>');

			//-->

			</script>

              <?php

			  }

			  else{

			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/classes.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES ENREGISTREMENTS <span class="task">[ajouter]</span> </td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 

		  <td valign="top" align="center">

		  

		   <a href="#"onclick="javascript:valid_form();"><div class="save"></div>Valider</a> 

		   



		  </td>

		  <td valign="top" align="center">

		  

		   <a href="gestion_enregistrement.php?option=<?=$_SESSION['parametre']?>">

		  <div class="cancel"></div>Annuler</a>

		 

		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

 </table>

 <form method="post" ENCTYPE="multipart/form-data" action="gestion_enregistrement.php?new=oui" name="f_ajout"  >

	  	       <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">

		  

		  <tr>

		  <td width="25%">Titre</td>

		  <td width="25%"><input type="text" name="titre" class="input" size="100" /></td>

		  <td width="25%"></td>

		  <td width="25%"></td>

		  </tr>

		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr>

		  <td>Fichier : </td>

		  <td><input type="file" name="fichier"  size="50" /></td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>

		  <tr><td colspan="4" height="3px"></td>

		  </tr>

		  

		   <tr>

		  <td>Processus: </td>

		  <td>

       <input type="text" name="processus" value="PRC/<?=$_SESSION['parametre']?>" class="input"  />

		  </td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>

 		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr>

	  </table>

	  

</form>



<?php

}



?>