<span id="titre_page">Emploi du temps</span>
  <form action="student.php" method="post" name="adminMenu" style="margin:0">
    <input type="hidden" name="boxchecked" id="boxchecked" value="0" />
    <input type="hidden" name="task" id="task" value="0" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
 <?php

 // vérification de la variable de session

    if (isset($_SESSION['code_etudiant'])){

    	 $code_inscription=$_SESSION['code_etudiant'];
		 
	  $sql="SELECT groupe FROM $tbl_etudiant WHERE code_inscription='$code_inscription'";  
 		 $req=@mysql_query($sql) or die ('erreur de selection de la session');
		  $groupe=$row['groupe'];
		 
	     $sqlsession="SELECT idSession, session, annee_academique FROM $tbl_session  ORDER BY idSession DESC";  
 		 $reqsession=@mysql_query($sqlsession) or die ('erreur de selection de la session');
 		
		 while($ligne=mysql_fetch_assoc($reqsession)){
		 
		 $idSession=$ligne['idSession'];
		 $session=$ligne['session'];
		 $annee=$ligne['annee_academique'];
 
		$sql="SELECT s.code_cours, p.nom_prenom,s.groupe, 
				 sl.nom_salle, h.nom_horaire, j.nom_jours  FROM 
 				 $tbl_seance as s, $tbl_professeur as p, $tbl_jours as j,
				 $tbl_horaire as h, $tbl_salle as sl
				 WHERE s.code_prof=p.code_prof 
				 AND s.code_jours=j.code_jours
				 AND s.code_horaire=h.code_horaire
				 AND s.code_salle=sl.code_salle
				 AND s.groupe='$groupe'
				 AND s.code_cours IN (SELECT DISTINCT code_cours 
				 FROM $tbl_inscription_cours 
				 WHERE code_inscription='$code_inscription' AND idSession= '$idSession')
				 GROUP BY s.code_cours
				 ORDER BY lower(nom_jours), trim(nom_horaire)"; 
		 
		$req=@mysql_query($sql) or die("erreur lors de la sélection des cours".$sql);
		
      		if(mysql_num_rows($req)!=0){
 ?>
 <table width="575" border="0" cellspacing="1" cellpadding="0" align="center" class="adminlist">
 	<tr style="font-style:italic">
	    <th colspan="5" align="center" height="8"> <?=$session?>&nbsp;<?=$annee?></th>
	</tr>
     <tr class="entete" align="center">
	    <td width="50">&nbsp;Code</td>
	    <td width="50">&nbsp;Jour</td>
        <td width="50">&nbsp;Salle</td>
        <td width="50">&nbsp;Horaire</td>
        <td width="125">&nbsp;Professeur</td>
    </tr>
 <?php
 while ($line=mysql_fetch_assoc($req)){
 $id=$line['code_cours'];
 ?>
   <tr style="text-align:left; height:16px">
    <td class="bold">&nbsp;<?=$id?></td>
    <td>&nbsp;<?=stripslashes(ucfirst($line['nom_jours']))?></td>
    <td align="center">&nbsp;<?=stripslashes($line['nom_salle'])?></td>
    <td>&nbsp;<?=stripslashes($line['nom_horaire'])?></td>
    <td>&nbsp;<?=stripslashes(ucfirst($line['nom_prenom']))?></td>
  </tr>
<?php
 }
 ?>
</table>
<?php
}
 }
 //fermeture test sur la variable de session
 }
 ?>
 </form>
 <br /><br /> 