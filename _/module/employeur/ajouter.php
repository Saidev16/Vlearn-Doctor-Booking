 <style type="text/css">

input{

width:300px;

}

</style>

<script language="javascript1.2">

function valid_form(){



if ($F('nom')==""){

alert('veuillez taper le nom ');

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
$prenom=$_POST['prenom'];
$email=$_POST['email'];
$tel=$_POST['tel'];
$type_emp=$_POST['type_emp'];
$adresse=$_POST['adresse'];
$commentaire=addslashes($_POST['commentaire']);

$sql="INSERT INTO $tbl_employeur
( `nom` , `prenom`, `adresse`, `tel`, `email`, `type_emp`, `commentaire` )
VALUES ('$nom' , '$prenom', '$adresse', '$tel', '$email', '$type_emp', '$commentaire');";

                @mysql_query($sql)or die ("erreur lors de l'ajout de cet employeur ");
			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('gestion_employeur.php');

			//-->

			</script>

              <?php

			  }

			  else{

			  ?>


<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;Ajout  d' un employeur </td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" 
		   onclick="javascript:valid_form();"><div class="ajouter"></div>Ajouter</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_employeur.php"><div class="cancel"></div>  Annuler</a>
		  </td>
		</tr>
	  </table>

	</td> 

  </tr>

 </table>

 <form method="post"  action="gestion_employeur.php?new=oui" name="f_ajout">

	 

	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		  <tr>
    		  <td width="25%">Nom : </td>
    		  <td width="25%"><input type="text" name="nom" id="nom" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
          <tr>
              <td height="5px"></td>
          </tr>
          <tr>
    		  <td width="25%">Prénom : </td>
    		  <td width="25%"><input type="text" name="prenom" id="prenom" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
		  <tr>
              <td height="5px"></td>
          </tr>
           <tr>

    		  <td width="25%">Adresse : </td>

    		  <td width="25%">
			  <input type="text" name="adresse" id="adresse" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
          <tr>
              <td height="5px"></td>
          </tr>
          <tr>
    		  <td width="25%">Téléphone : </td>
    		  <td width="25%"><input type="text" name="tel" id="tel" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
		  <tr>
              <td height="5px"></td>
          </tr>
          <tr>
    		  <td width="25%">Email : </td>
    		  <td width="25%"><input type="text" name="email" id="email" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
          <tr>
              <td height="5px"></td>
          </tr>
          <tr>

    		  <td width="25%" valign="top">Type : </td>

    		  <td width="25%">
				  <select name="type_emp" class="input">
					  <option value="0">Employeur</option>
					  <option value="1">Employeur potentiel</option>
				  </select>
			  </td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
            <tr>
              <td height="5px"></td>
          </tr>
            <tr>
    		  <td width="25%" valign="top">Commentaire : </td>
    		  <td width="25%">
			  <textarea style="width:300px; height:60px;" name="commentaire" ></textarea></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
          <tr>
              <td height="5px"></td>
          </tr>
	  </table>
     </form>
<?php
}
?>