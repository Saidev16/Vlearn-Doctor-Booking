<span id="titre_page">Answers To my requests</span>
<?php
if (isset($_SESSION['code_etudiant'])){
$code_etudiant=$_SESSION['code_etudiant'];
?>
<table width="575" border="0" cellspacing="1" cellpadding="0" class="adminlist">
  <tr class="entete">
    <td width="125">Subject</td>
    <td width="75">Date</td>
	<td width="350">Response</td>
  </tr>
  <?php
  $i=0;
  $sqll="select objet, date_requette, reponse, reponse_date_time, reponse_auteur
   from $tbl_demande 
   where code_inscription='$code_etudiant' 
   order by date_requette desc limit 6";
  $req=@mysql_query($sqll) or die ("errur lors de la sélection des reponse");
  while($row=mysql_fetch_assoc($req)){
  $i++;
  ?>
  <tr valign="top" align="left" style="padding-left:1px">
    <td valign="top"><?=htmlentities($row['objet'])?></td>
    <td valign="top"><?=substr($row['date_requette'], 0, 10)?></td>
    <td valign="top" id="hack">&nbsp; 
<?=($row['reponse_date_time']!='0000-00-00 00:00:00') ? $row['reponse_date_time'].'<br />' : ''?>
	<?=html_entity_decode(stripslashes($row["reponse"]))?><br />
      <?=$row['reponse_auteur']?></td>
  </tr>
  <?php
  }
  ?>
  <tr class="footer_table"><td colspan="3">Total :<?=$i?></td></tr>
</table>
<?php
}
?>