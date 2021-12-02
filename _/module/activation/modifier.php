<?php

	if (isset($_POST['id'])){

					$lesgroup='&nbsp;';
					$id=$_POST['id'];
					$groups=$_POST['groupe'];foreach($groups as $group)  $lesgroup.=$group.',';   
					
			$sql="update $tbl_cours_inscription set `groupe` = '$lesgroup' where id='$id' limit 1"; 
							
			@mysql_query($sql)or die ("erreur lors de la mise a jour du cours activé");

								 

 			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('activation_cours.php');
			//-->
			</script>
              <?php
			  }
			  else{
			  $id=(int)$_GET["modifier"];
			  $sql2="select c.titre, ci.id,ci.groupe, s.session, s.annee_academique 
			  from $tbl_cours as c, $tbl_cours_inscription as ci, $tbl_session as s
			  where ci.id='$id' 
			  and c.code_cours=ci.code_cours
			  and s.idSession=ci.idSession limit 1";
			  
			  $req2=@mysql_query($sql2) or die("erreur dans la selection ");
			  $row=mysql_fetch_assoc($req2);
			  $titre=stripslashes(trim($row['titre']));
			  $code_cours=trim($row['code_cours']);
			  $session=$row['session'].' '.$row['annee_academique'];
			  $group=$row['groupe'];

					  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/cours.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES COURS <span class="task">[modifier état]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="document.f_ajout.submit()"><div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="activation_cours.php"><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>

 <form method="post" action="activation_cours.php?modifier=oui" name="f_ajout" >
 <input type="hidden" value="<?=$id?>" name="id" />
	   <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
		 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		    <tr>
		  		<td class="gras"><label for="libele">Titre du cours : </label></td>
		        <td><?=$titre?></td>
		   </tr>
	    <tr>
			<td colspan="3" height="3px"></td>
		</tr>
	
	   <tr>
		   <td class="gras"><label for="session">Session :</label> </td>
		   <td><?=$session?></td>
		   
	  </tr>
   <tr>
		  <td class="gras" valign="top" style="padding-top:13px"><label for="type">Groupes : </label></td>
		  <td valign="top">
		  <table cellpadding="0" cellspacing="0" width="250" border="0" align="left" class="cellule_table">
		   <?php
			   $sql3="select id, title from $tbl_groupe";
			   $req=@mysql_query($sql3) or die('erreur de selection des groupes');
			   while($row=mysql_fetch_assoc($req)){
			   $thisId=$row['id'];
			   
			   ?>
			   <tr>
			   	<td><?=$row['title']?></td>
				<td>
				<input type="checkbox" name="groupe[]" value="<?=$thisId?>" <?=(strpos($group, $thisId)) ? $checked :''?> />
				</td>
			   </tr>
			   <?php
			   }
			   ?>
			   </table>
		   </td>
    </tr>
		  
	<tr>
		<td colspan="2" height="3px"></td>
	</tr>
	  </table>
	  			</td>
	  		</tr>
		</table>
</form>
<?php
}
?>