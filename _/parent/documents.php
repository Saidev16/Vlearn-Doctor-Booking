<span id="titre_page">Documents</span>
<table width="575" border="0" cellspacing="1" cellpadding="0" id="tbl_demande" style="margin-top:10px; border:#333333 1px solid">
  <tr class="entete" align="center">
     <td width="75">Date</td>
	 <td width="400">Titre</td>
  </tr>
  <tr><td colspan="3" height="1px" bgcolor="#333333"></td></tr>
  <?php
  $nombre=0;
  if (isset($_SESSION['code_etudiant'])){
  $code_etudiant=$_SESSION['code_etudiant'];
  $sqll="select id, date, titre, nom
  from tbl_docman  order by date";
  $req=@mysql_query($sqll) or die ("erreur lors de la sélection des réponses");
  $nombre=mysql_num_rows($req);
  while($row=mysql_fetch_assoc($req)){
  ?>
  <tr valign="top" align="left">
    <td valign="top">&nbsp;<?=htmlentities($row['date'])?></td>
    <td valign="top">&nbsp;<a href="http://piimt.us/piimt/module/demande/fichier/<?php echo $row['nom'];?>" style="color:#000; text-decoration:none"><?=stripslashes($row['titre'])?></a></td>
  </tr>
   <tr><td colspan="3" height="1px" bgcolor="#333333"></td></tr>
  <?php
  }
  }
  ?>
  <tr><td colspan="3" height="5px" class="footer_table">Totale :<?=$nombre?></td></tr>
</table>
