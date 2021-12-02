 <style type="text/css">
input{
width:300px;
}
</style>
<script language="javascript1.2">
function valid_form(){

if ($F('nom')==""){
alert('veuillez taper le titre du jour');
$('nom').focus();
return false;
}

else {
document.f_ajout.submit();
return true;
}
}
</script>
<?php
if (isset($_POST['nom'])){
$nom=$_POST['nom'];
$id=(int)$_POST['id'];
			$sql="UPDATE  $tbl_salle SET `nom_salle`='$nom' where code_salle=$id ";
               @mysql_query($sql)or die ("erreur lors de l'ajout de jours ");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_salles.php');
			//-->
			</script>
              <?php
			  }
			  else{
			   $id=$_GET["modifier"];
			  $sql2="select * from $tbl_salle where code_salle=$id";
			  $req2=@mysql_query($sql2) or die("erreur dans la sélection des salles");
			  $row=mysql_fetch_assoc($req2);
			  ?>
			   

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">Modification d' une salle </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" 
		   onclick="javascript:valid_form();">
		   <div class="save"></div>
		   Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_salles.php" >
		  <div class="cancel"></div>
		  Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
 <form method="post" action="gestion_salles.php?modifier=oui" name="f_ajout" onsubmit="return valid_form();" >
 <input type="hidden" value="<?=$row['code_salle'];?>" name="id" />
	 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" style="margin-left:10px" class="cellule_table">
		  
		  <tr>
		  <td width="25%">Titre du jour : </td>
		  <td width="25%">
	<input type="text" name="nom" id="nom" class="input" value="<?=htmlspecialchars($row['nom_salle']); ?>" />
	</td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		
	  </table>
	  
     </form>

<?php
}

?>