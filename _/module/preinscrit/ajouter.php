<style type="text/css">
input{width:200px;}
</style>
<?php
if (isset($_POST['ci'])){

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
$pass=md5(trim(strtolower($_POST['year_n'].'-'.$_POST['month_n'].'-'.$_POST['day_n'])));
$mail=$_POST['mail'];
$nationalite=addslashes($_POST['nationalite']);
$sexe=$_POST['sexe'];
$code_bac=$_POST['code_bac'];
$montantbourse=$_POST['montantbourse'];
$cinq_photo=$_POST['cinq_photo'];
$copie_bac=$_POST['copie_bac'];
$buletin_note=$_POST['buletin'];
$copie_cin=$_POST['copie_cin'];
$extrait=$_POST['extrait'];
$note_fr=$_POST['note_fr'];
$note_eng=$_POST['note_eng'];
$note_logique=$_POST['note_logique'];
$note_math=$_POST['note_math'];
$buletin=$_POST['buletin'];
$reglement=$_POST['reglement'];
$trois_lettre=$_POST['trois_lettre'];
$trois_enveloppe=$_POST['trois_enveloppe'];
$aquise=addslashes($_POST['aquise']);
$groupe=$_POST['groupe'];
$annee=$_POST['annee'];
$activite=addslashes($_POST['activite']);
$annee_inscription=date('Y');
$ville = $_POST['ville'];
$niveau = $_POST['niveau'];
$elearning = $_POST['elearning'];
$original_bac = $_POST['original_bac'];
$english_bac = $_POST['english_bac'];
$piimt = $_POST['piimt'];
$aul = $_POST['aul'];
$umt = $_POST['umt'];
$fraisinscription = $_POST['fraisinscription'];
$observation = $_POST['observation'];

 $sql_insert="INSERT INTO tbl_preinscrit  (
`code_inscription` , `nom` , `prenom` , `date_naissance` , `nationalite` , `adresse` , `sexe` , `code_bac` , 
`date_inscription` , `tel` , `email` , `annee` , `semestre` , `filiere` , `lieu_naissance` , `cin` , `cinq_photo` , `original_bac` ,
`copie_bac` , `english_bac` , `trois_lettre` , `trois_enveloppe` , `buletin` , `reglement` , `copie_cin` ,
`extrait_naissance` , `test_fr` , `test_eng` , `test_logique` , `test_math` , `aquise_academique` , `login` , `mot_pass` ,
`acces` , `groupe` , `activite` , `annee_inscription`, `niveau` , `ville` , `elearning`, `piimt`, `aul`, `umt`,`fraisinscription`,`montantbourse`,`observation`)
VALUES (

 '$code_inscription', '$nom', '$prenom', '$date_naissance', '$nationalite', '$adresse', '$sexe', '$code_bac','$date_insc', '$tel', '$mail', '$annee', '$semestre', '$filiere', '$lieu_naissance', '$cin', '$cinq_photo', '$original_bac', '$copie_bac', '$english_bac', '$trois_lettre', '$trois_enveloppe', '$buletin_note',  '$reglement', '$copie_cin', '$extrait', '$note_fr', '$note_eng', '$note_logique', '$note_math', '$aquise', '$nom', '$pass', 1, '$groupe', '$activite', '$annee_inscription', '$niveau', '$ville', '$elearning', '$piimt', '$aul', '$umt', '$fraisinscription','$montantbourse','$observation');"; 

	  @mysql_query($sql_insert)or die ("Error save studentPSI");
if($aul ==1)

