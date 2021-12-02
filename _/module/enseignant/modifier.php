			<?php
			if(isset($_GET["archiver"])){
			
			  $id=(int)$_GET["archiver"]; 
			  $sql="update $tbl_professeur set archive= 1 WHERE code_prof = '$id' limit 1";
			  @mysql_query($sql)or die ("erreur lors de l'archivage du professeur");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
			window.location.replace('gestion_enseignants.php?archive=oui');
			//-->
			</script>
			<?php
			 }
				  if(isset($_GET["desarchiver"])){
			  $id=(int)$_GET["desarchiver"]; 
			  $sql="update $tbl_professeur set archive= 0 WHERE code_prof = '$id' limit 1";
			  @mysql_query($sql)or die ("erreur lors du désarchivage du professeur");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
			 window.location.replace('gestion_enseignants.php');
			//-->
			</script>
					<?php
					}
					 if (isset($_POST['nom'])){
					$nationalite=$_POST['nationalite'];
					$matiere=$_POST['matiere'];
					$nom=addslashes($_POST['nom']);
					$mail=$_POST['mail'];
					$mail1=addslashes($_POST['mail1']);
					$contact=$_POST['contact'];
					$niveau=$_POST['niveau'];
					$type=$_POST['type'];
					$login=$_POST['login'];
					$diplome=addslashes($_POST['diplome']).';'.addslashes($_POST['diplome1']).';'.addslashes($_POST['diplome2']);
					$commentaire=$_POST['commentaire'];
					$id=$_POST['id'];
					$pass=$_POST['pass'];

										function sendMail($n,$m,$nT,$mT,$sujet,$body) {
 									   // l'émetteur
									   $tete = "From: ".$n." <".$m.">\n";
									   $tete .= "Reply-To: ".$m."\n";
									   // et zou... false si erreur d'émission
									   return mail($nT." <".$mT.">",$sujet,$body,$tete);
									  												  }

											if($pass!=''){
											
											$send=true;
											
											$sql="UPDATE $tbl_professeur SET `nom_prenom` = '$nom', `nationnalite` = '$nationalite', `diplome` = '$diplome',
												`matiere` = '$matiere', `mail` = '$mail', `mail1` = '$mail1',	`contact` = '$contact', `niveau` = '$niveau',
												`type` = '$type', `login` = '$login', `mot_pass` = md5('$pass'), `commentaire` = '$commentaire' 
												 WHERE code_prof ='$id' LIMIT 1 ";
  										   
												 }
												 else{

											$sql="UPDATE $tbl_professeur SET `nom_prenom` = '$nom',`nationnalite` = '$nationalite',`diplome` = '$diplome',
												`matiere` = '$matiere',`mail` = '$mail',`mail1` = '$mail1',	`contact` = '$contact',`niveau` = '$niveau',
												`type` = '$type',`login` = '$login',`commentaire` = '$commentaire' 
												 WHERE code_prof ='$id' LIMIT 1 ";
												}
												 

           									@mysql_query($sql)or die ("erreur lors de la modification du profil enseignant");
											if($send==true){
											   $sujet= 'Votre login et mot de passe';
											   $body='votre login est : '.$login.' et votre mot de passe est :'.$send_pass;
											   sendMail('PIIMT SYSTEM ADMIN','a.maghlaoui@gmail.com',$nom,$mail,$sujet,$body);
										   					}
															 
 
                      if( (!isset($_SESSION['type'])) && (!isset($_SESSION['niveau_enseigne'])) ){

                          $_SESSION['search']=$nom;

                      }




			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('gestion_enseignants.php');

			//-->

			</script>

              <?php

			  }

			  else{

			   $id=$_GET["modifier"];

			  $sql2="select * from $tbl_professeur where code_prof='$id' limit 1";

	$req=@mysql_query($sql2) or die("erreur lors de la sélection des informations de l'enseignant");

			  $row=mysql_fetch_assoc($req);
               
	 $code_prof=htmlentities($row['code_prof']);
	 $nom_prenom=htmlentities($row['nom_prenom']);
	 $nationnalite=htmlentities($row['nationnalite']);
	 $diplome=htmlentities($row['diplome']);
	 $matiere=htmlentities($row['matiere']);
	 $mail=htmlentities($row['mail']);
	 $mail1=htmlentities($row['mail1']);
	 $contact=htmlentities($row['contact']);
	 $niveau=htmlentities($row['niveau']);
	 $type=htmlentities($row['type']);
	 $login=htmlentities($row['login']);
	 $ex_mot_pass=htmlentities($row['mot_pass']);
	 $commentaire=htmlentities($row['commentaire']);
	 $tbl = explode(";", $diplome); 
			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DES ENSEIGNANTS <span class="task">[modifier]</span> </td>
	<td width="10%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="return onUpdateValidate();"><div class="save"></div> Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_enseignants.php" ><div class="cancel"></div> Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>

 <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">
 <form method="post" action="gestion_enseignants.php?modifier=oui" name="f_ajout" >
 <input type="hidden" name="id" value="<?=$code_prof?>" />
 		  <tr>
		  <td width="25%">Nom et prénom </td>
		  <td width="25%">
		  <input type="text" name="nom" id="nom" class="input input_size" value="<?=$nom_prenom?>" />
		  </td>

		  <td width="45%"><div id="er_nom" class="erreur"></div> </td>
		  <td width="5%"></td>
		  </tr>
 		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
		  <td>Nationalité : </td>
		  <td>
   <input type="text" name="nationalite" id="nationalite" class="input input_size" value="<?=$nationnalite?>" />
          </td>
		   <td>&nbsp;</td>
		    <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td> </tr>
		  
		   <tr>
		  <td>E-mail : </td>
		  <td>
		  <input type="text" name="mail" id="mail" class="input input_size" value="<?=$mail?>" />
		  </td>
		   <td colspan="2"><div id="er_mail" class="erreur"></div></td>
		   </tr>
		   
		 
		   <tr>
		  <td>Phone : </td>
		  <td>
	<input type="text" name="contact" id="contact" class="input input_size" value="<?=$contact?>"/>
	</td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
		  <td>Degrees : </td>
		  <td>
      <input type="text" name="diplome" id="diplome" class="input input_size" 
	  value="<?=(isset($tbl[0])) ? $tbl[0] : '$diplome'; ?>" />
		  
         </td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td><input type="text" name="diplome1" id="diplome1" class="input input_size" 
		  value="<?=(isset($tbl[1])) ? $tbl[1] : '' ;?>"/></td>
		  
		   <td>&nbsp;</td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
		  <td>&nbsp;</td>
		  <td><input type="text" name="diplome2" id="diplome2" class="input input_size" 
		  value="<?=(isset($tbl[2])) ? $tbl[2] : '' ;?>" /></td>
		   <td>&nbsp;</td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  
		  <tr>
		  <td>Grade :</td>
		  
		 <td>
					 <select name="niveau" id="sexe" class="input" style="width:200px">
					 	<option value="" <?=$niveau=='' ? $selected : ''?>>Grade</option>
						<option value="9th grade" <?=$niveau=='9th grade' ? $selected : ''?>>9th Grade</option>
						<option value="10th grade" <?=$niveau=='10th grade' ? $selected : ''?>>10th Grade</option>
						<option value="11th grade" <?=$niveau=='11th grade' ? $selected : ''?>>11th Grade</option>
						<option value="12th grade" <?=$niveau=='12th grade' ? $selected : ''?>>12th Grade</option>

					</select>
			  </td>
		  </td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		  </tr>
		  
 <tr><td colspan="4" height="3px"></td></tr>
		 
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		  <td>Login :</td>
		  <td>
 			<input type="text" name="login" id="login" class="input" value="<?=$login?>"  />
 		 </td>
		   <td><div id="er_login" class="erreur"></div></td>
		   <td>&nbsp;</td>
		  </tr>
           <tr><td colspan="3" height="3px"></td></tr>

		  <tr>
			  <td>Mot de Passe : </td>
			  <td><input type="text" name="pass" id="pass" class="input input_size"/></td>
			  <td></td>
		  </tr>
     </form>
	  </table>

<?php

}

?>