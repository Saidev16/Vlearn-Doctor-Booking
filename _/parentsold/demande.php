<script language="javascript1.2">
function verif_demande(){
document.demande.submit();
return true;
}
</script>
<?php
$error='';
if (isset($_SESSION['code_prof'])){
$code_prof=$_SESSION['code_prof'];
$name=$_SESSION['name'];
?>
<span id="titre_page" >Demande et r&eacute;clamation </span>
<form name="demande" action="professeur.php" method="post" enctype="multipart/form-data">
<table width="575" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" ><p style="text-align:justify">Pour adresser efficacement vos requêtes et vos demandes de certains services administratifs, et pour assurer leur suivi, veuillez remplir  ce formulaire avant de l'envoyer � l�administration. Merci.</p>
	<hr align="center" />
	 </td>
  </tr>
  <tr height="17px">
    <td colspan="4" align="left">
	<table width="575" border="0" cellspacing="0" cellpadding="0">
   <tr height="17px">
    <td  align="left" class="bold" >Date :</td>
	<td style="font-size:11px">
    <input type="text" name="date" value="<?=date('Y-m-d')?>"  readonly="yes" style="border:#FFFFFF 1px solid; font-size:11px" />
	</td>
	<td class="bold">Nom et pr&eacute;nom :</td>
	<td  style="font-size:11px">
	<input type="text" name="nom" value="<?=$name?>"  readonly="yes" size="30" style="border:#FFFFFF 1px solid; font-size:11px" />
   </td>
  </tr>
</table>
   </td>
  </tr>
   <tr>
    <td align="left" colspan="4" class="bold"><hr align="center" />objet :<br /></td>
  </tr>
   <tr height="3px">
    <td colspan="4"></td>
  </tr>
  <tr><td colspan="4">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
   <td width="10px"><input type="radio" name="objet" id="objet" value="Absence" /></td>
    <td align="left" colspan="3">Absence</td>
  </tr>
  
  <tr>
  <td width="10px"><input type="radio" name="objet" id="objet" value="Emploi du temps" /></td>
    <td align="left" colspan="3">Emploi du temps </td>
  </tr>

  <tr>
  <td width="10px"><input type="radio" name="objet" id="objet" value="Attestation de travail" /></td>
    <td align="left" colspan="3">Attestation de travail</td>       
  </tr>
  <tr>
  <td width="10px"><input type="radio" name="objet" id="autre" value="autre" /></td>
    <td align="left" colspan="4">Autres, sp&eacute;cifier SVP&nbsp;
	<input type="text" name="autre"  size="50" class="input" onfocus="document.getElementById('autre').checked=true"/> </td>
  </tr>
  <tr>
     <td colspan="4" class="bold" align="left"><hr align="center" />Joindre un fichier :</td>
  </tr>	
  <tr>
     <td height="3px" colspan="4"></td>
  </tr>
  <tr>
    <td>Fichier &nbsp;</td>
    <td align="left" colspan="4">
	&nbsp;<input type="file" name="fichier" style="height:20px" size="40"  /> </td>
  </tr>
  </table>
  <tr><td colspan="4" align="left">
  <hr align="center" />
 <p style="text-align:justify; padding-bottom:10px; padding-top:0px; margin-top:0px"> Explication d&eacute;taill&eacute;e de votre demande/r&eacute;clamation 
(Vous pouvez attacher une feuille suppl&eacute;mentaire à celle-ci si n&eacute;cessaire):</p>
</td></tr>
<tr>
  <td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><textarea cols="50" rows="3" name="explication" class="text_area1"></textarea></td>
  </tr>
</table>

  </td></tr>
	<tr height="15px"><td colspan="4" align="right">
	<input type="submit" name="valider" value="valider" class="bouton"  />
	&nbsp;<input type="reset" value="annuler" class="bouton"/>&nbsp;
	<input type="hidden" name="action" value="add_request" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
	</td></tr>
</table>
</form>
<?php
}
?>