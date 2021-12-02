<?php

$count=0;

$code_cours=addslashes($_GET['code_cours']);

$idSession = isset($_GET['idSession']) ? (int)$_GET['idSession'] : $_SESSION['idSession'];

$pcours="select c.titre, p.nom_prenom 
from $tbl_cours as c, $tbl_professeur as p, $tbl_seance as s
where c.code_cours='$code_cours' 
and c.code_cours=s.code_cours
and s.code_prof=p.code_prof limit 1";

$req=@mysql_query($pcours) or die ("erreur");

$row=mysql_fetch_assoc($req);

$titre=htmlentities($row['titre']);

$nom=htmlentities($row['nom_prenom']);

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/absence.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES ABSENCES 

	<span class="sub_title">Titre du cours :<?=$titre?></span>

	<span class="sub_title">Enseignant :<?=$nom?></span>

	</td>

	<td width="22%">

	  <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>
		 <td valign="top" align="center" >
		   <a href="gestion_absences.php?new=oui&course_code=<?php echo $code_cours?>&idSession=<?php echo $idSession?>"><div class="ajouter"></div> Ajouter</a>
		  </td>
		 <td valign="top" align="center" >
			<a href="#" onclick="window.print()" title="Imprimer"><div class="imprimer"></div>Imprimer</a>
		 </td>
		 <td valign="top" align="center" width="90px">
		 	<a href="gestion_absences.php"><div class="retour"></div>Retour</a>
		 </td>

		</tr>

	  </table>

	</td> 

  </tr>

</table>

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

    

$sql="select DISTINCT e.code_inscription, concat(e.nom,' ', e.prenom) as name from $tbl_etudiant as e, $tbl_inscription_cours as i where 

i.code_cours='$code_cours' 

and i.code_inscription=e.code_inscription 

and i.idSession='$idSession' order by e.nom";

$req=@mysql_query($sql) or die("erreur lors de la sélection des étudiants");

?>

<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="adminlist">

<form action="#" method="post" name="adminMenu">

<input type="hidden" name="boxchecked" value="0" />

  <tr valign="top" style="font-weight:bold; padding-bottom:1px; padding-top:1px"> 

    <td align="left" width="989">&nbsp;Nom et prénom</td>

	<?php

	$i=2;

	$sql1="SELECT DISTINCT date

FROM $tbl_absence

WHERE code_cours = '$code_cours' 

and idSession='$idSession' order by date limit 0, 28";

	$req1=@mysql_query($sql1) or die ("erreur lors de la sélection des dates");

	while($row=mysql_fetch_assoc($req1)){

	$i++;

	?>

	<td width="14px" title="<?=$row['date']?>" align="center">
	<span style="width:14px;writing-mode:tb-rl; white-space: nowrap;">

	<?=rotate_text($row['date'])?></span></td>

	<?php

	}

	?>

  </tr>

<?php
 $nc=$nic=0;
while ($row=mysql_fetch_assoc($req)){
$ci=htmlentities($row['code_inscription']);
$n=htmlentities($row['name']);
?>

  <tr height="12px">

    <td align="left">&nbsp;<a href="gestion_absences.php?code_inscription=<?=$ci?>&idSession=<?php echo $idSession?>"><?=$n?></a>

	</td>

	<?php 

	$code=$row["code_inscription"];
   
 
	$sql2="select jeton, n_comptabilise, n_incomptabilise from $tbl_absence where code_inscription='$code' 

	and code_cours='$code_cours'

	and idSession='$idSession' order by date";

	$req2=mysql_query($sql2) or die("erreur lors de la selection des absences");

	$count=mysql_num_rows($req);

	while($row=mysql_fetch_assoc($req2)){
     $nc+=$row['n_comptabilise'];
	 $nic+=$row['n_incomptabilise'];
	?>

	<td title="Nombre d'absences: <?=$row['n_comptabilise']?>">&nbsp;<?=$row['jeton']?></td>

	<?php

	}

	?>

  </tr>

  <?php

  }
  //try
  echo  '<tr><td class="footer_table">Nombre d\'absences par date:</td>';
$sql_nbr_date="SELECT date, sum( n_comptabilise ) as somme
FROM `tbl_absence`
WHERE code_cours = '$code_cours'
and idSession='$idSession'
GROUP BY date ORDER BY date";
$req_nbr_date=@mysql_query($sql_nbr_date) or die('erreur de selection du nombre absence par date');
while ($row_nbr_date=mysql_fetch_assoc($req_nbr_date)){
?>
<td title="Nombre d'absences à la date: <?=$row_nbr_date['date']?>">&nbsp;<?=$row_nbr_date['somme']?></td>
<?php
}
  //end
  ?> 
  </tr>
  <tr><td colspan="<?=$i?>" class="footer_table">Nombre d'étudiants :<?=$count?></td></tr>
  <tr><td colspan="<?=$i?>" class="footer_table">Nombre d'absences comptabilisé :<?=$nc?></td></tr>
  <tr><td colspan="<?=$i?>" class="footer_table">Nombre d'absences non comptabilisé :<?=$nic?></td></tr>
</form>
</table>

 