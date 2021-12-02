<link rel="stylesheet" type="text/css" href="css/layout.css">
<style type="text/css">
input{
width:200px;
}
</style>
<script language="javascript1.2">
function valid_form(){
if ($F('date_lim')==""){
alert('veuillez taper la date');
$('date_lim').focus();
return false;
}
if ($F('titre')==""){
alert('veuillez taper le titre');
$('titre').focus();
return false;
}
if ($F('contenu')==""){
alert('veuillez taper le contenu');
$('contenu').focus();
return false;
}
else {
document.f_ajout.submit();
return true;
}
}
</script>
<?php
if (isset($_POST['date_lim'])){
$date=$_POST['date_lim'];
$titre=addslashes($_POST['titre']);
$contenu=addslashes($_POST['contenu']);

											$sql="INSERT INTO `$tbl_actualite` ( `code_actualite` , `titre` , `contenu` , `date` )
VALUES (
'', '$titre', '$contenu', '$date'
);";

                                            @mysql_query($sql)or die ("erreur lors de l'ajout de l'actualité ");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_actualite.php');
			//-->
			</script>
              <?php
			  }
			  else{
			  ?>
			   

<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" style="font-size:20px; font-weight:bold">Ajout  d' une actualit&eacute; </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" >
	    <tr>
		 
		  <td valign="top" align="center">
		   <a href="#" 
		   onclick="javascript:valid_form();" id="lien_msj">
		   <div style="background:top url(images/save.png); width:32; height:34;"></div>
		   Ajouter</a>		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_actualite.php"  id="lien_msj">
		  <div style="background:top url(images/annule.png); width:32; height:34;"></div>
		  Annuler</a>		  </td>
		</tr>
	  </table>	</td> 
  </tr>
 <!-- <tr height="30">
     <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="3" bgcolor="#9fa0a3" height="1px"></td>
  </tr>-->
</table>
 <form method="post" ENCTYPE="multipart/form-data" action="gestion_actualite.php?new=oui" name="f_ajout" onsubmit="return valid_form();" >
	  <table border="0" width="1000" cellpadding="0" cellspacing="0" align="center">
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="600">
	       <table border="0" cellpadding="0" cellspacing="0" width="70%" style="margin-left:10px">
		  
		  <tr>
		  <td>Date : </td>
		  <td> </td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		   <tr>
		  <td>Titre : </td>
		  <td><input type="text" name="titre" id="titre" style="width:420px" /></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td>
		  </tr>
		   <tr>
		  <td valign="top">Contenu : </td>
		  <td><textarea cols="50" rows="6" name="contenu" id="contenu"></textarea></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		   
		  </table>
	     </td>
		
		</tr>  
	  </table>
</form>

<?php
}

?>