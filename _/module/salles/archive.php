<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES SALLES <span class="task">[archive]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  </td>
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez une salle ??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_salles.php?desarchiver='+chemin;
				     window.location.replace(chemin);
				   }
				   ">
		 <div class="desarchiver"></div> Désarchiver</a>
		  </td>
		 <td valign="top" align="center">
		   <a href="gestion_salles.php"><div class="retour"></div>Retour</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<table width="100%" align="center" cellspacing="1"  class="adminlist">
  <tr>
     <th width="25" align="center">#</th>
	 <th width="25"></th>
	 <th width="25" align="center" nowrap="nowrap">Code</th>
	 <th align="center" width="250px">Nom de la salle</th>
	 <th>&nbsp;</th>
  </tr>
  <?php
 $sql="select * from $tbl_salle where archive=1";
 $i=0;
$req=@mysql_query($sql) or die ("erreur lors de la selection des salles");
 	  while ($ligne = mysql_fetch_array($req)) {
	   $i++;
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ligne["code_salle"]?>" name="id" value="<?=$ligne["code_salle"]?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["code_salle"];?>" /></td>
	 <td align="center"><?=$ligne["code_salle"];?></td>
	 <td align="center"><?=$ligne["nom_salle"];?></td>
	 <td>&nbsp;</td>
  </tr>
<?php
      } 
	   
?>
 </table>
 
</form>
 
