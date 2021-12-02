<script language="javascript1.2">
function valider_form(){
if($F('pass')==""){
alert("veuiller taper votre mot de passe");
$('pass').focus;
return false;
}

if($F('pass1')==""){
alert("veuiller retaper votre  mot de passe");
$('pass1').focus;
return false;
}

if($F('pass') != $F('pass1')){
alert("les deux mot de passe ne sont pas identique");
$('pass1').focus;
return false;
}

else{
document.inscription.submit();
return true;
}

}
</script>
<span id="titre_page">Change Password </span>
<form name="inscription"  action="professeur.php" method="post" onsubmit="return valider_form();">
<table width="575" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:10px; text-align:left">

					   <tr><td colspan="3" height="3px"></td></tr>
  <tr>
    <td align="left" class="bold" width="150px">Username :</td>
	<td>&nbsp;</td>
    <td>&nbsp;<?=$_SESSION['prof_login']?></td>
	</tr>
  </tr>
   <tr><td colspan="3" height="3px"></td></tr>
  <tr>
    <td align="left" class="bold">Password : </td>
    <td>&nbsp;</td>
    <td>
	<input type="password" name="pass" id="pass"  class="input" size="35" maxlength="15"/>
	</td>
  </tr>
   <tr><td colspan="3" height="3px"></td></tr>
  <tr>
    <td align="left" class="bold">Retype the password : </td>
    <td>&nbsp;</td>
    <td>
	<input type="password" name="pass1" id="pass1" class="input" size="35" maxlength="15"/>
	</td>
  </tr>
   <tr><td colspan="3" height="3px"></td></tr>
  <tr>
    <td colspan="3" align="right" style="padding-right:150px">
	<input type="submit" value="Submit" class="bouton"/>&nbsp;&nbsp;
	<input type="reset" value="Cancel" class="bouton" />&nbsp;&nbsp;</td>
	<input type="hidden" name="action" value="change_pass" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
  </tr>
</table>
</form>