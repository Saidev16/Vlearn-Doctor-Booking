<span id="titre_page">Sondage</span>
<div id="contenu"><br>
<?php
if (isset($_SESSION['code_etudiant'])){
$code_etudiant=$_SESSION['code_etudiant'];
$sql="select code_inscription from $tbl_sondage where code_inscription='$code_etudiant' ";
$req=mysql_query($sql);
if($req){
?>
<script language="javascript1.2">
alert("vous avez déja participé dans ce sondage");
window.location.replace("student.php?task=info");
</script>
<?php
}
else{
?>
<form name="sondage" action="student.php" method="post">
<input type="hidden" name="code" value="<?=$code_etudiant?>" />
<input type="hidden" name="action" value="sondage">
<input type="hidden" name="token" value="<?=$_SESSION['token']?>">
<table width="565" border="0" cellspacing="0" cellpadding="0" id="tbl_demande" style="text-align:left">
    </tr>
   <tr>
   <td width="10px" align="center"><img src="images/motif.jpg" /></td>
    <td align="left" colspan="3" class="gras">
	Par quel intermédiaire vous avez connu PIIMT ?</td>
  </tr>
   <tr><td height="5px" colspan="4"></td></tr>
   <tr >
    <td  width="10px"><input type="radio" name="objet" value="Amis(e)/Famille" id="ami" /></td>
	<td colspan="3">&nbsp;<label for="ami">Amis(e)/Famille</label></td>
	</tr>
  <tr>
    <td  width="10px"><input type="radio" name="objet" value="Bouche à oreille" id="bouche" /></td>
	<td colspan="3">&nbsp;<label for="bouche">Bouche à oreille</label></td>
  </tr>
  <tr>
    <td  width="10px"><input type="radio" name="objet" value="website" id="web" /></td>
	<td colspan="3">&nbsp;<label for="web">website</label>  </td>
  </tr>
  <tr>
   <td  width="10px"><input type="radio" name="objet" value="forum" id="forum" /></td>
	<td colspan="3">&nbsp;<label for="forum">forum </label>  </td>
  </tr>
  <tr>
    <td  width="10px"><input type="radio" name="objet" value="visite de PIIMT"  id="visite"/></td>
	<td colspan="3">&nbsp;<label for="visite">visite de PIIMT</label></td>
	</tr>
	<tr>
	<td  width="10px"><input type="radio" name="objet"  value="supports publicitaires" id="pub" /></td>
	<td colspan="3">&nbsp;<label for="pub">supports publicitaires </label> 
	</td>  </tr>
	   <tr>
    <td  width="10px"><input type="radio" name="autre" id="objet" /></td>
	<td colspan="3">&nbsp;<label for="autre">Autres, veuillez spécifier&nbsp;</label>
	<input type="text" name="autre" id="autre" size="50" onblur="chebox();" class="input"/> </td>
  </tr>
   <tr><td height="5px" colspan="4"></td></tr>
  <tr>
  <td width="10px" align="center"><img src="images/motif.jpg" /></td>
    <td align="left" colspan="3" class="gras">
		Quel serait votre conseil pour faire connaître PIIMT plus ?</td>
  </tr>
   <tr><td height="5px" colspan="4"></td></tr>
    <tr>
    <td align="left" colspan="4">
	<input type="text" name="conseil" id="conseil" size="50" class="input" /> </td>
  </tr>
    <tr><td height="5px" colspan="4"></td></tr>
  <tr>
  <td width="10px" align="center"><img src="images/motif.jpg" /></td>
    <td align="left" colspan="3" class="gras">
	Pourquoi vous avez choisi PIIMT ?</td>
  </tr>
    <tr><td height="5px" colspan="4"></td></tr>
  <tr>
    <td align="left" colspan="4">
	<input type="text" name="choix" id="choix" size="50" class="input" /> </td>
  </tr>
   <tr height="15"><td colspan="4" align="right">
   <input type="submit" value="envoyer" class="bouton"  />&nbsp;
	<input type="reset" value="annuler" class="bouton"  />
	&nbsp;</td></tr>
</table>
</form>
<?php
}
}
?>