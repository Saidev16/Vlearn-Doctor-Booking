<?php
         
		if( (isset($_GET['code_cours'])) && (!empty($_GET['code_cours'])) ){
		  $code_cours=$_SESSION['cours']=trim($_GET['code_cours']); 
 		  $idSession=(int)$_SESSION['NidSession'];
 											 
                     
		  $sql1="select session, annee_academique 
				from $tbl_session where idSession=$idSession limit 1";
				
				
		$req=@mysql_query($sql1) ;
		$row=mysql_fetch_assoc($req);
 		$session = $row['session'];
		$annee = $row['annee_academique'];
  
					//get cours title
					
					$sql2="select titre from tbl_cours  where code_cours='$code_cours' limit 1";
				
 					$req=@mysql_query($sql2) or die("no");
					$row=mysql_fetch_assoc($req);
					$titre=substr(stripslashes($row['titre']), 0, 65);
 					
					//get professor
					/*
					$sql2="select nom_prenom 
					from   $tbl_professeur as p, $tbl_seance as s 
					where s.code_cours='$code_cours'
 					and s.idSession=$idSession
					and p.code_prof=s.code_prof limit 1";
 						 
					$req=@mysql_query($sql2) or die ("erreur lors de la sélection du prof");
					$row=mysql_fetch_assoc($req);
 					$nom=$row['nom_prenom'];
					*/
	?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/horraires.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Listing Registration  
		<span class="sub_title">Course Title :<?=$titre?></span>
	  
		<span class="sub_title">Session : <?=$session.'  '.$annee?></span>
	</td>

	<td width="22%">
	  <table border="0" align="right" width="15%" cellpadding="10" cellspacing="2" id="link" >
	    <tr>
		<!--<td valign="top" align="center"><a href="gestion_inscription_burkina.php?new=oui">
		  <div class="ajouter"></div>Nouveau</a>
		  </td>
		  <td valign="top" align="center">
		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un étudiant ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_inscription_burkina.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   "  >

		 
		  <div class="modifier"></div>Modifier</a>
		  </td> -->
          <td valign="top" align="center">
		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un étudiant ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_inscription_burkina.php?supprimer='+chemin;

				     window.location.replace(chemin);

				   }

				   "  >

		
		  <div class="delete"></div>Supprimer</a>
		  </td>
		 <td valign="top" align="center"><a href="gestion_inscription_usa.php">
		  <div class="retour"></div>Back</a>
		  </td>
		</tr>
	  </table>
	</td> 

</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist" >

<form action="#" method="post" name="adminMenu">

<input type="hidden" name="boxchecked" value="0" />

  <tr>
     <th width="15">#</th>
	 <th width="15"></th>
	 <th width="740">Name</th>
	 <th width="175" align="center">Registration Date</th>
   </tr>

  <?php
   $i=0;
   $sql="select e.code_inscription, concat(e.nom,' ', e.prenom) as name, 
   		  i.id, i.date_inscription 
	      from tbl_inscription_cours_burkina as i, tbl_etudiant_burkina as e, $tbl_cours as c
		   where  
		 i.code_cours='$code_cours' 
		 and i.code_inscription=e.code_inscription 
		 and i.code_cours= c.code_cours
		 and i.idSession=$idSession 
		 and i.archive=0 
		
		 order by name";
		 $res=@mysql_query($sql) or die ("erreur lors de la sélection des cours");
 		 while ($row = mysql_fetch_array($res)) {
		 $i++;
		 $cn=$row["code_inscription"];
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center" width="25px">
	  <input type="radio" id="<?=$cn?>" name="id" value="<?=$cn?>" onClick="document.adminMenu.boxchecked.value='<?=$cn?>'" /></td> 
	 <td align="left"><a href="gestion_inscription_usa.php?code_inscription=<?=$cn?>">&nbsp;<?=ucfirst($row["name"])?></a></td>
	 <td align="left"><?=$row["date_inscription"]?></td>
   </tr>
<?php
      }
?>
<!--<tr><td colspan="5"><b>Nombre d'inscrits : <?=$i?></b></td></tr>-->
</form>
 </table>
<?php
}
?>