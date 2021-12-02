			<?php
			if(isset($_GET["archiver"])){
			
			  $id=(int)$_GET["archiver"]; 
			  $sql="update tbl_parents set archive= 1 WHERE code_parent = '$id' limit 1";
			  @mysql_query($sql)or die ("erreur lors de l'archivage du professeur");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
			window.location.replace('parents.php?archive=oui');
			//-->
			</script>
			<?php
			 }
				  if(isset($_GET["desarchiver"])){
			  $id=(int)$_GET["desarchiver"]; 
			  $sql="update tbl_parents set archive= 0 WHERE code_parent = '$id' limit 1";
			  @mysql_query($sql)or die ("erreur lors du désarchivage du professeur");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
			 window.location.replace('parents.php');
			//-->
			</script>
					<?php
					}
					 if (isset($_POST['nom'])){
					
					$nom=addslashes($_POST['nom']);
					$mail=$_POST['mail'];				
					$contact=$_POST['contact'];
					$tel=$_POST['tel'];					
					$login=$_POST['login'];
						$code_inscription=$_POST['code_inscription'];			
					
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
											
											$sql="UPDATE tbl_parents SET `nom_prenom` = '$nom', `mail` = '$mail',`contact` = '$contact', 
												`tel` = '$tel', `login` = '$login', `mot_pass` = md5('$pass')
												 WHERE code_parent ='$id' LIMIT 1 ";
  										   
												 }
												 else{

											$sql="UPDATE tbl_parents SET `nom_prenom` = '$nom',`mail` = '$mail',`contact` = '$contact',												`tel` = '$tel',`login` = '$login'
												 WHERE code_parent ='$id' LIMIT 1 ";
												}
												 

           									@mysql_query($sql)or die ("erreur lors de la modification du profil enseignant");
											if($send==true){
											   $sujet= 'Votre login et mot de passe';
											   $body='votre login est : '.$login.' et votre mot de passe est :'.$send_pass;
											   sendMail('PIIMT SYSTEM ADMIN','zineb@aulm.us',$nom,$mail,$sujet,$body);
										   					}
															 
 
                      if( (!isset($_SESSION['type'])) && (!isset($_SESSION['niveau_enseigne'])) ){

                          $_SESSION['search']=$nom;

                      }




			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('parents.php');

			//-->

			</script>

              <?php

			  }

			  else{

			   $id=$_GET["modifier"];

			  $sql2="select * from tbl_parents where code_parent='$id' limit 1";

	$req=@mysql_query($sql2) or die("erreur lors de la sélection des informations de l'enseignant");

			  $row=mysql_fetch_assoc($req);
               
	 $code_parent=htmlentities($row['code_parent']);
	  $mail=htmlentities($row['mail']);
	 $nom_prenom=htmlentities($row['nom_prenom']);
	  $code_inscription=($row['code_inscription']);
	 $tel=htmlentities($row['tel']);	
	 $contact=htmlentities($row['contact']);	
	 $login=htmlentities($row['login']);
	 $ex_mot_pass=htmlentities($row['mot_pass']);	
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
		   <a href="parents.php" ><div class="cancel"></div> Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>

 <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">
 <form method="post" action="parents.php?modifier=oui" name="f_ajout" >
 <input type="hidden" name="id" value="<?=$code_parent?>" />
 		  <tr>
		  <td width="25%">Nom et prénom </td>
		  <td width="25%">
		  <input type="text" name="nom" id="nom" class="input input_size" value="<?=$nom_prenom?>" />
		  </td>

		  <td width="45%"><div id="er_nom" class="erreur"></div> </td>
		  <td width="5%"></td>
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
	<input type="text" name="tel" id="tel" class="input input_size" value="<?=$tel?>"/>
	</td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  
		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr>
		  <td>Adress : </td>
		  <td>
	<input type="text" name="contact" id="contact" class="input input_size" value="<?=$contact?>"/>
	</td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
						<td style="width: 95px;">Student * : </td>
						<td style="width: 280px;">
							<select name="code_inscription" class=" input input_size"  style="width:280px">
								<option value="null">Student</option>
							  	<?php
							 		$sql_prof = "SELECT * FROM `tbl_etudiant_morocco` WHERE 'archive' = 0  order by nom_prenom";
							 		$req_prof = mysql_query($sql_prof)or die ("erreur lors de la sélection des enseignants");
							 		
							 		while ($row_prof = mysql_fetch_array($req_prof)) {
							 			$selected = "";
							 			if (isset($code_inscription) && $row_prof["code_inscription"] == $code_inscription) {
							 				$selected = "selected";
							 			}
							 			if ($row_prof["code_inscription"] == $code_inscription) {
							 				$selected = "selected";
							 			}
						 				echo "<option value='".$row_prof["code_inscription"]."'".$selected.">
						 				".$row_prof["nom"].$row_prof["prenom"]"</option>";
						 			}
							 		
							 	?>
						  	</select>
						</td>
					<!--	<td style="padding-left: 26px;color: red;">
							<?php if ($_SESSION['message_prof'] == "1"): ?>
								<?php echo "ce champ est oblegatoire"; ?>
							<?php endif ?>
						</td>-->
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