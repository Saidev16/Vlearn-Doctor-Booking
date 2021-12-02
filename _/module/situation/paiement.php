       <?php
 if( isset($_GET['code_inscription'])){
     $code_inscription=$_GET['code_inscription'];
     $sql="select concat(nom, '' , prenom) as name, annee, filiere from tbl_etudiant where code_inscription='$code_inscription' limit 1";
     $req=@mysql_query($sql);
     $row= mysql_fetch_assoc($req);
     $nom=$row['name'];
     $annee=$row['annee'];
     $filiere=$row['filiere'];
 ?>


<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DES SITUATIONS FINANCIERES
     <span style="font-size:11px; padding-left:90px; width:100%; height:15px; display:block">Nom :<?=$name?></span>
 	 <span style="font-size:11px; padding-left:90px; width:100%; height:15px; display:block">Filière :<?=$filiere?></span>
     <span style="font-size:11px; padding-left:90px; width:100%; height:15px; display:block">Année :<?=$annee?></span>
     </td>
	<td width="22%">
	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" >
	    <tr>
		  <td valign="top" align="center" >
		  <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un étudiant ??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_situation.php?modifier='+chemin;
				     window.location.replace(chemin);
				   }
				   "
		    id="lien_msj">
		  <div style="background:top url(images/modifier.gif); width:32; height:34;"></div>
	      Modifier</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_situation.php" id="lien_msj">
		   <div style="background:top url(images/retour.gif); width:32; height:34;"></div>
		   Retour</a>
		  </td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
 

<table width="999px" align="center" cellspacing="1" border="0"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
  <tr style="text-align:center">
     <th>#</th>
	 <th></th>
	 <th>Année academique</th>
	 <th>Session</th>
     <th>Montant</th>
	 <th>Date paiement</th>
	 <th>Type de paiement</th>
	 <th>Numero de chèque</th>
	 <th>Banque</th>
	 <th>Date retirement</th>
  </tr>
  <?php
  
    
      $i=0;
	 
	  $sql1 = "SELECT  * from tbl_paiement where  code_inscription = $code_inscription ";
	 
      $req = mysql_query($sql1) or die ("erreur lors de la sélection des paiements ");
	 
 	  while ($ligne = mysql_fetch_array($req)) {
	  
	  $i++;
	   ?>
<tr style="vertical-align:top; text-align:center">
     <td><?=$i?></td>
	 <td><input type="radio" id="<?=$ligne["code_inscription"]?>" name="id" value="<?=$ligne["code_inscription"]?>" 
	 onClick="document.adminMenu.boxchecked.value=<?=$ligne["code_inscription"]?>" /></td>
	 <td align="left"><?=$ligne["annee_academique"]?></td>
	 <td>&nbsp;<?=($ligne["session"])?></td>
     <td>&nbsp;<?=($ligne["montant"])?></td>
	 <td>&nbsp;<?=$ligne['date_paiement']?></td>
	 <td>&nbsp;<?=$ligne['type_paiement']?></td>
	 <td>&nbsp;<?=$ligne['numero_cheque']?></td>
	 <td>&nbsp;<?=$ligne['banque']?></td>
	 <td>&nbsp;<?=$ligne['date_retirement']?></td>
  </tr>
<?php
      }
?>
</form>
 </table>
 <?php
 }
 ?>