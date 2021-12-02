<span id="titre_page">Mes emprunts</span>
<div id="contenu">
<table width="575" border="0" cellspacing="1" cellpadding="0" class="adminlist">
  <tr class="entete">
    <td width="5%">&nbsp;#</th>
    <td width="55%">&nbsp;Titre</th>
    <td width="20%">&nbsp;Date d'empreinte</th>
    <td width="20%">&nbsp;Date de retour</th>
  </tr>
  <?php
  $id=$_SESSION['code_etudiant'];
  $today=date('Y-m-d');
  $sql="select l.titre_livre, e.date_empreint, e.date_retour 
  from $tbl_livre as l, $tbl_empreinte as e where 
  e.code_inscription='$id' 
  and l.code_livre=e.code_livre order by date_empreint desc";
  $req=@mysql_query($sql) or die("erreur lors de la sélection des livres empruntés");
  $i=0;
  while ($row=mysql_fetch_assoc($req)){
  $i++;
  ?>
  <tr>
  <td>&nbsp;<?=$i?></td>
  <td align="left">&nbsp;<?=htmlentities($row['titre_livre'])?></td>
  <td align="left">&nbsp;<?=htmlentities($row['date_empreint'])?></td>
  <td align="left">&nbsp;<?=htmlentities($row['date_retour'])?></td>
	</tr>
	<?php
	}
    ?>
		<tr class="footer_table">
  <td colspan="4" align="left" id="total">&nbsp;Total: <?=$i?></td>
  </tr>
</table>