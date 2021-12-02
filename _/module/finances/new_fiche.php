
<?php
	if (isset($_POST['code_inscription'])){
	    
		$code_inscription= $_POST['code_inscription'] ;
		$bourse=(int)$_POST['bourse'];
		$frais_inscription=(int)$_POST['frais_inscription'];
		$payed_frais_inscription=(int)$_POST['payed_frais_inscription'];
		$annee=$_POST['annee'];
		$sommes = $prices = 0;
	 
		//insertion du cours
		
		$sql="INSERT INTO tbl_finance ( `code_inscription` , `bourse` , `assurance`, `payed_frais_inscription`,`payee` , `annee` )
			  VALUES ('$code_inscription' , '$bourse', '$frais_inscription', '$payed_frais_inscription', '0', '$annee');"; 
		@mysql_query($sql)or die ("erreur lors de l'ajout d'une nouvelle fiche ");
		
		
		// select somme payed
		$sql="SELECT sum(somme) as somme, sum(price) as price  FROM tbl_finance_detail 
		WHERE code_inscription='$code_inscription' 
		AND idSession IN (SELECT DISTINCT idSession FROM tbl_session WHERE annee_academique = '$annee')";
		
		$res=mysql_query($sql);
		$row = mysql_fetch_assoc($res);
		$sommes= (int)$row['somme'];
		$prices= (int)$row['price'];
		
		//mise à jour du reste et de la somme payée
		$sql = "UPDATE tbl_finance SET `frais_etude` = '$prices',
		`reste` = (assurance+frais_etude)-(bourse+$sommes+$payed_frais_inscription)  
				WHERE code_inscription = '$code_inscription' AND annee = '$annee'";
		@mysql_query($sql) or die ('erreur du mise à jour du paiement ');
	  
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_finance.php');
			//-->
			</script>
              <?php
						}
				  else{
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES PAIEMENTS <span class="task">[ajouter]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="document.f_ajout.submit();"><div class="save"></div>Valider</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_finance.php" ><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 <form method="post" action="gestion_finance.php?new_fiche=oui" name="f_ajout"  >
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
		 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		 
		   	<tr>
			  <td width="25%" class="gras"><label for="code_inscription">Nom et prénom  : </label></td>
			  <td width="75%">
				<select name="code_inscription" id="code_inscription" class="input">
					<option value="0">Séléctionner un étudiant</option>
					<?php
					$sql="SELECT code_inscription, nom, prenom FROM $tbl_etudiant ORDER BY nom";
					$res=@mysql_query($sql) or die('');
					while($row=mysql_fetch_assoc($res)){
					?>
					<option value="<?php echo $row['code_inscription']; ?>"><?php echo ucfirst($row['nom']).' '.ucfirst($row['prenom'])?></option>
					<?php
					}
					?>
			    </select>
			  
			  </td> 
		    </tr>
			
		     
			
		    <tr>
		  		<td class="gras"><label for="bourse">Bourse : </label></td>
		        <td><input type="text" name="bourse" id="bourse"   class="input" /></td>
		   </tr>
		  
		  <tr>
			   <td class="gras"><label for="frais_inscription">Frais d'inscription:</label> </td>
			   <td><input type="text" name="frais_inscription" id="frais_inscription"   class="input"/></td>
		  </tr>
          
          <tr>
			   <td class="gras"><label for="payed_frais_inscription">Frais d'inscription (payée):</label> </td>
			   <td><input type="text" name="payed_frais_inscription" id="payed_frais_inscription"   class="input"/></td>
		  </tr>
	
	   <tr>
		   <td class="gras"><label for="idSession">Année scolaire :</label> </td>
		   <td>
			 <select name="annee" id="annee" class="input">
					<option value="0">Séléctionner une ann&eacute;e</option>
					<?php
					for ($i=2006; $i<=2014; $i++){
					?>
					<option value="<?php echo $i; ?>" <?php echo $i==$row['annee'] ? $selected : ''; ?>><?php echo $i?></option>
					<?php
					}
					?>
			    </select>
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