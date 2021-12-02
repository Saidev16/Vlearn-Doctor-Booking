<span id="titre_page">Fiche des notes</span>
<table width="575" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-bottom:5px">
<tr><td>
<!--print and edit-->
<table width="80" border="0" cellspacing="0" cellpadding="0" align="right" id="lien_msj">
  <tr>
   <td align="center">
   <a href="#" onclick="window.print()" title="imprimer la fiche de notes">
	<div class="imprimer"></div>Print</a>
	</td>
     <td align="center"><a href='#' onClick="javascript:document.retour.submit();" title="retourner à la page précedente">
	<div class="back"></div>retour</a>
	</td>
  </tr>
</table>
<!--fin print and edit-->
</td></tr>
</table>
    <!--entete-->
  <table width="575" border="0" align="center" cellspacing="1" cellpadding="0" height="70px" class="adminlist print" >
 <?php
 $sqlh="select * from $tbl_header where type='note' limit 1";
 $req=@mysql_query($sqlh) or die ("erreur lors de la création du hedaer");
 $row=mysql_fetch_assoc($req);
 ?>
  <tr height="30px">
    <td rowspan="3" width="30%"  style="padding-left:8px; padding-top:8px; text-align:left">
	<img src="images/logo/<?=$row['logo']?>" border="0" width="80" height="40" />
	<br /><span style="font-weight:bold; width:70px; float:right; padding-left:10px; text-align:center"><?=$row['sous_logo']?></span></td>
	<td width="30%" align="center" ><span style=" font-weight:bold; text-align:center">Formulaire </span></td>
    <td width="30%" align="center"><span style=" font-weight:bold"><?=$row['for_esm']?></span></td>
     </tr>
 <tr height="15px">
    <td rowspan="2" align="center"><span style=" font-weight:bold; text-align:center"><?=$row['titre']?></span></td>													
    <td  rowspan="2" align="center"><span style=" font-weight:bold"><?=$row['version']?></span>
	<br /><span style=" font-weight:bold; width:100%; display:block; border-top:#000000 1px solid"><?=$row['page']?></span>
	 </td>		
  </tr>
  <tr height="10px"></tr>
