<?php
	if (isset($_POST['code_inscription'])){
	    
		$code_inscription=$_POST['code_inscription'];
		$type_paiement=$_POST['type_paiement'];
		$date_paiement=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
		$somme=$_POST['somme'];
		$annee=$_POST['annee'];
		$mois=$_POST['mois'];
		$designation=addslashes($_POST['designation']);
		$receveur= $_SESSION['id_user'];
		 
	 
	 
		
	$sql="INSERT INTO tbl_finance_data 
	( `code_inscription` , `designation` ,`annee` ,`mois` , `type_paiement` , `date_paiement` ,`somme` ,`receveur` )  
		VALUES ('$code_inscription' , '$designation', '$annee', '$mois', '$type_paiement', '$date_paiement', '$somme', '$receveur');";
	

    @mysql_query($sql)or die ("Error on save data");
	
	// select somme payed
	$sql="SELECT sum(somme) as somme FROM tbl_finance_data WHERE code_inscription='$code_inscription' AND annee= '$annee'";
	$res=mysql_query($sql);
	$row = mysql_fetch_assoc($res);
	$sommes= $row['somme'];
	
	//update somme payed
	$sql="UPDATE tbl_finance SET payee = '$sommes' , reste = reste - $somme 
	WHERE code_inscription='$code_inscription' AND annee= '$annee'";
	@mysql_query($sql);
	
	  
	   
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_finance.php?detail=<?php echo $code_inscription;?>');
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
 <form method="post" action="gestion_finance.php?new=oui" name="f_ajout"  >
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
 					<?php
					$code_inscription=$_GET['new'];
					$sql="SELECT code_inscription, nom, prenom FROM $tbl_etudiant where code_inscription='$code_inscription' LIMIT 1";
					$res=@mysql_query($sql) or die('');
					$row=mysql_fetch_assoc($res) ;
					?>
					<input type="hidden" name="code_inscription" value="<?php echo $row['code_inscription']; ?>" />
					<input type="text" name="nom" value="<?php echo ucfirst($row['nom']).' '.ucfirst($row['prenom'])?>" class="input" style="width:250px" />
 			  </td> 
		    </tr>
			 <tr>
		  		<td class="gras"><label for="type_paiement">Désignation : </label></td>
		        <td>
				<input type="text" name="designation" class="input" style="width:400px" />
				</td>
		   </tr>
		     	 	<tr>
			  <td width="25%" class="gras"><label for="idSession">Année  : </label></td>
			  <td width="75%">
				<select name="annee" id="annee" class="input">
					<?php
					$code_inscription=$_GET['new'];
					$sql="SELECT DISTINCT annee FROM tbl_finance WHERE code_inscription='$code_inscription'";
					$res=@mysql_query($sql) or die('');
					while ($row=mysql_fetch_assoc($res)){
					?>
					<option value="<?php echo $row['annee']; ?>"><?php echo $row['annee']?></option>
					<?php
					}
					?>
			    </select>
			  </td> 
		    </tr>
				<tr>
			  <td width="25%" class="gras"><label for="idSession">Mois  : </label></td>
			  <td width="75%">
				<select name="mois" id="mois" class="input">
					<option value="Octobre">Octobre</option>
					<option value="Novembre">Novembre</option>
					<option value="Décembre">Décembre</option>
					<option value="Janvier">Janvier</option>
					<option value="Février">Février</option>
					<option value="Mars">Mars</option>
					<option value="Avril">Avril</option>
					<option value="Mai">Mai</option>
					<option value="Juin">Juin</option>
					<option value="Juillet">Juillet</option>
			    </select>
			  
			  </td> 
		    </tr>
		    <tr>
		  		<td class="gras"><label for="type_paiement">Type de paiement : </label></td>
		        <td>
				<select name="type_paiement" id="type_paiement"   class="input" />
					<option value="1">Espèce</option>
					<option value="0">Chèque</option>				
				</select>
				</td>
		   </tr>
		   
		    
			
		   <tr>
			   <td class="gras"><label for="date_paiement">Date de paiement:</label> </td>
			   <td><select name="year_i" id="year_i" class="input">
		  <?php for ($i=date('Y'); $i>1996; $i--){?>
		  <option value="<?=$i?>" <?=(date('m')==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
		  &nbsp;<select name="month_i" class="input">
					  <option value="01" <?=(date('m')==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=(date('m')==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=(date('m')==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=(date('m')==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=(date('m')==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=(date('m')==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=(date('m')==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=(date('m')==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=(date('m')==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=(date('m')==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=(date('m')==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=(date('m')==12) ? $selected : '' ?>>12</option>
				  </select>
			  &nbsp;
				  <select name="day_i" class="input">
					  <option value="01" <?=(date('d')==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=(date('d')==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=(date('d')==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=(date('d')==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=(date('d')==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=(date('d')==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=(date('d')==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=(date('d')==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=(date('d')==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=(date('d')==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=(date('d')==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=(date('d')==12) ? $selected : '' ?>>12</option>
					  <option value="13" <?=(date('d')==13) ? $selected : '' ?>>13</option>
					  <option value="14" <?=(date('d')==14) ? $selected : '' ?>>14</option>
					  <option value="15" <?=(date('d')==15) ? $selected : '' ?>>15</option>
					  <option value="16" <?=(date('d')==16) ? $selected : '' ?>>16</option>
					  <option value="17" <?=(date('d')==17) ? $selected : '' ?>>17</option>
					  <option value="18" <?=(date('d')==18) ? $selected : '' ?>>18</option>
					  <option value="19" <?=(date('d')==19) ? $selected : '' ?>>19</option>
					  <option value="20" <?=(date('d')==20) ? $selected : '' ?>>20</option>
					  <option value="21" <?=(date('d')==21) ? $selected : '' ?>>21</option>
					  <option value="22" <?=(date('d')==22) ? $selected : '' ?>>22</option>
					  <option value="23" <?=(date('d')==23) ? $selected : '' ?>>23</option>
					  <option value="24" <?=(date('d')==24) ? $selected : '' ?>>24</option>
					  <option value="25" <?=(date('d')==25) ? $selected : '' ?>>25</option>
					  <option value="26" <?=(date('d')==26) ? $selected : '' ?>>26</option>
					  <option value="27" <?=(date('d')==27) ? $selected : '' ?>>27</option>
					  <option value="28" <?=(date('d')==28) ? $selected : '' ?>>28</option>
					  <option value="29" <?=(date('d')==29) ? $selected : '' ?>>29</option>
					  <option value="30" <?=(date('d')==30) ? $selected : '' ?>>30</option>
					  <option value="31" <?=(date('d')==31) ? $selected : '' ?> >31</option>
				</select></td>
		  </tr>
		  
		  <tr>
			   <td class="gras"><label for="somme">Somme:</label> </td>
			   <td><input type="text" name="somme" id="somme"   class="input"/></td>
		  </tr>
		  
		 <tr>
			   <td colspan="2" height="3px"></td>
		 </tr>
	
	    
		</table>
</form>
<?php
}
?>