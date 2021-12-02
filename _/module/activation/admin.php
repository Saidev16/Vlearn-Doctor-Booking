<?php
			$where='';
						if((isset($_POST['search_par_code'])) && (!empty($_POST['search_par_code'])) ){
						   $Csearch = addslashes(trim($_POST['search_par_code']));
						   $where ="  and ci.code_cours like '".$Csearch."%'";
																									}
			
						if((isset($_POST['search_par_titre'])) && (!empty($_POST['search_par_titre'])) ){
						   $Csearch = trim($_POST['search_par_titre']);
						   $where ="  and c.titre like '".$Csearch."%'";
																									}
																									
						if(isset($_POST['idSession'])){
						$idSession=$_SESSION['AidSession']=$_POST['idSession'];
						$where.= "and  ci.idSession='".$idSession."'";
						}
						
						else if( (isset($_SESSION['AidSession'])) && ($_SESSION['AidSession']!='') ){
						$idSession=$_SESSION['AidSession'];
						$where.= "and  ci.idSession='".$idSession."'";
						}
						
						else{
						$where.= "and  ci.idSession='".$idSession."'";
						}
						
						$sql="SELECT ci.id, ci.code_cours, c.titre, ci.dateActivation
							 FROM $tbl_cours as c, $tbl_cours_inscription as ci 
							 where c.code_cours=ci.code_cours ". $where . " ORDER BY c.titre ";
							 
							  

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES COURS<span class="task">&nbsp;[inscription]</span></td>
	<td width="22%">
	<!--top menu-->
	  <table border="0" align="right" width="100%" cellpadding="0" cellspacing="12" id="link" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="activation_cours.php?ajouter=oui"><div class="ajouter"></div>Nouveau</a>
		  </td>
		  <td valign="top" align="center" >
		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionnez un cours ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='activation_cours.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   " 

		   title="modifier un cours"><div class="modifier"></div>Modifier</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionnez un cours??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='activation_cours.php?supprimer='+chemin;

				     window.location.replace(chemin);

				   }

				   " title="archiver un cours"><div class="supprimer"></div>Supprimer</a>

		  </td>
		   <td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer"><div class="imprimer"></div>Imprimer</a>
		  </td>
		</tr>

	  </table>
	</td> 
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist" style="margin-top:2px">

<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<div class="container_search">
		 <select name="idSession" class="search" >
 			   <?php
			   $sql_credit="select idSession, session, annee_academique from $tbl_session group by idSession";
			   $req=@mysql_query($sql_credit);
			   while($row=mysql_fetch_assoc($req)){
			   $ids=$row['idSession'];
			   $ss=ucfirst($row['session']).' '.$row['annee_academique'];
			   ?>
			   <option value="<?=$ids?>" <?=($idSession==$ids) ? $selected : '' ?>><?=$ss?></option>
			<?php
			}
			?>
 		</select>
		  <input type="text" class="input" name="search_par_code" size="15" />&nbsp;
		  <input type="text" class="input" name="search_par_titre" size="35" />&nbsp;
		  <input type="submit" value="valider" name="valider" class="input"  />&nbsp;
 </div>

  <tr>
     <th width="15" align="center">#</th>
	 <th width="10">&nbsp;</th>
	 <th width="75" align="center" nowrap="nowrap">Code</th>
	 <th width="650" align="center" >Intitul&eacute; du cours</th>
	 <th>Date d'activation</th>
  </tr>

  <?php
     $i=0;
     $req = @mysql_query($sql) or die("erreur lors de la s&eacute;lectiob des cours"); 
 	 while ($ligne = mysql_fetch_array($req)) {
	 $i++;
	 $cc=htmlentities($ligne["code_cours"]);
	 $id=$ligne['id'];
?>

    <tr>
       <td align="center"><?=$i?></td>
 	   <td align="center"><input type="radio" id="<?=$id?>"  name="id" value="<?=$id?>" 
	   onClick="document.adminMenu.boxchecked.value='<?=$id?>'" /></td>
       <td align="left" style="font-weight:bold">&nbsp;<?=$cc?></td>
 	   <td align="left">&nbsp;<?=trim(stripslashes($ligne["titre"]))?></td>
	    <td align="left">&nbsp;<?=trim(stripslashes($ligne["dateActivation"]))?></td>
  </tr>
      <?php
      }
      ?>
</form> 
</table>
