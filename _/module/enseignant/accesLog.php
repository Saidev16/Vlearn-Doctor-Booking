<?php
if (isset($_GET['journal'])){

	 $code_prof=(int)$_GET['journal'];
	 ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/enseignants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Journal d'accès</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer">
		  <div class="imprimer"></div>Imprimer</a>
		  </td>
		 <td align="right">
		 	<a href="gestion_enseignants.php"><div class="retour"></div>retour</a>
		 </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
	 <table width="100%" border="0" cellspacing="2" cellpadding="0" align="left" class="adminlist">
	 <tr>
    <th>Date et heure d'acc&egrave;s</th>
	<th>Adresse ip d'acc&egrave;s</th>
  </tr>
	 <?php
	 $sql="select date, ip from $tbl_log where id_user='$code_prof' order by date desc";
	 $req=@mysql_query($sql) or die ("erreur lors de la sélection du journal");
	 while($row=mysql_fetch_assoc($req)){
	 ?>
 

  <tr>
    <td align="center"><?=$row['date']?></td>
    <td align="center"><?=$row['ip']?></td>
  </tr>
   <?php
   }
   }
  ?>
</table>