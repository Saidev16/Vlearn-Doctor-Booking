<?php
$publish="<img src=\"images/unpublish_f2.png\"  border=\"0\" width=\"16\" height=\"16\"  />";
$unpublish="<img src=\"images/cancel_f2.png\" border=\"0\" width=\"16\" height=\"16\" />";
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/inscription.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DU MENU <span class="task">[archive]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un menu??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_menu.php?desarchiver='+chemin;
				     window.location.replace(chemin);
				   }
				   ">
		   <div class="desarchiver"></div>Désarchiver</a>
		   
		  </td>
		 <td valign="top" align="center">
		 
		   <a href="gestion_menu.php"><div class="retour"></div>Retour</a> 
		  
		   
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
<table width="100%" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
  <tr>
     <th width="25" align="center">#</th>
	 <th width="25"></th>
	 <th width="450" align="center" nowrap="nowrap">Titre du menu</th>
	 <th width="100" align="center" >Publié</th>
   </tr>
  <?php
  $type = $_SESSION['type_menu'];
	    
 	  	   $sql="select * from $tbl_menu where archive= 1 order by ordre";
 	                
         $i=0;
       $req=@mysql_query($sql) or die ("erreur lors de la sélection du menu archivé");
 	   while ($ligne = mysql_fetch_array($req)) {
	   $i++;
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ligne["id"]?>" name="id" value="<?=$ligne["id"]?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["id"];?>" /></td>
	 <td align="left"><?=$ligne["titre"]?></td>
	 <td align="center"><a href="gestion_menu.php?action=<?=$ligne["publie"]?>&pid=<?=$ligne["id"]?>&ptype=<?=$type?>">
	 <?=($ligne["publie"]== 0) ? $publish : $unpublish ?></a></td>
     </tr>
<?php
      }
?>
</form> 
</table>