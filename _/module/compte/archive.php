
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/compte.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES COMPTES<span class="task">&nbsp;[archive]</span> </td>

	<td width="22%">
	 <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		  <td valign="top" align="center">

		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s�lectionnez un utilisateur??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_compte.php?desarchiver='+chemin;

				     window.location.replace(chemin);

				   }

				   ">

		   <div class="desarchiver"></div>

		   D�sarchiver</a>

		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_compte.php">

		  <div class="retour"></div>Retour</a>

		  </td>

		</tr>

	  </table>
	</td> 
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist">

<form action="#" method="post" name="adminMenu">

<input type="hidden" name="boxchecked" value="0" />

  <tr>

     <th width="42" align="center">#</th>
	 <th width="22"></th>
	 <th  align="center" nowrap="nowrap">Nom</th>
	 <th>Pr�nom</th>
	 <th>E-mail</th>
	 <th>Type de compte</th>
	 <th>Description</th>
  </tr>

  <?php
		$i=0;
		$sql = "SELECT id, nom, prenom, email,  description 
		from tbl_admin 
		where archive=1";
		$req=@mysql_query($sql) or die ("erreur lors de la s�lection des utilisateurs");
 	    while ($row = mysql_fetch_array($req)) {
	    $i++;
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center">
	 <input type="radio" id="<?=$row["id_user"]?>" name="id" value="<?=$row["id_user"];?>" 
	 onClick="document.adminMenu.boxchecked.value=<?=$row["id_user"]?>" /></td>
	 <td align="center">&nbsp;<?=$row["nom"]?></td>
	 <td align="center">&nbsp;<?=$row["prenom"]?></td>
	 <td align="center">&nbsp;<?=$row["email"]?></td>
     <td align="center">&nbsp;<?=$row["type"]?></td>
	 <td align="center">&nbsp;<?=$row["description"]?></td>
  </tr>
<?php
      }	  
?>
</form>
 </table>

