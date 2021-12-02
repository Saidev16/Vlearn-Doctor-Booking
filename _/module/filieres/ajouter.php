<script language="javascript1.2">
function valid_form(){

if ($F('nom')==""){
$('er_nom').update('veuillez taper le nom de la filière');
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



		$sql="INSERT INTO $tbl_filiere( `id_filiere` , `nom_filiere`  ) VALUES (NULL , '$nom');";


                    @mysql_query($sql)or die ("erreur lors de l'ajout de la filiere ");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_filieres.php');
			//-->
			</script>
              <?php
			  }
			  else{
			  ?>
			   

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">Ajout  d' une fili&egrave;re </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" 
		   onclick="javascript:valid_form();" id="lien_msj">
		   <div class="save"></div> Ajouter</a>
		  
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_filieres.php">  <div class="cancel"></div>Annuler</a>
		
		  
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
 <form method="post"  action="gestion_filieres.php?new=oui" name="f_ajout" >
	 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		  
		  <tr>
		  <td width="15%">Nom de la filière : </td>
		  <td width="35%"><input type="text" name="nom" id="nom" class="input" style="width:350px" /></td>
		  <td width="35%"><div id="er_nom" class="erreur"></div></td>
		  <td></td>
		  </tr>
		
	  </table>
	  
     </form>

<?php
}

?>