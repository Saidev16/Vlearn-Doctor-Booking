<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION D'ACTUALITE </td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestion_actualite.php?new=oui"><div class="ajouter"></div>Nouveau</a>
		  
		  </td>
		  <td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez s�lectionnez une actualit� ??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_actualite.php?modifier='+chemin;
				     window.location.replace(chemin);
				   }
				   " >
		    
		  <div class="modifier"></div>Modifier</a>
	      
		  </td>
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez s�lectionnez une actualit�??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_actualite.php?archiver='+chemin;
				     window.location.replace(chemin);
				   }
				   ">
		   <div class="delete"></div>Supprimer</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
<table width="100%" align="center" cellspacing="1" border="0"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
  <tr style="text-align:center">
     <th width="15">#</th>
	 <th width="15"></th>
	 <th width="75">Date</th>
	 <th width="100">Titre</th>
	 <th width="75">Groupe</th>
     <th>Contenu</th>
  </tr>
  <?php
  	     $i=0;
		  $sql = "SELECT * FROM tbl_actualite order by date desc"; 
		 $total = @mysql_query($sql) or die("erreur lors de s�lection des �tudiants"); 
		 $url = $_SERVER['PHP_SELF']."?limit=";
		 $nblignes = mysql_num_rows($total);
		 $parpage=10;
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);
		 while ($row = mysql_fetch_array($result)) {
		 $i++;
	     $ca=$row["id_actualite"];
?>
<tr style="vertical-align:top; text-align:justify">
     <td><?=$i?></td>
	 <td><input type="radio" id="<?=$ca?>" name="id" value="<?=$ca?>" onClick="document.adminMenu.boxchecked.value=<?=$ca?>" /></td>
	 <td>&nbsp;<?=htmlentities($row["date"])?></td>
	 <td>&nbsp;<?=htmlentities(stripslashes($row["titre"]))?></td>
	 <td>&nbsp;<?=htmlentities($row["type"])?></td>
     <td>&nbsp;<?=html_entity_decode(stripslashes($row["contenu"]))?></td>
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

