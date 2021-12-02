<style type="text/css">

input{

width:400px;

}

</style>

<?php

	if (isset($_POST['titre'])){

	$titre=$_POST['titre'];

	$processus=$_POST['processus'];

 	$id=$_POST['id'];

					 

				  if ( (isset($_FILES['fichier'])) && ($_FILES['fichier']['size']!=0) ){  

        // Taille maximum

      $MAX_FILE_SIZE = 150000;

      $error = 0;

      $msg = '';

      // Dossier de destination du fichier

     



      // Tableau array des différents types

      $allowed_types = array("application/vnd.ms-excel", "application/msword", "application/pdf");



      // Variables récupérée par methode POST du formulaires

      $fname="image";

      $ftype = $_FILES['fichier']['type'];

      $fsize = $_FILES['fichier']['size'];

      $ftmp  = $_FILES['fichier']['tmp_name'];

       // Recuperation de l'extension du fichier

             $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

       $sql="SELECT MAX( id ) as idmax  from $tbl_document ";

		                                 $req=@mysql_query($sql);

		                                 $ligne=@mysql_fetch_array($req);

		                                 $idmax=$ligne["idmax"];

										 $idmax=$idmax+1;

		                                 $fname='_'.$idmax.'.'.$extension;

	   

	   

      // Diverses test afin de savoir si :

      // Le format de fichier correspond à notre tableau array

      if(!in_array($ftype, $allowed_types)){$error = 1;}



      // La taille du fichier n'est pas dépassée

      if($fsize > $MAX_FILE_SIZE){$error = 2;}

	  

       

      // Le fichier n'existe pas déjà

      if(file_exists($folder.''.$fname)){$error = 3;}

 

       // Si tout va bien, c'est bien déroulé

      if(copy($ftmp, $folder.''.$fname)) {$error = 0;}



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

				

				$sql1="UPDATE $tbl_document SET `groupe` = 'archive' WHERE id='$id' LIMIT 1 ;";



				@mysql_query($sql1)or die ("erreur lors de l'archivage du document ");

					

				$sql2="INSERT INTO $tbl_document( `id` , `titre` , nom , `processus` , `groupe` )

                           VALUES (NULL, '$titre' , '$fname', '$processus', 'document');";

		 

		 	@mysql_query($sql2)or die ("erreur lors de la mise à jour du document ");

				 }

				 

				else{

				

				$sql1="update $tbl_document set  

				       titre='$titre'

                       where id='$id'"; 

		 

		 	@mysql_query($sql1)or die ("erreur lors de la mise à jour du document ");

				 }

			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

			window.location.replace('gestion_document.php?option=<?=$_SESSION['parametre']?>');

			//-->

			</script>

              <?php

			  }

			  else{

			  $id=$_GET['modifier'];

			  $sql3="select * from $tbl_document where id='$id'";

			  $req=@mysql_query($sql3) or die ("erreur lors de la sélection du document ");

			  while ($row=mysql_fetch_assoc($req)){

			  $ex_titre=$row['titre'];

			  $ex_processus=$row['processus'];

			  $ex_file=$row['nom'];

 			  }

			  			  ?>

			   



<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES DOCUMENTS <span class="task">[modifier]</span> </td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 

		  <td valign="top" align="center">

		   <a href="#" onclick="document.f_ajout.submit()"><div class="save"></div>Valider</a>

		   

		  	

		   	  </td>

		  <td valign="top" align="center">

		  <a href="gestion_document.php?option=<?=$_SESSION['parametre']?>">

		  <div class="cancel"></div>Annuler</a>

		 		  

		  </td>

		</tr>

	  </table>	</td> 

  </tr>

</table>

	    <table border="0" cellpadding="0" cellspacing="2" width="100%" style="margin-left:10px" class="cellule_table">

 <form method="post" ENCTYPE="multipart/form-data" action="gestion_document.php?modifier=oui" name="f_ajout">

 <input type="hidden" name="id" value="<?=$id?>" />

		  <tr>

		  <td width="25%">Titre</td>

		  <td width="25%"><input type="text" name="titre" class="input" size="100" value="<?=$ex_titre?>" /></td>

		  <td width="25%"></td>

		  <td width="25%"></td>

		  </tr>

		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr>

		   <tr>

		 <td>Fichier :</td>

		 <td align="left">&nbsp;

		 <a href="http://<?=$_SERVER['HTTP_HOST']?>/piimt/administrator/<?=$ex_file?>">

		 Aperçu</a></td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>

		  <tr><td colspan="4" height="3px"></td>

		  </tr>

		  <td>Mette à jour : </td>

		  <td><input type="file" name="fichier"  size="50"  /></td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>

		  <tr><td colspan="4" height="3px"></td>

		  </tr>

		   

		   <tr>

		  <td>Processus: </td>

		  <td>

          <select name="processus" class="input">

       		    <option value="PRC/ESM" <?=($ex_processus=="PRC/ESM") ? $selected : ''?>>Enseignement supérieur et master</option>

                <option value="PRC/CAM" <?=($ex_processus=="PRC/CAM") ? $selected : ''?>>Conception et analyse du marché</option>

                <option value="PRC/CDL" <?=($ex_processus=="PRC/CDL") ? $selected : ''?>>Centre de langues</option>

                <option value="PRC/PRI" <?=($ex_processus=="PRC/PRI") ? $selected : ''?>>Programmes internationaux</option>

                <option value="PRC/ACH" <?=($ex_processus=="PRC/ACH") ? $selected : ''?>>Achats</option>

                <option value="PRC/RMI" <?=($ex_processus=="PRC/RMI") ? $selected : ''?>>Ressource matérielles et infrastructures</option>

                <option value="PRC/COP" <?=($ex_processus=="PRC/COP") ? $selected : ''?>>Comptabilité</option>

                <option value="PRC/RHF" <?=($ex_processus=="PRC/RHF") ? $selected : ''?>>Ressource Humaineet formation</option>

                <option value="PRC/BIB" <?=($ex_processus=="PRC/BIB") ? $selected : ''?>>Bibliothèque</option>

                <option value="PRC/AML" <?=($ex_processus=="PRC/AML") ? $selected : ''?>>Amélioration SMQ</option>

                <option value="PRC/POL" <?=($ex_processus=="PRC/POL") ? $selected : ''?>>Politique et stratégie</option>

                <option value="PRC/PLA" <?=($ex_processus=="PRC/PLA") ? $selected : ''?>>Planification SMQ</option>

                <option value="PRC/COM" <?=($ex_processus=="PRC/COM") ? $selected : ''?>>Communication</option>

 		  </select>

          </td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>

   <tr><td colspan="4" height="3px"></td></tr>

		   <tr>

</form>

 </table>

<?php

}



?>