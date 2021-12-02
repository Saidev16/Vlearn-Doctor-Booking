<?php	

	if (isset($_POST['code_inscription'])){
	    
		$code_inscription=$_POST['code_inscription'];
		$prefixe=$_POST['prefixe'];


		$program=$_POST['program'];

		$idSession=$_POST['idSession'];
		$startdate=$_POST['startdate'];
		$enddate=$_POST['enddate'];	
		$paymentdate=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
		$refunddate=$_POST['year_r'].'-'.$_POST['month_r'].'-'.$_POST['day_r'];
		$refundamount=$_POST['refundamount'];
		$receveur = $_SESSION['admin_id_user'];
		 
		
		
	

echo $query = "SELECT MAX(recu) as statut FROM refund  ";
$result = mysql_query($query) or die ("Exécution de la requête impossible");
$row = mysql_fetch_assoc($result);
$valeurmax = $row["statut"];



	
	//insert in tbl_finance_paiement
$sql = "INSERT INTO refund(`code_inscription` ,`prefixe` ,`program` ,`idSession` ,`startdate` ,enddate,`paymentdate` ,
`refunddate` ,`refundamount` ,`recu`) VALUES ('$code_inscription','$prefixe','$program', '$idSession', '$startdate', '$enddate','$paymentdate','$refunddate','$refundamount', '$valeurmax'+1);";

	@mysql_query($sql) or die('Erreur insertion de paiement1');

	

			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_finance.php?detail=<?=$code_inscription;?>&prefixe=<?=$prefixe?>');

			//-->
			</script>
              <?php
						}
				  else{
				
				  $code_inscription = $_SESSION['detailCodeInscription'];
				  $prefixe= $_SESSION['pref'];
 

				  $sql = "SELECT nom, prenom,prefixe FROM tbl_etudiant_all WHERE code_inscription = '$code_inscription' and prefixe = '$prefixe'

			";
				  $req = @mysql_query($sql) or die ('Erreur de sélection du nom et du prénom');
				  $row = @mysql_fetch_assoc($req) or die ('error fetch data');
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Refund<span class="task">[New Refund]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="document.f_ajout.submit();"><div class="save"></div>Submit</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_finance.php?detail=<?php echo $code_inscription ?>&prefixe=<?=$prefixe?>" ><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 <form method="post" action="gestion_finance.php?new_refund=oui" name="f_ajout" >
 <input type="hidden" name="code_inscription" value="<?php echo $code_inscription ; ?>" />
 <input type="hidden" name="prefixe" value="<?php echo $prefixe ; ?>" />
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
		 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
			 <tr>
			    <td width="25%" class="gras"><label for="code_inscription">Full name : </label></td>
			    <td width="75%"><?php echo ucfirst($row['nom']).' '.ucfirst($row['prenom'])	?></td>	
			 </tr>
             <tr>
		  		<td class="gras"><label for="program">Program : </label></td>
		      <td><input type="text" name="program" id="program" class="input" style="width:280px;" /></td>
				  <!-- <td width="40%" > <TEXTAREA cols="60" rows="3" name="designation" ></TEXTAREA></td>-->
			   
		 
		   </tr>
		    <tr>
		  		<td class="gras"><label for="idSession">Session : </label></td>
		      <td><input type="text" name="idSession" id="idSession" class="input" style="width:280px;" /></td>
				  <!-- <td width="40%" > <TEXTAREA cols="60" rows="3" name="designation" ></TEXTAREA></td>-->
				 
		   </tr>
		    <tr>
		  		<td class="gras"><label for="startdate">Session Start Date: </label></td>
		      <td><input type="text" name="startdate" id="startdate" class="input" style="width:280px;" /></td>
				  <!-- <td width="40%" > <TEXTAREA cols="60" rows="3" name="designation" ></TEXTAREA></td>-->
				 
		   </tr>
		    <tr>
		  		<td class="gras"><label for="enddate">Session End Date : </label></td>
		      <td><input type="text" name="enddate" id="enddate" class="input" style="width:280px;" /></td>
				  <!-- <td width="40%" > <TEXTAREA cols="60" rows="3" name="designation" ></TEXTAREA></td>-->
				 
		   </tr>

		  <tr>
			   <td class="gras"><label for="refunddate">Date of withdrawal:</label> </td>
			   <td><select name="year_r" id="year_r" class="input">
		  <?php for ($i=date('Y')-4; $i>1996,$i<2020; $i++){?>
		  <option value="<?=$i?>" <?=(date('Y')==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>&nbsp;<select name="month_r" class="input">
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
				  </select>&nbsp; <select name="day_r" class="input">
					  <option value="01" <?= (date('d')==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?= (date('d')==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?= (date('d')==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?= (date('d')==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?= (date('d')==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?= (date('d')==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?= (date('d')==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?= (date('d')==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?= (date('d')==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?= (date('d')==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?= (date('d')==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?= (date('d')==12) ? $selected : '' ?>>12</option>
					  <option value="13" <?= (date('d')==13) ? $selected : '' ?>>13</option>
					  <option value="14" <?= (date('d')==14) ? $selected : '' ?>>14</option>
					  <option value="15" <?= (date('d')==15) ? $selected : '' ?>>15</option>
					  <option value="16" <?= (date('d')==16) ? $selected : '' ?>>16</option>
					  <option value="17" <?= (date('d')==17) ? $selected : '' ?>>17</option>
					  <option value="18" <?= (date('d')==18) ? $selected : '' ?>>18</option>
					  <option value="19" <?= (date('d')==19) ? $selected : '' ?>>19</option>
					  <option value="20" <?= (date('d')==20) ? $selected : '' ?>>20</option>
					  <option value="21" <?= (date('d')==21) ? $selected : '' ?>>21</option>
					  <option value="22" <?= (date('d')==22) ? $selected : '' ?>>22</option>
					  <option value="23" <?= (date('d')==23) ? $selected : '' ?>>23</option>
					  <option value="24" <?= (date('d')==24) ? $selected : '' ?>>24</option>
					  <option value="25" <?= (date('d')==25) ? $selected : '' ?>>25</option>
					  <option value="26" <?= (date('d')==26) ? $selected : '' ?>>26</option>
					  <option value="27" <?= (date('d')==27) ? $selected : '' ?>>27</option>
					  <option value="28" <?= (date('d')==28) ? $selected : '' ?>>28</option>
					  <option value="29" <?= (date('d')==29) ? $selected : '' ?>>29</option>
					  <option value="30" <?= (date('d')==30) ? $selected : '' ?>>30</option>
					  <option value="31" <?= (date('d')==31) ? $selected : '' ?> >31</option>
				</select></td>
		  </tr>
	
	<tr>
			   <td class="gras"><label for="paymentdate">Date cleared:</label> </td>
			   <td><select name="year_i" id="year_i" class="input">
		  <?php for ($i=date('Y')-4; $i>1996,$i<2020; $i++){?>
		  <option value="<?=$i?>" <?=(date('Y')==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>&nbsp;<select name="month_i" class="input">
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
				  </select>&nbsp; <select name="day_i" class="input">
					  <option value="01" <?= (date('d')==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?= (date('d')==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?= (date('d')==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?= (date('d')==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?= (date('d')==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?= (date('d')==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?= (date('d')==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?= (date('d')==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?= (date('d')==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?= (date('d')==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?= (date('d')==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?= (date('d')==12) ? $selected : '' ?>>12</option>
					  <option value="13" <?= (date('d')==13) ? $selected : '' ?>>13</option>
					  <option value="14" <?= (date('d')==14) ? $selected : '' ?>>14</option>
					  <option value="15" <?= (date('d')==15) ? $selected : '' ?>>15</option>
					  <option value="16" <?= (date('d')==16) ? $selected : '' ?>>16</option>
					  <option value="17" <?= (date('d')==17) ? $selected : '' ?>>17</option>
					  <option value="18" <?= (date('d')==18) ? $selected : '' ?>>18</option>
					  <option value="19" <?= (date('d')==19) ? $selected : '' ?>>19</option>
					  <option value="20" <?= (date('d')==20) ? $selected : '' ?>>20</option>
					  <option value="21" <?= (date('d')==21) ? $selected : '' ?>>21</option>
					  <option value="22" <?= (date('d')==22) ? $selected : '' ?>>22</option>
					  <option value="23" <?= (date('d')==23) ? $selected : '' ?>>23</option>
					  <option value="24" <?= (date('d')==24) ? $selected : '' ?>>24</option>
					  <option value="25" <?= (date('d')==25) ? $selected : '' ?>>25</option>
					  <option value="26" <?= (date('d')==26) ? $selected : '' ?>>26</option>
					  <option value="27" <?= (date('d')==27) ? $selected : '' ?>>27</option>
					  <option value="28" <?= (date('d')==28) ? $selected : '' ?>>28</option>
					  <option value="29" <?= (date('d')==29) ? $selected : '' ?>>29</option>
					  <option value="30" <?= (date('d')==30) ? $selected : '' ?>>30</option>
					  <option value="31" <?= (date('d')==31) ? $selected : '' ?> >31</option>
				</select></td>
		  </tr>
	
		 <!-- <tr>
		  		<td class="gras"><label for="type_paiement">Payment Type: </label></td>
		        <td>
				<select name="type_paiement" id="type_paiement"   class="input" />
					<option value="0">Cash</option>
					<option value="1">Check</option>
					<option value="2">Deposits </option>
			         <option value="3">Pay Pal </option>	
					<option value="4">Bank Wire </option>
					<option value="5">Credit Card</option>	
								
				</select>
				</td>
		   </tr>-->
		     <tr>
			   <td class="gras"><label for="amountpaid">Refund Amount:</label> </td>
			   <td><input type="text" name="amountpaid" id="amountpaid" class="input"/></td>
		    </tr>
			<!-- <tr>
		  		<td class="gras"><label for="recu">N°Recu : </label></td>
		        <td><input type="text" name="recu" id="recu" class="input" style="width:280px;" /></td>
		     </tr> 
        <tr>
		  		<td class="gras"><label for="annee">Year: </label></td>
		        <td><select name="annee" id="annee" class="input">
				<?php
			$sql="SELECT distinct annee FROM tbl_finance";
			$res = @mysql_query($sql) or die ('Error :: SELECT YEARS');
			while ($row = mysql_fetch_assoc($res)){
			$year=$row['annee']
			?>
            	<option value="<?php echo $year ;?>" <?php echo $year==$_SESSION['paiement_annee'] ? $selected : ''; ?>><?php echo $year;?></option>
            <?php
			}
			?>
           </select></td>
		     </tr>-->
		  
		 	</table>
</form>
<?php
}
?>