<script language="javascript1.2">
function add(){
//ajout
if(document.adminMenu.boxchecked.value==0){
alert('Please select a student in the list');
return false;
}
else{
document.adminMenu.task.value='add_absence';
document.adminMenu.submit();
return true; }
}
//modification
function edit(){
if(document.adminMenu.boxchecked.value==0){
alert('Please select a student in the list');
return false;
}
else{
document.adminMenu.task.value='edit_absence';
document.adminMenu.submit();
return true; }
}
</script>
<span id="titre_page">Fiche d'Absences</span>
 
    <table width="120" border="0" cellspacing="0" cellpadding="0" align="right"  id="lien_msj">
  <tr>
  <td valign="top" align="center" width="50px">
		   <a href="#" onclick="return add()" title="ajouter un absence"><div class="add"></div>Ajouter</a>
	 </td>
     <td valign="top" align="center" width="50px">
		   <a href="#" onclick="return edit()" title="editer un absence"><div class="edit"></div>Editer</a>
	 </td>
    <td align="center" width="50px">
  			<a href="#" onclick="window.print()" title="imprimer"><div class="imprimer"></div>Imprimer</a>
	</td>
     <td align="center" width="50px">
		  <a href='professeur.php?task=cours' title="précedent"><div class="back"></div>retour</a>
	</td>
  <td width="10"></td>
  </tr>
</table>
 
 <!--entete-->
  <?php
 if (isset($_POST['boxchecked'])){

$code_cours=addslashes($_POST['boxchecked']);

	   $sql1="select p.nom_prenom, c.titre
       from $tbl_cours as c, $tbl_professeur as p, $tbl_seance as s
	   where c.code_cours='$code_cours'
	   and p.code_prof=s.code_prof 
	   and c.code_cours = s.code_cours 
	   and s.idSession='$idSession' limit 1";   
 
	    $req=@mysql_query($sql1) or die ("erreur lors de la sélection des infos du cours");

		$row=mysql_fetch_assoc($req);
		$nom=$row['nom_prenom'];
		$titre=stripslashes($row['titre']);
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
  <table width="550" border="0" cellspacing="1" cellpadding="0" height="70px" style="text-align:center;" class="adminlist" style="clear:both">
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
	<?php
	$jours=$salle=$horaire=$annee='';
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
<tr>
	<td align="left" colspan="2"><span class="bold">Professeur:&nbsp;</span><?=$nom?></td>
	<td align="left"><span class="bold">Session: </span>
	<?=$session?>&nbsp;<?=substr($annee, 2, 2)?></td>
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
<table width="575" border="0" cellspacing="1" cellpadding="0" align="center" style="border:#333333 1px solid">
  <tr valign="top" style="background:url(administrator/images/images/article_background.gif) repeat top; font-weight:bold"> 
    <td align="center" width="10px" id="check">#</td>
    <td align="left" width="535">&nbsp;Nom et pr&eacute;nom</td>
	<?php
	function rotate_text($date){
		$browser= $_SERVER['HTTP_USER_AGENT'];
		if (!strpos($browser, 'MSIE')){
		$y=substr($date, 2,2);
		$m=substr($date, 5,2);
		$d=substr($date, 8,2);
		return $d.'<br>'.$m.'<br>'.$y;
		}
		else{
		return $date;
		}
		}
	$i=2;
	$dates=array();$n=1;
	$date="SELECT date FROM $tbl_absence 
			WHERE code_cours = '$code_cours' 
			and idSession='$idSession' 
			group by date";
			
	$req=@mysql_query($date) or die ("erreur lors de la selection des dates");
	while($row=mysql_fetch_assoc($req)){
	$dates[$n]=$row['date'];
	$i++;$n++;
	?>
	<td width="14px">
	<span style="width:14px;writing-mode:tb-rl; white-space: nowrap;">
	<?=rotate_text($row['date'])?>
	</span>
	</td>
	<?php
	}
	?>
  </tr>
  <tr><td colspan="30" bgcolor="#333333" height="1px"></td></tr>
	<?php
	$student="select distinct e.code_inscription, concat(e.nom,' ', e.prenom) as name 
	from $tbl_etudiant as e, $tbl_inscription_cours as i where 
	i.code_cours='$code_cours' 
	and i.code_inscription=e.code_inscription 
	and i.idSession='$idSession' order by name";
	
	$j=0;
	$req=mysql_query($student) or die("erreur lors de la sélection des étudiants");
	while ($row=mysql_fetch_assoc($req)){
	$j++;$m=0;
	$ci=$row['code_inscription'];
	
	?>
	  <tr height="12px">
	   <td align="center" id="check">
	   <input type="radio" id="<?=$ci?>" name="id" value="<?=$ci?>" 
	   onClick="document.adminMenu.boxchecked.value='<?=$ci?>'" />
	   </td>
      <td align="left" width="">
	&nbsp;<?=htmlentities($row['name'])?></td>
	<?php 
	$sql2="select date, jeton, n_comptabilise from $tbl_absence 
	where code_inscription='$ci' 
	and code_cours='$code_cours'
	and idSession='$idSession' 
	group by date";
 	$req2=mysql_query($sql2) or die("erreur lors de la selection des absences");
	$count=mysql_num_rows($req);
	while($row=mysql_fetch_assoc($req2)){
	$m++;
 	?>
	<td>
	<?php if($dates[$m]!=$row['date']){ $m++;?>
	<span class="cadre" title="0 absence"></span></td><td>
	<?php
	}
	?>
	<span class="cadre" title="<?=$row['n_comptabilise'].' absence(s)'?>"><?=$row['jeton'] ?></span>
	</td>
	<?php 
	}
	?>
  </tr>
   <tr><td colspan="30" bgcolor="#333333" height="1px"></td></tr>
  <?php
  }
  ?> <tr><td colspan="<?=$i?>" class="footer_table">Nombre d'&eacute;tudiants :<?=$j?></td></tr>
</table>
 </form>
 <?php
    }
   ?>
<table width="575" align="center" border="0" cellspacing="0" cellpadding="0" class="fiche_footer">
  <?php
   $query="select * from  $tbl_footer where type='Fiche d\'absence' limit 1";
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
<input type="hidden" name="task" value="fiche_absence" />
</form>
