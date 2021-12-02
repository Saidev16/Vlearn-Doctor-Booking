<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES FILIERES <span class="task">[archive]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  </td>
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez s�lectionnez un titre??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestionCleEmploi.php?desarchiver='+chemin;
				     window.location.replace(chemin);
				   }
				   ">
		  <div class="desarchiver"></div>D�sarchiver</a>
		  
		  </td>
		 <td valign="top" align="center">
		 
		   <a href="gestionCleEmploi.php"><div class="retour"></div>Retour</a>
		  
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<table width="1000" align="center" cellspacing="1"  class="adminlist">
  <tr>
     <th width="25" align="center">#</th>
	 <th width="25"></th>
	 <th width="25" align="center" nowrap="nowrap">Code</th>
	 <th align="center" width="250px">Titre</th>
	 <th>&nbsp;</th>
  </tr>
  <?php
 $sql="select * from tbl_cle_emploi where archive=1";
 $i=0;
$req=@mysql_query($sql) or die ("erreur lors de la selection des titre");
 	  while ($ligne = mysql_fetch_array($req)) {
	   $i++;
?>
<tr>
         <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ligne["idCleEmploi"]?>" name="id" value="<?=$ligne["idCleEmploi"]?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["id_filiere"];?>" /></td>
	 <td align="center"><?=$ligne["idCleEmploi"];?></td>
	 <td align="left">&nbsp;<?=$ligne["titre"];?></td>
	 <td>&nbsp;</td>
  </tr>
<?php
      } 
	   
?>
 </table>
 
</form>
 
