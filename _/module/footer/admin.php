<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DU PIEDS DE PAGE </td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<td width="60%"></td>
		
		 		  <td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un element ??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_footer.php?apercu='+chemin;
				     window.location.replace(chemin);
				   }
				   " >
		   
		  <div class="apercu"></div>Aperçu</a>
	      
		  </td>
		 		  <td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un element ??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_footer.php?modifier='+chemin;
				     window.location.replace(chemin);
				   }
				   " >
		   
		  <div class="modifier"></div>Modifier</a>
	    
		  </td>
		</tr>
	  </table>
	</td> 
</table>
<table width="100%" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
  <tr>
     <th width="15" align="center">#</th>
	 <th width="15"></th>
	 <th width="75" align="center" nowrap="nowrap">Type</th>
	 <th width="75" align="center" >Auteur</th>
	 <th width="75" align="center" >Fonction</th> 
	 <th width="75" align="center" >Visa</th>
	 <th width="100" align="center" >date</th>
	 <th width="75" align="center">Auteur </th>
	 <th width="75" align="center">Fonction </th>
     <th width="75" align="center">Visa </th>
	 <th width="100" align="center" >date</th>
	 <th width="75" align="center">Auteur </th>
	 <th width="75" align="center">Fonction </th>
	 <th width="75" align="center">Visa </th>
	 <th width="100" align="center" >date</th>
  </tr>
  <?php
   // begin function
  function val($var){
  if(!empty($var)){
  echo htmlentities($var);
  }
  else {
  echo '-';
  }
  }
    // end function 
$i=0;
$sql = "SELECT * from $tbl_footer";
$req=@mysql_query($sql) or die ("erreur lors de la selection des livres");
 	  while ($ligne = mysql_fetch_array($req)) {
	   $i++;
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ligne["id_footer"];?>" name="id" value="<?=$ligne["id_footer"];?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["id_footer"];?>" /></td>
	 <td align="center"><?=htmlentities(stripslashes($ligne["type"]))?></td>
	 <td align="center"><?=htmlentities($ligne["auteur1"])?></td>
	 <td align="center"><?=htmlentities($ligne["fonction1"])?></td>
	 <td align="center"><?=val($ligne["visa1"])?></td>
	 <td align="center"><?=htmlentities($ligne["date1"])?></td>
	 <td align="center"><?=htmlentities($ligne["auteur2"])?></td>
	 <td align="center"><?=htmlentities($ligne["fonction2"])?></td>
	 <td align="center"><?=val($ligne["visa2"])?></td>
	 <td align="center"><?=$ligne["date2"]?></td>
	 <td align="center"><?=htmlentities($ligne["auteur3"])?></td>
     <td align="center"><?=htmlentities($ligne["fonction3"])?></td>
	 <td align="center"><?=val($ligne["visa3"])?></td>
	 <td align="center"><?=htmlentities($ligne["date3"])?></td>
  </tr>
<?php
      }?>
 </form>
</table>