 <style type="text/css">
 .hacking{
 margin-top:-5px !Important;
 margin-top:0;
 padding:0;
  }
 
 .hacking1 { margin-top:-5px !Important;
 margin-top:0;
 padding:0;
}
</style>
 <?php
        $where=$search=$annee=$search_student_absence=$search_student=$vil=$niv=$search_recu='';
		
																									 
	   
		$default_date = date('Y').'/'.(date('Y')+1);
		  if((isset($_POST['tous'])) && !empty($_POST['tous']) && $_POST['tous']=='tous'){
			 $where = '';
			 unset($_SESSION['paiement_annee']);
  	   															}
			
			    
if((isset($_POST['search_student'])) && (!empty($_POST['search_student'])) ){
						$search_student = $_SESSION['search_student'] = addslashes(trim($_POST['search_student']));
						$groupeFilter="";
						$where = $where." and (e.nom like '%".$search_student."%' or e.prenom like '%".$search_student."%') ";
																				  }
					  else if( (isset($_POST['search_student'])) && (empty($_POST['search_student'])) ){
  	                            unset($_SESSION['search_student']);
 						                                                          }

						else if( (isset($_SESSION['search_student']))&& (!empty($_SESSION['search_student'])) ){ 
								 $groupeFilter="";
								 $search_student=$_SESSION['search_student'];
								 $where = $where." and ( e.nom like '%".$search_student."%' or e.prenom like '%".$search_student."%' )";
								 							                                                                  }
								 
					 if( (isset($_POST['vil'])) && (!empty($_POST['vil'])) ){
								$ville = $_SESSION['vil'] = $_POST['vil'];
								$where =$where." and  e.ville = '".$ville."'";
																									}

									else if( (isset($_POST['vil'])) && (empty($_POST['vil'])) ){
  	                                                  unset($_SESSION['vil']);
						                                                                            }
																									
								else if( (isset($_SESSION['vil'])) && (!empty($_SESSION['vil'])) ){
								   $ville=$_SESSION['vil'];
  	                               $where = $where." and  e.ville = '".$ville."'";
						                                                                            }
								if( (isset($_POST['niv'])) && (!empty($_POST['niv'])) ){
								$niveau = $_SESSION['niv'] = $_POST['niv'];
								$where =$where." and  e.niveau = '".$niveau."'";
																									}

									else if( (isset($_POST['niv'])) && (empty($_POST['niv'])) ){
  	                                                  unset($_SESSION['niv']);
						                                                                            }
																									
								else if( (isset($_SESSION['niv'])) && (!empty($_SESSION['niv'])) ){
								   $niveau=$_SESSION['niv'];
  	                               $where = $where." and  e.niveau = '".$niveau."'";
						                                                                            }
																									
