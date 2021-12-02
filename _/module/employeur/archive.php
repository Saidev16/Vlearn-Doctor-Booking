<?php
       $where=$nom=$type_emp='';
	      if((isset($_POST['search_par_nom'])) && (!empty($_POST['search_par_nom'])) ){
 	        $search = $_POST['search_par_nom'];
	             $where ="  and nom like '%".$search."%'";
	                                                                                  }

	    

	                                                                

	   else if((isset($_POST['tous'])) && (!empty($_POST['tous']))){
	   $where=$nom=$type_emp='';
	   unset($_SESSION['nom']);
	   unset($_SESSION['type_emp']);
 	   }

	   else{
                   //type_emp comme critère
				  if( (isset($_POST['type_emp'])) && ($_POST['type_emp']!='') ){
 					 $type_emp = $_POST['type_emp'];
					 $_SESSION['type_emp'] = $type_emp;
  	                $where = $where." and type_emp='". $type_emp."'";
					                                                        	   }



						 else if( (isset($_POST['type_emp'])) && ($_POST['type_emp']!='') ){
   	                      unset($_SESSION['type_emp']);
  						                                                          }



				else if( (isset($_SESSION['type_emp'])) && (!empty($_SESSION['type_emp'])) ){
 						   $type_emp = $_SESSION['type_emp'];
   	                       $where = $where." and type_emp='". $type_emp."'";
  						                                                   }
				              
		}

		                 $sql="SELECT * FROM $tbl_employeur 
						       where archive = 1 ".$where."  ORDER BY nom ";
		 

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES EMPLOYEURS<span class="task">[archive]</span> </td>

	<td width="22%">

	   <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
 		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un employeur??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_employeur.php?desarchiver='+chemin;
				     window.location.replace(chemin);
				   }
				   "
		   ><div class="desarchiver"></div>
		   Désarchiver</a>
		  
		  </td>
		 <td valign="top" align="center">
		   <a href="gestion_employeur.php" >
		  <div class="retour"></div>Retour</a>
		  </td>
		</tr>
	  </table>

	</td> 

  </tr>

</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
      <div class="container_search">
          Nom: <input type="text" name="search_par_nom" class="input" />
		  <select name="type_emp" class="search"  >
		     <option value="">Type d'employeur</option>
			 <option value="0" <?=($type_emp==0) ? $selected : '' ?>>Employeur</option>
			 <option value="1" <?=($type_emp==1) ? $selected : ''?>>Employeur potentiel</option>
		  </select>
		  <input type="submit" value="valider" name="valider" class="input"  />&nbsp;
		  <input type="submit" value="afficher tous" name="tous" class="input"  />&nbsp;
     </div>
  <tr>
     <th width="25" align="center">#</th>
	 <th>&nbsp;</th>
  	 <th>Nom</th>
     <th>Prenom</th>
     <th>Tél</th>
	 <th>E-mail</th>
	 <th>Adresse</th>
     <th>commentaire</th>
  </tr>
     <?php
     $i=0;
     $total = @mysql_query($sql) or die($sql);
	 $url = $_SERVER['PHP_SELF']."?archive=oui&limit=";
     $nblignes = mysql_num_rows($total);
	 $parpage=25;
     $nbpages = ceil($nblignes/$parpage);
     $result = validlimit($nblignes,$parpage,$sql);
     $req=@mysql_query($sql) or die ("erreur lors de la selection des employeurs");
 	 while ($ligne = mysql_fetch_array($result)) {
     $i++;
	 $id=$ligne['idEmployeur'];
     ?>
  <tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$id?>" name="id" value="<?=$id?>" onClick="document.adminMenu.boxchecked.value=<?=$id?>" /></td>
 	 <td align="left">&nbsp;<?=$ligne["nom"];?></td>
     <td align="left">&nbsp;<?=$ligne["prenom"];?></td>
     <td align="left">&nbsp;<?=$ligne["tel"];?></td>
     <td align="left">&nbsp;<?=$ligne["email"];?></td>
	 <td align="left">&nbsp;<?=$ligne["adresse"]?></td>
     <td align="left">&nbsp;<?=$ligne["commentaire"];?></td>
   </tr>

      <?php
      } 
      ?>
</form>

  </table>
      <?php
     echo "<div id='pagination' align='center'>";
     echo pagination($url,$parpage,$nblignes,$nbpages);
     echo "</div>";
      ?>