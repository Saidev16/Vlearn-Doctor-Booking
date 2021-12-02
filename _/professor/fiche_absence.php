<link rel="stylesheet" type="text/css" href="../css/print.css">
<span id="titre_page" class="hide">Fiche d'Absences</span>
<table width="575" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-bottom:5px" id="lien_msj">
  <tr>
    <td>
    <table width="80" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
  <td align="center" width="50px"><a href="#" onclick="window.print()" title="print">
	<div class="imprimer"></div>Print</a></td>
		    <td align="center" width="50px">
	<a href='#' onClick="javascript:document.retour.submit();" title="pr�cedent">
	<div  class="back"></div>retour</a>
	</td>
  <td width="5px"></td>
  </tr>
</table>
</td></tr>
</table>
 <!--entete-->
    <table width="575" border="0" cellspacing="1" cellpadding="0" height="70px" class="adminlist">
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

$header="select * from $tbl_header where type='absence' limit 1";
		$req=@mysql_query($header) or die ("erreur lors de la création du hedaer");
		$row=mysql_fetch_assoc($req);
		$logo=$row['logo'];
		$title=$row['titre'];
		$version=$row['version'];
		$for_esm=$row['for_esm'];
		$sous_logo=$row['sous_logo'];
?>
<!--entete-->
  <table width="550" border="0" cellspacing="1" cellpadding="0" height="70px" style="text-align:center" class="adminlist">
   <tr height="30px">
    <td rowspan="3" width="30%">
	<img src="images/logo/<?=$logo?>" border="0" width="168" height="70" />
	<br />
	<span id="sous_logo"><?=$sous_logo?></span>
	</td>
	<td width="30%" ><span id="formulaire">Formulaire</span></td>
    <td width="30%"><span id="for_esm"><?=$for_esm?></span></td>
     </tr>
 <tr height="15px">
    <td rowspan="2"><span id="tit"><?=$title?></span></td>
    <td  rowspan="2" ><span id="version"><?=$version?></span></td>
  </tr>
  <tr height="10px"></tr>
</table>
<!--  fin entete-->
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
 
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
 <input type="hidden" name="task" id="task" value="" />
<input type="hidden" name="cours" value="<?=$code_cours?>" />
<table width="575" border="0" cellspacing="1" cellpadding="0" align="center" class="adminlist" >
  <tr valign="top" height="50px"> 
    <td align="center" width="10px"><span style="margin-top:15px; margin-bottom:15px; display:block">#</span></td>
    <td align="left" width="160"><span style="margin-top:15px; margin-bottom:15px; display:block">&nbsp;Nom et pr&eacute;nom</span></td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
	<td class="largeurtd">&nbsp;</td>
  </tr>
 	<?php
	$student="select distinct e.code_inscription, concat(e.nom,' ', e.prenom) as name 
	from $tbl_etudiant as e, tbl_inscription_cours as i where 
	i.code_cours='$code_cours' 
	and i.code_inscription=e.code_inscription 
	and i.idSession='$idSession' order by name";
	$j=0;
	$req=mysql_query($student) or die("erreur lors de la selection des etudiants");
	while ($row=mysql_fetch_assoc($req)){
	$j++;
	?>
	  <tr height="12px">
	  <td><?=$j?></td>
        <td align="left" width="">&nbsp;<?=htmlentities($row['name'])?></td>
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
<table width="575" align="center" border="0" cellspacing="0" cellpadding="0" class="fiche_footer">
  <?php
   $query="select * from  $tbl_footer where type='Fiche d\'absence' limit 1";
   $req=@mysql_query($query) or die ("erreur lors de la création du footer");
  $row=mysql_fetch_assoc($req) ;
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
<input type="hidden" value="absence" name="task" />
<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
 <input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
</form>
