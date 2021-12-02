<?php
if (isset($_POST['boxchecked'])){
$code_absence=$_POST['boxchecked'];
 
 // selection du nom et prénom de l'�tudiant

$sql="select a.code_inscription, a.code_cours, a.date, h.nom_horaire, a.n_comptabilise, a.n_incomptabilise, concat(e.nom,' ', e.prenom) as name, c.titre 
from $tbl_etudiant as e, $tbl_absence as a, $tbl_cours as c, $tbl_horaire as h  
where a.idAbsence='$code_absence'
and a.code_cours=c.code_cours 
and e.code_inscription=a.code_inscription
and a.idHoraire=h.code_horaire
and a.idSession='$idSession' limit  1 ";

$req=@mysql_query($sql) or die("erreur lors de la sélection de cet absence");
$row=mysql_fetch_assoc($req);
$code_inscription=$row['code_inscription'];
$code_cours=$row['code_cours'];
$date=$row['date'];
$horaire=$row['nom_horaire'];
$n_comptabilise=$row['n_comptabilise'];
$n_incomptabilise=$row['n_incomptabilise'];
$name=$row['name'];
$libele=stripslashes($row['titre']);
?>  
  <form name="adminMenu" method="post" action="">
	  <input type="hidden" name="action" value="action_edit_absence" />
	  <input type="hidden" value="<?=$code_absence?>" name="code_absence" />
	  <input type="hidden" value="<?=$code_inscription?>" name="code_inscription" />
	  <input type="hidden" value="<?=$code_cours?>" name="code_cours" />
	  <input type="hidden" value="<?=$n_comptabilise?>" name="n_comptabilise" />
	  <input type="hidden" value="<?=$n_incomptabilise?>" name="n_incomptabilise" />
	  <input type="hidden" value="<?=$horaire?>" name="ex_horaire" />
  <table width="550" border="0" cellspacing="1" cellpadding="0" align="center" id="lien_msj">
  <tr>
  <td width="510"></td>
<td align="center">
	<a href="#"  onclick="document.retour.submit();">
	<div class="back">
	</div>retour</a>
	</td>
	</tr>
	<tr><td colspan="2" headers="3px"></td></tr>
	</table>
<table width="550" border="0" cellspacing="0" cellpadding="0"  style="text-align:left; margin-top:15px; margin-left:25px">
  <tr>
    <td class="bold" width="150px">&nbsp;Titre du cours : </td>
    <td width="400px">
	<?=trim($libele)?></td>
  </tr>
   <tr>
    <td colspan="2" height="4px"></td>
  </tr>
  <tr>
    <td class="bold">&nbsp;Nom et pr&eacute;nom : </td>
    <td><?=trim($name)?></td>
  </tr>
  <tr>
    <td colspan="2" height="4px"></td>
  </tr>
  <tr>
    <td class="bold">&nbsp;Date d'absence: </td>
    <td><?=$date?></td>
  </tr>
  <tr>
    <td colspan="2" height="4px"></td>
  </tr>
  <tr>
    <td class="bold">&nbsp;Horaire : </td>
    <td><?=$horaire?></td>
  </tr>
  <tr>
    <td colspan="2" height="4px"></td>
  </tr>
  <tr>
    <td class="bold">&nbsp;Nombre : </td>
    <td><select name="nombre" class="select input">
    <option value="1" <?= $n_comptabilise==1 ? 'selected="selected"' : ''?> >1</option>
    <option value="2" <?= $n_comptabilise==2 ? 'selected="selected"' : ''?>>2</option>
    </select>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" height="4px"></td>
  </tr>
    <tr>
    <td colspan="2" align="right">
	<input type="submit" value="valider" class="bouton" />&nbsp;
	<input type="reset" value="annuler" class="bouton" />&nbsp;	</td>
  </tr>
</table>
</form>

	   <form name="retour" method="post">
	<input type="hidden" value="edit_absence" name="task" />
	<input type="hidden" name="cours" value="<?=$code_cours?>" />
	<input type="hidden" name="boxchecked" value="<?=$code_inscription?>" />
 	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
	 </form>
	 <?php
	 }
	 
	 ?>