	<?php
	$idSession = isset($_GET['idSession']) ? (int)$_GET['idSession'] :$_SESSION['idSession'] ;
	$code_cours = $code_inscription = '';
	?>

	<script language="javascript1.2">
	
	function valid_form(){
	
	if($F('code_cours')==''){
	alert('Veuillez choisir un cours');
	$('code_cours').focus();
	return false;
	}
	
	if($F('code_inscription')==''){
	alert('Veuillez choisir un étudiant');
	$('code_inscription').focus();
	return false;
	}
	
	if($F('horaire')==''){
	alert('Veuillez choisir un horaire');
	$('horaire').focus();
	return false;
	}
	
	if($F('nombre')==''){
	alert('Veuillez choisir le nombre');
	$('nombre').focus();
	return false;
	}
	
	if($F('idSession')==''){
	alert('Veuillez choisir la session');
	$('idSession').focus();
	return false;
	}
	else{
 	document.f_ajout.submit();
 	return true;
 			}
						}
	</script>

	<?php 

        if (isset($_POST['code_inscription'])){

			$code_inscription=$_POST['code_inscription'];
 			$code_cours=$_POST['code_cours'];
  			$nombre = $_POST['nombre'];
			$horaire = $_POST['horaire'];
			$idSession= $_POST['idSession'];
			$date = $_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
			
			// insert absence
			//vérification si il y a des absences dans la même date et le même code_cours
  
	  $sql = "select count(*) as nbr from $tbl_absence 
	  where code_cours = '$code_cours' 
	  and date = '$date' 
	  and idSession = '$idSession'"; 
	  
       $req=@mysql_query($sql) or die("erreur lors de la vérification des absences"); 
   
      //si le cours à déja enregistré un absence
	  
      $tuple= mysql_fetch_assoc($req); 
	  $abs=$tuple['nbr'];
       if($abs>0){   
      //mise à jour de la table absence
  
	   $sql1="UPDATE $tbl_absence SET jeton='A',
 	   n_comptabilise = n_comptabilise+'$nombre'
	   WHERE code_cours = '$code_cours' 
	   AND code_inscription = '$code_inscription' 
	   AND date = '$date' 
	   AND idSession = '$idSession'";  
	    
 	   @mysql_query($sql1) or die ("erreur lors de l'enregistrement de l'absence");	
		 
	  //mise à jour du nombre d'absences dans la table note
 	  
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
    @mysql_query($sql4) or die('erreur enregistrement de date');
        } 
	 
      
 //mise à jour de la fiche de présence
 
   $sql5="update $tbl_absence 
   set jeton='A',
    n_comptabilise= n_comptabilise+'$nombre'
   where code_cours='$code_cours' 
   and code_inscription='$code_inscription' 
   and date='$date'
   and idSession='$idSession' "; 
   

  @mysql_query($sql5) or die("erreur lors de l'update de la fiche de présence");
  }
			// end insert absence
 
								?>

								<script type="text/javascript" language="JavaScript1.2">

								<!--        

		window.location.replace('gestion_absences.php?code_inscription=<?php echo $code_inscription; ?>&idSession=<?php echo $idSession; ?>');

										

							//-->

							</script>

				  <?php

							  }

														else{

			$code_inscription=$_GET["new"];
 			$sql5="SELECT concat(nom,' ', prenom) as name FROM $tbl_etudiant WHERE code_inscription = '$code_inscription' limit 1"; 
 		    $req=@mysql_query($sql5) or die("erreur lors de la sélection du nom");
 		    $row=mysql_fetch_assoc($req);
 			$name=  $row['name'];

																		?>

        <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
 
  <tr>

    <td><img src="images/icone/cours.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES ABSENCES <span style="font-size:12px">[Ajouter]</span></td>
 
        <td width="22%">

          <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

            <tr>

                  <td valign="top" align="center">

                <a href="#"onclick="javascript:return valid_form();"><div class="save"></div>  Valider</a> 

                  </td>

                  <td valign="top" align="center">

              <a href="#" onclick="window.history.go(-1)" >

                  <div class="cancel"></div>Annuler</a>

                  

                  </td>

                </tr>

          </table>

        </td> 

  </tr>

</table>

       <form method="post"  action="gestion_absences.php?new=oui" name="f_ajout" >
  			<!--<input type="hidden" name="code_inscription" value="<?=$row['code_inscription']?>" />-->
 


           <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">

                <tr>

                  <td width="300">Intitulé du cours : </td>

                  <td colspan="3">
                  <select name="code_cours" id="code_cours" class="input">
                  <option value="">S&eacute;l&eacute;ctionner un cours</option>
 				  <?php 
				   if (isset($_GET['registration_code'])){
				  	$code_inscription = addslashes($_GET['registration_code']);
				  $sql="SELECT code_cours, titre FROM $tbl_cours WHERE code_cours in 
				  (SELECT DISTINCT code_cours FROM $tbl_inscription_cours 
				  WHERE code_inscription = '$code_inscription' AND idSession = '$idSession') order by lower(trim(titre))";
				  }
				   elseif (isset($_GET['course_code'])){
				  	$code_cours = addslashes($_GET['course_code']);
				  $sql="SELECT code_cours, titre FROM $tbl_cours WHERE code_cours = '$code_cours'";
				  }
				  else{
				  $sql="SELECT code_cours, titre FROM $tbl_cours order by titre";
				  }
				  $res = @mysql_query($sql);
				  while($row = mysql_fetch_assoc($res)){
				  ?>
                  <option value="<?php echo $row['code_cours'] ;?>" <?php echo $row['code_cours']==$code_cours ? $selected : '' ?>><?php echo $row['code_cours'] ;?>: <?php echo stripslashes(ucfirst($row['titre'])) ;?></option>
                  <?php } ?>
                   </select>
                  </td>

                </tr>

                <tr>

				  <td colspan="4" height="3px"></td>

				</tr>

                <tr>

                  <td width="25%">Nom et prénom de l'étudiant : </td>

                  <td width="25%"> 
			
 				  <?php 
				  $code_inscription=addslashes(trim($_GET['new']));
				  if (isset($_GET['registration_code'])){
				  	$code_inscription = addslashes($_GET['registration_code']);
				  $sql="SELECT code_inscription, nom, prenom FROM $tbl_etudiant  WHERE code_inscription ='$code_inscription' LIMIT 1 ";
				  }
				  else{
				  $sql="SELECT code_inscription, nom, prenom FROM $tbl_etudiant GROUP BY code_inscription ORDER BY lower(trim(nom))";
				  }
				  ?>
                  <select name="code_inscription" id="code_inscription" class="input">
                  <option value="">S&eacute;l&eacute;ctionner un &eacute;tudiant</option>
 				  <?php 
				  
				  $res = @mysql_query($sql);
				  while($row = mysql_fetch_assoc($res)){
				  ?>
                  <option value="<?php echo $row['code_inscription'] ;?>" <?php echo $row['code_inscription']==$code_inscription ? $selected : '' ?>><?php echo ucfirst($row['nom']) .' '.ucfirst($row['prenom']) ;?></option>
                  <?php } ?>
                   </select>
                  </td>

                  <td width="25%"> </td>

                  <td width="25%"></td>

                  </tr>

                  <tr>

				  <td colspan="4" height="3px"></td>

                  </tr>

                   <tr>

                  <td>Date  : </td>

                <td><select name="year_i" id="year_i" class="input">
		  <?php for ($i=date('Y'); $i>2005; $i--){?>
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
				</select></td>

                   <td>&nbsp;</td>

                   <td>&nbsp;</td>

                   </tr>

                  <tr><td colspan="4" height="3px"></td></tr>

                  <tr>

                  <td>Horaire : </td>

                  <td><select name="horaire" id="horaire" class="input">
                  <option value="">S&eacute;l&eacute;ctionner un horaire</option>
 				  <?php 
				  $sql="SELECT code_horaire, nom_horaire FROM $tbl_horaire ";
				  $res = @mysql_query($sql);
				  while($row = mysql_fetch_assoc($res)){
				  ?>
                  <option value="<?php echo $row['code_horaire'] ;?>"><?php echo $row['nom_horaire'] ;?></option>
                  <?php } ?>
                   </select></td>

                   <td>&nbsp;</td>

                   <td>&nbsp;</td>

                   </tr>
				   
				   <tr><td colspan="4" height="3px"></td></tr>

                  <tr>

                  <td>Session : </td>

                  <td><select name="idSession" id="idSession" class="input">
                  <option value="">S&eacute;l&eacute;ctionner une session</option>
 				  <?php 
				  if (isset($_GET['registration_code'])){
				  $code_inscription = addslashes($_GET['registration_code']);
				  $sql="SELECT * FROM $tbl_session where archive =1 and idSession in (select distinct idSession from tbl_inscription_cours where code_inscription ='$code_inscription')";
				  }
				  else
				  {
				  $sql="SELECT * FROM $tbl_session where archive =1";
				  }
				  $res = @mysql_query($sql);
				  while($row = mysql_fetch_assoc($res)){
				  ?>
                  <option value="<?php echo $row['idSession'] ;?>" <?php echo $row['idSession']==$idSession ? $selected : '' ?>><?php echo ucfirst($row['session']). ' '.$row['annee_academique'] ;?></option>
                  <?php } ?>
                   </select></td>

                   <td>&nbsp;</td>

                   <td>&nbsp;</td>

                   </tr>
 
                  <tr><td colspan="4" height="3px"></td></tr>

                  <tr>

                  <td>Nombre d'absence : </td>

                  <td>

                   <select name="nombre" id="nombre" class="input">
                   		<option value="">S&eacute;l&eacute;ctionner le nombre</option>
                        <option value="1">1 absence</option>
                        <option value="2">2 absences</option>
                    </select>

                  </td>

                   <td>&nbsp;</td>

                   <td>&nbsp;</td>

                   </tr>

                  <tr><td colspan="4" height="3px"></td></tr>

          </table>

</form>

<?php

}
  ?>

