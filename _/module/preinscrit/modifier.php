<style type="text/css">
input{width:200px;}
</style>
<?php
if (isset($_POST['ci'])){

$ci=htmlentities($_POST['ci']);
$code_inscription = $_SESSION['num_inscription'] = $_POST['ci'];
$nom=addslashes(trim($_POST['nom']));
$prenom=addslashes(trim($_POST['prenom']));
$date_naissance=$_POST['year_n'].'-'.$_POST['month_n'].'-'.$_POST['day_n'];
$date_insc=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
$lieu_naissance=addslashes($_POST['lieu_naissance']);
$tel=addslashes($_POST['tel']);
$adresse=addslashes($_POST['adresse']);
$serie_bac=$_POST['serie_bac'];
$semestre=$_POST['semestre'];
$filiere=$_POST['filiere'];
$cin=$_POST['cin'];
$pass=md5(trim(strtolower($_POST['cin'])));
$email=$_POST['mail'];
$nationalite=addslashes($_POST['nationalite']);
$sexe=$_POST['sexe'];
$code_bac=$_POST['code_bac'];
$serie_bac=$_POST['serie_bac'];
$cinq_photo=$_POST['cinq_photo'];
$copie_bac=$_POST['copie_bac'];
$copie_cin=$_POST['copie_cin'];
$extrait=$_POST['extrait'];
$test_fr=$_POST['note_fr'];
$test_eng=$_POST['note_eng'];
$test_logique=$_POST['note_logique'];
$test_math=$_POST['note_math'];
$buletin=$_POST['buletin']; 
$reglement=$_POST['reglement'];
$trois_lettre=$_POST['trois_lettre'];
$trois_enveloppe=$_POST['trois_enveloppe'];
$aquise=addslashes($_POST['aquise']);
$groupe=$_POST['groupe'];
$annee=$_POST['annee'];
$original_bac=$_POST['original_bac'];
$english_bac=$_POST['english_bac'];
$activite=addslashes($_POST['activite']);
$annee_inscription=date('Y');
$ville = $_POST['ville'];
$niveau = $_POST['niveau'];
$elearning = $_POST['elearning'];
$original_bac = $_POST['original_bac'];
$english_bac = $_POST['english_bac'];
$piimt = isset($_POST['piimt']) ? $_POST['piimt'] : 0;
$aul = isset($_POST['aul']) ? $_POST['piimt'] : 0;
$umt = isset($_POST['umt']) ? $_POST['piimt'] : 0;
$attestation_fr = addslashes($_POST['attestation_fr']);
$attestation_eng = addslashes($_POST['attestation_eng']);
$fraisinscription = $_POST['fraisinscription'];
$observation = $_POST['observation'];
$montantbourse=$_POST['montantbourse'];
  
                    // �a sera ex�cut� en cas l'utilisateur change le code d'inscription           
                   /* if($code_inscription!=$ci){

 
					// update table etudiant

                        $sql="UPDATE tbl_preinscrit SET `code_inscription`='$ci',
 						`nom` = '$nom',
						`prenom` = '$prenom',
						`date_naissance` = '$date_naissance',
						`nationalite` = '$nationalite',
						`adresse` = '$adresse',
 						`sexe` = '$sexe',
						`fraisinscription` = '$fraisinscription',
						`code_bac` = '$code_bac', 
						`observation` = '$observation',
						`montantbourse` = '$montantbourse',
						`date_inscription` = '$date_insc',
						`tel` = '$tel',
 						`email` = '$mail',
						`annee` = '$annee',
						`semestre` = '$semestre',
						`filiere` = '$filiere',
 						`lieu_naissance` = '$lieu_naissance',
						`cin` = '$cin',
						`cinq_photo` = '$cinq_photo',
						`original_bac` = '$original_bac',
						`copie_bac` = '$copie_bac',
 						`english_bac` = '$english_bac',
						`trois_lettre` = '$trois_lettre',
						`trois_enveloppe` = '$trois_enveloppe',
						`buletin` = '$buletin',
 						`reglement` = '$reglement',
						`copie_cin` = '$copie_cin', 
						`extrait_naissance` = '$extrait',
						`test_fr` = '$test_fr',
						`test_eng` = '$test_eng',
 						`test_logique` = '$test_logique',
						`test_math` = '$test_math', 
						`aquise_academique` = '$aquise',
						`groupe` = '$groupe',
						`activite` = '$activite',
 						`annee_inscription` = '$annee_inscription',
						`niveau` = '$niveau',
						`ville` = '$ville',
						`elearning` = '$elearning',
						`piimt` = '$piimt',
						`aul` = '$aul',
						`umt` = '$umt',
						`attestation_fr` = '$attestation_fr',
						`attestation_eng` = '$attestation_eng'
						 WHERE `code_inscription` ='$code_inscription' limit 1 ";

             @mysql_query($sql) or die ("erreur lors de la mise � jour dans la table etudiant");
						   

              //update table inscription


            /* $sql1="update $tbl_inscription_cours set code_inscription='$ci' 
			 where code_inscription='$code_inscription'";
             @mysql_query($sql1) or die ("erreur lors de la mise � jour dans la table inscription");


    		 //update table note

             $sql2="update $tbl_note set code_inscription='$ci' 
	         where code_inscription='$code_inscription'";
             @mysql_query($sql2) or die ("erreur lors de la mise � jour dans la table note"); 
						  

			//update table absence

             $sql3="update $tbl_absence set code_inscription='$ci' 
			 where code_inscription='$code_inscription'";
             @mysql_query($sql3) or die ("erreur lors de la mise � jour dans la table absence");
							 

		   //update table buletin

            $sql4="update $tbl_buletin set code_inscription='$ci' 
			where code_inscription='$code_inscription'";
            @mysql_query($sql4) or die ("erreur lors de la mise � jour dans la table buletin");
			 
					
			//update table demande

            $sql5="update $tbl_demande set code_inscription='$ci' 
			where code_inscription='$code_inscription'";
            @mysql_query($sql5) or die ("erreur lors de la mise � jour du 
			code inscription dans la table demande");

			//update table log 

            $sql6="update $tbl_log set id_user='$ci'  
		    where id_user='$code_inscription'";
            @mysql_query($sql6) or die ("erreur lors de la mise � jour dans la table log.");
					

			//update table sondage

            $sql7="update $tbl_sondage_data set code_inscription='$ci' 
			where code_inscription='$code_inscription'";
            @mysql_query($sql7) or die ("erreur lors de la mise � jour du dans la table sondage");
					
			//update table emprunt

            $sql8="update $tbl_empreinte set code_inscription='$ci'  
			       where code_inscription='$code_inscription'";																
            @mysql_query($sql8) or die ("erreur lors de la mise � jour du dans la table emprunt"); 
			
			//update table buletin

            $sql8="update $tbl_buletin set code_inscription='$ci'  
			       where code_inscription='$code_inscription'";																
            @mysql_query($sql8) or die ("erreur lors de la mise � jour du dans la table buletin"); */
                                          	
											
											?>

			<!--<script type="text/javascript" language="JavaScript1.2">
			
				window.location.replace('gestion_preinscrit.php');
			
			</script>//-->
				
              <?php


                                                    /*      }
                                         else{*/

					 $sql="UPDATE tbl_preinscrit SET 
					 `code_inscription`='$ci',
 						`nom` = '$nom',
						`prenom` = '$prenom',
						`date_naissance` = '$date_naissance',
						`nationalite` = '$nationalite',
						`adresse` = '$adresse',
 						`sexe` = '$sexe',
						`code_bac` = '$code_bac',
					`fraisinscription` = '$fraisinscription',
						 
						`observation` = '$observation',
						`montantbourse` = '$montantbourse',
						`date_inscription` = '$date_insc',
						`tel` = '$tel',
 						`email` = '$email',
						`annee` = '$annee',
						`semestre` = '$semestre',
						`filiere` = '$filiere',
 						`lieu_naissance` = '$lieu_naissance',
						`cin` = '$cin',
						`cinq_photo` = '$cinq_photo',
						`original_bac` = '$original_bac',
						`copie_bac` = '$copie_bac',
 						`english_bac` = '$english_bac',
						`trois_lettre` = '$trois_lettre',
						`trois_enveloppe` = '$trois_enveloppe',
						`buletin` = '$buletin',
 						`reglement` = '$reglement',
						`copie_cin` = '$copie_cin', 
						`extrait_naissance` = '$extrait',
						`test_fr` = '$test_fr',
						`test_eng` = '$test_eng',
 						`test_logique` = '$test_logique',
						`test_math` = '$test_math', 
						`aquise_academique` = '$aquise',
						`groupe` = '$groupe',
						`activite` = '$activite',
 						`annee_inscription` = '$annee_inscription',
						`niveau` = '$niveau',
						`ville` = '$ville',
						`elearning` = '$elearning',
						`piimt` = '$piimt',
						`aul` = '$aul',
						`umt` = '$umt',
						`attestation_fr` = '$attestation_fr',
						`attestation_eng` = '$attestation_eng'
						
						 WHERE `code_inscription` ='$code_inscription' limit 1 "; 
//die($sql);
         @mysql_query($sql)or die ("erreur lors de la mise � jour de cet �tudiant");

        // }
               if( (!isset($_SESSION['tri_par_code'])) && (!isset($_SESSION['niveau'])) 
			   && (!isset($_SESSION['filiere'])) && (!isset($_SESSION['annee'])) ){

                          $_SESSION['search']=$nom;

                      }

			?>

			<script type="text/javascript" language="JavaScript1.2">
			<!--
				   window.location.replace('gestion_preinscrit.php');
			//-->
			</script>

              <?php

			  }

			  else{

			  $code_inscription = $_GET["modifier"];
			  $sql2="select * from tbl_preinscrit  
			  where code_inscription='$code_inscription' limit 1 ";
			  $req2=@mysql_query($sql2) or die("erreur lors du chargements  des donn�es");
			  $row=mysql_fetch_assoc($req2);
			  
			   $code_inscription = $row['code_inscription'];
			   $nom = htmlentities($row['nom']);
			   $prenom = htmlentities($row['prenom']);
 			   $nationalite=htmlentities($row['nationalite']);
			   $adresse = htmlentities($row['adresse']);
			   $sexe = trim($row['sexe']);
			   $code_bac = htmlentities($row['code_bac']);
			   $semestre = $row['semestre'];
			   $montantbourse = $row['montantbourse'];
			   $fraisinscription = $row['fraisinscription'];
			   $observation = $row['observation'];
			   $date_inscription = htmlentities($row['date_inscription']);
			   $tel = htmlentities($row['tel']);
			   $email =htmlentities($row['email']);
			   $filiere =html_entity_decode($row['filiere']);
			   $lieu_naissance =htmlentities($row['lieu_naissance']);
			   $cin =htmlentities($row['cin']);
			   $groupe =htmlentities($row['groupe']);
			   //$financeur  =htmlentities($row['financeur']);
			   //$last_diplome =htmlentities($row['last_diplome']);
			   $cinq_photo  =htmlentities($row['cinq_photo']);
			   $buletin = htmlentities($row['buletin']);
			   $copie_cin = htmlentities($row['copie_cin']);
			   $copie_bac  =  htmlentities($row['copie_bac']);
		       $extrait_naissance = htmlentities($row['extrait_naissance']);
		       $test_fr = htmlentities($row['test_fr']) ;
			   $test_eng = htmlentities($row['test_eng']);
			   $test_math = $row['test_math'] ;
			   $test_logique = $row['test_logique'];
			   $original_bac = $row['original_bac'];
			   $english_bac = $row['english_bac'];
			   $trois_lettre = $row['trois_lettre'];
			   $trois_enveloppe = $row['trois_enveloppe'];
			   $aquise_academique = htmlentities($row['aquise_academique']) ;
			   $login = htmlentities($row['login']) ;
			   $pass = $row['cin'] ;
			   $acces = $row['acces'] ;
			   $etat = $row['groupe'] ;
			   $reglement = html_entity_decode($row['reglement']) ;
               $annee = htmlentities($row['annee']) ;
			   $activite = htmlentities($row['activite']);
			   $y = substr($row['date_naissance'], 0,4);
		       $m = substr($row['date_naissance'], 5,2);
		       $d = substr($row['date_naissance'], 8,2);
			   $yi = substr($date_inscription, 0,4);
		       $mi = substr($date_inscription, 5,2);
		       $di = substr($date_inscription, 8,2);
			   $niveau = htmlentities($row['niveau']);
			   $ville = htmlentities($row['ville']);
			   $elearning = htmlentities($row['elearning']);
			   $piimt = $row['piimt'];
			   $aul = $row['aul'];
			   $umt = $row['umt'];
			   $bba='Bachelor of Business Administration';
			   $mba='Master of Business Administration';
			   $attestations_count = $row['attestations_count'];
			   $attestation_fr = stripslashes($row['attestation_fr']);
			   $attestation_eng = stripslashes($row['attestation_eng']);
			  ?>
 <style type="text/css">
input{
width:230px;
}
</style>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/etudiants.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES PRE-INSCRITS
	<span class="task">[modifier]</span></td>
	<td width="22%">
	  <table border="0" align="right" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:validate1();"> <div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_preinscrit.php" ><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>

 <form method="post" action="gestion_preinscrit.php?modifier=oui" name="f_ajout" >
 <input type="hidden" value="<?=$code_inscription?>" name="id" id="id" />
	 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		  <tr>
		  	  <td colspan="4" height="3px"><div id="er_code" class="erreur"></div></td>
		  </tr>
		  
		  <tr>
			  <td width="25%"><label for="ci">Num�ro d'inscription :</label> </td>
			  <td width="25%">
				<input type="text" name="ci" id="ci" class="input" value="<?=$code_inscription?>"  onchange="onUpdateVerify()" onkeyup="onUpdateVerify()" />
			  </td>
			  <td width="25%"><label for="buletin">Buletin de notes : </label></td>
			  <td>
				   <select name="buletin" id="buletin" class="combobox">
				       <option value="1" <?=($buletin==1) ?  $selected : '' ?>>oui</option>
			   		   <option value="0" <?=($buletin==0) ?  $selected : '' ?>>non</option>
				   </select>
			   </td>
		  </tr>
		  
		 
		  <tr>
			   <td><label for="nom">Nom :</label> </td>
			   <td><input type="text" name="nom" id="nom" class="input" value="<?=$nom?>" /></td>
			   <td><label for="cinq_photo">5 photos :</label> </td>
			   <td>
				   <select name="cinq_photo" id="cinq_photo" class="combobox">
					  <option value="1" <?=($cinq_photo==1) ?  $selected : '' ?>>oui</option>
			   	      <option value="0" <?=($cinq_photo==0) ?  $selected : '' ?>>non</option>
				   </select>
			   </td>
		  </tr>

		  <tr>
		  	   <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="prenom">Pr�nom : </label></td>
			  <td>
				<input type="text" name="prenom" id="prenom" class="input" value="<?=$prenom?>" />
			  </td>
			   <td><label for="copie_bac">Copie du bac :</label> </td>
			   <td>
				   <select name="copie_bac" id="copie_bac" class="combobox">
					   <option value="1" <?=($copie_bac==1) ?  $selected : '' ?>>oui</option>
			   	      <option value="0" <?=($copie_bac==0) ?  $selected : '' ?>>non</option>
				   </select>
			   </td>
		  </tr>
		  
		  <tr>
		  	  <td colspan="4" height="3px"></td>
		  </tr>
		  
		    <tr>
		  	  <td><label for="year_n">date de naissance : </label></td>
		  	  <td>
			  <select name="year_n" id="year_n" class="input">
		  <?php 
		  $param=date('Y')-16;
		  for ($i=1960; $i<$param; $i++){
		  ?>
		  <option value="0000">0000</option>
		  <option value="<?=$i?>" <?=($y==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  &nbsp;</select>
		  &nbsp;<select name="month_n" class="input">
		  <option value="00">00</option>
		  <?php for ($i=1; $i<13; $i++){
		  ?>
		  <option value="<?=$i?>" <?=($m==$i) ? $selected  : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		 </select>
		  &nbsp;<select name="day_n" class="input">
		   <option value="00">00</option>
		  <?php for ($i=1; $i<32; $i++){
		  ?>
		  <option value="<?=$i?>" <?=($d==$i) ? $selected  : ''?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
		      </td>
			    <td><label for="fraisinscription">Frais d'inscription :</label> </td>
		  <td><input type="text" name="fraisinscription" id="fraisinscription" value="<?=$fraisinscription?>" class="input" /></td>
			   
		  </tr>
		  
		   <tr>
			  <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
		  	  <td><label for="lieu_naissance">Lieu de naissance : </label></td>
		  	  <td>
			  	<input type="text" name="lieu_naissance" id="lieu_naissance" value="<?=$lieu_naissance?>" class="input"/>
			  </td>
		      <td><label for="lieu_naissance">Copie cin :</label> </td>
		      <td>
				  <select name="copie_cin" id="copie_cin" class="combobox">
					   <option value="1" <?=($copie_cin==1) ? $selected : '' ?>>oui</option>
					   <option value="0" <?=($copie_cin==0) ? $selected : '' ?>>non</option>
				  </select>
		     </td>
		  </tr>
		  
		  <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="tel">Num�ro de t�l�phone :</label> </td>
			  <td>
				<input type="text" name="tel" value="<?=$tel?>" id="tel" class="input"/>
			  </td>
			  <td><label for="extrait">Extrait de naissance : </label></td>
			  <td>
				   <select name="extrait" id="extrait" class="combobox">
				        <option value="1" <?=($extrait_naissance==1) ? $selected : '' ?>>oui</option>
					   <option value="0" <?=($extrait_naissance==0) ? $selected : '' ?>>non</option>
				   </select>
			   </td>
		  </tr>
		  
		  <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="adresse">Adresse :</label> </td>
			   <td>
					<input type="text" name="adresse" id="adresse" value="<?=$adresse?>" class="input"/>
			   </td>
			   <td><label for="note_fr">Note de test en fran&ccedil;ais :</label> </td>
			   <td>
					<input type="text" name="note_fr" id="note_fr" value="<?=$test_fr?>" class="input"/>
			   </td>
		  </tr>
		  <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
          <tr>
			  <td><label for="original_bac">Bac original : </label></td>
			  <td>
				   <select name="original_bac" id="original_bac" class="combobox">
				        <option value="1" <?=($original_bac==1) ?  $selected : '' ?>>oui</option>
			   	        <option value="0" <?=($original_bac==0) ?  $selected : '' ?>>non</option>
				   </select>
			   </td>
			   <td><label for="note_logique">Note de test � la logique :</label> </td>
			   <td>
					<input type="text" name="note_logique"  id="note_logique" value="<?=$test_logique?>" class="input"/>
			   </td>
		  </tr>
          <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
          <tr>
			  <td><label for="english_bac">Bac en englais : </label></td>
			  <td>
				   <select name="english_bac" id="english_bac" class="combobox">
				        <option value="1" <?php echo $english_bac==1 ?  $selected : '' ?>>oui</option>
			   	      <option value="0" <?php echo $english_bac==0 ?  $selected : '' ?>>non</option>
				   </select>
			   </td>
			   <td><label for="note_math">Note de test au math&eacute;matique :</label> </td>
			   <td>
					<input type="text" name="note_math" id="note_math" value="<?=$test_math?>" class="input"/>
			   </td>
		  </tr>
          <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
          <tr>
			  <td><label for="trois_lettre">Trois lettres : </label></td>
			  <td>
				   <select name="trois_lettre" id="trois_lettre" class="combobox">
				        <option value="1" <?=($trois_lettre==1) ?  $selected : '' ?>>oui</option>
			   	        <option value="0" <?=($trois_lettre==0) ?  $selected : '' ?>>non</option>
				   </select>
			   </td>
			   <td><label for="trois_enveloppe">Trois enveloppe: </label></td>
			  <td>
				   <select name="trois_enveloppe" id="trois_enveloppe" class="combobox">
				        <option value="1" <?=($trois_enveloppe==1) ?  $selected : '' ?>>oui</option>
			   	        <option value="0" <?=($trois_enveloppe==0) ?  $selected : '' ?>>non</option>
				   </select>
			   </td>
		  </tr>
           
		  <tr>
		  	   <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  
			   <td><label for="note_eng">Note de test en englais :</label> </td>
			   <td><input type="text" name="note_eng" id="note_eng" value="<?=$test_eng?>" class="input"/></td>
			   <td><label for="montantbourse">Montant Bourse :</label> </td>
		  <td><input type="text" name="montantbourse" id="montantbourse" value="<?=$montantbourse?>" class="input" /></td>
		  </tr>
		  
		  <tr><td colspan="4" height="3px"></td></tr>
		  
		  <tr>
		  <td><label for="semestre">Semestre : </label></td>
		  <td>
			  <select name="semestre" id="semestre" style="width:200px" class="input">
 				  <option value="NULL">S�lectionnner</option>
				  <option value="1 FR" <?=$semestre=='1 FR' ? $selected : ''; ?>>Premier semestre FR</option>
				  <option value="2 FR" <?=$semestre=='2 FR' ? $selected : ''; ?>>Deuxi�me semestre FR</option>
				  <option value="3 FR" <?=$semestre=='3 FR' ? $selected : ''; ?>>Troisi�me semestre FR</option>
				  <option value="4 FR" <?=$semestre=='4 FR' ? $selected : ''; ?>>Quatri�me semestre FR</option>
				  <option value="5 FR" <?=$semestre=='5 FR' ? $selected : ''; ?>>Cinqui�me semestre FR</option>
				  <option value="6 FR" <?=$semestre=='6 FR' ? $selected : ''; ?>>Sixi�me semestre FR</option>
				  <option value="7 FR" <?=$semestre=='7 FR' ? $selected : ''; ?>>Septi�me semestre FR</option>
				  <option value="8 FR" <?=$semestre=='8 FR' ? $selected : ''; ?>>Huiti�me semestre FR</option>
				  <option value="9 FR" <?=$semestre=='9 FR' ? $selected : ''; ?>>Neivi�me semestre FR</option>
				  <option value="10 FR" <?=$semestre=='10 FR' ? $selected : ''; ?>>dixi�me semestre FR</option>
                  <option value="1 ANG" <?=$semestre=='1 ANG' ? $selected : ''; ?>>Premier semestre ANG</option>
				  <option value="2 ANG" <?=$semestre=='2 ANG' ? $selected : ''; ?>>Deuxi�me semestre ANG</option>
				  <option value="3 ANG" <?=$semestre=='3 ANG' ? $selected : ''; ?>>Troisi�me semestre ANG</option>
				  <option value="4 ANG" <?=$semestre=='4 ANG' ? $selected : ''; ?>>Quatri�me semestre ANG</option>
				  <option value="5 ANG" <?=$semestre=='5 ANG' ? $selected : ''; ?>>Cinqui�me semestre ANG</option>
				  <option value="6 ANG" <?=$semestre=='6 ANG' ? $selected : ''; ?>>Sixi�me semestre ANG</option>
				  <option value="7 ANG" <?=$semestre=='7 ANG' ? $selected : ''; ?>>Septi�me semestre ANG</option>
				  <option value="8 ANG" <?=$semestre=='8 ANG' ? $selected : ''; ?>>Huiti�me semestre ANG</option>
				  <option value="9 ANG" <?=$semestre=='9 ANG' ? $selected : ''; ?>>Neivi�me semestre ANG</option>
				  <option value="10 ANG" <?=$semestre=='10 ANG' ? $selected : ''; ?>>dixi�me semestre ANG</option>
 			  </select>
		  </td>
		   <td><label for="aquise">Aquise acad&eacute;mique :</label></td>
		   <td>
		   		<input type="text" name="aquise" id="aquise" value="<?=$aquise_academique?>" class="input" />
				</td>
		  </tr>
		  
		   <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="filiere">filiere : </label></td>
			  <td>
				  <select name="filiere" id="filiere" style="width:200px" class="input">
					<option value="8">S�lectionnner</option>
				 <?php 
				  $sql3="select  id_filiere, nom_filiere from $tbl_filiere ";
				 $req=mysql_query($sql3) or die("erreur lors de la s�lection des filiere");
				 while ($row=mysql_fetch_assoc($req)){
				 ?>
				 <option value="<?=$row['id_filiere']?>" <?=$row['id_filiere']==$filiere ? $selected : ''; ?>><?=$row['nom_filiere']?></option>
				 <?php
				 }
				 ?>
				 </select>
			   </td>
			   <td><label for="reglement">R&egrave;glement lu et approuv�: </label></td>
			  <td>
				   <select name="reglement" id="reglement" class="combobox">
				        <option value="1" <?=($reglement==1) ?  $selected : '' ?>>oui</option>
			   	        <option value="0" <?=($reglement==0) ?  $selected : '' ?>>non</option>
				   </select>
			   </td>
		  </tr>
		  
		  <tr>
		  	   <td colspan="4" height="3px"><div id="er_cin" class="erreur"></div></td>
		  </tr>
		  
		  <tr>
		   <td><label for="cin">Num&eacute;ro de CIN :</label> </td>
		   <td><input type="text" name="cin" id="cin" class="input"  value="<?=$cin?>"  onchange="onAddVerifyCin()" onkeyup="onAddVerifyCin()"/></td>
		   <td><label for="year_i">Date d'inscription :</label></td>
		   <td>
		   <select name="year_i" id="year_i" class="input">
		  <?php for ($i=date('Y'); $i>2005; $i--){?>
		  <option value="<?=$i?>" <?=($yi==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
		  &nbsp;<select name="month_i" class="input">
					  <option value="01" <?=($mi==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=($mi==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=($mi==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=($mi==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=($mi==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=($mi==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=($mi==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=($mi==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=($mi==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=($mi==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=($mi==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=($mi==12) ? $selected : '' ?>>12</option>
				  </select>
			  &nbsp;
				  <select name="day_i" class="input">
					  <option value="01" <?=($di==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=($di==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=($di==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=($di==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=($di==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=($di==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=($di==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=($di==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=($di==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=($di==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=($di==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=($di==12) ? $selected : '' ?>>12</option>
					  <option value="13" <?=($di==13) ? $selected : '' ?>>13</option>
					  <option value="14" <?=($di==14) ? $selected : '' ?>>14</option>
					  <option value="15" <?=($di==15) ? $selected : '' ?>>15</option>
					  <option value="16" <?=($di==16) ? $selected : '' ?>>16</option>
					  <option value="17" <?=($di==17) ? $selected : '' ?>>17</option>
					  <option value="18" <?=($di==18) ? $selected : '' ?>>18</option>
					  <option value="19" <?=($di==19) ? $selected : '' ?>>19</option>
					  <option value="20" <?=($di==20) ? $selected : '' ?>>20</option>
					  <option value="21" <?=($di==21) ? $selected : '' ?>>21</option>
					  <option value="22" <?=($di==22) ? $selected : '' ?>>22</option>
					  <option value="23" <?=($di==23) ? $selected : '' ?>>23</option>
					  <option value="24" <?=($di==24) ? $selected : '' ?>>24</option>
					  <option value="25" <?=($di==25) ? $selected : '' ?>>25</option>
					  <option value="26" <?=($di==26) ? $selected : '' ?>>26</option>
					  <option value="27" <?=($di==27) ? $selected : '' ?>>27</option>
					  <option value="28" <?=($di==28) ? $selected : '' ?>>28</option>
					  <option value="29" <?=($di==29) ? $selected : '' ?>>29</option>
					  <option value="30" <?=($di==30) ? $selected : '' ?>>30</option>
					  <option value="31" <?=($di==31) ? $selected : '' ?> >31</option>
				</select>
		  </td>
		  </tr>
		  
		   <tr>
		  	<td colspan="4" height="3px"><div id="er_mail" class="erreur"></div></td>
		  </tr>
		  
		   <tr>
		  <td><label for="mail">Email : </label></td>
		  <td><input type="text" name="mail" id="mail" class="input" value="<?=$email?>" /></td>
		    <td><label for="code_bac">Code du bac :</label> </td>
		  <td><input type="text" name="code_bac" id="code_bac" value="<?=$code_bac?>" class="input" /></td>
		  </tr>
		  
		  <tr><td colspan="4" height="3px"></td></tr>
		  
		  <tr>
		  <td><label for="nationalite">Nationalit� :</label> </td>
		  <td><input type="text" name="nationalite" id="nationalite" value="<?=$nationalite?>" class="input" /></td>
		  <td><label for="groupe">Groupe : </label></td>
			  <td>
					<select name="groupe" id="groupe" style="width:200px" class="input" 
					onchange="get_selected()" >
					<?php
					$sql4="select id, title from $tbl_groupe where archive = 0 ";
					$req=mysql_query($sql4);
					while($row=mysql_fetch_assoc($req)){
					?>
				  <option value="<?=$row['id']?>" <?=$row['id']==$groupe ? $selected : ''?>>&nbsp;<?=$row['title']?></option>
					<?php }?>
				  </select>
			  </td>
		  </tr>
		  
		  <tr><td colspan="4" height="3px"></td></tr>
		  
		  <tr>
			  <td><label for="sexe">Sexe :</label> </td>
			  <td>
					 <select name="sexe" id="sexe" class="input" style="width:200px">
						<option value="masculin" <?=$sexe=='masculin' ? $selected : ''?>>Masculin</option>
						<option value="f�minin" <?=$sexe=='f�minin' ? $selected : ''?>>F�minin</option>

					</select>
			  </td>
			 <td><label for="activite">Activit� :</label></td>
		    <td><input type="text" name="activite" id="activite" value="<?=$activite?>" class="input" /></td>
		  </tr>
		  
		   <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
          <tr>
			  <td><label for="annee">Ann�e :</label> </td>
			  <td>
					<select name="annee" id="annee" style="width:200px" class="input">
					 	<option value="">S&eacute;l&eacute;ctionner</option>
                        <option value="1" <?=($annee==1) ? $selected : '' ?>>1.ann&eacute;e</option>
                        <option value="2" <?=($annee==2) ? $selected : '' ?>>2.ann&eacute;e</option>
                        <option value="3" <?=($annee==3) ? $selected : '' ?>>3.ann&eacute;e</option>
                        <option value="4" <?=($annee==4) ? $selected : '' ?>>4.ann&eacute;e</option>
                        <option value="5" <?=($annee==5) ? $selected : '' ?>>5.ann&eacute;e</option>
                        <option value="master" <?=($annee=='master') ? $selected : '' ?>>master</option>
                        <option value="MBA" <?=($annee=='MBA') ? $selected : '' ?>>MBA</option>
				  </select>
			  </td>
			 <td><label for="elearning">Elearning</label></td>
		    <td>
            <select name="elearning" id="elearning" style="width:200px" class="input">
					<option value="1" <?php echo $elearning==1 ? $selected : ''?>>oui</option>
					<option value="0" <?php echo $elearning==0 ? $selected : ''?>>non</option>
 				  </select>
            </td>
		  </tr>
          <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  <tr>
			  <td><label for="niveau">Niveau :</label> </td>
			  <td>
					<select name="niveau" id="niveau" style="width:200px" class="input">
					<option value="BBA" <?php echo $niveau=='BBA' ? $selected : ''?>>BBA</option>
					<option value="MASTER" <?php echo $niveau=='MASTER' ? $selected : ''?>>MASTER</option>
                    <option value="MBA" <?php echo $niveau=='MBA' ? $selected : ''?>>MBA</option> 
				  </select>
			  </td>
			 <td><label for="ville">Ville :</label> </td>
		    <td><select name="ville" id="ville" style="width:200px" class="input">
					<option value="Rabat" <?php echo $ville=='Rabat' ? $selected : ''?>>Rabat</option>
					<option value="Casablanca" <?php echo $ville=='Casablanca' ? $selected : ''?>>Casablanca</option>
                    <option value="F�s" <?php echo $ville=='F�s' ? $selected : ''?>>F�s</option>
                    <option value="Marrakech" <?php echo $ville=='Marrakech' ? $selected : ''?>>Marrakech</option> 
                    <option value="Mekn�s" <?php echo $ville=='Mekn�s' ? $selected : ''?>>Mekn�s</option> 
                    <option value="Oujda" <?php echo $ville=='Oujda' ? $selected : ''?>>Oujda</option> 
                    <option value="Tanger" <?php echo $ville=='Tanger' ? $selected : ''?>>Tanger</option>
				  </select></td>
		  </tr>
          <tr>
            <td><label for="piimt"> PIIMT:</label></td>
            <td><input type="checkbox" name="piimt" id="piimt" value="1" <?php echo $piimt==1 ? $checked : ''?> /></td>
			<td><label for="observation">Observation :</label> </td>
		  <td><TEXTAREA name="observation" cols="40" rows="10" maxlength="500"><?= $observation;?></textarea>  
		  </td>
	      </tr>
          <tr>
          	<td><label for="aul"> AUL:</label></td>
            <td><input type="checkbox" name="aul" id="aul" value="1" <?php echo $aul==1 ? $checked : ''?> /></td>
          </tr>
          <tr>
            <td><label for="umt"> UMT:</label></td>
            <td><input type="checkbox" name="umt" id="umt" value="1" <?php echo $umt==1 ? $checked : ''?> /></td>
            
          </tr>
          <tr>
            <td valign="top"><label for="attestation_fr"> Attestation fr:</label></td>
            <td colspan="3"><textarea cols="" rows="" name="attestation_fr" id="attestation_fr" style="width:900px; height:100px;"><?php if ($attestation_fr!=''){ echo $attestation_fr; } else {?>Est �tudiant<?=$sexe=='masculin' ? '' : 'e'?> au programme du <?php echo $niveau?> ��<?=$niveau=='BBA' ? $bba : $mba ?>�� au sein de  l�Institut Sup�rieur
 ��Private International Institute Of Management and Technology�� P.I.I.M.T pour l�ann�e universitaire <?php echo date('Y')-1?>-<?php echo date('Y')?>.<?php }?></textarea></td>
          </tr>
          <tr>
            <td valign="top"><label for="attestation_eng"> Attestation eng:</label></td>
            <td colspan="3"><textarea cols="" name="attestation_eng" id="attestation_eng" rows="" style="width:900px; height:100px;"><?php if ($attestation_fr!=''){ echo $attestation_eng; } else {?>Is  following the   <?php echo $niveau?> <?=$niveau=='BBA' ? $bba : $mba ?>�� for the year <?php echo date('Y')-1?>-<?php echo date('Y')?>.<?php }?></textarea></td>
          </tr>
		  </table>
	     </td>
		</tr>  
	  </table>
</form>
        <?php
         }
        ?>