</table>
<!--  fin entete-->
</td></tr>
<?php
if (isset($_POST['boxchecked'])){

$code_cours=$_POST['boxchecked'];

$sql1="select p.nom_prenom, c.titre
       from $tbl_cours as c, $tbl_professeur as p, $tbl_seance as s
	   where c.code_cours='$code_cours'
	   and p.code_prof=s.code_prof 
	   and c.code_cours = s.code_cours 
	   and s.idSession='$idSession' limit 1"; 
  
  
 
$req=@mysql_query($sql1) or die ("erreur lors de la sélection des infos du cours");

$row=mysql_fetch_assoc($req);
$nom=htmlentities($row['nom_prenom']);
$titre=htmlentities($row['titre']);
?>
<table width="575" border="0" cellspacing="0" cellpadding="0" align="center" class="print" >
<tr>
    <td align="left" width="125px"><span class="bold">Code:</span> <?=$code_cours?></td>
	<td colspan="2" align="left"><span class="bold">Cours:</span><?=$titre?></td>
</tr>
<tr>
	<td align="left" colspan="2"><span class="bold">Professeur:&nbsp;</span><?=$nom?></td>
	<td align="left">
	<?php
	$sql2="select session, annee_academique, nom_jours, nom_salle, nom_horaire
	from $tbl_session as ss, $tbl_seance as s, $tbl_jours as j, 
	$tbl_salle as sl, $tbl_horaire as h
	where s.code_cours='$code_cours'
	and s.idSession='$idSession'
	and s.idSession=ss.idSession
	and s.code_jours=j.code_jours
	and s.code_salle=sl.code_salle
	and s.code_horaire=h.code_horaire limit 0, 2";
	$req=@mysql_query($sql2) or die ('erreur 184'); 
	while($row=mysql_fetch_assoc($req)){
	$session=$row['session'];
	$annee=$row['annee_academique'];
	$jours.=$row['nom_jours'].'<br />';
	$salle.=$row['nom_salle'].'<br />';
	$horaire.=$row['nom_horaire'].'<br />';
	}
	?>
	<span class="bold">Session: </span><?=($session=='automne') ? $txt_automne : $txt_printemps?>&nbsp;<?=substr($annee, 2, 2)?></td>
</tr>
<tr>
	<td align="left"><span class="bold">Jours: </span><?=$jours?></td>
	<td align="left"><span class="bold">Horaire: </span><?=$horaire?></td>
	<td align="left"><span class="bold">Salle: </span><?=$salle?></td>
</tr>
<tr>
	<td height="5px" colspan="5"></td>
</tr>
</table>
<table width="575" border="0" align="center" cellspacing="0" class="print" cellpadding="0" style=" font-weight:bold; text-align:left; margin-top:10px">
  <tr>
    <td>C=Contrôle</td>
    <td>E.F=Examen final</td>
	<td>D.P=Devoirs et projets</td>
  </tr>
  <tr>
    
    <td>N.P=Note de participation</td>
	<td>N.L=Note en lettre</td>
    <td>N.F=Note finale</td>
  </tr>
  <tr>
    <td>P.forts=Points forts</td>
    <td>P.améliorer=Points à améliorer</td>
	<td>A=Nombre d'absences</td>
  </tr>
</table>
</td></tr>
<tr><td height="5px"></td></tr>
<tr><td>
  <?php
 
$sql="select  concat(e.nom,' ', e.prenom) as name 
from $tbl_etudiant as e, $tbl_note as n
where n.code_inscription = e.code_inscription 
and n.code_cours = '$code_cours'
and n.idSession = '$idSession' 
and n.archive=0 order by name" ;
 $req=@mysql_query($sql) or die("erreur lors de la créatiob de la fiche des  notes");
$i=0;
?>
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="task" value="edit_note" />
<table width="575" border="0" cellspacing="1" cellpadding="0" align="center" class="adminlist">
  <tr class="entete" align="center">
    <td width="15px">#</td>
    <td width="220">&nbsp;Nom</td>
	<td width="15" valign="top" title="nombre d'absences">A</td>
    <td width="25" valign="top" title="contrôle 1">C1</td>
    <td width="25" valign="top" title="Examen de mi semestre">C2</td>
    <td width="25" valign="top" title="Contrôle 3">C3</td>
    <td width="25" valign="top" title="Examen final">E.F</td>
	<td width="25" valign="top" title="Devoirs et projets">D.P</td>
    <td width="25" valign="top" title="Note de participation">N.P</td>
    <td width="25" valign="top" title="Note finale">N.F</td>
	<td width="25" valign="top" title="note finale en chiffre">N.C</td>
	<td width="25" valign="top" title="note finale en lettre">N.L</td>
	<td width="75" valign="top">P.forts</td>
	<td width="75" valign="top">P.améliorer</td>
  </tr>
<?php
while ($row=mysql_fetch_assoc($req)){
$i++;
?>
<tr style="text-align:center;height:13px">
    <td><?=$i?></td>
  	<td align="left">&nbsp;<?=htmlentities($row['name'])?></td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	 </tr>
	 <?php
  }
  ?>
 </table>
</form>
 <?php
  }
  ?>
 <table width="575" border="0" cellspacing="0" cellpadding="0" class="fiche_footer">
  <?php
   $query="select * from  $tbl_footer where type='Fiche de notes' limit 1";
   $req=@mysql_query($query) or die ("erreur lors de la création du footer");
   $row=mysql_fetch_assoc($req);
   ?>
  <tr>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: <?=$row['auteur1']?></td>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: <?=$row['auteur2']?></td>
	<td class="souligne" width="10%">Auteur</td>
    <td width="25%">: <?=$row['auteur3']?></td>
  </tr>
  <tr>
     <td class="souligne">Fonction</td>
	<td>: <?=$row['fonction1']?></td>
	 <td class="souligne">Fonction</td>
	<td>: <?=$row['fonction2']?></td>
	 <td class="souligne">Fonction</td>
	<td>: <?=$row['fonction3']?></td>
  
  </tr>
  <tr>
    <td class="souligne">Visa</td>
    <td>: &nbsp;<?=$row['visa1']?></td>
    <td class="souligne">Visa</td>
    <td>: &nbsp;<?=$row['visa2']?></td>
	<td class="souligne">Visa</td>
    <td>: &nbsp;<?=$row['visa3']?></td>
  </tr>
  <tr>
    <td class="souligne">Date</td>
	<td>: <?=$row['date1']?></td>
	<td class="souligne">Date</td>
	<td>: <?=$row['date2']?></td>
	<td class="souligne">Date</td>
	<td>: <?=$row['date3']?></td>
	</tr>
	<tr><td colspan="6" height="2px"></td></tr>
</table>
        <form name="retour" method="post">
		<input type="hidden" name="task" value="note" />
		<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
		</form>