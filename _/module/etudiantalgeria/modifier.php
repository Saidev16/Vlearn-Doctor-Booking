<style type="text/css">
input{width:200px;}
</style>
<?php
if (isset($_POST['ci'])){

$day_g='01';
$ci=htmlentities($_POST['ci']);
$code_inscription = $_SESSION['num_inscription'] = $_POST['ci'];
$nom=addslashes(trim($_POST['nom']));
$prenom=addslashes(trim($_POST['prenom']));
$date_naissance=$_POST['year_n'].'-'.$_POST['month_n'].'-'.$_POST['day_n'];
$graduation_date=$_POST['year_g'].'-'.$_POST['month_g'].'-'.$day_g;
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
$test_etudesoc=$_POST['note_etudesoc'];
$test_sciences=$_POST['note_sciences'];
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
//$aul = isset($_POST['aul']) ? $_POST['piimt'] : 0;
$aul = isset($_POST['aul']) ? $_POST['aul'] : 0;
$umt = isset($_POST['umt']) ? $_POST['piimt'] : 0;
$attestation_fr = addslashes($_POST['attestation_fr']);
$attestation_eng = addslashes($_POST['attestation_eng']);
$idSession = $_POST['idSession'];
$parentname = $_POST['parentname'];
$parentphone = $_POST['parentphone'];
$parentemail = $_POST['parentemail'];
$type = $_POST['type'];
  
                    // ça sera exécuté en cas l'utilisateur change le code d'inscription           
                    if($code_inscription!=$ci){

 
					// update table etudiant

                        $sql="UPDATE tbl_etudiant_algeria SET `code_inscription`='$ci',
 						`nom` = '$nom',
						`prenom` = '$prenom',
						`parentname` = '$parentname',
						`parentphone` = '$parentphone',
						`parentemail` = '$parentemail',
						`date_naissance` = '$date_naissance',
						`nationalite` = '$nationalite',
						`adresse` = '$adresse',
 						`sexe` = '$sexe',
						`code_bac` = '$code_bac',
						`serie_bac` = '$serie_bac',
						`date_inscription` = '$date_insc',
						`tel` = '$tel',
 						`email` = '$mail',
						`annee` = '$annee',
						`semestre` = '$idSession',
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
						`test_etudesoc` = '$test_etudesoc',
 						`test_sciences` = '$test_sciences',
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
						`attestation_eng` = '$attestation_eng',
						`type` = '$type',
							`graduation_date` = '$graduation_date'
						 WHERE `code_inscription` ='$code_inscription' limit 1 ";

             @mysql_query($sql) or die ("erreur lors de la mise à jour dans la table etudiant");
			
											?>

			<script type="text/javascript" language="JavaScript1.2">
			<!--
				window.location.replace('gestion_des_etudiants_algeria.php');
			//-->
			</script>
				
              <?php


                                                          }
                                         else{

					 $sql="UPDATE tbl_etudiant_algeria SET  
 						`nom` = '$nom',
						`prenom` = '$prenom',
						`date_naissance` = '$date_naissance',
						`nationalite` = '$nationalite',
						`adresse` = '$adresse',
 						`sexe` = '$sexe',
						`code_bac` = '$code_bac',
						`serie_bac` = '$serie_bac',
						`date_inscription` = '$date_insc',
						`tel` = '$tel',
 						`email` = '$email',
						`annee` = '$annee',
						`semestre` = '$idSession',
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
						`test_etudesoc` = '$test_etudesoc',
 						`test_sciences` = '$test_sciences',
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
						`attestation_eng` = '$attestation_eng',
						`parentname` = '$parentname',
						`parentphone` = '$parentphone',
						`parentemail` = '$parentemail',
						`type` = '$type',
							`graduation_date` = '$graduation_date'
						
						 WHERE `code_inscription` ='$code_inscription' limit 1 "; 
//die($sql);
         @mysql_query($sql)or die ("erreur lors de la mise à jour de cet étudiant");


          $sql2="UPDATE tbl_etudiant_all SET  
 						`nom` = '$nom',
						`prenom` = '$prenom',
						`date_naissance` = '$date_naissance',
						`nationalite` = '$nationalite',
						`adresse` = '$adresse',
 						`sexe` = '$sexe',
						`code_bac` = '$code_bac',
						`serie_bac` = '$serie_bac',
						`date_inscription` = '$date_insc',
						`tel` = '$tel',
 						`email` = '$email',
						`annee` = '$annee',
						`semestre` = '$idSession',
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
						`test_etudesoc` = '$test_etudesoc',
 						`test_sciences` = '$test_sciences',
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
						`attestation_eng` = '$attestation_eng',
						`parentname` = '$parentname',
						`parentphone` = '$parentphone',
						`parentemail` = '$parentemail',
						`type` = '$type',
							`graduation_date` = '$graduation_date'
						
						 WHERE `code_inscription` ='$code_inscription' and prefixe='AG' limit 1 "; 
//die($sql);
         @mysql_query($sql2)or die ("erreur lors de la mise à jour de cet étudiant");

         }
               if( (!isset($_SESSION['tri_par_code'])) && (!isset($_SESSION['niveau'])) 
			   && (!isset($_SESSION['filiere'])) && (!isset($_SESSION['annee'])) ){

                          $_SESSION['search']=$nom;

                      }

			?>
<?php  if ($type !='Prospect') { ?>
		<!--	<script type="text/javascript" language="JavaScript1.2">
	
				   window.location.replace('gestion_des_etudiants_algeria.php');

			</script>
		-->
 <script type="text/javascript" language="JavaScript1.2">
          window.location.replace('/module/api_testing/edit_user.php?code_inscription=<?php echo $code_inscription; ?>&prefixe=AG');
 			</script>

              <?php
}
			  }

			  else{
			  $code_inscription = $_GET["modifier"];
			  $sql2="select * from tbl_etudiant_algeria  
			  where code_inscription='$code_inscription' limit 1 ";
			  $req2=@mysql_query($sql2) or die("erreur lors du chargements  des données");
			  $row=mysql_fetch_assoc($req2);
			  
			   $code_inscription = $row['code_inscription'];
			   $nom = htmlentities($row['nom']);
			   $prenom = htmlentities($row['prenom']);
 			   $nationalite=htmlentities($row['nationalite']);
			   $adresse = htmlentities($row['adresse']);
			   $sexe = trim($row['sexe']);
			   $code_bac = htmlentities($row['code_bac']);
			   $idSession = $row['semestre'];
			   $serie_bac = htmlentities($row['serie_bac']);
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
			   $test_sciences = htmlentities($row['test_sciences']);
			   $test_math = $row['test_math'] ;
			   $test_etudesoc = $row['test_etudesoc'];
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
			   $parentname = $row['parentname'];
			   $parentphone = $row['parentphone'];
			   $parentemail = $row['parentemail'];
			    $yg = substr($row['graduation_date'], 0,4);
		       $mg = substr($row['graduation_date'], 5,2);
		       $dg = substr($row['graduation_date'], 8,2);
		         $type = $row['type'];
			  ?>
 <style type="text/css">
input{
width:230px;
}
</style>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/etudiants.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;Edit  Students 
	<span class="task">[EDIT]</span></td>
	<td width="22%">
	  <table border="0" align="right" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:validate();"> <div class="save"></div>Submit</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_des_etudiants_algeria.php" ><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>

 <form method="post" action="gestion_des_etudiants_algeria.php?modifier=Yes" name="f_ajout" >
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
		  	  <td colspan="4" height="3px"><div id="er_nom" class="erreur"></div></td>
		  </tr>
		  <tr>
		  <td width="25%"><label for="ci">Registration Code :</label> </td>
			  <td width="25%">
				<input type="text" name="ci" id="ci" class="input" value="<?=$code_inscription?>"  onchange="onUpdateVerify()" onkeyup="onUpdateVerify()" />
			  </td>
		  </tr>
		  <tr>
			   <td><label for="nom">First Name  :</label> </td>
			   <td><input type="text" name="nom" id="nom" class="input" value="<?=$prenom?>" /></td>
			   <td></td>
			    <td><label for="prenom">Last Name  : </label></td>
			  <td>
				<input type="text" name="prenom" id="prenom" class="input" value="<?=$nom?>" />
			  </td>
			  
		  </tr>

		  <tr>
		  	  <td colspan="4" height="3px"></td>
		  </tr>
		  
		    <tr>
		  	  <td><label for="year_n">Date of birth  : </label></td>
		  	  <td>
			  <select name="month_n" class="input">
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
		  </select>  &nbsp;
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
		
			   </td>
			    <td></td>
				 <td><label for="sexe">Gender :</label> </td>
			  <td>
					 <select name="sexe" id="sexe" class="input" style="width:200px">
					 	<option value="" <?=$sexe=='' ? $selected : ''?>></option>
						<option value="male" <?=$sexe=='male' ? $selected : ''?>>Male</option>
						<option value="female" <?=$sexe=='female' ? $selected : ''?>>Female</option>

					</select>
			  </td>
			  </tr>
		  
		  <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="adresse">Adress :</label> </td>
			   <td>
					<input type="text" name="adresse" id="adresse" value="<?=$adresse?>" class="input"/>
			   </td>
			   <td>
			   </td>
			    <td><label for="tel">Cell :</label> </td>
			  <td>
				<input type="text" name="tel" value="<?=$tel?>" id="tel" class="input"/>
			  </td>
			   
			  <!-- <td><label for="note_fr">Grade of French:</label> </td>
			   <td>
					<input type="text" name="note_fr" id="note_fr" value="<?=$test_fr?>" class="input"/>
			   </td>-->
		  </tr>
		  <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr> <tr>
		   <td><label for="cin">ID,Passport or Driver's Licence :</label> </td>
		   <td><input type="text" name="cin" id="cin" class="input"  value="<?=$cin?>"  onchange="onAddVerifyCin()" onkeyup="onAddVerifyCin()"/></td>
		   <td>
			   </td>
			   <td><label for="year_i">Registration date :</label></td>
		   <td>
		   <select name="month_i" class="input">
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
					  &nbsp;
		   <select name="year_i" id="year_i" class="input">
		  <?php for ($i=date('Y'); $i>2005; $i--){?>
		  <option value="<?=$i?>" <?=($yi==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
	
		  </td>
		  
		  
		  </tr>
		  
		 <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		   <td><label for="mail">Email : </label></td>
		  <td><input type="text" name="mail" id="mail" class="input" value="<?=$email?>" /></td>
		  <td></td><td><label for="nationalite">Nationality :</label> </td>
		  <td><input type="text" name="nationalite" id="nationalite" value="<?=$nationalite?>" class="input" /></td>
		  
		  </tr>
		  
		  <tr><td colspan="4" height="3px"></td></tr>
          <tr>
			 
			<!--   <td><label for="note_sciences">Grade of Sciences :</label> </td>
			   <td>
					<input type="text" name="note_sciences"  id="note_sciences" value="<?=$test_sciences?>" class="input"/>
			   </td>-->
			 
			    <td><label for="groupe">Section : </label></td>
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
			   <td>
			   </td>
			     <td><label for="reglement">Student Signature: </label></td>
			  <td>
				   <select name="reglement" id="reglement" class="combobox">
				        <option value="1" <?=($reglement==1) ?  $selected : '' ?>>Yes</option>
			   	        <option value="0" <?=($reglement==0) ?  $selected : '' ?>>No</option>
				   </select>
			   </td>
		  </tr>
          <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
		   <tr>
		  	  <td><label for="lieu_naissance">Name of Lasted School attented : </label></td>
		  	  <td>
			  	<input type="text" name="lieu_naissance" id="lieu_naissance" value="<?=$lieu_naissance?>" class="input"/>
			  </td><td></td>
			    <td><label for="code_bac">School Adress :</label> </td>
		  <td><input type="text" name="code_bac" id="code_bac" value="<?=$code_bac?>" class="input" /></td>
		    
		  </tr>
		   <tr>
		  	  <td colspan="4" height="3px"></td>
		  </tr>
          <tr>
			  <td><label for="english_bac">Last completed level : </label></td>
			  <td>
			  <select name="english_bac" id="english_bac" class="combobox">
                 <option value="0" selected="selected"></option>
                   <option value="5" <?php echo $english_bac==5 ?  $selected : '' ?>>5th Grade</option>
                     <option value="6" <?php echo $english_bac==6 ?  $selected : '' ?>>6th Grade</option>
                       <option value="7" <?php echo $english_bac==7 ?  $selected : '' ?>>7th Grade</option>
                         <option value="8" <?php echo $english_bac==8 ?  $selected : '' ?>>8th Grade</option>

                 <option value="1" <?php echo $english_bac==1 ?  $selected : '' ?>>9th Grade</option>
                 <option value="2" <?php echo $english_bac==2 ?  $selected : '' ?>>10th Grade</option>
                 <option value="3" <?php echo $english_bac==3 ?  $selected : '' ?>>11th Grade</option>
                 <option value="4" <?php echo $english_bac==4 ?  $selected : '' ?>>12th Grade</option>
               </select>
			   </td>
			    <td>
			   </td>
			   <td><label for="ville">Country:</label></td>
			      
			  <td>
					<select name="ville" id="ville" style="width:200px" class="input">
				
					<option value="" <?php echo $ville==''?$selected : ''?>> </option> 
					<option value="United States" <?php echo $ville=='United States'?$selected : ''?>>United States</option>
<option value="United Kingdom"<?php echo $ville=='United Kingdom'?$selected : ''?>>United Kingdom</option>
<option value="Afghanistan"<?php echo $ville=='Afghanistan'?$selected : ''?>>Afghanistan</option>
<option value="Albania"<?php echo $ville=='Albania'?$selected : ''?>>Albania</option>
<option value="Algeria"<?php echo $ville=='Algeria'?$selected : ''?>>Algeria</option>
<option value="American Samoa" <?php echo $ville=='American Samoa'?$selected : ''?>>American Samoa</option>
<option value="Andorra" <?php echo $ville=='Andorra'?$selected : ''?>>Andorra</option>
<option value="Angola" <?php echo $ville=='Angola'?$selected : ''?>>Angola</option>
<option value="Anguilla" <?php echo $ville=='Anguilla'?$selected : ''?>>Anguilla</option>
<option value="Antarctica" <?php echo $ville=='Antarctica'?$selected : ''?>>Antarctica</option>
<option value="Antigua and Barbuda" <?php echo $ville=='Antigua and Barbuda'?$selected : ''?>>Antigua and Barbuda</option>
<option value="Argentina" <?php echo $ville=='Argentina'?$selected : ''?>>Argentina</option>
<option value="Armenia"<?php echo $ville=='Armenia'?$selected : ''?>>Armenia</option>
<option value="Aruba" <?php echo $ville=='Aruba'?$selected : ''?>>Aruba</option>
<option value="Australia" <?php echo $ville=='Australia'?$selected : ''?>>Australia</option>
<option value="Austria" <?php echo $ville=='Austria'?$selected : ''?>>Austria</option>
<option value="Azerbaijan" <?php echo $ville=='Azerbaijan'?$selected : ''?>>Azerbaijan</option>
<option value="Bahamas" <?php echo $ville=='Bahamas'?$selected : ''?>>Bahamas</option>
<option value="Bahrain" <?php echo $ville=='Bahrain'?$selected : ''?>>Bahrain</option>
<option value="Bangladesh" <?php echo $ville=='Bangladesh'?$selected : ''?>>Bangladesh</option>
<option value="Barbados" <?php echo $ville=='Barbados'?$selected : ''?>>Barbados</option>
<option value="Belarus" <?php echo $ville=='Belarus'?$selected : ''?>>Belarus</option>
<option value="Belgium" <?php echo $ville=='Belgium '?$selected : ''?>>Belgium</option>
<option value="Belize" <?php echo $ville=='Belize'?$selected : ''?>>Belize</option>
<option value="Benin" <?php echo $ville=='Benin'?$selected : ''?>>Benin</option>
<option value="Bermuda" <?php echo $ville=='Bermuda'?$selected : ''?>>Bermuda</option>
<option value="Bhutan" <?php echo $ville=='Bhutan'?$selected : ''?>>Bhutan</option>
<option value="Bolivia" <?php echo $ville=='Bolivia'?$selected : ''?>>Bolivia</option>
<option value="Bosnia and Herzegovina" <?php echo $ville=='Bosnia and Herzegovina'?$selected : ''?>>Bosnia and Herzegovina</option>
<option value="Botswana" <?php echo $ville=='Botswana'?$selected : ''?>>Botswana</option>
<option value="Bouvet Island" <?php echo $ville=='Bouvet Island'?$selected : ''?>>Bouvet Island</option>
<option value="Brazil" <?php echo $ville=='Brazil'?$selected : ''?>>Brazil</option>
<option value="British Indian Ocean Territory" <?php echo $ville=='British Indian Ocean Territory'?$selected : ''?>>British Indian Ocean Territory</option>
<option value="Brunei Darussalam" <?php echo $ville=='Brunei Darussalam'?$selected : ''?>>Brunei Darussalam</option>
<option value="Bulgaria" <?php echo $ville=='Bulgaria'?$selected : ''?>>Bulgaria</option>
<option value="Burkina Faso" <?php echo $ville=='Burkina Faso'?$selected : ''?>>Burkina Faso</option>
<option value="Burundi" <?php echo $ville=='Burundi'?$selected : ''?>>Burundi</option>
<option value="Cambodia" <?php echo $ville=='Cambodia'?$selected : ''?>>Cambodia</option>
<option value="Cameroon" <?php echo $ville=='Cameroon'?$selected : ''?>>Cameroon</option>
<option value="Canada" <?php echo $ville=='Canada'?$selected : ''?>>Canada</option>
<option value="Cape Verde" <?php echo $ville=='Cape Verde'?$selected : ''?>>Cape Verde</option>
<option value="Cayman Islands" <?php echo $ville=='Cayman Islands'?$selected : ''?>>Cayman Islands</option>
<option value="Central African Republic" <?php echo $ville=='Central African Republic'?$selected : ''?>>Central African Republic</option>
<option value="Chad" <?php echo $ville=='Chad'?$selected : ''?>>Chad</option>
<option value="Chile" <?php echo $ville=='Chile'?$selected : ''?>>Chile</option>
<option value="China" <?php echo $ville=='China'?$selected : ''?>>China</option>
<option value="Christmas Island" <?php echo $ville=='Christmas Island'?$selected : ''?>>Christmas Island</option>
<option value="Cocos (Keeling) Islands" <?php echo $ville=='Cocos (Keeling) Islands'?$selected : ''?>>Cocos (Keeling) Islands</option>
<option value="Colombia" <?php echo $ville=='Colombia'?$selected : ''?>>Colombia</option>
<option value="Comoros" <?php echo $ville=='Comoros'?$selected : ''?>>Comoros</option>
<option value="Congo" <?php echo $ville=='Congo'?$selected : ''?>>Congo</option>
<option value="Cook Islands" <?php echo $ville=='Cook Islands'?$selected : ''?>>Cook Islands</option>
<option value="Costa Rica" <?php echo $ville=='Costa Rica'?$selected : ''?>>Costa Rica</option>
<option value="Cote D'ivoire" <?php echo $ville=='Cote D ivoire'?$selected : ''?>>Cote D'ivoire</option>
<option value="Croatia" <?php echo $ville=='Croatia'?$selected : ''?>>Croatia</option>
<option value="Cuba" <?php echo $ville=='Cuba'?$selected : ''?>>Cuba</option>
<option value="Cyprus" <?php echo $ville=='Cyprus'?$selected : ''?>>Cyprus</option>
<option value="Czech Republic" <?php echo $ville=='Czech Republic'?$selected : ''?>>Czech Republic</option>
<option value="Denmark" <?php echo $ville=='Denmark'?$selected : ''?>>Denmark</option>
<option value="Djibouti" <?php echo $ville=='Djibouti'?$selected : ''?>>Djibouti</option>
<option value="Dominica"<?php echo $ville=='Dominica'?$selected : ''?>>Dominica</option>
<option value="Dominican Republic" <?php echo $ville=='Dominican Republic'?$selected : ''?>>Dominican Republic</option>
<option value="Ecuador" <?php echo $ville=='Ecuador'?$selected : ''?>>Ecuador</option>
<option value="Egypt" <?php echo $ville=='Egypt'?$selected : ''?>>Egypt</option>
<option value="El Salvador" <?php echo $ville=='El Salvador'?$selected : ''?>>El Salvador</option>
<option value="Equatorial Guinea" <?php echo $ville=='Equatorial Guinea'?$selected : ''?>>Equatorial Guinea</option>
<option value="Eritrea" <?php echo $ville=='Eritrea'?$selected : ''?>>Eritrea</option>
<option value="Estonia" <?php echo $ville=='Estonia'?$selected : ''?>>Estonia</option>
<option value="Ethiopia" <?php echo $ville=='Ethiopia'?$selected : ''?>>Ethiopia</option>
<option value="Fiji" <?php echo $ville=='Fiji'?$selected : ''?>>Fiji</option>
<option value="Finland" <?php echo $ville=='Finland'?$selected : ''?>>Finland</option>
<option value="France" <?php echo $ville=='France'?$selected : ''?>>France</option>
<option value="Gabon"<?php echo $ville=='Gabon'?$selected : ''?>>Gabon</option>
<option value="Gambia"<?php echo $ville=='Gambia'?$selected : ''?>>Gambia</option>
<option value="Georgia"<?php echo $ville=='Georgia'?$selected : ''?>>Georgia</option>
<option value="Germany"<?php echo $ville=='Germany'?$selected : ''?>>Germany</option>
<option value="Ghana" <?php echo $ville=='Ghana'?$selected : ''?>>Ghana</option>
<option value="Gibraltar"<?php echo $ville=='Gibraltar'?$selected : ''?>>Gibraltar</option>
<option value="Greece"<?php echo $ville=='Greece'?$selected : ''?>>Greece</option>
<option value="Greenland"<?php echo $ville=='Greenland'?$selected : ''?>>Greenland</option>
<option value="Grenada"<?php echo $ville=='Grenada'?$selected : ''?>>Grenada</option>
<option value="Guadeloupe"<?php echo $ville=='Guadeloupe'?$selected : ''?>>Guadeloupe</option>
<option value="Guam"<?php echo $ville=='Guam'?$selected : ''?>>Guam</option>
<option value="Guatemala"<?php echo $ville=='Guatemala'?$selected : ''?>>Guatemala</option>
<option value="Guinea"<?php echo $ville=='Guinea'?$selected : ''?>>Guinea</option>
<option value="Guinea-bissau"<?php echo $ville=='Guinea-bissau'?$selected : ''?>>Guinea-bissau</option>
<option value="Guyana"<?php echo $ville=='Guyana'?$selected : ''?>>Guyana</option>
<option value="Haiti"<?php echo $ville=='Haiti'?$selected : ''?>>Haiti</option>
<option value="Honduras"<?php echo $ville=='Honduras'?$selected : ''?>>Honduras</option>
<option value="Hong Kong"<?php echo $ville=='Hong Kong'?$selected : ''?>>Hong Kong</option>
<option value="Hungary"<?php echo $ville=='Hungary'?$selected : ''?>>Hungary</option>
<option value="Iceland"<?php echo $ville=='Iceland'?$selected : ''?>>Iceland</option>
<option value="India"<?php echo $ville=='India'?$selected : ''?>>India</option>
<option value="Indonesia"<?php echo $ville=='Indonesia'?$selected : ''?>>Indonesia</option>
<option value="Iraq"<?php echo $ville=='Iraq'?$selected : ''?>>Iraq</option>
<option value="Ireland"<?php echo $ville=='Ireland'?$selected : ''?>>Ireland</option>
<option value="Israel"<?php echo $ville=='Israel'?$selected : ''?>>Israel</option>
<option value="Italy"<?php echo $ville=='Italy'?$selected : ''?>>Italy</option>
<option value="Jamaica"<?php echo $ville=='Jamaica'?$selected : ''?>>Jamaica</option>
<option value="Japan"<?php echo $ville=='Japan'?$selected : ''?>>Japan</option>
<option value="Jordan"<?php echo $ville=='Jordan'?$selected : ''?>>Jordan</option>
<option value="Kazakhstan<?php echo $ville=='Kazakhstan'?$selected : ''?>">Kazakhstan</option>
<option value="Kenya"<?php echo $ville=='Kenya'?$selected : ''?>>Kenya</option>
<option value="Kiribati"<?php echo $ville=='Kiribati'?$selected : ''?>>Kiribati</option>
<option value="Korea"<?php echo $ville=='Korea'?$selected : ''?>>Korea, Republic of</option>
<option value="Kuwait"<?php echo $ville=='Kuwait'?$selected : ''?>>Kuwait</option>
<option value="Latvia"<?php echo $ville=='Latvia'?$selected : ''?>>Latvia</option>
<option value="LebaNo"<?php echo $ville=='LebaNo'?$selected : ''?>>LebaNo</option>
<option value="Lesotho"<?php echo $ville=='Lesotho'?$selected : ''?>>Lesotho</option>
<option value="Liberia"<?php echo $ville=='Liberia'?$selected : ''?>>Liberia</option>
<option value="Liechtenstein"<?php echo $ville=='Liechtenstein'?$selected : ''?>>Liechtenstein</option>
<option value="Lithuania"<?php echo $ville=='Lithuania'?$selected : ''?>>Lithuania</option>
<option value="Luxembourg"<?php echo $ville=='Luxembourg'?$selected : ''?>>Luxembourg</option>
<option value="Macao"<?php echo $ville=='Macao'?$selected : ''?>>Macao</option>
<option value="Madagascar"<?php echo $ville=='Madagascar'?$selected : ''?>>Madagascar</option>
<option value="Malawi"<?php echo $ville=='Malawi'?$selected : ''?>>Malawi</option>
<option value="Malaysia"<?php echo $ville=='Malaysia'?$selected : ''?>>Malaysia</option>
<option value="Maldives"<?php echo $ville=='Maldives'?$selected : ''?>>Maldives</option>
<option value="Mali"<?php echo $ville=='Mali'?$selected : ''?>>Mali</option>
<option value="Malta"<?php echo $ville=='Malta'?$selected : ''?>>Malta</option>
<option value="Marshall Islands" <?php echo $ville=='Marshall Islands'?$selected : ''?>>Marshall Islands</option>
<option value="Martinique" <?php echo $ville=='Martinique'?$selected : ''?>>Martinique</option>
<option value="Mauritania" <?php echo $ville=='Mauritania'?$selected : ''?>>Mauritania</option>
<option value="Mauritius" <?php echo $ville=='Mauritius'?$selected : ''?>>Mauritius</option>
<option value="Mayotte" <?php echo $ville=='Mayotte'?$selected : ''?>>Mayotte</option>
<option value="Mexico" <?php echo $ville=='Mexico'?$selected : ''?>>Mexico</option>
<option value="Monaco"<?php echo $ville=='Monaco'?$selected : ''?>>Monaco</option>
<option value="Mongolia"<?php echo $ville=='Mongolia'?$selected : ''?>>Mongolia</option>
<option value="Montenegro"<?php echo $ville=='Montenegro'?$selected : ''?>>Montenegro</option>
<option value="Montserrat"<?php echo $ville=='Montserrat'?$selected : ''?>>Montserrat</option>
<option value="Morocco"<?php echo $ville=='Morocco'?$selected : ''?>>Morocco</option>
<option value="Mozambique"<?php echo $ville=='Mozambique'?$selected : ''?>>Mozambique</option>
<option value="Myanmar"<?php echo $ville=='Myanmar'?$selected : ''?>>Myanmar</option>
<option value="Namibia"<?php echo $ville=='Namibia'?$selected : ''?>>Namibia</option>
<option value="Nauru"<?php echo $ville=='Nauru'?$selected : ''?>>Nauru</option>
<option value="Nepal"<?php echo $ville=='Nepal'?$selected : ''?>>Nepal</option>
<option value="Netherlands"<?php echo $ville=='Netherlands'?$selected : ''?>>Netherlands</option>
<option value="Netherlands Antilles"<?php echo $ville=='Netherlands Antilles'?$selected : ''?>>Netherlands Antilles</option>
<option value="New Caledonia"<?php echo $ville=='New Caledonia'?$selected : ''?>>New Caledonia</option>
<option value="New Zealand"<?php echo $ville=='New Zealand'?$selected : ''?>>New Zealand</option>
<option value="Nicaragua"<?php echo $ville=='Nicaragua'?$selected : ''?>>Nicaragua</option>
<option value="Niger"<?php echo $ville=='Niger'?$selected : ''?>>Niger</option>
<option value="Nigeria"<?php echo $ville=='Nigeria'?$selected : ''?>>Nigeria</option>
<option value="Niue"<?php echo $ville=='Niue'?$selected : ''?>>Niue</option>
<option value="Norfolk Island"<?php echo $ville=='Norfolk Island'?$selected : ''?>>Norfolk Island</option>
<option value="Northern Mariana Islands"<?php echo $ville=='Northern Mariana Islands'?$selected : ''?>>Northern Mariana Islands</option>
<option value="Norway"<?php echo $ville=='Norway'?$selected : ''?>>Norway</option>
<option value="Oman" <?php echo $ville=='Oman'?$selected : ''?>>Oman</option>
<option value="Pakistan" <?php echo $ville=='Pakistan'?$selected : ''?>>Pakistan</option>
<option value="Palau" <?php echo $ville=='Palau'?$selected : ''?>>Palau</option>
<option value="Palestinian Territory, Occupied" <?php echo $ville=='Palestinian Territory, Occupied'?$selected : ''?>>Palestinian Territory, Occupied</option>
<option value="Panama" <?php echo $ville=='Panama'?$selected : ''?>>Panama</option>
<option value="Papua New Guinea" <?php echo $ville=='Papua New Guinea'?$selected : ''?>>Papua New Guinea</option>
<option value="Paraguay" <?php echo $ville=='Paraguay'?$selected : ''?>>Paraguay</option>
<option value="Peru" <?php echo $ville=='Peru'?$selected : ''?>>Peru</option>
<option value="Philippines" <?php echo $ville=='Philippines'?$selected : ''?>>Philippines</option>
<option value="Pitcairn" <?php echo $ville=='Pitcairn'?$selected : ''?>>Pitcairn</option>
<option value="Poland" <?php echo $ville=='Poland'?$selected : ''?>>Poland</option>
<option value="Portugal" <?php echo $ville=='Portugal'?$selected : ''?>>Portugal</option>
<option value="Puerto Rico" <?php echo $ville=='Puerto Rico'?$selected : ''?>>Puerto Rico</option>
<option value="Qatar" <?php echo $ville=='Qatar'?$selected : ''?>>Qatar</option>
<option value="Reunion" <?php echo $ville=='Reunion'?$selected : ''?>>Reunion</option>
<option value="Romania" <?php echo $ville=='Romania'?$selected : ''?>>Romania</option>
<option value="Russian Federation" <?php echo $ville=='Russian Federation'?$selected : ''?>>Russian Federation</option>
<option value="Rwanda" <?php echo $ville=='Rwanda'?$selected : ''?>>Rwanda</option>
<option value="Saint Helena" <?php echo $ville=='Saint Helena'?$selected : ''?>>Saint Helena</option>
<option value="Saint Kitts and Nevis"<?php echo $ville=='Saint Kitts and Nevis'?$selected : ''?>>Saint Kitts and Nevis</option>
<option value="Saint Lucia"<?php echo $ville=='Saint Lucia'?$selected : ''?>>Saint Lucia</option>
<option value="Saint Pierre and Miquelon"<?php echo $ville=='Saint Pierre and Miquelon'?$selected : ''?>>Saint Pierre and Miquelon</option>
<option value="Saint Vincent and The Grenadines"<?php echo $ville=='Saint Vincent and The Grenadines'?$selected : ''?>>Saint Vincent and The Grenadines</option>
<option value="Samoa"<?php echo $ville=='Samoa'?$selected : ''?>>Samoa</option>
<option value="San Marino"<?php echo $ville=='San Marino'?$selected : ''?>>San Marino</option>
<option value="Sao Tome and Principe"><?php echo $ville=='Sao Tome and Principe'?$selected : ''?>Sao Tome and Principe</option>
<option value="Saudi Arabia"<?php echo $ville=='Saudi Arabia'?$selected : ''?>>Saudi Arabia</option>
<option value="Senegal"<?php echo $ville=='Senegal'?$selected : ''?>>Senegal</option>
<option value="Serbia" <?php echo $ville=='Serbia'?$selected : ''?>>Serbia</option>
<option value="Seychelles" <?php echo $ville=='Seychelles'?$selected : ''?>>Seychelles</option>
<option value="Sierra Leone"<?php echo $ville=='Sierra Leone'?$selected : ''?>>Sierra Leone</option>
<option value="Singapore"<?php echo $ville=='Singapore'?$selected : ''?>>Singapore</option>
<option value="Slovakia" <?php echo $ville=='Slovakia'?$selected : ''?>>Slovakia</option>
<option value="Slovenia" <?php echo $ville=='Slovenia'?$selected : ''?>>Slovenia</option>
<option value="Solomon Islands" <?php echo $ville=='Solomon Islands'?$selected : ''?>>Solomon Islands</option>
<option value="Somalia" <?php echo $ville=='Somalia'?$selected : ''?>>Somalia</option>
<option value="South Africa" <?php echo $ville=='South Africa'?$selected : ''?>>South Africa</option>
<option value="South Sudan" <?php echo $ville=='South Sudan'?$selected : ''?>>South Sudan</option>
<option value="Spain" <?php echo $ville=='Spain'?$selected : ''?>>Spain</option>
<option value="Sri Lanka" <?php echo $ville=='Sri Lanka'?$selected : ''?>>Sri Lanka</option>
<option value="Sudan" <?php echo $ville=='Sudan'?$selected : ''?>>Sudan</option>
<option value="Suriname" <?php echo $ville=='Suriname'?$selected : ''?>>Suriname</option>
<option value="Svalbard and Jan Mayen" <?php echo $ville=='Svalbard and Jan Mayen'?$selected : ''?>>Svalbard and Jan Mayen</option>
<option value="Swaziland" <?php echo $ville=='Swaziland'?$selected : ''?>>Swaziland</option>
<option value="Sweden" <?php echo $ville=='Sweden'?$selected : ''?>>Sweden</option>
<option value="Switzerland" <?php echo $ville=='Switzerland'?$selected : ''?>>Switzerland</option>
<option value="Syrian Arab Republic" <?php echo $ville=='Syrian Arab Republic'?$selected : ''?>>Syrian Arab Republic</option>
<option value="Taiwan, Republic of China" <?php echo $ville=='Taiwan, Republic of China'?$selected : ''?>>Taiwan, Republic of China</option>
<option value="Tajikistan" <?php echo $ville=='Tajikistan'?$selected : ''?>>Tajikistan</option>
<option value="Tanzania, United Republic of" <?php echo $ville=='Tanzania, United Republic of'?$selected : ''?>>Tanzania, United Republic of</option>
<option value="Thailand" <?php echo $ville=='Thailand'?$selected : ''?>>Thailand</option>
<option value="Timor-leste" <?php echo $ville=='Timor-leste'?$selected : ''?>>Timor-leste</option>
<option value="Togo" <?php echo $ville=='Togo'?$selected : ''?>>Togo</option>
<option value="Tokelau" <?php echo $ville=='Tokelau'?$selected : ''?>>Tokelau</option>
<option value="Tonga" <?php echo $ville=='Tonga'?$selected : ''?>>Tonga</option>
<option value="Trinidad and Tobago" <?php echo $ville=='Trinidad and Tobago'?$selected : ''?>>Trinidad and Tobago</option>
<option value="Tunisia" <?php echo $ville=='Tunisia'?$selected : ''?>>Tunisia</option>
<option value="Turkey" <?php echo $ville=='Turkey'?$selected : ''?>>Turkey</option>
<option value="Turkmenistan" <?php echo $ville=='Turkmenistan'?$selected : ''?>>Turkmenistan</option>
<option value="Turks and Caicos Islands" <?php echo $ville=='Turks and Caicos Islands'?$selected : ''?>>Turks and Caicos Islands</option>
<option value="Tuvalu"<?php echo $ville=='Tuvalu'?$selected : ''?>>Tuvalu</option>
<option value="Uganda" <?php echo $ville=='Uganda'?$selected : ''?>>Uganda</option>
<option value="Ukraine" <?php echo $ville=='Ukraine'?$selected : ''?>>Ukraine</option>
<option value="United Arab Emirates" <?php echo $ville=='United Arab Emirates'?$selected : ''?>>United Arab Emirates</option>
<option value="United Kingdom" <?php echo $ville=='United Kingdom'?$selected : ''?>>United Kingdom</option>
<option value="United States" <?php echo $ville=='United States'?$selected : ''?>>United States</option>
<option value="United States Minor Outlying Islands" <?php echo $ville=='United States Minor Outlying Islands'?$selected : ''?>>United States Minor Outlying Islands</option>
<option value="Uruguay" <?php echo $ville=='Uruguay'?$selected : ''?>>Uruguay</option>
<option value="Uzbekistan" <?php echo $ville=='Uzbekistan'?$selected : ''?>>Uzbekistan</option>
<option value="Vanuatu" <?php echo $ville=='Vanuatu'?$selected : ''?>>Vanuatu</option>
<option value="Venezuela" <?php echo $ville=='Venezuela'?$selected : ''?>>Venezuela</option>
<option value="Viet Nam" <?php echo $ville=='Viet Nam'?$selected : ''?>>Viet Nam</option>
<option value="Virgin Islands, British" <?php echo $ville=='Virgin Islands, British'?$selected : ''?>>Virgin Islands, British</option>
<option value="Virgin Islands, U.S." <?php echo $ville=='Virgin Islands, U.S.'?$selected : ''?>>Virgin Islands, U.S.</option>
<option value="Wallis and Futuna" <?php echo $ville=='Wallis and Futuna'?$selected : ''?>>Wallis and Futuna</option>
<option value="Yemen" <?php echo $ville=='Yemen'?$selected : ''?>>Yemen</option>
<option value="Zambia" <?php echo $ville=='Zambia'?$selected : ''?>>Zambia</option>
<option value="Zimbabwe" <?php echo $ville=='Zimbabwe'?$selected : ''?>>Zimbabwe</option>

				  </select>
			  </td>
		  
			 
		  </tr>
          <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
          <tr>
			  <td><label for="trois_lettre">ASL application forms : </label></td>
			  <td>
				   <select name="trois_lettre" id="trois_lettre" class="combobox">
				        <option value="1" <?=($trois_lettre==1) ?  $selected : '' ?>>Yes</option>
			   	        <option value="0" <?=($trois_lettre==0) ?  $selected : '' ?>>No</option>
				   </select>
			   </td>
			   <td>
			   </td>
			     <td><label for="copie_cin">2 Notarized copy of Your ID :</label> </td>
		      <td>
				  <select name="copie_cin" id="copie_cin" class="combobox">
					   <option value="1" <?=($copie_cin==1) ? $selected : '' ?>>Yes</option>
					   <option value="0" <?=($copie_cin==0) ? $selected : '' ?>>No</option>
				  </select>
		     </td>
			  
		  </tr>
            <tr>
		  	  <td colspan="4" height="3px"></td>
		  </tr>
		  <tr>
			 <td><label for="extrait">Exam fee payment : </label></td>
			  <td>
				   <select name="extrait" id="extrait" class="combobox">
				        <option value="1" <?=($extrait_naissance==1) ? $selected : '' ?>>Yes</option>
					   <option value="0" <?=($extrait_naissance==0) ? $selected : '' ?>>No</option>
				   </select>
			   </td>
			   
			    <td>
			   </td>
			    <td><label for="copie_bac">A scholastic certificate with mention <br />
			of 12th grade/ or baccalaureate level :</label> </td>
			   <td>
				   <select name="copie_bac" id="copie_bac" class="combobox">
					   <option value="1" <?=($copie_bac==1) ?  $selected : '' ?>>Yes</option>
			   	      <option value="0" <?=($copie_bac==0) ?  $selected : '' ?>>No</option>
				   </select>
			   </td>
		  </tr>
		  
		   <tr>
		  	  <td colspan="4" height="3px"></td>
		  </tr>
		  
		  
		   <tr>
		  <td><label for="cinq_photo">2 Pictures :</label> </td>
			   <td>
				   <select name="cinq_photo" id="cinq_photo" class="combobox">
					  <option value="1" <?=($cinq_photo==1) ?  $selected : '' ?>>Yes</option>
			   	      <option value="0" <?=($cinq_photo==0) ?  $selected : '' ?>>No</option>
				   </select>
			   </td>
			   <td></td>
		 <td><label for="trois_enveloppe">3 years High school transcripts: </label></td>
			  <td>
				   <select name="trois_enveloppe" id="trois_enveloppe" class="combobox">
				        <option value="1" <?=($trois_enveloppe==1) ?  $selected : '' ?>>Yes</option>
			   	        <option value="0" <?=($trois_enveloppe==0) ?  $selected : '' ?>>No</option>
				   </select>
			   </td>
		  
		  </tr>
		  
		   <tr>
		   <td><label for="idSession">Session :</label> </td>
		   <td>
		<select name="idSession" id="idSession" class="input">
		<option value="">Select Session</option>
 		  <?php 
		  $sql7="select idSession, session, annee_academique from $tbl_session  ";
		  $req=@mysql_query($sql7);
		  while($row=mysql_fetch_assoc($req)){
		  $ns=ucfirst($row['session']).' '.$row['annee_academique'];
		  $cs=$row['idSession'];
		  ?>
		  <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
		  <?php
		  }
		  ?>
		  </select>
		  </td>
		   <td>&nbsp;</td>
		 <td><label for="year_g">	Graduation Date :  </label></td>
		
		  	  <td>
			   <select name="month_g" class="input">
			  
		  <option value="00">MM</option>
		    <option value="01" <?=($mg==1) ? $selected : '' ?>>JAN</option>
					  <option value="02" <?=($mg==2) ? $selected : '' ?>>FEB</option>
					  <option value="03" <?=($mg==3) ? $selected : '' ?>>MAR</option>
					  <option value="04" <?=($mg==4) ? $selected : '' ?>>APR</option>
					  <option value="05" <?=($mg==5) ? $selected : '' ?>>MAY</option>
					  <option value="06" <?=($mg==6) ? $selected : '' ?>>JUN</option>
					  <option value="07" <?=($mg==7) ? $selected : '' ?>>JUL</option>
					  <option value="08" <?=($mg==8) ? $selected : '' ?>>AUG</option>
					  <option value="09" <?=($mg==9) ? $selected : '' ?>>SEP</option>
					  <option value="10" <?=($mg==10) ? $selected : '' ?>>OCT</option>
					  <option value="11" <?=($mg==11) ? $selected : '' ?>>NOV</option>
					  <option value="12" <?=($mg==12) ? $selected : '' ?>>DEC</option>
		  <?php /* for ($i=1; $i<13; $i++){
		  ?>
		  <option value="<?=$i?>" <?=($m==$i) ? $selected  : '' ?>><?=$i?></option>
		  <?php
		  }*/
		  ?>
		&nbsp; </select>
	 &nbsp;
		<!-- <select name="day_g" class="input">
		   <option value="00">DD</option>
		  <?php for ($i=1; $i<32; $i++){
		  ?>
		  <option value="<?=$i?>" <?=($dg==$i) ? $selected  : ''?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>&nbsp;-->
			  <select name="year_g" id="year_g" class="input">
			  		 <option value="0000">YY</option>
		  <?php 
		 
		  for($i=date('Y'); $i>2010; $i--){
		  ?>
		 
		  <option value="<?=$i?>" <?=($yg==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  &nbsp;</select>
		  
		      </td>
			
		   </tr>
		  
		  
		  <tr><td colspan="4" height="3px"></td></tr>
		  
		 
		   <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
		   <tr>
		  	  <td><label for="parentname">Parent Name : </label></td>
		  	  <td>
			  	<input type="text" name="parentname" id="parentname" value="<?=$parentname?>" class="input"/>
			  </td><td></td>
			    <td><label for="parentphone">Parent Phone :</label> </td>
		  <td><input type="text" name="parentphone" id="parentphone" value="<?=$parentphone?>" class="input" /></td>
		    
		  </tr>
		   <tr>
		  	  <td colspan="4" height="3px"></td>
		  </tr>
		
          <tr>
          	<tr>
		  	  <td><label for="parentemail">Parent Email : </label></td>
		  	  <td>
			  	<input type="text" name="parentemail" id="parentemail" value="<?=$parentemail?>" class="input"/>
			  </td>
			    <td><label for="type ">Type of student: </label></td>
             <td><select name="type" id="type" class="combobox">
                 <option value="0" selected="selected"> Select Type</option>
                 <option value="Prospect" <?=$type=='Prospect' ? $selected : ''?>>Prospect</option>
                 <option value="Transfer" <?=$type=='Transfer' ? $selected : ''?>>Transfer</option>
                 <option value="9th Grade" <?=$type=='9th Grade' ? $selected : ''?>>9th Grade</option>
                 <option value="10th Grade" <?=$type=='10th Grade' ? $selected : ''?>>10th Grade</option>
                 <option value="11th Grade" <?=$type=='11th Grade' ? $selected : ''?>>11th Grade</option>
                 <option value="12th Grade" <?=$type=='12th Grade' ? $selected : ''?>>12th Grade</option>

                        </select>             </td>
			
			<!-- <td><label for="elearning">Elearning</label></td>
		    <td>
            <select name="elearning" id="elearning" style="width:200px" class="input">
					<option value="1" <?php echo $elearning==1 ? $selected : ''?>>Yes</option>
					<option value="0" <?php echo $elearning==0 ? $selected : ''?>>No</option>
 				  </select>
            </td>-->
		  </tr>
          
		 
         
           <!-- <td>Nombre d'attestation</td>
            <td><?= $attestations_count?></td>
          </tr>-->
         
         
		  </table>
	     </td>
		</tr>  
	  </table>
</form>
        <?php
         }
        ?>