{ ?>


<script type="text/javascript" language="JavaScript1.2">
window.open('http://sis.aulm.us/administrator/ajou.php?nom=<?=$nom?>&prenom=<?=$prenom?>&code_inscription=<?=$code_inscription?>&date_naissance=<?= $date_naissance?>&nationalite=<?= $nationalite?>&adresse=<?= $adresse?>&sexe=<?= $sexe?>&code_bac=<?= $code_bac?>&serie_bac=<?= $serie_bac?>&date_insc=<?= $date_insc?>&tel=<?= $tel?>&mail=<?= $mail?>&annee=<?= $annee?>&semestre=<?= $semestre?>&filiere=<?= $filiere?>&lieu_naissance=<?= $lieu_naissance?>&cin=<?= $cin?>&cinq_photo=<?= $cinq_photo?>&original_bac=<?= $original_bac?>&copie_bac=<?= $copie_bac?>&english_bac=<?= $english_bac?>&trois_lettre=<?= $trois_lettre?>&trois_enveloppe=<?= $trois_enveloppe?>&buletin_note=<?= $buletin_note?>&reglement=<?= $reglement?>&copie_cin=<?= $copie_cin?>&extrait=<?= $extrait?>&note_fr=<?= $note_fr?>&note_eng=<?= $note_eng?>&note_logique=<?= $note_logique?>&note_math=<?= $note_math?>&aquise=<?= $aquise?>&nom=<?= $nom?>&pass=<?= $pass?>&groupe=<?= $groupe?>&activite=<?= $activite?>&annee_inscription=<?= $annee_inscription?>&niveau=<?= $niveau?>&ville=<?= $ville?>&elearning=<?= $elearning?>&piimt=<?= $piimt?>&aul=<?= $aul?>&umt=<?= $umt?>','_blank','toolbar=0,menubar=0,location=0,scrollbars=0,width=720,height=720'); 
</script>

<?php }



                           $_SESSION['search'] = $nom;
						   
						   
 $sql1="select login,date_naissance,email,groupe
        from $tbl_etudiant 
		where code_inscription='$code_inscription' ";
		$resultat=@mysql_query($sql1)or die ("Error");
		 while ($ligne=mysql_fetch_array($resultat))
{
 $email=$ligne["email"];
		 $groupe=$ligne["groupe"];
		 $login=$ligne["login"];
		 $pass=$ligne["date_naissance"];
}
 if($groupe==2)
 {    $affich="";
     if($copie_cin==0)
         {
		 $affich="<br/>-Copie du Cin,";}
		 if($copie_bac==0)
		 {$affich .= '<br/>-Copie du Bac,'; }
		 if($original_bac==0)
		 {$affich .= '<br/>-Bac Original,'; }
		 if($trois_lettre==0)
		 {$affich .= '<br/>-Trois Lettres de Motivation,'; }
		 if($buletin==0)
		 {$affich .= '<br/>-Buletin des notes,'; }
		 if($extrait==0)
		 {$affich .= '<br/>-Extrait de naissance,'; }
		 if($trois_enveloppe==0)
		 {$affich .= '<br/>-Trois enveloppes,'; }
		  if($cinq_photo==0)
		 {$affich .= '<br/>-Cinq photo,'; }
		if($affich!="")
		 {$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Bienvenue dans votre espace étudiant, veuillez 

utiliser ce système <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> pour avoir votre emploi du temps, classes, stages et bulletins de notes.</p><p align="left"> Votre 

username est:'.$login.' </p><p align="left"> Votre password est:'.$pass.'</p> <p align="left"> Veuillez acceder au site à: 

<a href="http://www.piimt.us/">www.piimt.us</a></p><p align="left"> Si vous avez des questions n\'hesitez pas a nous contacter via: 

info@piimt.us</p><p align="left">Merci de nous faire parvenir les pièces manquantes ci-dessous, dans les brefs délais afin de compléter votre dossier:'.$affich.'</p></body></html>';

     if(mail($email, 'Inscription PSI',$message,$headers))
     {
          return 1;
     }
     else
     {
         return 0;
     } 
	 }
	
		 else{
   $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Bienvenue dans votre espace étudiant, veuillez 

utiliser ce système <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> pour avoir votre emploi du temps, classes, stages et bulletins de notes.</p><p align="left"> Votre 

username est:'.$login.' </p><p align="left"> Votre password est:'.$pass.'</p> <p align="left"> Veuillez acceder au site à: 

<a href="http://www.piimt.us/">www.piimt.us</a></p><p align="left"> Si vous avez des questions n\'hesitez pas a nous contacter via: 

info@piimt.us</p></body></html>';

     if(mail($email, 'Inscription PSI',$message,$headers))
     {
          return 1;
     }
     else
     {
         return 0;
     } 
	 
	 }}
 
 
 
 else
 
 {
 $affich="";
     if($copie_cin==0)
         {
		 $affich="<br/>-copie du cin,";}
		 if($copie_bac==0)
		 {$affich .= '<br/>-Copie du Bac,'; }
		 if($original_bac==0)
		 {$affich .= '<br/>-Bac Original,'; }
		 if($trois_lettre==0)
		 {$affich .= '<br/>-Trois Lettres de Motivation,'; }
		 if($buletin==0)
		 {$affich .= '<br/>-Buletin des notes,'; }
		 if($extrait==0)
		 {$affich .= '<br/>-Extrait de naissance,'; }
		 if($trois_enveloppe==0)
		 {$affich .= '<br/>-Trois enveloppes,'; }
		  if($cinq_photo==0)
		 {$affich .= '<br/>-Cinq photo,'; }
		if($affich!="")
		 { $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Welcome to your student Account, Please use this system <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> to get information
about your schedule, classes, internships and obtain your grades.</p><p align="left">Your username is:'.$login.'</p><p align="left">Your password is:'.$pass.'</p><p align="left"> The website can be reached through: 

<a href="http://www.piimt.us/">www.piimt.us</a></p><p align="left"> If you have any questions, please email us at: 

info@piimt.us</p><p align="left">We inform you that you need to complete your file by the following papers:'.$affich.'</p></body></html>';

     if(mail($email, 'Inscription PSI',$message,$headers))
     {
          return 1;
     }
     else
     {
         return 0;
     } 
 }
 
 else{
 $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Welcome to your student Account, Please use this system <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> to get information
about your schedule, classes, internships and obtain your grades.</p><p align="left">Your username is:'.$login.'</p><p align="left">Your password is:'.$pass.'</p><p align="left"> The website can be reached through: 

<a href="http://www.piimt.us/">www.piimt.us</a></p><p align="left"> If you have any questions, please email us at: 

info@piimt.us</p></body></html>';

     if(mail($email, 'Inscription PSI',$message,$headers))
     {
          return 1;
     }
     else
     {
         return 0;
     }
	 
	 
	  }}
           ?>
 			<script type="text/javascript" language="JavaScript1.2">
 			<!--
                       window.location.replace('gestion_preinscrit.php');
 			//-->
 			</script>
               <?php
                   }
                  
			  else{
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="80%" class="titre">&nbsp;GESTION DES PRE-INSCRITS <span class="task">[ajouter]</span></td>
	<td width="20%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="return validate1()"><div class="save"></div>Valider</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_preinscrit.php"><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>


  <form method="post" action="gestion_preinscrit.php?new=oui" name="f_ajout" >
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
			  <td width="25%"><label for="ci">Numéro d'inscription :</label> </td>
			  <td width="25%">
				<input type="text" name="ci" id="ci" class="input" onkeyup="onAddVerify()" onchange="onAddVerify()" />
			  </td>
			  <td width="25%"><label for="buletin">Buletin de notes : </label></td>
			  <td>
				   <select name="buletin" id="buletin" class="combobox">
				       <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				   </select>
			   </td>
		  </tr>
		  
		  <tr>
		  	  <td colspan="4" height="3px"><div id="er_nom" class="erreur"></div></td>
		  </tr>
		  
		  <tr>
			   <td><label for="nom">Nom :</label> </td>
			   <td><input type="text" name="nom" id="nom" class="input" /></td>
			   <td><label for="cinq_photo">5 photos :</label> </td>
			   <td>
				   <select name="cinq_photo" id="cinq_photo" class="combobox">
					   <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				   </select>
			   </td>
		  </tr>

		  <tr>
		  	   <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="prenom">Prénom : </label></td>
			  <td>
				<input type="text" name="prenom" id="prenom" class="input"/>
			  </td>
			   <td><label for="copie_bac">Copie du bac :</label> </td>
			   <td>
				   <select name="copie_bac" id="copie_bac" class="combobox">
					   <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
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
			  <option value="0000">0000</option>
			  <?php 
			  $cur=date('Y')-16;
			  for ($i=1960; $i<$cur; $i++){
			  ?>
			  <option value="<?=$i?>"><?=$i?></option>
			  <?php
			  }
			  ?>
			  </select>
			  &nbsp;
			  <select name="month_n" class="input">
					  <option value="00">00</option>
					  <option value="01">01</option>
					  <option value="02">02</option>
					  <option value="03">03</option>
					  <option value="04">04</option>
					  <option value="05">05</option>
					  <option value="06">06</option>
					  <option value="07">07</option>
					  <option value="08">08</option>
					  <option value="09">09</option>
					  <option value="10">10</option>
					  <option value="11">11</option>
					  <option value="12">12</option>
				  </select>
			  &nbsp;
			  <select name="day_n" class="input">
					  <option value="00">00</option>
					  <option value="01">01</option>
					  <option value="02">02</option>
					  <option value="03">03</option>
					  <option value="04">04</option>
					  <option value="05">05</option>
					  <option value="06">06</option>
					  <option value="07">07</option>
					  <option value="08">08</option>
					  <option value="09">09</option>
					  <option value="10">10</option>
					  <option value="11">11</option>
					  <option value="12">12</option>
					  <option value="13">13</option>
					  <option value="14">14</option>
					  <option value="15">15</option>
					  <option value="16">16</option>
					  <option value="17">17</option>
					  <option value="18">18</option>
					  <option value="19">19</option>
					  <option value="20">20</option>
					  <option value="21">21</option>
					  <option value="22">22</option>
					  <option value="23">23</option>
					  <option value="24">24</option>
					  <option value="25">25</option>
					  <option value="26">26</option>
					  <option value="27">27</option>
					  <option value="28">28</option>
					  <option value="29">29</option>
					  <option value="30">30</option>
					  <option value="31">31</option>
				</select>
			   </td>
			   <td></td>
			   <td></td>
		  </tr>
		  
		   <tr>
			  <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
		  	  <td><label for="lieu_naissance">Lieu de naissance : </label></td>
		  	  <td>
			  	<input type="text" name="lieu_naissance" id="lieu_naissance" class="input"/>
			  </td>
		      <td><label for="lieu_naissance">Copie cin :</label> </td>
		      <td>
				  <select name="copie_cin" id="copie_cin" class="combobox">
					   <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				  </select>
		     </td>
		  </tr>
		  
		  <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="tel">Numéro de téléphone :</label> </td>
			  <td>
				<input type="text" name="tel" id="tel" class="input"/>
			  </td>
			  <td><label for="extrait">Extrait de naissance : </label></td>
			  <td>
				   <select name="extrait" id="extrait" class="combobox">
				       <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				   </select>
			   </td>
		  </tr>
		  
		  <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="adresse">Adresse :</label> </td>
			   <td>
					<input type="text" name="adresse" id="adresse" class="input"/>
			   </td>
			   <td><label for="note_fr">Note de test en fran&ccedil;ais :</label> </td>
			   <td>
					<input type="text" name="note_fr" id="note_fr" class="input"/>
			   </td>
		  </tr>
		  <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
          <tr>
			  <td><label for="original_bac">Bac original : </label></td>
			  <td>
				   <select name="original_bac" id="original_bac" class="combobox">
				       <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				   </select>
			   </td>
			   <td><label for="note_logique">Note de test à la logique :</label> </td>
			   <td>
					<input type="text" name="note_logique"  id="note_logique" class="input"/>
			   </td>
		  </tr>
          <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
          <tr>
			  <td><label for="english_bac">Bac en englais : </label></td>
			  <td>
				   <select name="english_bac" id="english_bac" class="combobox">
				       <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				   </select>
			   </td>
			   <td><label for="note_math">Note de test au math&eacute;matique :</label> </td>
			   <td>
					<input type="text" name="note_math" id="note_math" class="input"/>
			   </td>
		  </tr>
          <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
          <tr>
			  <td><label for="trois_lettre">Trois lettres : </label></td>
			  <td>
				   <select name="trois_lettre" id="trois_lettre" class="combobox">
				       <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				   </select>
			   </td>
			   <td><label for="trois_enveloppe">Trois enveloppe: </label></td>
			  <td>
				   <select name="trois_enveloppe" id="trois_enveloppe" class="combobox">
				       <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				   </select>
			   </td>
		  </tr>
           
		  <tr>
		  	   <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="montantbourse">Montant Bourse  :</label> </td>
			  <td>
				 <input type="text" name="montantbourse" id="montantbourse" class="input" style="width:200px">
			   </td>
			   <td><label for="note_eng">Note de test en englais :</label> </td>
			   <td><input type="text" name="note_eng" id="note_eng" class="input"/></td>
		  </tr>
		  
		  <tr><td colspan="4" height="3px"></td></tr>
		  
		  <tr>
		  <td><label for="semestre">Semestre : </label></td>
		  <td>
			  <select name="semestre" id="semestre" style="width:200px" class="input">
 				  <option value="NULL">Sélectionnner</option>
				  <option value="1 FR">Premier semestre Fr</option>
				  <option value="2 FR">Deuxième semestre Fr</option>
				  <option value="3 FR">Troisième semestre Fr</option>
				  <option value="4 FR">Quatrième semestre Fr</option>
				  <option value="5 FR">Cinquième semestre Fr</option>
				  <option value="6 FR">Sixième semestre Fr</option>
				  <option value="7 FR">Septième semestre Fr</option>
				  <option value="8 FR">Huitième semestre Fr</option>
				  <option value="9 FR">Neivième semestre Fr</option>
				  <option value="10 FR">dixième semestre Fr</option>
                  <option value="1 Ang">Premier semestre Ang</option>
				  <option value="2 Ang">Deuxième semestre Ang</option>
				  <option value="3 Ang">Troisième semestre Ang</option>
				  <option value="4 Ang">Quatrième semestre Ang</option>
				  <option value="5 Ang">Cinquième semestre Ang</option>
				  <option value="6 Ang">Sixième semestre Ang</option>
				  <option value="7 Ang">Septième semestre Ang</option>
				  <option value="8 Ang">Huitième semestre Ang</option>
				  <option value="9 Ang">Neivième semestre Ang</option>
				  <option value="10 Ang">dixième semestre Ang</option>
 			  </select>
		  </td>
		   <td><label for="aquise">Aquise acad&eacute;mique :</label></td>
		   <td>
		   		<input type="text" name="aquise" id="aquise" class="input" />
				</td>
		  </tr>
		  
		   <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="filiere">filiere : </label></td>
			  <td>
				  <select name="filiere" id="filiere" style="width:200px" class="input">
					<option value="8">Sélectionnner</option>
				 <?php 
				  $sql3="select  id_filiere, nom_filiere from $tbl_filiere ";
				 $req=mysql_query($sql3) or die("erreur lors de la sélection des filiere");
				 while ($row=mysql_fetch_assoc($req)){
				 ?>
				 <option value="<?=$row['id_filiere']?>"><?=$row['nom_filiere']?></option>
				 <?php
				 }
				 ?>
				 </select>
			   </td>
			   <td><label for="reglement">R&egrave;glement lu et approuvé: </label></td>
			  <td>
				   <select name="reglement" id="reglement" class="combobox">
				       <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				   </select>
			   </td>
		  </tr>
		  
		  <tr>
		  	   <td colspan="4" height="3px"><div id="er_cin" class="erreur"></div></td>
		  </tr>
		  
		  <tr>
		   <td><label for="cin">Num&eacute;ro de CIN :</label> </td>
		   <td><input type="text" name="cin" id="cin" class="input" onchange="onAddVerifyCin()" onkeyup="onAddVerifyCin()"/></td>
		   <td><label for="year_i">Date d'inscription :</label></td>
		   <td>
		   <select name="year_i" id="year_i" class="input">
		  <?php for ($i=date('Y'); $i>1996; $i--){?>
		  <option value="<?=$i?>" <?=(date('m')==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
		  &nbsp;<select name="month_i" class="input">
					  <option value="01" <?=(date('m')==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=(date('m')==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=(date('m')==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=(date('m')==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=(date('m')==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=(date('m')==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=(date('m')==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=(date('m')==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=(date('m')==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=(date('m')==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=(date('m')==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=(date('m')==12) ? $selected : '' ?>>12</option>
				  </select>
			  &nbsp;
				  <select name="day_i" class="input">
					  <option value="01" <?=(date('d')==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=(date('d')==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=(date('d')==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=(date('d')==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=(date('d')==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=(date('d')==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=(date('d')==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=(date('d')==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=(date('d')==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=(date('d')==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=(date('d')==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=(date('d')==12) ? $selected : '' ?>>12</option>
					  <option value="13" <?=(date('d')==13) ? $selected : '' ?>>13</option>
					  <option value="14" <?=(date('d')==14) ? $selected : '' ?>>14</option>
					  <option value="15" <?=(date('d')==15) ? $selected : '' ?>>15</option>
					  <option value="16" <?=(date('d')==16) ? $selected : '' ?>>16</option>
					  <option value="17" <?=(date('d')==17) ? $selected : '' ?>>17</option>
					  <option value="18" <?=(date('d')==18) ? $selected : '' ?>>18</option>
					  <option value="19" <?=(date('d')==19) ? $selected : '' ?>>19</option>
					  <option value="20" <?=(date('d')==20) ? $selected : '' ?>>20</option>
					  <option value="21" <?=(date('d')==21) ? $selected : '' ?>>21</option>
					  <option value="22" <?=(date('d')==22) ? $selected : '' ?>>22</option>
					  <option value="23" <?=(date('d')==23) ? $selected : '' ?>>23</option>
					  <option value="24" <?=(date('d')==24) ? $selected : '' ?>>24</option>
					  <option value="25" <?=(date('d')==25) ? $selected : '' ?>>25</option>
					  <option value="26" <?=(date('d')==26) ? $selected : '' ?>>26</option>
					  <option value="27" <?=(date('d')==27) ? $selected : '' ?>>27</option>
					  <option value="28" <?=(date('d')==28) ? $selected : '' ?>>28</option>
					  <option value="29" <?=(date('d')==29) ? $selected : '' ?>>29</option>
					  <option value="30" <?=(date('d')==30) ? $selected : '' ?>>30</option>
					  <option value="31" <?=(date('d')==31) ? $selected : '' ?> >31</option>
				</select>
		  </td>
		  </tr>
		  
		   <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  
		   <tr>
		  <td><label for="mail">Email : </label></td>
		  <td><input type="text" name="mail" id="mail" class="input" /></td>
		    <td><label for="code_bac">Code du bac :</label> </td>
		  <td><input type="text" name="code_bac" id="code_bac" class="input" /></td>
		  </tr>
		  <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		   <tr>
		  <td><label for="fraisinscription">Frais d'inscription :</label> </td>
		  <td><input type="text" name="fraisinscription" id="fraisinscription" class="input" /></td>
		  </tr>
		  <tr>
		  <td colspan="4" height="3px"></td></tr>
		  
		  <tr>
		  <td><label for="nationalite">Nationalité :</label> </td>
		  <td><input type="text" name="nationalite" id="nationalite" class="input" /></td>
		  <td><label for="groupe">Groupe : </label></td>
			  <td>
					<select name="groupe" id="groupe" style="width:200px" class="input" 
					onchange="get_selected()" >
					<?php
					$sql4="select id, title from $tbl_groupe where archive = 0 ";
					$req=mysql_query($sql4);
					while($row=mysql_fetch_assoc($req)){
					?>
				  <option value="<?=$row['id']?>">&nbsp;<?=$row['title']?></option>
					<?php }?>
				  </select>
			  </td>
		  </tr>
		  
		  <tr><td colspan="4" height="3px"></td></tr>
		  
		  <tr>
			  <td><label for="sexe">Sexe :</label> </td>
			  <td>
					 <select name="sexe" id="sexe" class="input" style="width:200px">
						<option value="masculin">Masculin</option>
						<option value="féminin">Féminin</option>
					</select>
			  </td>
			 <td><label for="activite">Activité :</label></td>
		    <td><input type="text" name="activite" id="activite" class="input" /></td>
		  </tr>
		  
		   <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  <tr>
			  <td><label for="annee">Année :</label> </td>
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
					<option value="1">oui</option>
					<option value="0">non</option>
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
					<option value="BBA">BBA</option>
					<option value="MASTER">MASTER</option>
                    <option value="MBA">MBA</option> 
				  </select>
			  </td>
			 <td><label for="ville">Ville :</label> </td>
		    <td><select name="ville" id="ville" style="width:200px" class="input">
					<option value="Rabat">Rabat</option>
					<option value="Casablanca">Casablanca</option>
                    <option value="Fès">Fès</option>
                    <option value="Marrakech">Marrakech</option> 
                    <option value="Meknès">Meknès</option> 
                    <option value="Oujda">Oujda</option> 
                    <option value="Tanger">Tanger</option>
				  </select></td>
		  </tr>
          <tr>
            <td><label for="piimt"> PIIMT:</label></td>
            <td><input type="checkbox" name="piimt" id="piimt" value="1" /></td>
			
		  
		  <td><label for="observation">Observation :</label> </td>
		   <td> <TEXTAREA name="observation" rows=4 cols=40></TEXTAREA> </td>
		 
	      </tr>
          <tr>
          	<td><label for="aul"> AUL:</label></td>
            <td><input type="checkbox" name="aul" id="aul" value="1" /></td>
          </tr>
          <tr>
            <td><label for="umt"> UMT:</label></td>
            <td><input type="checkbox" name="umt" id="umt" value="1" /></td>
          </tr>
		  </table>
	     </td>
		</tr>  
	  </table>
     </form>
<?php
}

?>