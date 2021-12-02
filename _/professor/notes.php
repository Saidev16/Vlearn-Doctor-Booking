<script language="javascript1.2">
function edit(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez sélectionner un étudiant ');
return false;
}
else{
document.adminMenu.submit();
return true; }
}
</script>
<span id="titre_page">Fiche des notes</span>
<table width="100" border="0" cellspacing="0" cellpadding="0" align="right" id="lien_msj" style="margin-right:10px;">
  <tr>
   <td align="center">
   <a href="#" title="imprimer la fiche de notes"><div class="imprimer"></div>Imprimer</a>
	</td>
    <td align="center"><a href="#" onclick="return edit()" title="modifier les notes">
		   <div class="edit"></div>Editer</a></td>
		   <td align="center">
	<a href='professeur.php?task=cours' title="retourner à la page précedente">
	<div class="back"></div>retour</a>
	</td>
  </tr>
</table>
<!--fin print and edit-->
</td></tr>
</table>
    <!--entete-->
  <table width="575" border="0" align="center" cellspacing="1" cellpadding="0" height="70px" class="adminlist" style="clear:both" >
 <?php
 $sqlh="select * from $tbl_header where type='note' limit 1";
 $req=@mysql_query($sqlh) or die ("erreur lors de la cr�ation du hedaer");
 $row=mysql_fetch_assoc($req);
 ?>
  <tr height="30px">
    <td rowspan="3" width="30%"  style="padding-left:8px; padding-top:8px; text-align:left">
	<img src="images/logo/<?=$row['logo']?>" border="0" width="80" height="40" />
	<br /><span id="sous_logo"><?=$row['sous_logo']?></span></td>
	<td width="30%" align="center" ><span id="formulaire">Formulaire </span></td>
    <td width="30%" align="center"><span id="for_esm"><?php //$row['for_esm']?></span></td>
     </tr>
 <tr height="15px">
    <td rowspan="2" align="center"><span id="letitre"><?=$row['titre']?></span></td>													
    <td  rowspan="2" align="center"><span id="version"><?=$row['version']?></span>
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
  
  
 
$req=@mysql_query($sql1) or die ("erreur lors de la s�lection des infos du cours");

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
	$session=$annee=$jours=$salle=$horaire='';
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
	<span class="bold">Session: </span><?php echo $session ?>&nbsp;<?= $annee?></td>
</tr>
<tr>
	<td align="left"><span class="bold">Jours: </span><br /><?=$jours?></td>
	<td align="left"><span class="bold">Horaire: </span><br /><?=$horaire?></td>
	<td align="left"><span class="bold">Salle: </span><br /><?=$salle?></td>
</tr>
<tr>
	<td height="5px" colspan="5"></td>
</tr>
</table>
 
</td></tr>
<tr><td height="5px"></td></tr>
<tr><td>
  <?php
 
    $sql="select  n.*, 
	concat(e.nom,' ', e.prenom) as name from 
	$tbl_etudiant as e, $tbl_note as n 
	where n.code_inscription = e.code_inscription 
	and n.code_cours = '$code_cours'
	and n.idSession = '$idSession' order by name" ;
    $req=@mysql_query($sql) or die("erreur lors de la s�lection des notes");
    $i=0;
	
	//selection des coeficients
	
	$sql_desc="SELECT pourcentage from $tbl_descriptif 
	WHERE code_cours='$code_cours' 
	AND idSession='$idSession'";
	$req_desc=@mysql_query($sql_desc) or die('erreur de selection des coeficientsx');
	$row_desc=mysql_fetch_assoc($req_desc); 
	$percent=explode(';', $row_desc['pourcentage']);
?>
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="task" value="edit_note" />
<table width="575" border="0" cellspacing="1" cellpadding="0" align="center" class="adminlist">
 <tr class="entete" height="18px" align="center">
    <td width="15"></td>
    <td width="300">Nom </td>
	<td width="50">Mid-Term</td>
    <td width="50">Projet</td>
    <td width="50">Participation</td>
    <td width="50">Final exam</td>
    <td width="50">Final grade</td>
	<td width="50">Letter grade</td>
   </tr>
<?php
 
while ($row=mysql_fetch_assoc($req)){
$i++;
$cn=$row['code_note'];
?>
<tr style="text-align:center;height:13px">
     <td align="center" id="check"><input type="radio" id="<?=$cn?>" name="id" value="<?=$cn?>" onClick="document.adminMenu.boxchecked.value='<?=$cn?>'" /></td>
	 <td align="left">&nbsp;<?=stripslashes($row['name'])?></td>
		<td>&nbsp;<?=$row['mid_term']?></td>
		<td>&nbsp;<?=$row['project']?></td>
		<td>&nbsp;<?=$row['participation']?></td>
		<td>&nbsp;<?=$row['final_exam']?></td>
        <td>&nbsp;<?=$row['final_grade']?></td>
		<td>&nbsp;<?=$row['letter_grade']?></td>
	 </tr>
	 <?php
  }
  ?>
  <tr>
  	<td colspan="14" align="left" class="footer_table">
      Nombre d'&eacute;tudiants dans ce cours: <?=$i?>
    </td>
  </tr>
</table>
</form>
 
 <table width="575" align="center" border="0" cellspacing="0" cellpadding="0" class="fiche_footer">
  <?php
   $query="select * from  $tbl_footer where type='Fiche de notes' limit 1";
   $req=@mysql_query($query) or die ("erreur lors de la cr�ation du footer");
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
<form action="#" method="post" name="go_to_fiche">
<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
<input type="hidden" name="task" value="fiche_note" />
</form>
<?php
  }
  ?>