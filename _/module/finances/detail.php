 <SCRIPT language="javascript">
    function popup(page) {
      window.open(page);
    }
  </SCRIPT>
 <?php

	 if (isset($_GET['detail'])){
 $code_inscription= $_SESSION['detailCodeInscription'] = addslashes($_GET['detail']);
 $pref= $_SESSION['pref'] = addslashes($_GET['prefixe']);

 $prefixe=$_GET['prefixe'];
 if($prefixe=='MOR'){
 $table=tbl_etudiant_morocco;
}
else if($prefixe=='AG'){
 $table=tbl_etudiant_algeria;
}if($prefixe=='BF'){
 $table=tbl_etudiant_burkina;
}if($prefixe=='BN'){
 $table=tbl_etudiant_benin;
}

	  $sql= "SELECT concat(nom,' ', prenom) as name,aul,piimt,niveau FROM tbl_etudiant_all WHERE code_inscription='$code_inscription'and prefixe='$prefixe' LIMIT 1";
	 $req = @mysql_query($sql);
	 $row = mysql_fetch_assoc($req);
	 $name = $row['name'];
	 $aul = $row['aul'];
	  $piimt = $row['piimt'];
	  $niveau = $row['niveau'];
 ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Details<span class="task"> &nbsp;[<?=ucfirst($name)?>]</span></span></td>
	<td width="90">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		
          <td valign="top" align="center">
		   <a href="gestion_finance.php?new_paiement=oui"><div class="ajouter"></div>Add Payment</a>
		    <td valign="top" align="center">
		   <a href="gestion_finance.php?new_refund=oui"><div class="ajouter"></div>Add Refund</a>


		  </td>
		   <td valign="top" align="center">
		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {
				     chemin=document.adminMenu.boxchecked.value;
				         xyz=document.adminMenu.prefixe.value;
					 chemin='gestion_finance.php?modif_paiement='+chemin+'&prefixe='+xyz;
				     window.location.replace(chemin);				

				   }

				   " title="modifier une fiche"><div class="modifier"></div>Edit Payment</a>

		  </td>
          <td valign="top" align="center">
		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un cours dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;
				   xyz=document.adminMenu.prefixe.value;

					 chemin='gestion_finance.php?delete_paiement='+chemin+'&prefixe='+xyz;

				     window.location.replace(chemin);

				   }

				   " title="Editer une fiche"><div class="supprimer"></div>Delete Payment</a>

		  </td>
	
		   <td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer"><div class="imprimer"></div>Print</a>
		  </td>
		   <td align="right">
		 <a href="gestion_finance.php"><div class="retour"></div>Back</a>
		 </td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
  
 

    

<table width="100%" border="0"  align="center" cellspacing="3" class="cellule_table">
         <tr>
            <th>Payments Received</th>
         </tr>
</table> 
<table width="100%" border="0"  align="center" cellspacing="1" class="adminlist">
         <tr>
             <th width="10">#</th>
             <th>Description</th>
             <!-- <th>Année</th>-->
             <th>Payment Type</th>
             <th>Date </th>
             <th>Amount Paid</th>
           <!--  <th>Receptor</th>-->
			 <th>Receipt N°</th>
             <th>Receipt</th>
         </tr>
		 <form action="#" method="post" name="adminMenu">
	<input type="hidden" name="boxchecked" value="0" />

