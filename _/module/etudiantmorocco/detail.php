 <?php
	 if (isset($_GET['detail'])){
	 $code_inscription= $_GET['detail'];
	 ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Details</span></td>
	<td width="90">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 
		  <td valign="top" align="center" >
		  <a href="gestion_des_etudiants_morocco.php?modifier=<?=$code_inscription?>">
		  <div class="modifier"></div>Edit</a>
		  </td>
		  <!-- <td valign="top" align="center" >
		  <a href="gestion_des_etudiants_usa.php?journal=<?=$code_inscription?>">
		  <div class="ajouter"></div>Journal</a>
		  </td>-->
		 <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="Imprimer">
		  <div class="imprimer"></div>Print</a>
		  </td>
		   <td align="right">
		 <a href="gestion_des_etudiants_morocco.php"><div class="retour"></div>Back</a>
		 </td>
		</tr>
	  </table>
	</td> 
  </tr>
  </table>
    
	 <table width="100%" border="0"  align="center" cellspacing="3" class="cellule_table">
	 <?php
	 $id=$_GET['detail'];
	 /*$sql="select e.*, f.nom_filiere, g.title
	  from $tbl_etudiant as e, tbl_filiere as f, $tbl_groupe as g
	  where code_inscription='$id'
	  and e.filiere=f.id_filiere 
	  and e.groupe=g.id
	  limit 1";*/
	  $sql="select e.*
	  from tbl_etudiant_morocco as e
	  where code_inscription='$id'
	  limit 1";
	 $req=@mysql_query($sql) or die ("erreur lors du chargement de fiche de cet &eacute;tudiant");
	 while($row=mysql_fetch_assoc($req)){
	 ?>
 	<tr>
		<td><span class="gras">Registration Code</span> :&nbsp;<?=$row['code_inscription']?></td>
		<td><span class="gras"></span>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"height="2px"></td>
   </tr>
   <tr>
   <td ><span class="gras">First Name </span> :&nbsp;<?=$row['prenom']?></td>
       <td><span class="gras">Last Name</span> :&nbsp;<?=$row['nom']?></td>
       
  </tr>
   <tr>
        <td colspan="2"height="2px"></td>
   </tr>
  <tr>
   <td><span class="gras">Date of Birth </span> :&nbsp;<?php $date=$row['date_naissance'];
		$tab=split('[/.-]',$date); 
		echo $tab[1].'-'.$tab[2].'-'.$tab[0];?></td>
   <td><span class="gras">Gender:&nbsp;</span><?=$row['sexe']?></td>
   
  </tr>
   <tr>
        <td colspan="2"height="2px"></td>
   </tr>
  <tr>
    <td><span class="gras">Address</span> :&nbsp;<?=$row['adresse']?></td>
	<td><span class="gras">Cell</span> :&nbsp;<?=$row['tel']?></td>
    
  </tr>
   <tr>
        <td colspan="2"height="2px"></td>
   </tr>
    <tr>
    <td ><span class="gras">ID, Passport or Driver's Licence Number</span> :&nbsp;<?=$row['cin']?></td>
	<td ><span class="gras">Registration Date</span> :&nbsp;<?php
	$date=$row['date_inscription'];
		$tab=split('[/.-]',$date); 
		echo $tab[1].'-'.$tab[2].'-'.$tab[0]; ?></td>
  
  </tr>
   <tr>
        <td colspan="2"height="2px"></td>
   </tr>
   <tr>
    <td ><span class="gras">E-mail</span> :&nbsp;<?=$row['email']?></td>
    <td><span class="gras">Nationality</span>:&nbsp;<?=$row['nationalite']?></td>
  </tr>
   <tr>
        <td colspan="2"height="2px"></td>
   </tr>
   <tr>
    <td><span class="gras">Previous School:&nbsp;</span><?=$row['lieu_naissance']?></td>
    <td><span class="gras"> Previous School Address </span> :&nbsp;<?=$row['code_bac']?></td>
   
  </tr>
   <tr>
        <td colspan="2"height="2px"></td>
   </tr>
   <tr>
    <td><span class="gras">Last completed level</span> :&nbsp;<?php
     if($row['english_bac']==1) echo'9th Grade';
	else if($row['english_bac']==2) echo '10th Grade';
	else if($row['english_bac']==3) echo '11th Grade';
	else if($row['english_bac']==4) echo '12th Grade';
	else if($row['english_bac']==5) echo '5th Grade';
	else if($row['english_bac']==6) echo '6th Grade';
	else if($row['english_bac']==7) echo '7th Grade';
	else if($row['english_bac']==8) echo '8th Grade';
	else if($row['english_bac']==0) echo '';?>
	</td>
    <td><span class="gras">Country </span> :&nbsp;<?=$row['ville']?></td>
   
  </tr>
   <tr>
        <td colspan="2"height="2px"></td>
   </tr>
 
   <tr>
   <td><span class="gras">ASL application forms :&nbsp;</span><?=($row['trois_lettre']==1) ? 'Yes' : 'No'?></td>
    <td ><span class="gras">Notarized Copy of ID, Passport or Driver's License:&nbsp;</span><?=($row['copie_cin']==1) ? 'Yes' : 'No'?></td>
    
  </tr>
   <tr>
        <td colspan="2"height="2px"></td>
   </tr>
  <!-- <tr>
    <td ><span class="gras">Note de test de fran&ccedil;ais</span> :&nbsp;<?=$row['test_fr']?></td>
    <td><span class="gras">Exam fee payment:&nbsp;</span><?=$row['extrait_naissance']== 1 ? 'Yes' : 'No'?></td>
	<td><span class="gras">A scholastic certificate with mention of 12th grade/ or baccalaureate level</span> :&nbsp;<?=($row['copie_bac']==1) ? 'Yes' : 'No'?>
	</td>
  </tr>
  
  <!--  <tr>
    
    <td><span class="gras">Note de teste des sciences</span> :&nbsp;<?=$row['test_sciences']?></td>
  </tr>
  
   <tr>
    <td><span class="gras">Login</span> :&nbsp;<?=$row['login']?></td>
    <td><span class="gras">Acc&egrave;s</span> :&nbsp;<?=($row['acces']==1) ? 'Yes' : 'No'?></td>
  </tr>-->
  
 <!--  <tr>
    <td><span class="gras">Mot de passe</span> :&nbsp;<?=strtolower($row['cin'])?></td>
    
  </tr>-->
  
<!--
<tr>
    <td><span class="gras">note de test de math&eacute;matique</span> :&nbsp;<?=$row['test_math']?></td>
    <td><span class="gras">note de test de Social Studies</span> :&nbsp;<?=$row['test_etudesoc']?></td>
  </tr>
   <tr>
    
   
         </tr>        
       -->    
	    <tr>
        <td colspan="2"height="2px"></td>
   </tr>     
  <tr>
    <td height="22"><span class="gras">2 Pictures</span> :&nbsp;<?=($row['cinq_photo']==1) ? 'Yes' : 'No'?></td>
    <td><span class="gras">3 years High school transcripts</span> :&nbsp;<?=($row['trois_enveloppe']==1) ? 'Yes' : 'No'?></td>
  </tr>
  <tr>
        <td colspan="2"height="2px"></td>
   </tr>
   <tr>
    
   <td><span class="gras">Section</span> :&nbsp;<?=$row['groupe']== '2' ?  'french' :  'english' ?></td>
   <td><span class="gras"> Student Signature</span> :&nbsp; 
      <?=($row['reglement']==1) ? 'Yes' : 'No'?>
    </td>
  </tr>
  <tr>
  <td><span class="gras">Session</span> :&nbsp;<?=$row['semestre']=='32'? 'Fall 2014' : 'Spring 2014' ?></td>
  <td></td>
  </tr>
  
 <!-- <tr>
    <td><span class="gras">Elearning</span> :&nbsp;<?=($row['elearning']==1) ? 'Yes' : 'No'?></td>
    
  </tr>-->
  <tr>
    
    <td></td>
  </tr>
  
<!--  <tr>
    <td><span class="gras">Nombre d'attestation</span> :&nbsp;<?=$row['attestations_count']?></td>
    <td></td>
  </tr>-->

<tr><td height="2px" colspan="2"></td></tr>
   <tr>
    <td align="right" colspan="2">
	<form name="acces" id="" action="../traitement_etu.php" method="post" target="_blank" >
	<input type="hidden" name="login_etudiant" id="login_etudiant" value="<?=$row['login']?>" />
		<input type="hidden" name="pass_etudiant" id="pass_etudiant" value="<?=strtolower ($row['date_naissance'])?>" />
		<input type="hidden" name="token" value="<?=md5(uniqid(rand(), true))?>" />
	<input type="submit" value="Access to Student Space" name="acces" 
		style="font-family:verdana; font-size:11px" />
 	</form>
	</td>
   </tr>
 <tr>
    <td colspan="2" height="20px"></td>
  </tr>
  <tr><td height="2px" colspan="2"></td></tr>
   <tr>
    <td align="right" colspan="2">
  <form name="acces" id="" action="../traitement_par.php" method="post" target="_blank" >
  <input type="hidden" name="login_parent" id="login_parent" value="<?=$row['login_parent']?>" />
    <input type="hidden" name="pass_parent" id="pass_parent" value="<?=strtolower ($row['date_naissance'])?>" />
    <input type="hidden" name="token" value="<?=md5(uniqid(rand(), true))?>" />
  <input type="submit" value="Access to Parent Space" name="acces" 
    style="font-family:verdana; font-size:11px" />
  </form>
  </td>
   </tr>
  <!--  <tr>
  	<td><span class="task"><a href="http://<?=$_SERVER['HTTP_HOST']?>/piimt/html2pdf_v3.20/html2pdf_v3.20/exemples/exemple01.php?code_inscription=<?=$id?>" target="_blank">Attestation de scolarité en Français</a></span></td>
	<td></td>
  </tr>-->
 <!-- <tr>
  	<td><span class="task"><a href="http://<?=$_SERVER['HTTP_HOST']?>/piimt/html2pdf_v3.20/html2pdf_v3.20/exemples/exemple02.php?code_inscription=<?=$id?>" target="_blank" >Attestation de scolarité en Anglais</a></td>
	<td></td>
  </tr>-->

  <?php
  }
  ?>
</table>
 <?php
  }
  ?>