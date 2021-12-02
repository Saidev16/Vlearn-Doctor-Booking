<?php
       $where=$nom=$matiere=$diplome='';

	      if((isset($_POST['search_par_nom'])) && (!empty($_POST['search_par_nom'])) ){

 	   $search = $_POST['search_par_nom'];

	   $where ="  and nom like '%".$search."%'";

	                                                                }

	    if((isset($_POST['search_par_diplome'])) && (!empty($_POST['search_par_diplome'])) ){

 	   $search = $_POST['search_par_diplome'];

	   $where ="  and diplome like '%".$search."%'";

	                                                                }

	   else if((isset($_POST['tous'])) && (!empty($_POST['tous']))){

	   $where=$nom=$matiere=$diplome='';

	   unset($_SESSION['nom']);

	   unset($_SESSION['matiere']);

	   unset($_SESSION['diplome']);


	   }

	   else{

                   //matiere comme critère



				  if( (isset($_POST['matiere'])) && (!empty($_POST['matiere'])) ){

 					 $matiere = $_POST['matiere'];

					 $_SESSION['matiere'] = $matiere;

  	                $where = $where." and matiere='". $matiere."'";

					                                                        }



						 else if( (isset($_POST['matiere'])) && (empty($_POST['matiere'])) ){

  	                      unset($_SESSION['matiere']);

 						                                                          }



							else if( (isset($_SESSION['matiere'])) && (!empty($_SESSION['matiere'])) ){

							  $matiere = $_SESSION['matiere'];

  	                       $where = $where." and matiere='". $_SESSION['matiere']."'";

 						                                                   }
				              
									 }

		                 $sql="SELECT * FROM tbl_cv where archive = 0 ".$where."  ORDER BY nom ";
		 

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES CV </td>

	<td width="22%">

	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 <td valign="top" align="center">

		   <a href="gestion_cv.php?new=oui">

		  <div class="ajouter"></div>Nouveau</a>

		  </td>

		  <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un cv dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_cv.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   "  >

		   

		  <div class="modifier"></div>

	      Modifier</a>

		  </td>

		  <td valign="top" align="center">

		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un cv dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_cv.php?archiver='+chemin;

				     window.location.replace(chemin);

				   }

				   ">

		   <div class="supprimer"></div>Supprimer</a>

		   

		  </td>

		 

		   <td valign="top" align="center" >

		  <a href="#" onclick="window.print()"  id="lien_msj" title="Imprimer">

		  <div class="imprimer"></div>Imprimer</a>

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



 <select name="matiere" class="search"  >

<option value="0">&nbsp;Matière</option>

 <?php
     $matiere='0';
	 
     $sql2="select distinct matiere  from tbl_cv where archive= 0 and matiere!='' ";

	 $req2=@mysql_query($sql2) or die("erreur lors de la sélection des matières");

	 while ($row = mysql_fetch_assoc($req2)){

	 ?>

	 <option value="<?=$row['matiere']?>" <?=($matiere==$row['matiere']) ? $selected : '' ?>><?=htmlentities($row['matiere'])?></option>

 <?php

 }

 ?>

 </select>

          Diplôme: <input type="text" name="search_par_diplome" class="input" size="40" />

  
		  <input type="submit" value="valider" name="valider" class="input"  />&nbsp;

		  <input type="submit" value="afficher tous" name="tous" class="input"  />&nbsp;

 </div>

  <tr>

     <th width="25" align="center">#</th>

	 <th width="25"></th>
  	 <th>Nom</th>
     <th>Email</th>
     <th>Tél</th>
	 <th>Diplômes</th>
     <th>commentaire</th>

  </tr>

  <?php

     

     $i=0;

     $total = @mysql_query($sql) or die($sql);

	 $url = $_SERVER['PHP_SELF']."?limit=";

     $nblignes = mysql_num_rows($total);

	 $parpage=25;

     $nbpages = ceil($nblignes/$parpage);

     $result = validlimit($nblignes,$parpage,$sql);

     $req=@mysql_query($sql) or die ("erreur lors de la selection des cv");

 	 while ($ligne = mysql_fetch_array($result)) {

     $i++;

?>

<tr>

     <td align="center"><?=$i?></td>

	 <td align="center"><input type="radio" id="<?=$ligne["id"]?>" name="id" value="<?=$ligne["id"]?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["id"];?>" /></td>

 	 <td align="left">&nbsp;<?=$ligne["nom"];?></td>
     <td align="left">&nbsp;<?=$ligne["email"];?></td>
     <td align="left">&nbsp;<?=$ligne["tel"];?></td>
     <td align="left">&nbsp;<?=$ligne["diplome"];?></td>
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