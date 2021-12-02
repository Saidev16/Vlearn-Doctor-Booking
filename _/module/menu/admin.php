<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/inscription.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Gestionnaire de menus </td>
	<td width="22%">
	<table width="20%" align="right">
	<tr>
	<td width="80%"></td>
	       <td valign="top" align="center">
 		  </td>
		  <td width="4px"></td>
		  </tr>
		  </table>
	</td> 
  </tr>
</table>
<table width="100%" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
  <tr>
     <th width="25">#</th>
 	 <th width="150" align="center" nowrap="nowrap">Nom du Menu</th>
	 <th width="238" align="center" >Eléments du Menu </th>
	 <th width="100" align="center"># Publiés </th>
	 <th width="267" align="center"># Non Publiés </th>
     <th width="239" align="center"># Corbeille </th>
  </tr>
  <?php
     
        $i=0;
	    $sql1="select type, publie, depublie, archive  from $tbl_menu_statistic group by type";
        $req=@mysql_query($sql1) or die ("erreur lors de la sélection du menu");
 	    while ($ligne = mysql_fetch_array($req)) {
	    $i++;
 ?>
<tr style="text-align:center">
     <td><?=$i?></td>
 	 <td class="gras"><?=htmlentities($ligne["type"])?></td>
	 <td><a href="gestion_menu.php?type=<?=htmlentities($ligne["type"])?>">
	 <img src="images/mainmenu.png" width="20" height="17" border="0" title="Editer les élements du menu" /></a></td>
	 <td title="nombre d'élement publié"><?=$ligne["publie"]?></td>
	 <td title="nombre d'élement non publié"><?=$ligne["depublie"]?></td>
	 <td title="nombre d'élement archivé"><?=$ligne['archive']?></td>
  </tr>
<?php
      }
?>
</form> 
</table>
