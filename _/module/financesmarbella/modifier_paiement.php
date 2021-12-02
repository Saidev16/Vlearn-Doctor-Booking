
<?php	
 

	if (isset($_POST['code_inscription'])){
	
 
        $id=$_POST['id'];
	    $code_inscription=$_POST['code_inscription'];
		$designation=$_POST['designation'];
		$recu=$_POST['recu'];
		$prefixe=$_POST['prefixe'];
		$type_paiement=$_POST['type_paiement'];
		$date_paiement=$_POST['year_n'].'-'.$_POST['month_n'].'-'.$_POST['day_n'];//$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
		$somme=(double)$_POST['somme'];
		$receveur = $_SESSION['admin_id_user'];
		$annee=$_SESSION['paiement_annee'];
		
	   
		
		$sql="UPDATE tbl_finance_paiement_casa SET designation = '$designation', 
		type_paiement= '$type_paiement',
		date_paiement= '$date_paiement',
		recu= '$recu',
		somme= '$somme'
		WHERE code_inscription = '$code_inscription'  and id= '$id'";
		@mysql_query($sql);
	
		$sql="select sum(somme) as nbre from tbl_finance_paiement_casa where code_inscription = '$code_inscription'";
		$reqab =mysql_query($sql) or die("erreur lors de traitement de F*");
        $ab= mysql_fetch_assoc($reqab);
	     $payee=$ab["nbre"];
	
	
	
		
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_finance_casa.php?detail=<?=$code_inscription;?>');
			//-->
			</script>
              <?php
						}
				  else{
				 $id1=(int)$_GET['modif_paiement']; 
			 $prefixe=$_GET['prefixe']; 
				 $annee=$_SESSION['paiement_annee'];
			 $sql="SELECT e.nom, e.prenom ,e.prefixe, p.* 
						 FROM tbl_etudiant_casa AS e, tbl_finance_paiement_casa AS p
						 WHERE e.code_inscription = p.code_inscription AND p.id = $id1 ";
				  $req=@mysql_query($sql) or die("erreur dans la s&eacute;lection de la fiche");
				  $row=mysql_fetch_assoc($req);
				  $id = $row['id'];
				  $code_inscription = $row['code_inscription'];
				  $designation = $row['designation'];
				  $type_paiement = $row['type_paiement'];
				   $y = substr($row['date_paiement'], 0,4);
		           $m = substr($row['date_paiement'], 5,2);
		            $d = substr($row['date_paiement'], 8,2);//$row['date_paiement'];
				  $somme= $row['somme'];
		          $recu= $row['recu'];
				  $name = ucfirst($row['prenom']). '  '.ucfirst($row['nom']);
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Tuition and Fees <span class="task">[Edit payment]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="document.f_ajout.submit();"><div class="save"></div>Submit</a> 
		  </td>
		 
		  <td valign="top" align="center">
		   <a href="gestion_finance_casa.php?detail=<?php echo $code_inscription ?>" ><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 <form method="post" action="gestion_finance_casa.php?modif_paiement=oui" name="f_ajout" >
 <input type="hidden" name="code_inscription" value="<?php echo $code_inscription ; ?>" />
 <input type="hidden" name="id" value="<?php echo $id ; ?>" />
  <input type="hidden" name="prefixe" value="<?php echo $prefixe ; ?>" />
 	 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
		 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table"> 
		    <tr>
			    <td width="25%" class="gras"><label for="code_inscription">Name : </label></td>
			    <td width="75%"><?php echo ucfirst($row['nom']).' '.ucfirst($row['prenom'])	?></td>	
			 </tr>
			  <tr>
		  		<td class="gras"><label for="designation">Desciption: </label></td>
		       <!-- <td><input type="text" name="designation" id="designation" class="input" style="width:280px;" /></td>-->
				  <td width="40%" > <TEXTAREA cols="60" rows="3" name="designation" ><?php echo $row['designation'] ;?></TEXTAREA></td>
				 <tr>
		    
		 
		   </tr>

		     <tr>
			   <td class="gras"><label for="somme">Amount Paid:</label> </td>
			   <td><input type="text" name="somme" id="somme"  value="<?=$row['somme']?>" class="input"/></td>
		    </tr>
			 <tr>
		  		<td class="gras"><label for="recu">Receipt N° : </label></td>
		        <td><input type="text" name="recu" id="recu" class="input" value="<?=$row['recu']?>" style="width:280px;" /></td>
		     </tr> 
			    <tr>
		  		<td class="gras"><label for="type_paiement">Payment Type : </label></td>
		        <td>
				<select name="type_paiement" id="type_paiement"   class="input" />
				
					<option value="1" <?=($type_paiement==1) ? $selected : '' ?>>Cash</option>
					<option value="2" <?=($type_paiement==2) ? $selected : '' ?>>Check</option>
					<option value="3" <?=($type_paiement==3) ? $selected : '' ?>>Deposits </option>
					<option value="4" <?=($type_paiement==4) ? $selected : '' ?>>Payapl </option>	
					<option value="5" <?=($type_paiement==5) ? $selected : '' ?>>Bank Wire </option>	
					<option value="6" <?=($type_paiement==6) ? $selected : '' ?>>Credit Card </option>			
				</select>
				</td>
		   </tr>
			  <tr>
		  	  <td class='gras'><label for="year_n">Date: </label></td>
		  	  <td>
			  <select name="year_n" id="year_n" class="input">
		  <?php 
		  /*$param=date('Y');
		  for ($i=1960; $i<=$param; $i++){*/
		   for ($i=date('Y')-2; $i>1996,$i<2022; $i++){?>
		 <option value="<?=$i?>" <?=($y==$i) ? $selected : '' ?>><?=$i?></option>
		 
		  <?php
		  }
		  ?>
		  &nbsp;</select>
		  &nbsp;<select name="month_n" class="input">
		  <option value="00">00</option>
		  <?php for ($i=1; $i<13; $i++){
		  ?>
		  <option value="<?=$i?>" <?=($m==$i) ? $selected  : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		 </select>
		  &nbsp;<select name="day_n" class="input">
		   <option value="00">00</option>
		  <?php for ($i=1; $i<32; $i++){
		  ?>
		  <option value="<?=$i?>" <?=($d==$i) ? $selected  : ''?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
			   </td>
			   <td></td>
			   <td></td>
		  </tr>      
         
			  
	
			 
	
		</table>
     
</form>
<?php
}
?>