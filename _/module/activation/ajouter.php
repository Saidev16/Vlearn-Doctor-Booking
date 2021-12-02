<?php
 $lesgroup='&nbsp;';
 $idSession=$_SESSION['AidSession'];
 
	if (isset($_POST['code_cours'])){
	    
		$code_cours=trim($_POST['code_cours']);
		$idSession=$_SESSION['AidSession']=$_POST['idSession']; 
		$groups=$_POST['groupe'];foreach($groups as $group)  $lesgroup.=$group.','; 
		$date=date('Y-m-d'); 
		
		//verify if cours is active
		
		$sqlverify="select count(*) as compte from $tbl_cours_inscription where code_cours='$code_cours'";
		$req=@mysql_query($sqlverify) or die ('error on verify');
		$row=mysql_fetch_assoc($req);
		$compte=$row['compte'];
		if ($compte==0){
	
		    //insertion du cours
		
	        $sql="INSERT INTO $tbl_cours_inscription ( `code_cours` , `idSession` , `groupe` , `dateActivation` ) 
		          VALUES ('$code_cours' , '$idSession', '$lesgroup', '$date');";
            @mysql_query($sql)or die ("erreur lors de l'ajout du nouveau cours ");
	
		    //insertion du syllabys
	   
		    $sql2="insert into $tbl_syllabus (`code_cours` , `idSession` , `week`)
			VALUES ";
            for($j=1; $j<13; $j++){
			$week=$j;
	        $sql2.="('$code_cours', '$idSession', '$week' ),";
								  }
			$sql2.="('$code_cours', '$idSession', '13');"; 
 		    @mysql_query($sql2) or die("erreur lors de la création des syllabus du cours");
 	
	  		 //insertion du descriptif
	
 	        $sql3="INSERT INTO $tbl_descriptif ( `code_cours`, `idSession` ) 
			VALUES ('$code_cours', '$idSession');"; 
             @mysql_query($sql3) or die("erreur lors de la création du descriptif du cours");
	
			//insertion du seance

 			$sql4="INSERT INTO $tbl_seance ( `code_cours`, `idSession` ) 
			VALUES ('$code_cours', '$idSession');";
            @mysql_query($sql4) or die("erreur lors de la création du séance du cours");
			
	   }
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('activation_cours.php');
			//-->
			</script>
              <?php
						}
				  else{
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES COURS <span class="task">[activer l'inscription]</span></td>
 	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="document.f_ajout.submit()"><div class="save"></div>Valider</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="activation_cours.php" ><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 <form method="post" action="activation_cours.php?ajouter=oui" name="f_ajout"  >
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
		 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		    <tr>
		  		<td class="gras"><label for="libele">Titre du cours : </label></td>
		        <td>
				<?php
				$sql1="select code_cours, titre from $tbl_cours where archive=0 order by code_cours";
 				$req=@mysql_query($sql1) or die ('erreur de selection des cours');
				?>
				<select name="code_cours" class="search">
				<?php
				while($row=mysql_fetch_assoc($req)){
				?>
					<option value="<?=$row['code_cours']?>"><?=$row['code_cours']?>:<?=substr(ucfirst(strtolower($row['titre'])), 0, 90)?></option>
				<?php
					}
				?>
				</select>
				</td>
		   </tr>
	    <tr>
			<td colspan="3" height="3px"></td>
		</tr>
	   <tr>
		   <td class="gras"><label for="session">Session :</label> </td>
		   <td>
			   <select name="idSession" id="idSession" class="input">
			   <?php
			   $sql2="select idSession, session, annee_academique from $tbl_session order by idSession desc";
			   $req=@mysql_query($sql2) or die('erreur de selection des sessions');
			   while($row=mysql_fetch_assoc($req)){
			   $is=$row['idSession'];
			   $ss=$row['session'].' '.$row['annee_academique'];
			   
			   ?>
				   <option value="<?=$is?>" <?=($is=$idSession) ? $selected : ''?>><?=$ss?></option>
			   <?php
			   }
			   ?>
			   </select>
		   </td>
	  </tr>
   <tr>
		  <td class="gras" valign="top" style="padding-top:13px"><label for="type">Groupes : </label></td>
		  <td valign="top">
		  <table cellpadding="0" cellspacing="0" width="250" border="0" align="left" class="cellule_table">
		   <?php
			   $sql3="select id, title from $tbl_groupe";
			   $req=@mysql_query($sql3) or die('erreur de selection des groupes');
			   while($row=mysql_fetch_assoc($req)){
			   
			   ?>
			   <tr>
			   	<td><?=$row['title']?></td>
				<td><input type="checkbox" name="groupe[]" value="<?=$row['id']?>" /></td>
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