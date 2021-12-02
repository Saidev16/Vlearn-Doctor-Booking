<span id="titre_page">Modifier le syllabus du cours </span>
  <?php
if (isset($_POST['boxchecked'])){
$code_syllabus=$_POST['boxchecked'];
$sql="select code_cours, week, contenu, avancement from  tbl_syllabus   where code_sylabus='$code_syllabus' limit 1";
$req=@mysql_query($sql) or die("erreur lors de la selection des syllabus");
$row=mysql_fetch_assoc($req);
$code_cours=$row['code_cours'];
$ex_week= $row['week'];
$contenu= html_entity_decode(stripslashes($row['contenu']));
$avancement= html_entity_decode(stripslashes($row['avancement']));
?>
 <table width="550" border="0" cellspacing="1" cellpadding="0" align="center" id="lien_msj">
  <tr>
    <td width="550"></td> 
  <td align="center">
	<a href="#"onclick="document.retour.submit();"><div class="back"></div>retour</a>	
  </td>
	</tr>
	<tr><td colspan="2" headers="3px"></td></tr>
	</table>
<form name="adminMenu" action="" method="post" >
	<input type="hidden" value="edit_syllabus" name="action" />
	<input type="hidden" name="boxchecked" value="<?=$code_syllabus?>" />
	<input type="hidden" name="code_cours" value="<?=$code_cours?>" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
<table width="550" border="0" cellspacing="0" cellpadding="0" style="text-align:left">
  <tr>
    <td class="bold">&nbsp;Week :</td>
    <td><input type="text" name="week" value="<?=$ex_week?>" readonly="yes" style="border:#FFFFFF 1px solid; font-family:verdana; font-size:11px" /></td>
  </tr>
  <tr height="2px">
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="bold" valign="top">&nbsp;Contenu : </td>
    <td><textarea cols="" rows="" name="contenu" style="width:375px; height:120px" ><?php echo $contenu?></textarea></td>
  </tr>
  <tr height="2px">
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="bold" valign="top">&nbsp;Etat d'avancement :</td>
    <td><textarea cols="" rows="" name="avancement" style="width:375px; height:200px"><?php echo $avancement?></textarea></td>
  </tr>
  <tr height="2px">
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2" align="right">
	<input type="submit" value="valider" class="bouton" />&nbsp;
	<input type="reset" value="annuler" class="bouton" />&nbsp;</td>
  </tr>
</table>
</form>
<?php
}
?>
<form name="retour" method="post">
	<input type="hidden" value="syllabus" name="task" />
	<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
</form>