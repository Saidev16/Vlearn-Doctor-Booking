<span id="titre_page">Réponse sur le requettes</span>
<table width="575" border="0" cellspacing="1" cellpadding="0" id="tbl_demande" style="margin-top:10px; border:#333333 1px solid">
  <tr class="entete" align="center">
    <td width="75">Objet</td>
    <td width="75">Date</td>
	<td width="400">Réponse</td>
  </tr>
  <tr><td colspan="3" height="1px" bgcolor="#333333"></td></tr>
  <?php
  $nombre=0;
  if (isset($_SESSION['code_prof'])){
  $code_prof=$_SESSION['code_prof'];
  $sqll="select objet, date_requette, reponse, reponse_date_time
  from $tbl_demande where code_prof='$code_prof' order by date_requette";
  $req=@mysql_query($sqll) or die ("erreur lors de la sélection des réponses");
  $nombre=mysql_num_rows($req);
  while($row=mysql_fetch_assoc($req)){
  ?>
  <tr valign="top" align="left">
    <td valign="top">&nbsp;<?=htmlentities($row['objet'])?></td>
    <td valign="top">&nbsp;<?=substr($row['date_requette'], 0, 10)?></td>
    <td valign="top">&nbsp;<?=($row['reponse']!='') ? $row["reponse_date_time"] : ''?><br />
                           <?=html_entity_decode(stripslashes($row['reponse']))?>
    </td>
  </tr>
   <tr><td colspan="3" height="1px" bgcolor="#333333"></td></tr>
  <?php
  }
  }
  ?>
  <tr><td colspan="3" height="5px" class="footer_table">Totale :<?=$nombre?></td></tr>
</table>
