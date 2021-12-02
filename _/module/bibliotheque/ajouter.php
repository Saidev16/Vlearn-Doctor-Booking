<style type="text/css">

input{

width:200px;

}

</style>

<script language="javascript1.2">

function valid_form(){



if ($F('titre')==""){

alert('veuillez taper le titre');

$('titre').focus();

return false;

}



if ($F('nbr_exemplaire')==""){

alert('veuillez taper le nombre d\'exemplaire');

$('nbr_exemplaire').focus();

return false;

}



if ($F('nbr_exemplaire').match(/^[-]?\d*\.?\d*$/) == null){

alert('veuillez taper un nombre !');

$('nbr_exemplaire').focus();

return false;

}



if ($F('categorie_livre')=="0"){

alert('veuillez sélectionner le categorie du livre ');

$('categorie_livre').focus();

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

$titre=$_POST['titre'];

$nbr_exemplaire=$_POST['nbr_exemplaire'];

$categorie_livre=$_POST['categorie_livre'];

$date_insc=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];


$sql="INSERT INTO $tbl_livre(`titre_livre` , `nbr_exemplaire` , `categorie_livre` ,`date_aquisition` )

VALUES ('$titre', '$nbr_exemplaire', '$categorie_livre', '$date_insc');";

       @mysql_query($sql)or die ("erreur lors de l'ajout du livre ");

			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('gestion_bibliotheque.php');

			//-->

			</script>

              <?php

			  }

			  else{

			  ?>

			   



<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/bibliotheque.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES LIVRES <span class="task">[ajouter]</span></td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		  <td valign="top" align="center">

		   <a href="#" onclick="javascript:valid_form();"><div class="save"></div>Ajouter</a>

		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_bibliotheque.php" id="lien_msj" >

		  <div class="cancel"></div>

		  Annuler</a>

		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

 </table>

 <form method="post"  action="gestion_bibliotheque.php?new=oui" name="f_ajout" onsubmit="return valid_form();" >

	  

	       <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">

		  

		  <tr>

		  <td width="25%">Titre : </td>

		  <td width="25%"><input type="text" name="titre" id="titre" class="input" style="width:500px" /></td>

		  <td width="25%"> </td>

		  <td width="25%"></td>

		  </tr>

		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr>

		  <td>Nombre d'exemplaire : </td>

		  <td><select name="nbr_exemplaire" id="nbr_exemplaire">
          <option value="1">1</option>
           <option value="2">2</option>
            <option value="3">3</option>
             <option value="4">4</option>
             </select>
          </td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>

		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr>

		  <td>Catégorie : </td>

		  <td>
          <select name="categorie_livre" id="categorie_livre" class="input" style="width:200px">

  		        <option value="0">Sélectionner</option>
 		  <option value="Management anglophone">Management anglophone</option>
          <option value="Management francophone">Management francophone</option>
          
          <option value="Ressources humaines anglophone">Ressources humaines anglophone</option>
          <option value="Ressources humaines francophone">Ressources humaines francophone</option>
          
          <option value="Comptabilité anglophone ">Comptabilité anglophone</option>
          <option value="Comptabilité francophone ">Comptabilité francophone</option>
         
          <option value="Droit anglophone">Droit anglophone</option>
          <option value="Droit francophone">Droit francophone</option>
          
          <option value="Systeme d 'information anglophone">Systeme d 'information anglophone</option>
          <option value="Systeme d 'information francophone">Systeme d 'information francophone</option>
          
          
          <option value="Finance,Communication et Economie francophone">Finance, Communication et Economie francophone</option>
          <option value="Finance,Communication et Economie anglophone">Finance,Communication et Economie anglophone</option>
          
          <option value="Marketing francophone">Marketing  francophone</option>
          <option value="Marketing anglophone">Marketing  anglophone</option>

		 </select></td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>

          <tr><td colspan="4" height="3px"></td></tr>

		   <tr>

		  <td>Date d'aquisition : </td>

		  <td>
           <select name="year_i" class="input">

		  <?php for ($i=date('Y'); $i>1996; $i--){

		  ?>

		  <option value="<?=$i?>" <?=(date('y')==$i) ? $selected : '' ?>><?=$i?></option>

		  <?php

		  }

		  ?>

		  &nbsp;</select>

		  &nbsp;<select name="month_i" class="input">

		  <?php for ($i=1; $i<13; $i++){

		  ?>

		  <option value="<?=$i?>" <?=(date('m')==$i) ? $selected : '' ?>><?=$i?></option>

		  <?php

		  }

		  ?>

		 </select>

		  &nbsp;<select name="day_i" class="input">

		  <?php for ($i=1; $i<32; $i++){

		  ?>

		  <option value="<?=$i?>" <?=(date('d')==$i) ? $selected : '' ?>><?=$i?></option>

		  <?php

		  }

		  ?>

		  </select>

          </td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>



	  </table>

	  

     </form>



<?php

}



?>