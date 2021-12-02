<?php
 if(isset($_POST['type'])){
   $type=$_SESSION['type_reg']=$_POST['type'];
   }
   if(isset($_SESSION['type_reg'])){
   $type=$_SESSION['type_reg'];
   }
   else{
   $type='etudiant';
   }
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DU REGLEMENT INTERIEUR</td>
	<td width="22%">
	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link">
	    <tr>
		  <td valign="top" align="center" >
		  <a href="gestion_reglement.php?modifier=oui">
		  <div class="modifier"></div>
	      Modifier</a>
		  </td>
		   <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="imprimer">
		  <div class="imprimer"></div>
	      Imprimer</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 
 <form action="#" method="post" name="adminMenu">
      <div class="container_search">
  		  <select name="type" class="search" style="height:19px">
		  	<option value="etudiant" <?=($type=='etudiant') ? $selected : ''?>>REGLEMENT DES ETUDIANTS</option>
			<option value="professeur" <?=($type=='professeur') ? $selected : ''?>>REGLEMENT DES ENSEIGNANTS</option>
		</select>
	<input type="submit" value="valider" name="valider" class="input" style="height:19px"  />
 	  </div>
 </form>
   <?php
  
		 $sql="select * from $tbl_reglement where type ='$type'";
  
		 $total = @mysql_query($sql) or die("erreur lors de sélection du reglement"); 

		 $url = $_SERVER['PHP_SELF']."?limit=";

		 $nblignes = mysql_num_rows($total);

		 $parpage=1;                           
    
		 $nbpages = ceil($nblignes/$parpage); 
		                    
		 $result = validlimit($nblignes,$parpage,$sql);

		 $ligne = mysql_fetch_array($result); 
  		 
 		  $reglement=html_entity_decode(stripslashes($ligne['reglement']));
		  $_SESSION['id_reg']=$ligne['id'];
  		  
  
			 
			
    	 ?>
  <table width="100%" align="center" cellspacing="1" style="font-size:11px; font-family:verdana; padding:5px;">
  	<tr>
		<td><?=$reglement?></td>
	</tr>
  </table>
  <?php
   			echo "<div id='pagination' align='center'>";
			 echo pagination($url,$parpage,$nblignes,$nbpages);
			 echo "</div>";
			 ?>