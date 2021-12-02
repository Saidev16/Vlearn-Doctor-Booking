<script language="javascript1.2">
function verif_note(){
if (($F('controle1')<0) || ($F('controle1')>100) ){
alert("la note doit être inférieur à 100 et supérieur à 0 ");
$('controle1').focus();
return false;
}
if (($F('controle2')<0) || ($F('controle2')>100) ){
alert("la note doit être inférieur à 100 et supérieur à 0 ");
$('controle2').focus();
return false;
}
if (($F('controle3')<0) || ($F('controle3')>100) ){
alert("la note doit être inférieur à 100 et supérieur à 0 ");
$('controle3').focus();
return false;
}
if (($F('controle4')<0) || ($F('controle4')>100) ){
alert("la note doit être inférieur à 100 et supérieur à 0 ");
$('controle4').focus();
return false;
}
if (($F('controle5')<0) || ($F('controle5')>100) ){
alert("la note doit être inférieur à 100 et supérieur à 0 ");
$('controle5').focus();
return false;
}
if (($F('controle6')<0) || ($F('controle6')>100) ){
alert("la note doit être inférieur à 100 et supérieur à 0 ");
$('controle6').focus();
return false;
}
else {
document.note.submit();
return true;
}
}
</script>
<span id="titre_page">Editer une note</span>
<?php
if (isset($_POST['boxchecked'])){
$code_note=$_POST['boxchecked'];
$sql="select e.code_inscription, e.nom, e.prenom, e.annee, f.nom_filiere, n.code_cours 
from $tbl_etudiant as e, $tbl_note as n, $tbl_filiere as f  
where e.filiere=f.id_filiere
and code_note='$code_note' 
and e.code_inscription=n.code_inscription limit 1 ";
$req=mysql_query($sql) or die("erreur lors de la selection de cet etudiant");
if(mysql_num_rows($req)){
while($row=mysql_fetch_assoc($req)){
$nom=$row['nom'];
$prenom=$row['prenom'];
$annee=$row['annee'];
$filiere=$row['nom_filiere'];
$code_etudiant=$row['code_inscription'];
$code_cours=$row['code_cours'];
}
?>
<table width="550" border="0" cellspacing="1" cellpadding="0" align="center">
  <tr>
  <td width="510"></td>
<td align="center" id="lien_msj">
	<a href='#' onclick="document.retour.submit();">
	<div class="retour"></div>retour</a>
	</td>
	</tr>
	<tr><td colspan="2" headers="3px"></td></tr>
	</table>

<table width="520" border="0" cellspacing="0"  cellpadding="0" style="text-align:left;">
  <tr>
    <td><span class="bold">Nom</span> : <?=ucfirst($nom)?></td>
    <td><span class="bold">Prénom</span> :  <?=ucfirst($prenom)?></td>
  </tr>
  <tr>
    <td><span class="bold">Filière</span>:<?=$filiere?></td>
    <td><span class="bold">Année</span> : <?=$annee?></td>
  </tr>
  </table>
  <?php
  }
   
    $sql1="select *
    from $tbl_note 
    where code_note='$code_note' limit 1 ";  
     
	$req=@mysql_query($sql1) or die("erreur lors de la sélection des notes");
	$row=mysql_fetch_assoc($req);
?>
<table width="575" border="0" cellspacing="2" cellpadding="0"  style="text-align:left; margin-top:15px;">
<form name="note" method="post" action="" onsubmit="return verif_note();">
<input type="hidden" name="id" name="id" value="<?=$row['code_note']?>" />
<tr>
    <td width="175" class="gras">&nbsp;Mid-term : </td>
    <td width="400">
	<input type="text" name="mid_term" id="mid_term" value="<?=$row['mid_term']?>" class="input" size="7"  />
	 </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="150" class="gras">&nbsp;Project : </td>
    <td width="400">
	<input type="text" name="project" id="project" value="<?=$row['project']?>" class="input" size="7" /> 
	</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td class="gras">&nbsp;Participation : </td>
    <td><input type="text" name="participation" id="participation" value="<?=$row['participation']?>" class="input" size="7" />  
    </td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td class="gras">&nbsp;Final Exam : </td>
    <td><input type="text" name="final_exam" id="final_exam" value="<?=$row['final_exam']?>" class="input" size="7"/></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td class="gras">&nbsp;Final grade : </td>
    <td><input type="text" name="final_grade" readonly="readonly" title="Lecture seul" id="final_grade" value="<?=$row['final_grade']?>" class="input" size="7" /> </td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td class="gras">&nbsp;Letter grade : </td>
    <td><input type="text" name="letter_grade" readonly="readonly" title="Lecture seul" id="letter_grade" value="<?=$row['letter_grade']?>" class="input" size="7" /> </td>
    <td>&nbsp;</td>
  </tr>
      <tr>
    <td colspan="3" align="right"><input type="submit" value="valider" class="bouton" />&nbsp;
	<input type="reset" value="annuler" class="bouton" />&nbsp;
	<input type="hidden" name="action" value="update_note" />
	<input type="hidden" name="boxchecked" value="<?=$code_note?>" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
	<input type="hidden" name="code_cours" value="<?=$code_cours?>" />
 	</td>
  </tr>
</form>
</table>
<?php
}
?>
<form name="retour" method="post">
<input type="hidden" value="note" name="task" />
<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
</form>