<input type="hidden" name="prefixe" value="0" />
<?php
	$prices = $sommes= 0;
    $id=$_GET['detail'];
  	$prefixe=$_GET['prefixe'];
  	$annee=$_GET['annee'];


	
 	 $sql="SELECT * FROM tbl_finance_paiement
	 WHERE code_inscription = '$id' and prefixe='$prefixe'
	 ORDER BY date_paiement ASC";
 	 $req=@mysql_query($sql) or die ("erreur lors de la sélection des paiements");
	 while($row=mysql_fetch_assoc($req)){
	 $id = $row['id'];
	 $designation = $row['designation'];
	 $pay= $row['type_paiement'];
	 if($pay==0)
	 {$type_paiement='Cash';
	 }
	 else
	 if($pay==1)
	 {$type_paiement='Check';}
	 else 
	 if($pay==2)
	 {$type_paiement='Deposits';}
	 else
	if($pay==3)
	 {$type_paiement='PayPal';}
	 else
	 if($pay==4)
	 {$type_paiement='BankWire';}
	  else
	 if($pay==5)
	 {$type_paiement='Credit Card';}
	 
?>
	<tr align="center">
    	<td><input type="radio" name="id" value="<?=$id?>" onClick="document.adminMenu.boxchecked.value='<?=$id?>' "  onmousedown="document.adminMenu.prefixe.value=<?php echo "'".$prefixe."'";?>" /></td> 
     
	    <td><?php echo $designation;?></td>
       <!-- <td><?php //echo $row['annee']; ?></td>-->
        <td><?php echo $type_paiement;//$row['type_paiement'] == 0 ? 'Ch&egrave;que' : 'Esp&egrave;ce';?></td>
        <td><?php 
		$date=$row['date_paiement'];
		$tab=split('[/.-]',$date);
		echo $tab[1].'-'.$tab[2].'-'.$tab[0];//echo $row['date_paiement']; ?>
		</td>
        <td><?php echo $row['somme']; ?></td>
		
       <!-- <td><?php
		//echo $row['receveur']; 
	/*	$rec=$row['receveur'];
		$s="select CONCAT(nom,' ', prenom) AS name from tbl_admin where id='$rec'";
		 $req=@mysql_query($s) or die('erreur de selection des paiements');  
		 $row=mysql_fetch_assoc($req);
		echo $row['name']; */?></td>-->
		<td><?php echo $row['recu']; ?></td>
		 <td><a href="javascript:popup('../module/finances/recu.php?recu=<?php echo $row['id']?>', '', 'resizable=no, location=no, width=200, height=100, menubar=no, status=no, scrollbars=no, menubar=no')">Receipt</a></td>

<?php
	}
?>
</table>
  
 <table width="100%" border="0"  align="center" cellspacing="3" class="cellule_table">
          <tr>
            <th>Refund Table</th>
          </tr>
        </table>
        <table width="100%" border="0"  align="center" cellspacing="1" class="adminlist">
          <tr>
           
            <th>Program</th>
            <th>Session </th>
            <th>Session Start Date </th>
            <th>Session End Date</th>
            <th>Date of Withdrawal</th>
            <th>Refund </th>
           
            <th>Date Cleared</th>
          <!--  <th>Receipt</th>-->
          </tr>

          <?php
          // conditions
          $id=$_GET['detail'];
          $prefixe=$_GET['prefixe'];
          $annee=$_GET['annee'];
          $sql="SELECT * FROM refund
          WHERE code_inscription = '$id' and prefixe='$prefixe'";
          //var_dump($sql);
          $req=@mysql_query($sql) or die ("erreur lors de la s�lection des paiements");
         $row=mysql_fetch_assoc($req);
         

            $startdate= $row['startdate'];
            $enddate= $row['enddate'];
            $paymentdate= $row['paymentdate'];

            $pay= $row['method'];
            if($pay==0)
            {$method='Cash';}
            else if($pay==1)
            {$method='Check';}
            else if($pay==2)
            {$method='Deposits';}
            else if($pay==3)
            {$method='PayPal';}
            else   if($pay==4)
            {$method='BankWire';}
            else  if($pay==5)
            {$method='Credit Card';}

            else  if($pay==7)
            {$method='MOU';}
            else {$method='n/a';}

            ?>
            <tr align="center">
        
            <td><?php echo $row['program'] ;?></td>
            <td><?php echo $row['idSession'];?></td>
              <td><?php echo $startdate; ?></td>
              
              <td><?php echo $enddate; ?></td>

              <td><?php  $date=$row['refunddate'];
              $tab=split('[/.-]',$date);
              echo $tab[1].'-'.$tab[2].'-'.$tab[0]; ?>              	
              </td>
              <td><?php if($row['refundamount'] == '0')
              {echo '$ -';} else {echo "$".$row['refundamount'];} ?>
              </td>
               <td><?php 
              $date=$row['paymentdate'];
              $tab=split('[/.-]',$date);
              echo $tab[1].'-'.$tab[2].'-'.$tab[0]; ?></td>
         

<!--
              <td>  <a href="javascript:popup('../module/finances/recu-refund.php?recu=<?php echo $row['id']?>', '', 'resizable=no, location=no, width=200, height=100, menubar=no, status=no, scrollbars=no, menubar=no')">Receipt</a><td>-->




              </tr>

              <?php
         

            ?>
          </table>


  
   <?php
   }
   ?>
   </form>