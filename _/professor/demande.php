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
<span id="titre_page" >Request</span>
<form name="demande" action="professeur.php" method="post" enctype="multipart/form-data">
<table width="575" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" ><p style="text-align:justify">
To address effectively your requests for certain administrative services, and to monitor them, please fill out this form before sending it to the administration. Thank you.</p>
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
	<td class="bold">Name :</td>
	<td  style="font-size:11px">
	<input type="text" name="nom" value="<?=$name?>"  readonly="yes" size="30" style="border:#FFFFFF 1px solid; font-size:11px" />
   </td>
  </tr>
</table>
   </td>
  </tr>
   <tr>
    <td align="left" colspan="4" class="bold"><hr align="center" />Subject :<br /></td>
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
    <td align="left" colspan="3">Schedule </td>
  </tr>

  <tr>
  <td width="10px"><input type="radio" name="objet" id="objet" value="Attestation de travail" /></td>
    <td align="left" colspan="3">Certificate</td>       
  </tr>
  <tr>
  <td width="10px"><input type="radio" name="objet" id="autre" value="autre" /></td>
    <td align="left" colspan="4">Other, specify please&nbsp;
	<input type="text" name="autre"  size="50" class="input" onfocus="document.getElementById('autre').checked=true"/> </td>
  </tr>
  <!--<tr>
     <td colspan="4" class="bold" align="left"><hr align="center" />Joindre un fichier :</td>
  </tr>	
  <tr>
     <td height="3px" colspan="4"></td>
  </tr>
  <tr>
    <td>Fichier &nbsp;</td>
    <td align="left" colspan="4">
	&nbsp;<input type="file" name="fichier" style="height:20px" size="40"  /> </td>
  </tr>-->
  </table>
  <tr><td colspan="4" align="left">
  <hr align="center" />
 <p style="text-align:justify; padding-bottom:10px; padding-top:0px; margin-top:0px"> Detailed explanation of your request / complaint (You can attach an additional sheet to this if necessary):</p>
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
	<input type="submit" name="valider" value="submit" class="bouton"  />
	&nbsp;<input type="reset" value="Cancel" class="bouton"/>&nbsp;
	<input type="hidden" name="action" value="add_request" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
	</td></tr>
</table>
</form>
<?php
}
?>