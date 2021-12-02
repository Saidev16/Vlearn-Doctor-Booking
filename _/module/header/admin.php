<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DES ENTETES DE PAGE </td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<td width="40"></td>
		 <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un element ??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_header.php?apercu='+chemin;
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
					 chemin='gestion_header.php?modifier='+chemin;
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
     <th width="25" align="center">#</th>
	 <th width="25"></th>
	 <th width="100" align="center" nowrap="nowrap">Type</th>
	 <th width="75" align="center" >sous logo</th>
	 <th width="300" align="center">Titre </th>
	 <th width="100" align="center">FOR ESM </th>
	 <th width="100" align="center">Version</th>
	 <th width="100" align="center">Page </th>
	 <th width="100" align="center">Logo</th>
  </tr>
  <?php
		$i=0;
		$sql = "SELECT * FROM $tbl_header";
		$req=@mysql_query($sql) or die ("erreur lors de la selection des header".$sql);
 	    while ($ligne = mysql_fetch_array($req)) {
	    $i++;
		$ih=$ligne["id_header"];
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ih?>" name="id" value="<?=$ih?>" 
	 onClick="document.adminMenu.boxchecked.value=<?=$ih?>" /></td>
	 <td align="center">&nbsp;<?=htmlentities($ligne["type"])?></td>
	 <td align="center">&nbsp;<?=htmlentities($ligne["sous_logo"])?></td>
	 <td align="center">&nbsp;<?=htmlentities($ligne["titre"])?></td>
	 <td align="center">&nbsp;<?=htmlentities($ligne["for_esm"])?></td>
	 <td align="center">&nbsp;<?=htmlentities($ligne["version"])?></td>
	 <td align="center">&nbsp;<?=htmlentities($ligne["page"])?></td>
	 <td align="center"><img src="../images/logo/<?=htmlentities($ligne["logo"])?>" width="70" height="30" /></td>
	  </tr>
<?php
      }?>
	  </form>
 </table>