if((isset($_POST['search_recu'])) && (!empty($_POST['search_recu'])) ){
						$search_recu = $_SESSION['search_recu'] = addslashes(trim($_POST['search_recu']));
						$groupeFilter="";
						$where = $where." and p.recu like '%".$search_student."%'";
																				  }
					  else if( (isset($_POST['search_recu'])) && (empty($_POST['search_recu'])) ){
  	                            unset($_SESSION['search_recu']);
 						                                                          }

						else if( (isset($_SESSION['search_recu']))&& (!empty($_SESSION['search_recu'])) ){ 
								 $groupeFilter="";
								 $search_recu=$_SESSION['search_recu'];
								 $where = $where." and p.recu like '%".$search_recu."%'";
								 							                                                                  }

                                                     

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Tuition and Fees&nbsp;&nbsp;</td>
	<td width="22%">
	
	<!--top menu-->
	  <table border="0" align="right" width="50%" cellpadding="0" cellspacing="12" id="link" >
	    <tr>
		 <!--<td valign="top" align="center">
		   <a href="gestion_paiement.php?new_fiche=oui"><div class="ajouter"></div>Nouveau</a>
		  </td>-->
          <td valign="top" align="center">
		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_finance_burkina.php?modifier='+chemin;
				     window.location.replace(chemin);

				   }

				   " title="modifier une fiche"><div class="modifier"></div>Edit</a>

		  </td>
 		   <td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer"><div class="imprimer"></div>Print</a>
		  </td>
		</tr>

	  </table>
	</td> 
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist" style="margin-top:2px">
  <form action="" method="post" name="adminMenu">
    <input type="hidden" name="boxchecked" value="0" />
    <div class="container_search">   	
	  <input type="text" class="input" name="search_student" style="width:125px" value="<?php echo $search_student?>"  />
			
      <input name="submit" type="submit" class="input" value="Submit" vname="valider" />
    
    </div>
    <tr>
      <th width="19" align="center">#</th>
  <th width="20">&nbsp;</th>
      <th width="100">Name</th>
	  <th width="84">Program Tuition</th>
      <th width="114">Courses Fees</th>
       <th width="84">Reinstatement</th>     
       <th width="84">Returned Check </th>
        <th width="84">Transcript</th>
         <th width="84">Diploma</th>
      <th width="67">Amount Paid</th>
      <th width="88">Rest</th>
      <!--<th width="226">Remarks</th>-->
    </tr>
    <?php
     $i=0;
	 $total_bourse = $total_frais_etude = $total_reste = $total_payee = 0;
     $sql = "SELECT DISTINCT e.code_inscription, CONCAT(e.nom,' ', e.prenom) AS name, f.*,e.tel ,e.ville,f.prefixe
		 FROM tbl_etudiant_burkina AS e, tbl_finance_burkina AS f
		 WHERE  e.code_inscription = f.code_inscription ". $where."  GROUP BY e.code_inscription ORDER BY name";
			
							 
	 $req=@mysql_query($sql) or die('erreur de selection des paiements');  
	 //var_dump($sql);
 	 while ($row = mysql_fetch_array($req)) {
	 $i++;
	 $id =  $row['id'];
	 $ci =  $row['code_inscription'];
	 $tel =  $row['tel'];
	  $prefixe =  $row['prefixe'];
	 $Replacement =  $row['Replacement'];
	 $nbre=$row['nbre'];
	 $remarquegen =  $row['remarquegen'];
	 $sum="select sum(somme) as somme from  tbl_finance_paiement_burkina where code_inscription='$ci' ";                                   
       $req12=@mysql_query($sum) or die('erreur de selection des paiements');
          $row12 = mysql_fetch_assoc($req12);
       $somme = $row12["somme"];


	  $reste = ((int)$row["frais_etude"]+((int)$row['frais_inscription']*100)+(int)$row["Reinstatement"]+(int)$row["Returned"]+((int)$row["Replacement"]*$nbre)+(int)$row["Diploma"]+(int)$row["uspostal"]+(int)$row["fedex"])-($somme);
	 $total_frais_inscription +=(int)$row["frais_inscription"];
	 $total_frais_etude +=(int)$row["frais_etude"];
	 $total_reste +=(int)$reste;
	 $total_payee +=(int)$row["payee"];
	 $name = ucfirst($row['name']);
 ?>
    <tr align="center">
      <td><b>
        <?=$i?>
      </b></td>
 <td><input type="radio" name="id" value="<?=$ci?>" onclick="document.adminMenu.boxchecked.value='<?=$ci?>'" /></td>
      <td align="left">&nbsp;<a href="gestion_finance_burkina.php?detail=<?=$ci;?>" >
        <?=$name?>
      </a></td>
	  
	 <td>&nbsp;
          <?=number_format($row["frais_etude"])?></td>
      <td>&nbsp;
          <?=number_format($row["frais_inscription"]*100)?></td>
          <td>&nbsp;
          <?=number_format($row["Reinstatement"])?></td>
         
          <td>&nbsp;
          <?=number_format($row["Returned"])?></td>
     
           <td>&nbsp;
          <?=number_format($row["Replacement"]*$nbre)?></td>
          <td>&nbsp;
          <?=number_format($row["Diploma"])?></td>
     
      <td>&nbsp;
          <?php 
$sum="select sum(somme) as somme from  tbl_finance_paiement_burkina where code_inscription='$ci' ";                                   
       $req12=@mysql_query($sum) or die('erreur de selection des paiements');
          $row12 = mysql_fetch_assoc($req12);
       $somme = $row12["somme"];

       echo number_format($somme);?></td>
      <td >&nbsp;
	  <b><font color="#0033FF">
          <?php 

//$total=$row["frais_inscription"]+$row["frais_etude"]+$row["Replacement"];
//$reste=$total-$somme;
         echo number_format($reste);?></b></font></td>
		
	  
    </tr>
    <?php
      }
      ?>
   <!-- <tr class="gras">
	
      <td colspan="3">&nbsp; Total: </td>
	   <td align="center">&nbsp;
          <?=number_format($total_frais_inscription)?></td>
      <td align="center">&nbsp;
          <?=number_format($total_frais_etude)?></td>
     		
      <td align="center">&nbsp;
          <?=number_format($total_payee)?></td>
      <td align="center">&nbsp;
          <?=number_format($total_reste)?></td>
    </tr>-->
  </form>
</table>
