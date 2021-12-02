 <style type="text/css">
input{
width:300px;
}
</style>
<script language="javascript1.2">
function valid_form(){

if ($F('session')==""){
alert('veuillez taper le nom de la session');
$('session').focus();
return false;
}

else {
document.f_ajout.submit();
return true;
}
}
</script>
<?php
if (isset($_POST['session'])){
$session=addslashes($_POST['session']);
$ac=addslashes($_POST['annee_academique']);
$ay=addslashes($_POST['academic_year']);

$sql="INSERT INTO $tbl_session( `session`, `annee_academique`, `academic_year`) VALUES ('$session', '$ac', '$ay');";
@mysql_query($sql)or die ("Erreur lors de l'ajout de la session");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_session.php');
			//-->
			</script>
              <?php
			  }
			   
			  ?>
			   

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">Ajout d'une session</td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center"><a href="#"  onclick="javascript:valid_form();"><div class="save"></div>Valider</a></td>
		  <td valign="top" align="center"><a href="gestion_session.php"><div class="cancel"></div>Annuler</a></td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
 <form method="post"  action="gestion_session.php?new=oui" name="f_ajout" onsubmit="return valid_form();" >
	 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" style="margin-left:10px" class="cellule_table">
		  
		  <tr>
		  <td width="25%">Session  : </td>
		  <td width="25%"><input type="text" name="session" id="session" class="input" /></td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
          <tr>
		  <td width="25%">Année  : </td>
		  <td width="25%"><input type="text" name="annee_academique" id="annee_academique" class="input" /></td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
          <tr>
		  <td width="25%">Ann&eacute;e acad&eacute;mique  : </td>
		  <td width="25%"><input type="text" name="academic_year" id="academic_year" class="input" /></td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		
	  </table>
	  
     </form>