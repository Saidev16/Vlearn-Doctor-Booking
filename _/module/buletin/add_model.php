<script language="javascript1.2">

function valid_form(){
    if($F('code_cours') == null){
    alert("Veuillez choisir un cours");
    $('code_cours').focus();
    return false;
}

if($F('semestre')== null){
    alert("Veuillez choisir un semestre ");
    $('semestre').focus();
    return false;
}

else{
document.f_ajout.submit();
return true;
   }
}

</script>

	<?php
  $id_filiere=$_SESSION['id_filiere_buletin'];
	if (isset($_POST['code_cours'])){

	$code_cours=$_POST['code_cours']; 
	$semestre=$_POST['semestre'];
	$id_filiere=$_POST['id_filiere'];
	
	$sql="select count(*) as nombre from $tbl_buletin 
		where code_cours='$code_cours'
		and id_filiere='$id_filiere'
		and semestre='$semestre' ";
		
	$req=@mysql_query($sql);
	$row=mysql_fetch_assoc($req);
	$nombre=$row['nombre'];
		if($nombre==0){
	 
	   $sql1="insert into $tbl_buletin 
	   (`code_cours`, `semestre`, `id_filiere`) 
	   values('$code_cours', '$semestre', '$id_filiere')";
       @mysql_query($sql1)or die ("erreur lors de l'insertion d'un cours dans le modèle");

	 ?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
		     window.location.replace('gestion_des_buletins.php?buletin_model=default');
			//-->
			</script>
              <?php
			  }
			  }
			  else{
			  			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;AJOUTER UN ELEMENT AU MODELE DU BULETIN
	<span class="task">[ajouter]</span></td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:valid_form();"> <div class="save"></div>Valider</a>
		   </td>
		  <td valign="top" align="center">
		<a href="gestion_des_buletins.php?buletin_model=default">
		<div class="cancel"></div>Annuler</a>
		  		  </td>
		</tr>
	  </table>	</td> 
  </tr>
</table>
 <form method="post" action="gestion_des_buletins.php?add_model=oui" name="f_ajout">
 <input type="hidden" name="idEmploiItem" value="<?=$idEmploiItem?>" />
	 <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">
          
		 
	   <tr>
		  <td width="15%" class="gras">Intitul&eacute; du cours : </td>
		  <td colspan="2">
             <select name="code_cours" id="code_cours" style="width:500px" class="input">
			 <option value="">Sélectionner un cours</option>
 		   <?php
 		  $sqlCours="select code_cours, titre from $tbl_cours where archive=0";
 		  $req=mysql_query($sqlCours);
 		  while ($row=mysql_fetch_assoc($req)){
		  $tc=htmlentities(substr($row['titre'],0, 100));
		  $cc=$row['code_cours'];
 		  ?>
		  <option value="<?=$cc?>"><?=$tc?></option>

		 <?php } ?>

		 </select></td>
 		  <td width="25%"></td>
	   </tr>
            <tr><td colspan="4" height="3px"></td>
		 <tr>
		  <td width="15%" class="gras">Semestre : </td>
		  <td colspan="2">
             <select name="semestre" id="semestre" class="input">
			 	 <option value="">Sélectionner un semestre</option>
 		   <?php
 		  $sqlSemestre="select distinct semestre from $tbl_buletin where archive=0 order by semestre";
 		  $req=mysql_query($sqlSemestre);
 		  while ($row=mysql_fetch_assoc($req)){
		  $ns=$row['semestre'];
 		  ?>
		  <option value="<?=$ns?>"><?=$ns?></option>
		 <?php 
		 }
		 ?>
		 </select></td>
 		  <td width="25%"></td>
	   </tr> 
 		<tr><td colspan="4" height="3px"></td>
		 <tr>
		  <td width="15%" class="gras">Filière : </td>
		  <td colspan="2">
             <select name="id_filiere" id="id_filiere" class="input">
			 	 <option value="">Sélectionner une filière</option>
 		   <?php
 		  $sqlFiliere="select distinct id_filiere, nom_filiere from $tbl_filiere where archive=0";
 		  $req=mysql_query($sqlFiliere);
 		  while ($row=mysql_fetch_assoc($req)){
		   $cf=$row['id_filiere'];
		   $nf=$row['nom_filiere'];
 		  ?>
		  <option value="<?=$cf?>" <?=($id_filiere==$cf)  ? $selected : ''?>><?=$nf?></option>
		 <?php 
		 } 
		 ?>
		 </select></td>
 		  <td width="25%"></td>
	   </tr> 
	  </table>
</form>
<?php
}
?>