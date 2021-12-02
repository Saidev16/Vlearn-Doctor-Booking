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
$ordering=' GROUP BY nom ';


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
								 $where = $where." and (e.nom like '%".$search_student."%' or e.prenom like '%".$search_student."%')";
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

							 if( (isset($_POST['status'])) && ($_POST['status'] != "") ){

								$archive = $_SESSION['status'] = $_POST['status'];
								if ($archive=='0')
								{$where =$where." and  e.archive= 0";}
								else if ($archive=='1')
								 {$where =$where." and  e.archive = 1";}
								 else if ($archive=='2')
								 {$where =$where." and  e.archive = 2 ";}



																									}

									else if( (isset($_POST['status'])) && (empty($_POST['status'])) ){
  	                                                  unset($_SESSION['status']);
						                                                                            }

								else if( (isset($_SESSION['status'])) && (!empty($_SESSION['status'])) ){
								   $archive=$_SESSION['status'];
  	                              if ($archive=='0')
								{$where =$where." and  e.archive = 0";}
								else if ($archive=='1')
								 {$where =$where." and  e.archive = 1";}
								 else if ($archive=='2')
								 {$where =$where." and  e.archive = 2 ";}
							                       }

						                                                                            	$date = "";
if( (isset($_POST['date'])) && ($_POST['date']!= "") ){
		$date = $_SESSION['date'] = $_POST['date'];
		$date1=$date+1;
		$date2=$date+2;
		if ($date < 2017) {
			$where =$where."  and (graduation_date ='0000-00-00' or graduation_date ='0000-00-01' or  graduation_date BETWEEN  '$date-09-01' AND '$date2-08-31' )";
		}else{
			$where .= " and r.year = $date";
		}
		/* $where =$where." and  date_inscription < '$date1-07-31' and (graduation_date ='0000-00-00' or graduation_date ='0000-00-01' or  graduation_date BETWEEN  '$date-09-01' AND '$date1-08-31'  or graduation_date >='$date-09-01')";

		*/
		// $where =$where." and   date_inscription BETWEEN '$date-06-21' AND '$date1-06-20'";
}else if( (isset($_POST['date'])) && (empty($_POST['date'])) ){
		unset($_SESSION['date']);
}else if( (isset($_SESSION['date'])) && (!empty($_SESSION['date'])) ){
		$date=$_SESSION['date'];
		$date1=$date+1;
		$date2=$date+2;
		if ($date < 2017) {
			$where =$where."  and (graduation_date ='0000-00-00' or graduation_date ='0000-00-01' or  graduation_date BETWEEN  '$date-09-01' AND '$date2-08-31' )";
		}else{
			$where .= " and r.year = $date ";
		}
		// $where = $where." and date_inscription BETWEEN '$date-06-21' AND '$date1-06-20'";
		/*
		$where =$where."  and  date_inscription < '$date1-07-31' and (graduation_date ='0000-00-00' or graduation_date ='0000-00-01' or  graduation_date BETWEEN  '$date-09-01' AND '$date1-08-31' or graduation_date >='$date-09-01')";*/
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
					 chemin='gestion_finance.php?modifier='+chemin;
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
     <!-- <?php
			$sql="SELECT DISTINCT annee FROM tbl_finance";
			$res = @mysql_query($sql) or die ('Error :: SELECT YEARS');
			?>
        <select name="paiement_annee" id="paiement_annee" class="input select hacking">
        <?php
			while ($row = mysql_fetch_assoc($res)){
			$year=$row['annee']
			?>
        <option value="<?=$year?>" <?=$year==$paiement_annee ? $selected : ''?>><?=$year?>
        </option>
        <?php
			}
			?>
      </select>
	 <select name="vil" class="search">
		<option value="">Ville</option>
        <option value="Rabat" <?=($ville=='Rabat') ? $selected : '' ?>>Rabat</option>
        <option value="Casablanca" <?=($ville=='casablanca') ? $selected : '' ?>>Casablanca</option>
        <option value="Marrakech" <?=($ville=='marrakech') ? $selected : '' ?>>Marrakech</option>

	  </select>
	   <select name="niv" class="search">
		<option value="">Niveau</option>
        <option value="BBA" <?=($niveau=='BBA') ? $selected : '' ?>>BBA</option>
        <option value="MBA" <?=($niveau=='MBA') ? $selected : '' ?>>MBA</option>
        <option value="MASTER" <?=($niveau=='MASTER') ? $selected : '' ?>>MASTER</option>

	  </select>-->
	  <select name="date" class="search">

  <option value=""><?php echo "Active Student/Year" ?></option>

  <option value="2017"<?=($date=='2017') ? $selected : '' ?>>2017-2018</option>
  <option value="2018"<?=($date=='2018') ? $selected : '' ?>>2018-2019</option>
  <option value="2019"<?=($date=='2019') ? $selected : '' ?>>2019-2020</option>

<option value="2020"<?=($date=='2020') ? $selected : '' ?>>2020-2021</option>



  </select>

	   <select name="status" class="search">
		<option value=""><?php echo 'Status'; ?></option>
		<option value="0"<?=($archive=='0') ? $selected : '' ?>>Active</option>
        <option value="1"<?=($archive=='1') ? $selected : '' ?>>Alumni</option>
		<option value="2"<?=($archive=='2') ? $selected : '' ?>>Withdrawal</option>


	  </select>

		    <input type="text" class="input" name="search_student" style="width:125px" value="<?php echo $search_student?>"  />

		   <!-- <input type="text" class="input" name="search_recu" style="width:125px" value="<?php echo "$search_recu"?>"  />-->
      <input name="submit" type="submit" class="input" value="Submit" vname="valider" />
     <!-- <input type="submit" value="tous" name="tous" class="input" />-->
    </div>
    <tr>
      <th width="19" align="center">#</th>
   <th width="20">&nbsp;</th>
      <th width="100">Name</th>

      <th width="114">Registration Fees</th>
      <th width="84">Program Tuition</th>
       <th width="84">Scholarships</th>
      <th width="67">Amount Paid</th>
       <th width="88">Refund</th>
      <th width="88">Amount to pay</th>

    </tr>
    <?php
     $i=0;
	 $total_bourse = $total_frais_etude = $total_reste = $total_payee = 0;
       $sql = "SELECT DISTINCT e.code_inscription, CONCAT(e.nom,' ', e.prenom) AS name, f.*,e.tel ,e.ville,f.prefixe
		 FROM tbl_etudiant_all AS e, tbl_finance AS f,registration_academic as r
		 WHERE r.`code_inscription` = e.code_inscription and r.`prefixe` = e.prefixe  and e.prefixe=f.prefixe and e.code_inscription = f.code_inscription ". $where.$ordering."

			 ORDER BY name";
							 //var_dump($sql);
	 $req=@mysql_query($sql) or die('erreur de selection des paiements');
 	 while ($row = mysql_fetch_array($req)) {
	 $i++;
	 $id =  $row['id'];
	 $ci =  $row['code_inscription'];
	 $tel =  $row['tel'];
	  $prefixe =  $row['prefixe'];
	 $remarque =  $row['remarque'];
	 $remarquegen =  $row['remarquegen'];
	  $sum="select sum(somme) as somme from  tbl_finance_paiement where code_inscription='$ci' and prefixe = '$prefixe' ";
                        $req12=@mysql_query($sum) or die('erreur de selection des paiements2');
                        $row12 = mysql_fetch_assoc($req12);
                        $somme = $row12["somme"];
      $ref="select refundamount from  refund where code_inscription='$ci' and prefixe='$prefixe' ";                                    //var_dump($sum);
                        $req12=@mysql_query($ref) or die('erreur de selection des paiements');
                        $row12 = mysql_fetch_assoc($req12);
                        $refundamount = $row12["refundamount"];

	 $reste = ((int)$row["frais_etude"]+(int)$row['frais_inscription']+(int)$row["frais_ceremonie"]+(int)$row["divers"])-((int)$row["bourse"]+$somme+$refundamount);
	 /*$$total_frais_inscription +=(int)$row["frais_inscription"];
	 $total_frais_etude +=(int)$row["frais_etude"];
	 $total_reste +=(int)$reste;
	 $total_payee +=(int)$row["payee"];*/
	 $name = ucfirst($row['name']);
 ?>
    <tr align="center">
      <td><b>
        <?=$i?>
      </b></td>
     <td><input type="radio" name="id" value="<?=$id?>" onclick="document.adminMenu.boxchecked.value='<?=$id?>'" /></td>
      <td align="left">&nbsp;<a href="gestion_finance.php?detail=<?=$ci;?>&amp;prefixe=<?=$prefixe;?>       " >
        <?=$name?>
      </a></td>


      <td>&nbsp;
          <?=number_format($row["frais_inscription"])?></td>
      <td>&nbsp;
          <?=number_format($row["frais_etude"])?></td>
         <td>&nbsp;
          <?=number_format($row["bourse"])?></td>

      <td>&nbsp;
          <?=number_format($somme)?></td>
          <td>&nbsp;
          <?=number_format($refundamount)?></td>
      <td >&nbsp;
	  <b><font color="#0033FF">
          <?=number_format($reste)?></b></font></td>
		<!--<td>
		<p align="center"><?php echo $row[remarquegen];?></p>
	 </td>-->

    </tr>
    <?php
      }
      ?>
   <!-- <tr class="gras">

      <td colspan="2">&nbsp; Total: </td>
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
