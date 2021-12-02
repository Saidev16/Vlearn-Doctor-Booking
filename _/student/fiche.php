<span id="titre_page">Personal Card</span>
<?php
if (isset($_SESSION['code_etudiant'])){
$code_inscription=$_SESSION['code_etudiant'];
   $prefixe=$_SESSION['prefixe'];
 $sql="SELECT e.code_inscription, concat(nom, ' ', prenom) as name, e.date_inscription, e.niveau, e.tel, e.email
from tbl_etudiant_all as e
where code_inscription = '$code_inscription' and prefixe='$prefixe'
 LIMIT  1";
$req=@mysql_query($sql) or die("erreur lors de la sélection des informations");
$row=mysql_fetch_assoc($req);
?>
<table width="575" cellspacing="2" cellpadding="0"  border="0" style="text-align:left; margin-top:10px">
  <tr>
    <td width="420" class="entete">&nbsp;Registration Code :</td>
	</tr><tr>
    <td height="15">&nbsp;<?php echo 'ASL'.$row['code_inscription'];?></td>
  </tr>
  <tr>
    <td class="entete">&nbsp;Full Name:</td>
	</tr><tr>
    <td height="15">&nbsp;<?=htmlentities($row['name'])?></td>
  </tr>
  <tr>
    <td class="entete">&nbsp;Registration Date : </td>
	</tr><tr>
    <td height="15">&nbsp;<?=htmlentities($row['date_inscription'])?></td>
  </tr>
  
  <tr>
    <td class="entete">&nbsp;Phone number </td>
	</tr><tr>
    <td height="15">&nbsp;<?=htmlentities($row['tel'])?></td>
  </tr>
   
  <tr>
    <td class="entete">&nbsp;Email : </td>
	</tr><tr>
    <td height="15">&nbsp;<?=htmlentities($row['email'])?></td>
  </tr>
  
  <!--<tr>
    <td class="entete">&nbsp;Fili&egrave;re :</td>
	</tr><tr>
    <td height="15">&nbsp;<?=htmlentities($row['nom_filiere'])?></td>
	</tr>
	<tr>
    <td class="entete">&nbsp;Groupe : </td>
	</tr><tr>
    <td height="15">&nbsp;<?=htmlentities($row['niveau'])?></td>
  </tr>
  <tr>
    <td class="entete">&nbsp;Teste d'acc&egrave;s  </td>
	</tr>
	<tr>
    <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="50%"><u>Français:</u> <?=htmlentities($row['test_fr'])?></th>
  </tr>
  <tr>
    <th><u>Anglais:</u> <?=htmlentities($row['test_eng'])?></th>
  <tr>
    <th width="50%"><u>Logique</u> <?=htmlentities($row['test_logique'])?></th>
  </tr>
  <tr>
    <th><u>Math&eacute;matique</u> <?=htmlentities($row['test_math'])?></th>
  </tr>-->
</table>
</td>
	</tr>
</table>
<?php
}
?>