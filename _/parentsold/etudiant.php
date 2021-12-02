<span id="titre_page">Liste des &eacute;tudiants </span>
<?php
$code_prof=(int)$_SESSION['code_prof'];
$code_cours=$_POST['boxchecked'];
$query="select code_cours, titre from $tbl_cours 
where code_cours='$code_cours' limit 1"; 

$req=@mysql_query($query) or die("erreur lors de la s�lection du titre du cours");
$row=mysql_fetch_assoc($req);
echo '<div><b>Titre du cours </b>: '.$row['titre'].'</div>';
echo '<div><b>Code du cours </b>: '.$row['code_cours'].'</div>';

$sql="select  concat(e.nom,' ', e.prenom) as name 
from $tbl_etudiant as e, $tbl_inscription_cours as i 
where i.code_cours='$code_cours' 
and i.code_inscription=e.code_inscription 
and i.idSession='$idSession' order by name";

$req=@mysql_query($sql) or die("erreur lors de la s&eacute;lection des &eacute;tudiants");

$i=0;
?>
<table width="550" border="0" cellspacing="1" align="center" id="lien_msj" class="msj">
    <tr>
  		<td width="510"></td>
		<td align="center">
			<a href='professeur.php?task=cours'><div class="retour"></div>retour</a>
		</td>
	</tr>
	<tr><td colspan="2" headers="3px"></td></tr>
	</table>
<table width="550" border="0" cellspacing="1" cellpadding="0" align="center" style="border:#333333 1px solid">
  <tr class="entete">
    <td width="20" align="center">#</td>
    <td width="530">&nbsp;Nom et pr&eacute;nom</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#333333" height="1px"></td>
  </tr>
<?php
while ($row=mysql_fetch_assoc($req)){
$i++;
?>
<tr height="18px">
    <td style="font-weight:bold"><?=$i?></td>
    <td align="left">&nbsp;<?=htmlentities($row['name'])?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#333333" height="1px"></td>
  </tr>
  <?php
  }
  ?>
   <tr>
     <td colspan="2"  height="16px" class="footer_table">&nbsp;Nombre d'&eacute;tudiants: <?=$i?></td>
   </tr>
</table>	