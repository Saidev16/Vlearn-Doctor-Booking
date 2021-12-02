<span id="titre_page">Détail du cours</span>
 <table width="550" border="0" cellspacing="1" cellpadding="0" align="center" id="lien_msj">
  <tr>
    <td width="510"></td>
	<td align="center">
		<a href='professeur.php?task=cours'><div class="retour"></div>retour</a>
	</td>
	</tr>
	<tr><td colspan="2" headers="3px"></td></tr>
	</table>
<table width="550px" border="0" cellspacing="0" cellpadding="0" style="text-align:left">
<?php
if (isset($_POST['boxchecked'])){
$code_cours=$_POST['boxchecked'];

// sélection des informations du cours

$sql="select c.titre, c.titre_eng, c.semestre, s.nbr_inscrit, p.nom_prenom, c.nbr_credit
from $tbl_cours as c, tbl_seance as s, $tbl_professeur as p  
where s.code_cours='$code_cours' 
and c.code_cours=s.code_cours 
and s.idSession='$idSession'
and s.code_prof=p.code_prof limit 1";

$req=@mysql_query($sql) or die("erreur lors de la sélection ");
$row=mysql_fetch_assoc($req);

$titre_fr=htmlentities($row['titre']);
$titre_eng=htmlentities($row['titre_eng']);
$semestre=htmlentities($row['semestre']);
$inscrit=htmlentities($row['nbr_inscrit']);
$nom_prof=htmlentities($row['nom_prenom']);
$nbr_credit=htmlentities($row['nbr_credit']);

$jours=$salle=$horaire='';
  $sql1="select h.nom_horaire, j.nom_jours, s.nom_salle 
  from $tbl_seance as ss, $tbl_jours as j, $tbl_salle as s, $tbl_horaire as h
  where ss.code_cours='$code_cours'
  and ss.idSession='$idSession'
  and ss.code_salle=s.code_salle
  and ss.code_jours=j.code_jours
  and ss.code_horaire=h.code_horaire";
  $req1=@mysql_query($sql1) or die ('erreur lors de la selection');
  $i=0; $sep='';
  while($row=mysql_fetch_assoc($req1)){
  	if($i>0) $sep=' - ';
  $jours.=$sep.''.htmlentities($row['nom_jours']);
  $horaire.=$sep.''.htmlentities($row['nom_horaire']);
  $salle.=$sep.''.htmlentities($row['nom_salle']);
  }
  ?>
  <tr height="18px">
    <td width="170px" class="bold">Titre en français :</td>
    <td width="380"><?=$titre_fr?></td>
  </tr>
  <tr><td colspan="2" height="1px" bgcolor="#333333"></td></tr>
 <tr height="18px">
    <td class="bold">Titre en englais :</td>
    <td><?=$titre_eng?></td>
  </tr>
   <tr><td colspan="2" height="1px" bgcolor="#333333"></td></tr>
 <tr height="18px">
    <td class="bold">Semestre :</td>
    <td><?=$semestre?></td>
  </tr>
   <tr><td colspan="2" height="1px" bgcolor="#333333"></td></tr>
 <tr height="18px">
    <td class="bold">Nombre d'étudiant inscrit :</td>
    <td><?=$inscrit?></td>
  </tr>
   <tr><td colspan="2" height="1px" bgcolor="#333333"></td></tr>
 <tr height="18px">
    <td class="bold">Nombre de crédit :</td>
    <td><?=$nbr_credit?></td>
  </tr>
  <tr><td colspan="2" height="1px" bgcolor="#333333"></td></tr>
  
  <tr height="18px">
    <td class="bold">Jour :</td>
    <td><?=$jours?></td>
  </tr>
   <tr><td colspan="2" height="1px" bgcolor="#333333"></td></tr>
 <tr height="18px">
    <td class="bold">Horaire :</td>
    <td><?$horaire?></td>
  </tr>
   <tr><td colspan="2" height="1px" bgcolor="#333333"></td></tr>
 <tr height="18px">
    <td class="bold">Salle :</td>
    <td><?=$salle?></td>
  </tr>
  <tr><td colspan="2" height="1px" bgcolor="#333333"></td></tr>
</table>
<?php
}
?>
