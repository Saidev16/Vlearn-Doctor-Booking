<span id="titre_page">Liste d'attente </span>
<?php
 if (isset($_POST['boxchecked'])){
  $code_cours=$_POST['boxchecked'];
  $sql="select titre_eng from $tbl_cours where code_cours='$code_cours' limit 1";
  $req=mysql_query($sql);
  $row=mysql_fetch_assoc($req);
  $titre=$row['titre_eng'];
  
  $sqlsession="select idSession, session, annee_academique from $tbl_session where inscription=0";
		 $req=@mysql_query($sqlsession) or die ('erreur de selection de la session');
		 $row=mysql_fetch_assoc($req);
		 $idSession=$row['idSession'];
		 $session=$row['session'];
		 $annee_academique=$row['annee_academique'];
?>
   <div style="margin-bottom:5px; font-weight:bold">Titre :<?=$titre?></div>
   <div style="margin-bottom:5px; font-weight:bold">Session : <?=$session?>&nbsp;<?=$annee_academique?></div>
<table width="550" border="0" cellspacing="0" cellpadding="0" align="center" style="border:#333333 1px solid">
  <tr class="entete">
    <td width="20">#</td>
    <td align="left">&nbsp;Nom et prénom</td>
  </tr>
  <tr>
    <td colspan="2" height="1px" bgcolor="#333333"></td>
  </tr>
  <?php
  $sql1="select concat(e.nom,' ', e.prenom) as name  
   from $tbl_etudiant as e, $tbl_inscription_cours as i where 
   i.code_cours='$code_cours' and 
   e.code_inscription=i.code_inscription 
   and i.idSession='$idSession'
   and i.liste_attente=1 order by i.date_inscription";   
   $req1=@mysql_query($sql1);
   $i=0;
   while ($row=mysql_fetch_assoc($req1)){
   $i++;
  ?>
  <tr height="16px">
    <td align="center"><?=$i?></td>
    <td align="left">&nbsp;<?=htmlentities($row['name'])?></td>
  </tr>
  <tr><td colspan="2" height="1px" bgcolor="#333333"></td></tr>
  <?php
  }
  ?>
  <tr class="footer_table">
  <td colspan="2" align="left" id="total">&nbsp;Total: <?=$i?></td>
  </tr>
 </table>
<?php
  }
  ?>
