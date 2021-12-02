<span id="titre_page">Fiche d'absences </span>
   <?php

     // vérification de la variable de session

    if (isset($_SESSION['code_etudiant'])){
    $code_inscription=$_SESSION['code_etudiant'];
    
	 $sqlsession="SELECT s.idSession, session, annee_academique 
	 FROM $tbl_session as s, $tbl_inscription_cours as i 
	 where i.code_inscription = '$code_inscription'
	 AND i.idSession = s.idSession
	 GROUP BY idSession
	 ORDER BY lower(session), annee_academique  DESC"; 
 	 $reqsession=@mysql_query($sqlsession) or die ('erreur de selection de la session');
 	 while($row=mysql_fetch_assoc($reqsession)){
		 	 $idSession=$row['idSession'];
			 $session=$row['session'];
			 $annee=$row['annee_academique'];
		 	
		$sql1="SELECT  distinct a.date, h.nom_horaire, c.titre_eng
		FROM  $tbl_cours AS c, $tbl_absence AS a, $tbl_etudiant as e, $tbl_horaire as h
		WHERE a.code_inscription = '$code_inscription'
		AND trim(a.code_cours) = trim(c.code_cours)
		and a.idSession='$idSession' 
		and a.n_comptabilise!=0 
		and a.idHoraire=h.code_horaire order by a.date desc";
 		$req=@mysql_query($sql1) or die("erreur lors de la sélection des absences ");
		if (mysql_num_rows($req)){
?>

<table width="575" cellspacing="1" cellpadding="1" align="center" class="adminlist">
   <tr style="font-style:italic">
	    <th colspan="4" align="center" height="8"> <?=$session?>&nbsp;<?=$annee?></th>
	</tr>
    <tr class="entete" align="center">
      <td width="425">Intitulé du cours</td>
	  <td width="75">Date</td>
	  <td width="75">Horaire</td>
   </tr>
<?php
while ($row=mysql_fetch_assoc($req)){
?>
  <tr height="18px">
     <td align="left"><?=stripslashes($row['titre_eng'])?></td>
     <td>&nbsp;<?=$row['date']?></td>
	 <td>&nbsp;<?=$row['nom_horaire']?></td>
  </tr>
 <?php
 }
 ?>
</table>
 <?php
	}
	}
	}
 ?>
