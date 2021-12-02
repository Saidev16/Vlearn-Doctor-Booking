 <style type="text/css">
input{
width:300px;
}
</style>
<script language="javascript1.2">
function valid_form(){

if ($F('titre')==""){
alert('veuillez taper le titre');
$('titre').focus();
return false;
}

else {
document.f_ajout.submit();
return true;
}
}
</script>
<?php
if (isset($_POST['titre'])){
$titre=addslashes($_POST['titre']);
$prix=(int)$_POST['prix'];

$sql="INSERT INTO tbl_type_cours(`titre`, `prix`) VALUES ('$titre', '$prix');";
@mysql_query($sql)or die ("Erreur lors de l'ajout du type de cours");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_type_cours.php');
			//-->
			</script>
              <?php
			  }
			   
			  ?>
			   

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Ajout d'un type de cours</td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center"><a href="#"  onclick="javascript:valid_form();"><div class="save"></div>Valider</a></td>
		  <td valign="top" align="center"><a href="gestion_type_cours.php"><div class="cancel"></div>Annuler</a></td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
 <form method="post"  action="gestion_type_cours.php?new=oui" name="f_ajout" onsubmit="return valid_form();" >
	 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" style="margin-left:10px" class="cellule_table">
		  
		  <tr>
		  <td width="25%">Titre  : </td>
		  <td width="25%"><input type="text" name="titre" id="titre" class="input" /></td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
          <tr>
		  <td width="25%">Prix  : </td>
		  <td width="25%"><input type="text" name="prix" id="prix" class="input" /></td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		
	  </table>
	  
     </form>