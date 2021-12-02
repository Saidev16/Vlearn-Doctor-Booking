<style type="text/css">
input{width:200px;}
</style>
<?php
if (isset($_POST['ci'])){

$ci=htmlentities($_POST['ci']);
$code_inscription = $_SESSION['num_inscription'] = $_POST['ci'];
$code_inscription = $_SESSION['num_inscription'];
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
$email=$_POST['email'];
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
$observation = $_POST['observation'];
  
                    // ça sera exécuté en cas l'utilisateur change le code d'inscription           
                    if($code_inscription!=$ci){

 
					// update table etudiant

                        $sql="UPDATE tbl_prospect  SET `code_inscription`='$ci',
 						`nom` = '$nom',
						`prenom` = '$prenom',
						`date_inscription` = '$date_insc',
						`tel` = '$tel',
 						`email` = '$email',
						`groupe` = '$groupe',
						`niveau` = '$niveau',
						`ville` = '$ville',
						`observation` = '$observation'
						
						 WHERE `code_inscription` ='$code_inscription' limit 1 ";

             @mysql_query($sql) or die ("erreur lors de la mise à jour dans la table etudiant");
						   

              //update table inscription


             $sql1="update $tbl_inscription_cours set code_inscription='$ci' 
			 where code_inscription='$code_inscription'";
             @mysql_query($sql1) or die ("erreur lors de la mise à jour dans la table inscription");


    		 //update table note

             $sql2="update $tbl_note set code_inscription='$ci' 
	         where code_inscription='$code_inscription'";
             @mysql_query($sql2) or die ("erreur lors de la mise à jour dans la table note"); 
						  

			//update table absence

             $sql3="update $tbl_absence set code_inscription='$ci' 
			 where code_inscription='$code_inscription'";
             @mysql_query($sql3) or die ("erreur lors de la mise à jour dans la table absence");
							 

		   //update table buletin

            $sql4="update $tbl_buletin set code_inscription='$ci' 
			where code_inscription='$code_inscription'";
            @mysql_query($sql4) or die ("erreur lors de la mise à jour dans la table buletin");
			 
					
			//update table demande

            $sql5="update $tbl_demande set code_inscription='$ci' 
			where code_inscription='$code_inscription'";
            @mysql_query($sql5) or die ("erreur lors de la mise à jour du 
			code inscription dans la table demande");

			//update table log 

            $sql6="update $tbl_log set id_user='$ci'  
		    where id_user='$code_inscription'";
            @mysql_query($sql6) or die ("erreur lors de la mise à jour dans la table log.");
					

			//update table sondage

            $sql7="update $tbl_sondage_data set code_inscription='$ci' 
			where code_inscription='$code_inscription'";
            @mysql_query($sql7) or die ("erreur lors de la mise à jour du dans la table sondage");
					
			//update table emprunt

            $sql8="update $tbl_empreinte set code_inscription='$ci'  
			       where code_inscription='$code_inscription'";																
            @mysql_query($sql8) or die ("erreur lors de la mise à jour du dans la table emprunt"); 
			
			//update table buletin

            $sql8="update $tbl_buletin set code_inscription='$ci'  
			       where code_inscription='$code_inscription'";																
            @mysql_query($sql8) or die ("erreur lors de la mise à jour du dans la table buletin"); 
                                          	
											
											?>

			<script type="text/javascript" language="JavaScript1.2">
			<!--
				window.location.replace('gestion_prospect.php');
			//-->
			</script>
				
              <?php


                                                          }
                                         else{
 $sql="UPDATE tbl_prospect  SET `code_inscription`='$ci',
 						`nom` = '$nom',
						`prenom` = '$prenom',
						`date_inscription` = '$date_insc',
						`tel` = '$tel',
 						`email` = '$email',
						`groupe` = '$groupe',
						`niveau` = '$niveau',
						`ville` = '$ville',
						`observation` = '$observation'
					 
						
						 WHERE `code_inscription` ='$code_inscription' limit 1 "; 
//die($sql);
         @mysql_query($sql)or die ("erreur lors de la mise à jour de cet étudiant");

         }
               if( (!isset($_SESSION['tri_par_code'])) && (!isset($_SESSION['niveau'])) 
			   && (!isset($_SESSION['filiere'])) && (!isset($_SESSION['annee'])) ){

                          $_SESSION['search']=$nom;

                      }

			?>

			<script type="text/javascript" language="JavaScript1.2">
			<!--
				   window.location.replace('gestion_prospect.php');
			//-->
			</script>

              <?php

			  }

			  else{

			  $code_inscription = $_GET["modifier"];
			  $sql2="select * from tbl_prospect  
			  where code_inscription='$code_inscription' limit 1 ";
			  $req2=@mysql_query($sql2) or die("erreur lors du chargements  des données");
			  $row=mysql_fetch_assoc($req2);
			  
			   $code_inscription = $row['code_inscription'];
			   $nom = htmlentities($row['nom']);
			   $prenom = htmlentities($row['prenom']);
			   $observation = $row['observation'];
 			 
			   $date_inscription = htmlentities($row['date_inscription']);
			   $tel = htmlentities($row['tel']);
			   $email =htmlentities($row['email']);
			  
			   $groupe =htmlentities($row['groupe']);
			 
			   //$financeur  =htmlentities($row['financeur']);
			   //$last_diplome =htmlentities($row['last_diplome']);
			   
			  
			   $niveau = htmlentities($row['niveau']);
			   $ville = htmlentities($row['ville']);
			  
			  ?>
 <style type="text/css">
input{
width:230px;
}
</style>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/etudiants.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES PROSPECTS 
	<span class="task">[modifier]</span></td>
	<td width="22%">
	  <table border="0" align="right" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:validate1();"> <div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_prospect.php" ><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>

 <form method="post" action="gestion_prospect.php?modifier=oui" name="f_ajout" >
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
			  <td width="25%"><label for="ci">Numéro d'inscription :</label> </td>
			  <td width="25%">
				<input type="text" name="ci" id="ci" class="input" value="<?=$code_inscription?>"  onchange="onUpdateVerify()" onkeyup="onUpdateVerify()" />
			  </td>
			  
		  </tr>
		  
		  <tr>
		  	  <td colspan="4" height="3px"><div id="er_nom" class="erreur"></div></td>
		  </tr>
		  
		  <tr>
			   <td><label for="nom">Nom :</label> </td>
			   <td><input type="text" name="nom" id="nom" class="input" value="<?=$nom?>" /></td>
		    
		  </tr>

		  <tr>
		  	   <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="prenom">Prénom : </label></td>
			  <td>
				<input type="text" name="prenom" id="prenom" class="input" value="<?=$prenom?>" />
			  </td>
		    
		  <tr>
		  	  <td colspan="4" height="3px"></td>
		  </tr>
		  
		   
		  
		   <tr>
			  <td colspan="4" height="3px"></td>
		  </tr>
		  
		  
		  
		  <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
		  
		  <tr>
			  <td><label for="tel">Numéro de téléphone :</label> </td>
			  <td>
				<input type="text" name="tel" value="<?=$tel?>" id="tel" class="input"/>
			  </td>
			  
		  </tr>
		  
		  <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  
		
		  <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
         
          
          <tr>
		  	 <td colspan="4" height="3px"></td>
		  </tr>
         
		  <tr>
		  	   <td colspan="4" height="3px"></td>
		  </tr>
		  
		 
		  
		  <tr><td colspan="4" height="3px"></td></tr>
		  
		  
			  
		  
		  <tr>
		  	   <td colspan="4" height="3px"><div id="er_cin" class="erreur"></div></td>
		  </tr>
		  
		  <tr>
		  
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
		  <td><label for="email">Email : </label></td>
		  <td><input type="text" name="email" id="email" class="input" value="<?=$email?>" /></td>
		   
		  </tr>
		  
		  <tr><td colspan="4" height="3px"></td></tr>
		  
		  <tr>
		 
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
		  	<td colspan="4" height="3px"></td>
		  </tr>
         
          <tr>
		  	<td colspan="4" height="3px"></td>
		  </tr>
		  <tr>
			  <td><label for="niveau">Besoin :</label> </td>
			  <td>
					<select name="niveau" id="niveau" style="width:200px" class="input">
					<option value="BBA" <?php echo $niveau=='BBA' ? $selected : ''?>>BBA</option>
					<option value="MASTER" <?php echo $niveau=='MASTER' ? $selected : ''?>>MASTER</option>
                    <option value="MBA" <?php echo $niveau=='MBA' ? $selected : ''?>>MBA</option> 
					<option value="highschool" <?php echo $niveau=='highschool' ? $selected : ''?>>HIGH SCHOOL</option> 
				  </select>
			  </td>
			 <tr><td><label for="ville">Ville :</label> </td>
		    <td><select name="ville" id="ville" style="width:200px" class="input">
					<option value="Rabat" <?php echo $ville=='Rabat' ? $selected : ''?>>Rabat</option>
					<option value="Casablanca" <?php echo $ville=='Casablanca' ? $selected : ''?>>Casablanca</option>
                    <option value="Fès" <?php echo $ville=='Fès' ? $selected : ''?>>Fès</option>
                    <option value="Marrakech" <?php echo $ville=='Marrakech' ? $selected : ''?>>Marrakech</option> 
                    <option value="Meknès" <?php echo $ville=='Meknès' ? $selected : ''?>>Meknès</option> 
                    <option value="Oujda" <?php echo $ville=='Oujda' ? $selected : ''?>>Oujda</option> 
                    <option value="Tanger" <?php echo $ville=='Tanger' ? $selected : ''?>>Tanger</option>
				  </select></td>
		  </tr>
          
         <tr>
		 <td><label for="observation">Observation :</label> </td>
		  <td><TEXTAREA name="observation" cols="40" rows="10" maxlength="500"><?= $observation;?></textarea>  
		  </td>
		 </tr>
		  </table>
	     </td>
		</tr>  
	  </table>
</form>
        <?php
         }
        ?>