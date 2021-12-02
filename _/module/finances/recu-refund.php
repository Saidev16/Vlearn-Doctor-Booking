<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ASL - Receipt</title>
</head>
<style type="text/css">
table{
font-family:verdana;
font-size:11px;
}
.bold{
font-weight:bold;
}
</style>
<style type="text/css" media="print">
.hide{
display:none;
}
</style>
<body>
<?php
require '../../administrator/config/config.php';
 $id=$_GET['recu']; 

  $sql="SELECT p.*, e.nom, e.prenom, e.niveau,e.prefixe, f.*
FROM refund as p, tbl_finance as f, tbl_etudiant_all as e
WHERE p.id='$id'
AND e.code_inscription=f.code_inscription
AND e.prefixe=f.prefixe
AND e.code_inscription=p.code_inscription
and e.prefixe= p.prefixe
LIMIT 1";
$res=@mysql_query($sql);
$row=@mysql_fetch_assoc($res);


  $code_inscription=$row['code_inscription'];
  $id=$row['id'];
  $recu=$row['recu'];  
  $idsession=$row['idSession'];  
  $name=ucfirst($row['prenom']).' '.ucfirst($row['nom']);
  $startdate= $row['startdate'];
  $enddate= $row['enddate'];
  $withdrawal_date = $row['withdrawl_date'];
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


 ?>

<table width="800" align="left" border="0">
	<tr>
 <td colspan="2" align="left" style="padding-top:25px" valign="top"><img src="../../administrator/images/aul2.jpg" alt="" /></td> 
    </tr>
<br /><br />

	<tr>
      <td ><span class="bold">Receipt N° : </span><?php echo $recu; ?></td>
		<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold">Student Name: </span><?php echo $name; ?></td>


    </tr>
	<br/>
  <tr height="5">
    <td colspan="1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">
    <br />
	  
		<br /><br />
    <table style="border-collapse:collapse; padding:1px" border="1" cellspacing="1" width="100%">
        <tr>

            <th>Session</th>
            <th> Start Date </th>
            <th> End Date</th>
          <!--  <th>Amount Paid</th>-->
            <th>Withdrawal Date</th>
            <th>Week of Refund</th>
             <th>Courses</th>
              <th>Refund</th>
               <th>Paid by</th>
               <th>Paid Date</th>
              <!-- <th>Expected Payment Date</th>
                <th>Method of reimbursement</th>-->

           
        </tr>   
              <tr align="center">

           <td><?php  $sqlsession="select session,annee_academique from tbl_session where idSession='$idsession'";
          $reqsession=@mysql_query($sqlsession) or die ("erreur lors de la s�lection des paiements");
          $rowsession=mysql_fetch_assoc($reqsession);
          echo $rowsession['session'].' '.$rowsession['annee_academique']; ?></td>
           <td><?php 
                
            $date = date("Y-m-d", strtotime($startdate));
                $tab=split('[/.-]',$date);
           echo $tab[1].'-'.$tab[2].'-'.$tab[0]; ?>
             
           </td>

           <td><?php 
           $date = date("Y-m-d", strtotime($enddate));
                $tab=split('[/.-]',$date);
           echo $tab[1].'-'.$tab[2].'-'.$tab[0]; ?>
             
           </td>
       
           <td><?php
           // $refunddate=$row['refunddate'];
         $tab=split('[/.-]',$withdrawal_date);
        echo $tab[1].'-'.$tab[2].'-'.$tab[0]; ?></td>
          
             <td><?php if(!empty( $row['weekrefund']))
             {echo $row['weekrefund'];}else { echo '-';} ?></td>
              <td><?php if(!empty( $row['percentage']))
             {echo $row['percentage'];}else { echo '-';} ?></td>
                <td><?php echo "$".$row['refundamount']; ?></td>
                 <td><?php if(!empty($method))
                {echo $method;}
                else { echo '-';} ?></td>
                <td><?php  if ($paymentdate == '0000-00-00')
{
 echo '-';
} else
{
  $date2 = date("Y-m-d", strtotime($paymentdate));
                $tab=split('[/.-]',$date2);
        echo $tab[1].'-'.$tab[2].'-'.$tab[0];
}
              ?>
                
              
         </tr>

         <?php


  ?>
</table>
  <br /><br /><br />
        	<table width="100%" style="font-size:10px; color:#36C">
               <tr> 
      
        
                    <td  width="50%" align="center">American School of Leadership,1507 S Hiawassee Rd Suite 114 Orlando, Florida 32835<br />
                                    PH: 407-745-1700    /  
                                    E-MAIL : CONTACT@AMERICANHIGH.US<br />
                                    WEBSITE : WWW.EDU.AMERICANHIGH.US
                    </td>
            
              </tr>
</table>

</div>
</body>
</html>
