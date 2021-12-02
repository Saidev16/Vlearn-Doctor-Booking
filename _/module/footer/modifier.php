<script language="javascript1.2">
function valid_form(){
document.f_ajout.submit();
}
</script>
<?php
if(isset($_POST['auteur1'])){
$auteur1=addslashes($_POST['auteur1']);
$auteur2=addslashes($_POST['auteur2']);
$auteur3=addslashes($_POST['auteur3']);
$fonction1=addslashes($_POST['fonction1']);
$fonction2=addslashes($_POST['fonction2']);
$fonction3=addslashes($_POST['fonction3']);
$visa1=addslashes($_POST['visa1']);
$visa2=addslashes($_POST['visa2']);
$visa3=addslashes($_POST['visa3']);
$id=$_POST['id'];
$sql1="UPDATE $tbl_footer SET 
`auteur1` = '$auteur1',
`auteur2` = '$auteur2',
`auteur3` = '$auteur3',
`fonction1` = '$fonction1',
`fonction2` = '$fonction2',
`fonction3` = '$fonction3',
`visa1` = '$visa1',
`visa2` = '$visa2',
`visa3` = '$visa3'
 WHERE  `id_footer`='$id' ";

$req1=mysql_query($sql1) or die("erreur lors de la mise à jour du footer");
?>
<script language="javascript1.2">
window.location.replace("gestion_footer.php");
 </script>
<?php
}
			  else{
			 // $id=$_POST['id'];
			  $id=$_GET["modifier"];
			  $sql2="select * from $tbl_footer where  id_footer='$id'";
			  $req2=@mysql_query($sql2) or die("erreur dans la requette");
			  $row=mysql_fetch_assoc($req2);
			  ?>
			   

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DU PIEDS DE PAGE <span class="task">[modifier]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 
		  <td valign="top" align="center">
		   <a href="#"  onclick="javascript:valid_form();"><div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_footer.php"><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
 <form method="post"  action="gestion_footer.php?modifier=oui" name="f_ajout" >
 <input type="hidden" name="id" value="<?=$id?>" />
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:verdana; font-size:11px; margin-top:10px">
  <tr>
    <td>Auteur:</td>
    <td><input type="text" name="auteur1" value="<?=$row['auteur1']?>" class="input" /></td>
    <td>Auteur:</td>
    <td><input type="text" name="auteur2" value="<?=$row['auteur2']?>" class="input" /></td>
    <td>Auteur:</td>
    <td><input type="text" name="auteur3" value="<?=$row['auteur3']?>" class="input" /></td>
  </tr>
   <tr><td height="5px" colspan="6"></td></tr>
  <tr>
    <td>Fonction:</td>
    <td><input type="text" name="fonction1" value="<?=$row['fonction1']?>" class="input" /></td>
    <td>Fonction:</td>
    <td><input type="text" name="fonction2" value="<?=$row['fonction2']?>" class="input" /></td>
    <td>Fonction:</td>
    <td><input type="text" name="fonction3" value="<?=$row['fonction3']?>" class="input" /></td>
  </tr>
   <tr><td height="5px" colspan="6"></td></tr>
  <tr>
    <td>Visa:</td>
    <td><input type="text" name="visa1" value="<?=$row['visa1']?>" class="input" /></td>
    <td>Visa:</td>
    <td><input type="text" name="visa2" value="<?=$row['visa2']?>" class="input" /></td>
    <td>Visa:</td>
    <td><input type="text" name="visa3" value="<?=$row['visa3']?>" class="input" /></td>
  </tr>
  <tr><td height="5px" colspan="6"></td></tr>
  <tr>
    <td>Date:</td>
    <td><input type="text" name="date1" value="<?=date('Y/m/d')?>" class="input" /></td>
    <td>Date:</td>
    <td><input type="text" name="date2" value="<?=date('Y/m/d')?>" class="input" /></td>
    <td>Date:</td>
    <td><input type="text" name="date3" value="<?=date('Y/m/d')?>"  class="input"/></td>
  </tr>
</table>

</form>

<?php
}?>
