<script language="javascript1.2">
//delete
function valider_delete(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez s�lectionner un absence ');
return false;
}
else{
document.adminMenu.action.value='delete_absence';
document.adminMenu.submit();
return true; 
}
}
//edit
function valider_edit(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez s�lectionner un absence ');
return false;
}
else{
document.adminMenu.action.value='edit_absence';
document.adminMenu.submit();
return true; 
}
}
</script>
<span id="titre_page">Editer les absences</span>
<table width="550" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-bottom:5px">
<tr><td>
<table width="150" border="0" cellspacing="0" cellpadding="0" align="right" id="lien_msj">
  <tr>
  	 <td valign="top" align="center" width="50px">
		   <a href="#" id="lien_msj" onclick="return valider_delete()" title="supprimer un absence">
		  <div class="cancel"></div>Supprimer</a>
	 </td>
     <td valign="top" align="center" width="50px">
		   <a href="#" id="lien_msj" onclick="return valider_edit()" title="editer absence">
		  <div class="edit"></div>Editer</a>
	</td>
    <td align="center" width="50px">
	<a href="#" onclick="document.retour.submit();" id="lien_msj" title="retour">
	<div class="back"></div>Retour
	</a>
	</td>
  <td width="5px"></td>
  </tr>
</table>
</td></tr>
</table>
<?php
if (isset($_POST['boxchecked'])){
$code_cours=$_POST['cours'];
$code_inscription=$_POST['boxchecked'];
 $sql="select a.idAbsence, a.date, h.nom_horaire, a.n_comptabilise 
 from $tbl_absence as a, $tbl_horaire as h
 where a.code_cours='$code_cours'
 and a.code_inscription='$code_inscription' 
 and a.n_comptabilise>0 
 and a.idHoraire=h.code_horaire
 order by a.date desc";
$req=@mysql_query($sql) or die ('erreur lors de la selection des absences');
$total=mysql_num_rows($req);
?>
<form action="#" method="post" name="adminMenu">
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="cours" value="<?=$code_cours?>" />
		<input type="hidden" name="action" value="" />
 <table width="550" border="0" cellspacing="1" cellpadding="0" style="border:#333333 1px solid">
  <tr class="entete" align="center">
    <td width="12px">#</td>
    <td width="180">Date d'absence </td>
    <td width="180">Horaire d'absence </td>
    <td width="180">Nombre d'absence </td>
  </tr>
   <tr><td colspan="4" bgcolor="#333333" height="1px"></td></tr>
   <?php
   $i=0;
   while($row = mysql_fetch_assoc($req)){
   $i+=$row['n_comptabilise'];
   $ia=$row['idAbsence'];
   ?>
  <tr align="center">
   <td> <input type="radio" id="<?=$ia?>" name="id" value="<?=$ia?>" 
   onClick="document.adminMenu.boxchecked.value='<?=$ia?>'" /></td>
   <td>&nbsp;<?=$row['date']?></td>
   <td>&nbsp;<?=$row['nom_horaire']?></td>
   <td>&nbsp;<?=$row['n_comptabilise']?></td>
  </tr>
  <tr><td colspan="4" bgcolor="#333333" height="1px"></td></tr>
  <?php
  }
  ?>
  <tr><td colspan="4" class="footer_table">Nombre d'absence :<?=$i?> </td></tr>
</table>
</form>
<form name="retour" method="post">
<input type="hidden" value="absence" name="task" />
<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
 <input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
</form>
<?php
}
 ?>
