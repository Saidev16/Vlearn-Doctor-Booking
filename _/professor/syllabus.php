<script language="javascript1.2">
function valider_syllabus(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez sélectionner un week ');
return false;
}
else{
document.adminMenu.task.value='edit_syllabus';
document.adminMenu.submit();
return true; }
}
</script>
<span id="titre_page">Syllabus</span>

	   <table width="550" border="0" cellspacing="0" cellpadding="0" id="lien_msj" align="center">
  <tr>
    <td width="400px"></td>
	<td align="center" width="50">
		<a href="#" onclick="window.print()"><div class="imprimer"></div>Print</a>
	</td>
    <td align="center" width="50">
		<a href="#" onclick="return valider_syllabus();"><div class="edit"></div>Editer</a></td>
    <td align="center" width="50">
		<a href='professeur.php?task=cours'><div class="back"></div>retour</a>
	</td>
  </tr>
</table>
	  

  <?php
 $header="select * from $tbl_header where type='syllabus' limit 1";
 $req=@mysql_query($header) or die ("erreur lors de la selection des syllabus");
 $row=mysql_fetch_assoc($req);
 $logo=$row['logo'];
 $title=$row['titre'];
 $version=$row['version'];
 $for_esm=$row['for_esm'];
 $sous_logo=$row['sous_logo'];
 if (isset($_POST['boxchecked'])){
 $code_cours=$_POST['boxchecked'];
$sql1 ="select p.nom_prenom, c.titre
       from $tbl_cours as c, $tbl_professeur as p, $tbl_seance as s
	   where c.code_cours='$code_cours'
	   and p.code_prof=s.code_prof 
	   and c.code_cours = s.code_cours 
	   and s.idSession='$idSession' limit 1";   
 
$req = @mysql_query($sql1) or die ("erreur lors de la sélection des infos du cours");

$row = mysql_fetch_assoc($req);
$nom_prenom = stripslashes(ucfirst($row['nom_prenom']));
$titre = htmlentities($row['titre']);
$jours=$salle=$horaire='';
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
  <!--entete-->
 <table width="550" border="0" cellspacing="1" cellpadding="0" height="70px" style="text-align:center" class="adminlist">
   <tr height="30px">
    <td rowspan="3" width="30%"><img src="images/logo/<?=$logo?>" border="0" width="168" height="70" />
	<br />
	<span id="sous_logo"><?=$sous_logo?></span>
	</td>
	<td width="30%" ><span id="formulaire">Formulaire </span></td>
    <td width="30%"><span id="for_esm"><?=$for_esm?></span></td>
     </tr>
 <tr height="15px">
    <td rowspan="2"><span id="letitre"><?=$title?></span></td>
    <td  rowspan="2" ><span id="version"><?=$version?></span> </td>
  </tr>
  <tr height="10px"></tr>
</table>
<!--  fin entete-->
  
  <table width="550" style="text-align:left" align="center" cellpadding="0" cellspacing="0">
    <tr>
		<td width="66%"><span class="bold">Intitul&eacute; du cours: </span><?=stripslashes($titre)?></td>
		<td><span class="bold">Code: </span><?=$code_cours?></td>
  	</tr>
    <tr>
		<td><span class="bold">Enseignant: </span><?=$nom_prenom?></td>
		<td><span class="bold">Semestre: </span>
		<?=$session?>&nbsp;<?=$annee?>
		</td>
  	</tr>
	</table>
	
    <table width="550" style="text-align:left" cellpadding="0" cellspacing="0" align="center">
    <tr>
		<td width="33%"><span class="bold">Jours: </span><?=$jours?></td>
		<td width="33%"><span class="bold">Horaire: </span><?=$horaire?></td>
		<td><span class="bold">Salle: </span><?=$salle?></td>
  	</tr>
	</table>
   
     
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="task" value="edit_syllabus" />
<table width="550" cellspacing="1" cellpadding="0" align="center" class="adminlist">
    <tr class="entete" align="center">
     <td width="15px" id="check">#</td>
     <td width="60px">Week</td>
	 <td width="170px">Contenu</td>
	 <td width="300px">Progress report :Etat d'avancement</td>
  </tr> 
<?php
$sql1="select * from $tbl_syllabus 
where code_cours='$code_cours'
and idSession='$idSession' order by week limit 0, 13"; 
$req=@mysql_query($sql1) or die( "erreur lors de s&eacute;lection des syllabus");
while ($row=mysql_fetch_assoc($req)){
$cc=$row['code_sylabus'];
?>
<tr height="18px">
	<td id="check"><input type="radio" id="<?=$cc?>" name="id" value="<?=$cc?>" 
	onClick="document.adminMenu.boxchecked.value=<?=$cc?>" /></td>
    <td align="left" class="bold" valign="top">&nbsp;week<?=$row['week']?></td>
	<td align="left" valign="top">&nbsp;<?=html_entity_decode(stripslashes($row['contenu']))?></td>
	<td align="left" valign="top" class="hack">&nbsp;<?=html_entity_decode(stripslashes($row['avancement']))?></td>
  </tr>
  <?php
  }
  ?>
</table>
</form>
 
  
   <table width="550" border="0" cellspacing="0" cellpadding="0" class="fiche_footer" align="center">
  <?php
   $query="select * from  $tbl_footer where type='descriptif' limit 1";
   $req=@mysql_query($query) or die ("erreur lors de la cr&eacute;ation du footer");
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
</table>
 
<?php
  }
  ?>