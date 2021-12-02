<?php
				  $id=(int)$_GET['edit_fiche'];
				  $sql2="SELECT p.*, e.nom,e.prenom 
				  		FROM tbl_finance_detail AS p, tbl_etudiant AS e 
				  		WHERE e.code_inscription = p.code_inscription 
						AND id = '$id' LIMIT 1";
				  $req2=@mysql_query($sql2) or die("erreur dans la selection de la fiche");
				  $row=mysql_fetch_assoc($req2);
				  $code_inscription=$row['code_inscription'];
				  
	if (isset($_POST['code_inscription'])){
	    
		$code_inscription=$_POST['code_inscription'];
		$type_paiement=$_POST['type_paiement'];
		$date_paiement=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
		$somme=(int)$_POST['somme'];
		$price=(int)$_POST['price'];
		$id= $_POST['id'];
		$idSession= $_POST['idSession'];
	 
	 
		
	$sql=" UPDATE tbl_finance_detail SET
	 `price`='$price' , 
	 `type_paiement`='$type_paiement' ,
	 `date_paiement`='$date_paiement' ,
	 `somme`='$somme' 
	  WHERE id='$id' LIMIT 1";
	
    @mysql_query($sql)or die ("Error on save data");
	
	$sql= "SELECT annee_academique FROM tbl_session WHERE idSession = '$idSession' LIMIT 1";
	$req = @mysql_query($sql);
	$row = mysql_fetch_assoc($req);
	$annee = $row['annee_academique'];
	
	// select somme payed
	$sql="SELECT sum(somme) as somme FROM tbl_finance_detail WHERE code_inscription='$code_inscription' 
	AND idSession IN (SELECT DISTINCT idSession FROM tbl_session WHERE annee_academique = '$annee')";
	
	$res=mysql_query($sql);
	$row = mysql_fetch_assoc($res);
	$sommes= $row['somme'];
	
	//update somme payed
	$sql="UPDATE tbl_finance SET payee = payed_frais_inscription + '$sommes' , 
	reste = (assurance+frais_etude)-(bourse+payed_frais_inscription+$sommes) 
	WHERE code_inscription='$code_inscription' AND annee= '$annee'";
	@mysql_query($sql);
	
	   
	   
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_finance.php?detail=<?php echo $code_inscription;?>&annee=<?=$_SESSION['paiement_annee']?>');
			//-->
			</script>
              <?php
						}
				  else{
				  $y = $row['date_paiement'] == '0000-00-00' ? date('Y') : substr($row['date_paiement'], 0,4);
		          $m = $row['date_paiement'] == '0000-00-00' ? date('m') : substr($row['date_paiement'], 5,2);
		          $d = $row['date_paiement'] == '0000-00-00' ? date('d') : substr($row['date_paiement'], 8,2);
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES PAIEMENTS <span class="task">[Editer un fiche]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="document.f_ajout.submit();"><div class="save"></div>Valider</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_finance.php?detail=<?php echo $code_inscription ?>&annee=<?=$_SESSION['paiement_annee']?>" ><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 <form method="post" action="gestion_finance.php?edit_fiche=oui" name="f_ajout"  >
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
		 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
			 	<tr>
			  <td width="25%" class="gras"><label for="code_inscription">Nom et pr&eacute;nom  : </label></td>
			  <td width="75%">
 					 <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                     <input type="hidden" name="idSession" value="<?php echo $row['idSession']; ?>" />
					<input type="hidden" name="code_inscription" value="<?php echo $row['code_inscription']; ?>" />
					<input type="text" name="nom" value="<?php echo ucfirst($row['nom']).' '.ucfirst($row['prenom'])?>" class="input" style="width:250px" />
 			  </td> 
		    </tr>
			 <tr>
		  		<td class="gras"><label for="designation">Code cours : </label></td>
		        <td>
				<input type="text" name="code_cours" class="input" value="<?php echo $row['code_cours']; ?>" readonly="readonly"  />
				</td>
		   </tr>
		     	 	<tr>
			  <td width="25%" class="gras"><label for="price">Prix du cours : </label></td>
			  <td width="75%">
				<input type="text" name="price" size="5" value="<?php echo $row['price']; ?>" id="price" class="input">
					 
			  </td> 
		    </tr>
				<tr>
			   <td class="gras"><label for="somme">Somme pay&eacute;e:</label> </td>
			   <td><input type="text" name="somme" id="somme"  value="<?php echo $row['somme']; ?>" class="input"/>
			   <input type="hidden" name="ex_somme" id="ex_somme"  value="<?php echo $row['somme']; ?>" class="input"/>
			   </td>
		  </tr>
		    <tr>
		  		<td class="gras"><label for="type_paiement">Type de paiement : </label></td>
		        <td>
				<select name="type_paiement" id="type_paiement"   class="input" />
					<option value="1" <?php echo $row['type_paiement']==1 ? $selected : ''; ?>>Espèce</option>
					<option value="0" <?php echo $row['type_paiement']==0 ? $selected : ''; ?>>Chèque</option>				
				</select>
				</td>
		   </tr>
		   
		    
			
		   <tr>
			   <td class="gras"><label for="date_paiement">Date de paiement:</label> </td>
			   <td><select name="year_i" id="year_i" class="input">
		  <?php for ($i=date('Y'); $i>1996; $i--){?>
		  <option value="<?=$i?>" <?=($y==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
		  &nbsp;<select name="month_i" class="input">
					  <option value="01" <?=($m==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=($m==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=($m==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=($m==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=($m==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=($m==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=($m==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=($m==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=($m==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=($m==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=($m==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=($m==12) ? $selected : '' ?>>12</option>
				  </select>
			  &nbsp;
				  <select name="day_i" class="input">
					  <option value="01" <?= ($d==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?= ($d==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?= ($d==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?= ($d==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?= ($d==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?= ($d==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?= ($d==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?= ($d==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?= ($d==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?= ($d==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?= ($d==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?= ($d==12) ? $selected : '' ?>>12</option>
					  <option value="13" <?= ($d==13) ? $selected : '' ?>>13</option>
					  <option value="14" <?= ($d==14) ? $selected : '' ?>>14</option>
					  <option value="15" <?= ($d==15) ? $selected : '' ?>>15</option>
					  <option value="16" <?= ($d==16) ? $selected : '' ?>>16</option>
					  <option value="17" <?= ($d==17) ? $selected : '' ?>>17</option>
					  <option value="18" <?= ($d==18) ? $selected : '' ?>>18</option>
					  <option value="19" <?= ($d==19) ? $selected : '' ?>>19</option>
					  <option value="20" <?= ($d==20) ? $selected : '' ?>>20</option>
					  <option value="21" <?= ($d==21) ? $selected : '' ?>>21</option>
					  <option value="22" <?= ($d==22) ? $selected : '' ?>>22</option>
					  <option value="23" <?= ($d==23) ? $selected : '' ?>>23</option>
					  <option value="24" <?= ($d==24) ? $selected : '' ?>>24</option>
					  <option value="25" <?= ($d==25) ? $selected : '' ?>>25</option>
					  <option value="26" <?= ($d==26) ? $selected : '' ?>>26</option>
					  <option value="27" <?= ($d==28) ? $selected : '' ?>>28</option>
					  <option value="29" <?= ($d==29) ? $selected : '' ?>>29</option>
					  <option value="30" <?= ($d==30) ? $selected : '' ?>>30</option>
					  <option value="31" <?= ($d==31) ? $selected : '' ?> >31</option>
				</select></td>
		  </tr>
		  
		  
		  
		 <tr>
			   <td colspan="2" height="3px"></td>
		 </tr>
	
	    
		</table>
</form>
<?php
}
?>