<span id="titre_page">Request</span>
<div id="contenu"><br />
<table width="575s" border="0" cellspacing="0" cellpadding="0" id="tbl_demande">
<form name="demande" action="student.php" method="post" >
<input type="hidden" name="code" value="<?=$code_etudiant?>" />
<input type="hidden" name="action" value="requette">
<input type="hidden" name="token" value="<?=$_SESSION['token']?>">

  <tr>
    <td colspan="4" style="text-align:justify; padding-top:5px">
	To address effectively your requests for certain administrative services, and to monitor them, please fill out this form before sending it to the administration. Thank you.
	<hr align="center" />
	 </td>
  </tr>
  <tr>
    <td colspan="4" align="left"><b>Date</b> :
    <input type="text" name="date" value="<?=date('Y-m-d')?>"  readonly="yes" style="border:#FFFFFF 1px solid; font-size:11px" />
	<b>Name :</b><input type="text" name="nom" value="<?=$_SESSION['name']?>"  readonly="yes" style="border:#FFFFFF 1px solid; font-size:11px" />
   </td>
  </tr>
   <tr>
    <td align="left" colspan="4"><hr align="center" /><b>Subject :</b><br /></td>
  </tr>
   <tr>
    <td align="left" colspan="4"><input type="radio" name="objet" id="absence" value="Absence" />Absence</td>
  </tr>
  <tr>
    <td align="left" colspan="4"><input type="radio" name="objet" value="Conflict/Grade" />Conflict/Grade</td>
  </tr>
   <tr>
    <td align="left" colspan="4"><input type="radio" name="objet" value="IT Technical Problem " />IT Technical Problem  </td>
  </tr>
  <td align="left" colspan="4"> 
	<input type="radio" name="objet" value="Social Services" />Social Services    </td></tr>
	<tr>
    <td align="left" colspan="4"> 
	<input type="radio" name="objet" value="Covid-19 Impact" />Covid-19 Impact </td></tr>
 
 <!-- <tr>
    <td align="left" colspan="4"><input type="radio" name="autre" id="objet" value="" />Autres, spécifier SVP&nbsp;
	<input type="text" name="autre" id="autre" size="50"  class="input"/> </td>
  </tr>-->
  <tr>
	  <td colspan="4" align="left" style="padding-bottom:10px">
	  <hr align="center" />
	 Detailed explanation of your request / complaint (You can attach an additional sheet to this if necessary):
	 </td>
</tr>
<tr>
  <td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px">
  <tr>
    <td align="left"><textarea cols="60" rows="3" name="explication" class="text_area"></textarea></td>
  </tr>
</table>

  </td></tr>
 	<tr height="15"><td colspan="4" align="right">
	<input type="submit" value="Submit" class="bouton"  />&nbsp;
	<input type="reset" value="Cancel"  class="bouton" />
	&nbsp;</td></tr>
</form>
</table>