<?php

    $code_cours=$where='';

    $code_inscription = addslashes($_GET['code_inscription']);
    $idSession = (int)$_GET['code_inscription'];
	$sql3="select nom, prenom, nom_filiere 
	from $tbl_etudiant as e, $tbl_filiere as f 
	where code_inscription='$code_inscription' 
	and e.filiere=f.id_filiere limit 1";

	$req=mysql_query($sql3) or ("erreur lors de la selection du nom etudiant");

	$row=mysql_fetch_assoc($req);

	$nom=$row['prenom'].' '.$row['nom'];

	$filiere=$row['nom_filiere'];
	
	if( (isset($_POST['idSession'])) && (!empty($_POST['idSession'])) ){
	
	         $idSession = $_SESSION['idSession'] = $_POST['idSession'];
			 
								}
								
	elseif( (isset($_GET['idSession'])) && (!empty($_GET['idSession'])) ){
	
	         $idSession = $_SESSION['idSession'] = (int)$_GET['idSession'];
			 
								}
	 

    if( (isset($_POST['code_cours'])) && (!empty($_POST['code_cours']))  ){

	  $code_cours=$_POST['code_cours'];
	
	   $sql="SELECT c.titre_eng, a.*, h.nom_horaire 
	 
	 FROM  $tbl_cours as c, $tbl_absence as a, $tbl_horaire as h
	 
	 where h.code_horaire=a.idHoraire

	 and a.code_inscription='$code_inscription'

	 and a.code_cours=c.code_cours

	 and a.idSession='$idSession'
	 
	 and a.code_cours='$code_cours'

	 and a.n_comptabilise!= 0 order by a.date desc"; 

	     }

	 else{

     $sql="SELECT c.titre_eng, a.*, h.nom_horaire 
	 
	 FROM  $tbl_cours as c, $tbl_absence as a, $tbl_horaire as h
	 
	 where h.code_horaire=a.idHoraire

	 and a.code_inscription='$code_inscription'

	 and a.code_cours=c.code_cours

	 and a.idSession='$idSession'

	 and a.n_comptabilise!= 0 order by a.date desc"; 
	  }

  

?>   

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/absence.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES ABSENCES 

	<span class="sub_title">Nom et prénom :<?=$nom?></span>

	<span class="sub_title">Filière :<?=$filiere?></span>

	</td>

	<td width="22%">

	  <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 <!-- <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un absence ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_absences.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }"><div class="modifier"></div> Modifier</a>

				   		  
  		  </td>-->
		   <td valign="top" align="center" >
		   <a href="gestion_absences.php?new=oui&registration_code=<?php echo $code_inscription ?>&idSession=<?php echo $idSession?>"><div class="ajouter"></div> Ajouter</a>
		  </td>
		   <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un absence ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_absences.php?supprimer='+chemin;

				     window.location.replace(chemin);

				   }"><div class="supprimer"></div> Supprimer</a>

				   		  
  		  </td>
 		  <td valign="top" align="center" >
			<a href="#" onclick="window.print()"><div class="imprimer"></div>Imprimer</a>	     
		  </td>

		  <td valign="top" align="center" >
		   <a href="gestion_absences.php"><div class="retour"></div> Retour</a>
		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist" style="padding-top:2px">

<form action="#" method="post" name="adminMenu">

<input type="hidden" name="boxchecked" value="0" />

<div class="container_search">
 
 <select name="idSession" class="search">

 <option value="0">SESSION</option>

 <?php 

     $annee="select idSession, session, annee_academique 
	 from $tbl_session
	 where idSession in (select distinct idSession 
	 from $tbl_absence
	 where code_inscription='$code_inscription'
	 and n_comptabilise!=0)";

	 $req=mysql_query($annee) or die("erreur lors de la selection des sessions");

	 while ($row=mysql_fetch_assoc($req)){
	 $is=$row['idSession'];
	 $ns=$row['session'].' '.$row['annee_academique'];
	 ?>
	 <option value="<?=$is?>" <?=($idSession==$is) ? $selected : '' ?>><?=$ns?></option>
	 <?php
	 }
	 ?>
 </select>
 <select name="code_cours" class="search" style="width:450px;" >
 <option value="0">TITRE DU COURS</option>
 <?php 
     $query="select distinct a.code_cours, c.titre_eng 
	 from $tbl_cours as c, $tbl_absence as a
	 where  c.code_cours=a.code_cours 
	 and a.code_inscription='$code_inscription'
	 and a.idSession='$idSession' 
	 and a.n_comptabilise!=0  
	 order by c.titre_eng  ";
	 $tuple=mysql_query($query) or die("erreur lors de la sélection des cours");

	 while ($row=mysql_fetch_assoc($tuple)){
	 $cc=$row['code_cours'];
	 $tc=stripslashes($row['titre_eng']);
	 ?>
	 <option  value="<?=$cc?>" <?=($code_cours==$cc) ? $selected : '' ?>><?=$tc?></option>
	 <?php
	 }
	 ?>
 </select>
 <input type="submit" value="valider" class="input" />
 </div>
  <tr>
     <th width="15">#</th>
 	 <th width="15"></th>
 	 <th width="75">Code</th>
 	 <th width="450">Intitulé du cours</th>
 	 <th width="75">Date</th>
 	 <th width="75">Horaire</th>
 	 <th width="75">Comptabilisé</th>
 	 <th width="75">Incomptabilisé</th>

  </tr>
  <?php
       $i=0;

       $req=@mysql_query($sql) or die ("erreur lors de la sélection des absences".$sql);

 	   while ($ligne = mysql_fetch_assoc($req)) {

	   $i++;
       $ca=$ligne['idAbsence'];
	   $cc=$ligne['code_cours'];
?>
<tr>
     <td>&nbsp;<?=$i?></td>
	 <td width="20px"><input type="radio" id="<?=$ca?>" name="id" value="<?=$ca?>" 
	 onClick="document.adminMenu.boxchecked.value=<?=$ca?>" /></td>
 	  <td><a href="gestion_absences.php?code_cours=<?=$cc?>&idSession=<?=$idSession?>" id="lien_msj"><?=$cc?></a></td>
	 <td><?=ucfirst(stripslashes($ligne["titre_eng"]))?></td>
	 <td><?=$ligne["date"]?></td>
	 <td align="center">&nbsp;<?=$ligne["nom_horaire"]?></td>
	 <td align="center"><?=$ligne["n_comptabilise"]?></td>
	 <td align="center"><?=$ligne["n_incomptabilise"]?></td>
  </tr>
<?php
      }
?>
</form> 
   </table>
