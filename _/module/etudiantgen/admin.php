<style type="text/css">
  .valider{
    width: 100%;
    background-color: #c16862;
    border-color: #fff;
    color: #fff;
  }
</style>
<?php
$user_ids = array(2,51,54,45,3,60);
$user_id = $_SESSION['admin_id_user'];
		$niveau=$filiere=$annee=$where=$code=$search=$sgroupe=$annee_inscription=$elearning=$search_student=$school='';
		$groupeFilter=" ";



	     if((isset($_POST['tous'])) && (!empty($_POST['tous']))){
	    	$niveau=$filiere=$annee=$where=$code=$search=$annee_inscription=$sgroupe='';
			unset($_SESSION['niveau']);
			unset($_SESSION['filiere']);
			unset($_SESSION['annee_etude']);
			unset($_SESSION['annee_inscription']);
			unset($_SESSION['search_student']);
			unset($_SESSION['elearning']);
			unset($_SESSION['school']);
	   																}



	   else{

	     //nom ou prenom comme crit&eacute;re

					 if((isset($_POST['search_student'])) && (!empty($_POST['search_student'])) ){
						$search_student = $_SESSION['search_student'] = addslashes(trim($_POST['search_student']));
						$groupeFilter="";
						$where = $where." and nom like '%".$search_student."%' or prenom like '%".$search_student."%'";
																				  }
					  else if( (isset($_POST['search_student'])) && (empty($_POST['search_student'])) ){
  	                            unset($_SESSION['search_student']);
 						                                                          }

						else if( (isset($_SESSION['search_student']))&& (!empty($_SESSION['search_student'])) ){
								 $groupeFilter="";
								 $search_student=$_SESSION['search_student'];
								 $where = $where." and nom like '%".$search_student."%' or prenom like '%".$search_student."%'";							                                                                  }

				              //groupe comme crit&eacute;re

					 if((isset($_POST['groupe'])) && (!empty($_POST['groupe'])) ){
						$sgroupe = $_SESSION['sgroupe'] = $_POST['groupe'];
						$groupeFilter="";
						$where = $where." and e.groupe=".$sgroupe;
																				  }
					  else if( (isset($_POST['groupe'])) && (empty($_POST['groupe'])) ){
  	                            unset($_SESSION['sgroupe']);
 						                                                          }

						else if( (isset($_SESSION['sgroupe']))&& (!empty($_SESSION['sgroupe'])) ){
								 $groupeFilter="";
								 $sgroupe=$_SESSION['sgroupe'];
								 $where = $where." and e.groupe=".$sgroupe;									                                                                  }
									//fili&eacute;re comme critere



						if( (isset($_POST['filiere'])) && (!empty($_POST['filiere'])) ){
							$filiere = $_SESSION['filiere'] = $_POST['filiere'];
							$where = $where." and e.filiere='". $filiere."'";
																					   }
							else if((isset($_POST['filiere'])) && (empty($_POST['filiere']))){
  	                          unset($_SESSION['filiere']);
 						                                                                       }
					            else if( (isset($_SESSION['filiere'])) && (!empty($_SESSION['filiere'])) ){
								 $filiere=$_SESSION['filiere'];
  	                          	 $where = $where." and e.filiere='". $filiere."'";
						                                                                                  }
									//ann&eacute;e d'&eacute;tude  comme crit&egrave;re

							 if( (isset($_POST['annee_etude'])) && (!empty($_POST['annee_etude'])) ){
								$annee = $_SESSION['annee_etude'] = $_POST['annee_etude'];
								$where =$where." and  e.annee = '".$annee."'";
																									}

									else if( (isset($_POST['annee_etude'])) && (empty($_POST['annee_etude'])) ){
  	                                                  unset($_SESSION['annee_etude']);
						                                                                            }

								else if( (isset($_SESSION['annee_etude'])) && (!empty($_SESSION['annee_etude'])) ){
								   $annee=$_SESSION['annee_etude'];
  	                               $where = $where." and  e.annee = '".$annee."'";
						                                                                            }

                       	//ann&eacute;e d'inscription  comme crit&eacute;re

							 if( (isset($_POST['annee_inscription'])) && (!empty($_POST['annee_inscription'])) ){
								$annee_inscription = $_SESSION['annee_inscription'] = $_POST['annee_inscription'];
								$where =$where." and  e.annee_inscription = '".$annee_inscription."'";
																												}

									else if( (isset($_POST['annee_inscription'])) && (empty($_POST['annee_inscription'])) ){
  	                                                  unset($_SESSION['annee_inscription']);
						                                                                           						   }

								else if( (isset($_SESSION['annee_inscription'])) && (!empty($_SESSION['annee_inscription'])) ){
								   $annee_inscription = $_SESSION['annee_inscription'];
  	                               $where = $where." and  e.annee_inscription = '".$annee_inscription."'";
						                                                                            						  }

								  //Elearning  comme crit&eacute;re

							 if( (isset($_POST['elearning'])) && ($_POST['elearning']!='') ){
								$elearning = $_SESSION['elearning'] = $_POST['elearning'];
								$where =$where." and  e.elearning = '".$elearning."'";
																												}

									else if( (isset($_POST['elearning'])) && ($_POST['elearning']=='') ){
  	                                                  unset($_SESSION['elearning']);
						                                                                           						   }

								else if( (isset($_SESSION['elearning'])) && ($_SESSION['elearning']!='') ){
								   $elearning = $_SESSION['elearning'];
  	                               $where = $where." and  e.elearning = '".$elearning."'";
						                                                                            						  }

							//school  comme crit&eacute;re

							 if( (isset($_POST['school'])) && ($_POST['school']!='') ){
								$school = $_SESSION['school'] = $_POST['school'];
								if ($school== 'piimt'){$where =$where." and  e.piimt = 1";}
								elseif($school== 'aul'){$where =$where." and  e.aul = 1";}
								elseif($school== 'umt'){$where =$where." and  e.umt = 1";}

																												}

									else if( (isset($_POST['school'])) && ($_POST['school']=='') ){
  	                                                  unset($_SESSION['school']);
						                                                                           						   }

								else if( (isset($_SESSION['school'])) && ($_SESSION['school']!='') ){
								   $school = $_SESSION['school'];
  	                               if ($school== 'piimt'){$where =$where." and  e.piimt = 1";}
								   elseif($school== 'aul'){$where =$where." and  e.aul = 1";}
								   elseif($school== 'umt'){$where =$where." and  e.umt = 1";}


						                                                                            						  }

							 if( (isset($_POST['status'])) && ($_POST['status'] != "") ){

								$archive = $_SESSION['status'] = $_POST['status'];
								if ($archive=='0')
								{$where =$where." and  archive= 0";}
								else if ($archive=='1')
								 {$where =$where." and  archive = 1";}
								 else if ($archive=='2')
								 {$where =$where." and  archive = 2 ";}
								else if ($archive=='3')
								 {$where =$where." and  archive = 3 ";}


																									}

									else if( (isset($_POST['status'])) && (empty($_POST['status'])) ){
  	                                                  unset($_SESSION['status']);
						                                                                            }

								else if( (isset($_SESSION['status'])) && (!empty($_SESSION['status'])) ){
								   $archive=$_SESSION['status'];
  	                              if ($archive=='0')
								{$where =$where." and  archive = 0";}
								else if ($archive=='1')
								 {$where =$where." and  archive = 1";}
								 else if ($archive=='2')
								 {$where =$where." and  archive = 2 ";}
								else if ($archive=='3')
								 {$where =$where." and  archive = 3 ";}
						                                                                            }


						                                                                            //Campus  comme Critere

  if( (isset($_POST['campus'])) && (!empty($_POST['campus'])) ){
    $prefixe = $_SESSION['campus'] = $_POST['campus'];
    $where =$where." and  prefixe = '".$prefixe."'";
  }

  else if( (isset($_POST['campus'])) && (empty($_POST['campus'])) ){
    unset($_SESSION['campus']);
  }

  else if( (isset($_SESSION['campus'])) && (!empty($_SESSION['campus'])) ){
    $prefixe=$_SESSION['campus'];
    $where = $where." and  prefixe = '".$prefixe."'";
  }

						                                                                            						  //Files  comme Critere

  if( (isset($_POST['fil'])) && ($_POST['fil']!= "") ){
    $files = $_SESSION['fil'] = $_POST['fil'];
    $where =$where." and  files = '".$files."'";
  }

  else if( (isset($_POST['fil'])) && (empty($_POST['fil'])) ){
    unset($_SESSION['fil']);
  }

  else if( (isset($_SESSION['fil'])) && (!empty($_SESSION['fil'])) ){
    $files=$_SESSION['fil'];
    $where = $where." and  files = '".$files."'";
  }

 if( (isset($_POST['onsiteS'])) && ($_POST['onsiteS']!= "") ){
    $onsite = $_SESSION['onsiteS'] = $_POST['onsiteS'];
    $where =$where." and  onsite = '".$onsite."'";
  }else if( (isset($_POST['onsiteS'])) && (empty($_POST['onsiteS'])) ){
    unset($_SESSION['onsiteS']);
  }else if( (isset($_SESSION['onsiteS'])) && (!empty($_SESSION['onsiteS'])) ){
    $onsite=$_SESSION['onsiteS'];
    $where = $where." and  onsite = '".$onsite."'";
  }

                       	//ann&eacute;e d'inscription  comme crit&eacute;re

							if( (isset($_POST['date'])) && ($_POST['date']!= "") ){
    $date = $_SESSION['date'] = $_POST['date'];

    $date1=$date+1;
    $where =$where." and   date_inscription BETWEEN '$date-06-21' AND '$date1-06-20'";
  }else if( (isset($_POST['date'])) && (empty($_POST['date'])) ){
    unset($_SESSION['date']);
  }else if( (isset($_SESSION['date'])) && (!empty($_SESSION['date'])) ){
    $date=$_SESSION['date'];
    $date1=$date+1;
    $where = $where." and date_inscription BETWEEN '$date-06-21' AND '$date1-06-20'";
  }




	      }
	  $sql = "SELECT distinct(`code_inscription`),concat(nom, ' ' ,prenom) as name,
	 		 tel,  date_inscription, annee,acces,ville,groupe,prefixe ,files,onsite,archive,email
	 		 FROM tbl_etudiant_algeria
        where archive!=10 " . $where. $groupeFilter. "
UNION
        SELECT distinct(`code_inscription`),concat(nom, ' ' ,prenom) as name,
	 		 tel,  date_inscription, annee,acces,ville,groupe,prefixe ,files,onsite,archive,email FROM tbl_etudiant_benin
        where archive!=10 ". $where. $groupeFilter. "
UNION
        SELECT distinct(`code_inscription`),concat(nom, ' ' ,prenom) as name,
	 		 tel,  date_inscription, annee,acces,ville,groupe,prefixe ,files ,onsite,archive,email FROM tbl_etudiant_burkina
        where archive!=10 ". $where. $groupeFilter. "
UNION
        SELECT distinct(`code_inscription`),concat(nom, ' ' ,prenom) as name,
	 		 tel,  date_inscription, annee,acces,ville,groupe,prefixe ,files ,onsite,archive,email FROM 	tbl_etudiant_cameroun
        where archive!=10 ". $where. $groupeFilter. "
        UNION
        SELECT distinct(`code_inscription`),concat(nom, ' ' ,prenom) as name,
	 		 tel,  date_inscription, annee,acces,ville,groupe,prefixe ,files,onsite,archive,email FROM tbl_etudiant_morocco
        where archive!=10 ". $where. $groupeFilter. "
          UNION
        SELECT distinct(`code_inscription`),concat(nom, ' ' ,prenom) as name,
	 		 tel,  date_inscription, annee,acces,ville,groupe,prefixe,files,onsite,archive,email  FROM tbl_etudiant_GUES
        where archive!=10 ". $where. $groupeFilter. "
         UNION
        SELECT distinct(`code_inscription`),concat(nom, ' ' ,prenom) as name,
	 		 tel,  date_inscription, annee,acces,ville,groupe,prefixe,files,onsite,archive,email  FROM tbl_etudiant_rabat
        where archive!=10 ". $where. $groupeFilter. "
        UNION
        SELECT distinct(`code_inscription`),concat(nom, ' ' ,prenom) as name,
	 		 tel,  date_inscription, annee,acces,ville,groupe,prefixe,files,onsite,archive,email  FROM tbl_etudiant_casa
	 		    where archive!=10 ". $where. $groupeFilter. "   
UNION
        SELECT distinct(`code_inscription`),concat(nom, ' ' ,prenom) as name,
	 		 tel,  date_inscription, annee,acces,ville,groupe,prefixe,files,onsite,archive,email  FROM tbl_etudiant_usa
        where archive!=10 ". $where. $groupeFilter. "  ORDER BY name ";

?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td class="titre">&nbsp;&nbsp;Listing Students </td>
	<td width="150">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>

		<!-- <td valign="top" align="center">
		   <a href="gestion_des_etudiants_gen.php?new=oui">
		  <div class="ajouter"></div>
		  New</a>
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
					 chemin='gestion_des_etudiants_gen.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }"> <div class="modifier"></div>
		  Edit</a>
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
				        xyz=document.adminMenu.notefoupasf.value;

					 chemin='gestion_des_etudiants_gen.php?detail='+chemin;
					   window.location.replace(chemin);


				   }

				   " ><div class="detail"></div>
		   Information</a>
   		  </td>

		   <?php $id_user = $_SESSION['admin_id_user'] ;
		  if($id_user != '23' ){?>
		  <td valign="top" align="center">
		   <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='transcript.php?code_inscription='+chemin;


				     window.location.replace(chemin);

				   }

				   "><div class="buletin"></div>Transcript </a>
		  </td>

		 <?php } ?>
		  <td valign="top" align="center" >
		  <a href="gestion_des_etudiants_gen.php?laureat" title="laureat">
		  <div class="detail"></div><?php echo 'Alumni'; ?></a>
		  </td>

		</tr>
	  </table>

	</td>

  </tr>

</table>

 <table width="100%" cellspacing="1" border="0"  class="adminlist" >
 <form action="#" method="post" name="adminMenu" >

<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="notefoupasf" value="0" />

<div class="container_search">

	  <select name="status" class="search">
		<option value=""><?php echo 'Status'; ?></option>
		<option value="0"<?=($archive=='0') ? $selected : '' ?>>Active</option>
        <option value="1"<?=($archive=='1') ? $selected : '' ?>>Alumni</option>
		<option value="2"<?=($archive=='2') ? $selected : '' ?>>Withdrawal</option>
		<option value="3"<?=($archive=='3') ? $selected : '' ?>>Rejected</option>


	  </select>

		 <select name="fil" class="search">
  <option value=""><?php echo 'Files'; ?></option>
  <option value="0"<?=($files=='0') ? $selected : '' ?>>Incomplete</option>
  <option value="1"<?=($files=='1') ? $selected : '' ?>>Complete</option>


  </select>

   <select name="onsiteS" class="search">
  <option value=""><?php echo "Location"; ?></option>
  <option value="0"<?php echo ($onsite=='0') ? $selected : '' ?>>No</option>
  <option value="1"<?php echo ($onsite=='1') ? $selected : '' ?>>Onsite</option>
  <option value="2"<?php echo ($onsite=='2') ? $selected : '' ?>>SKI</option>
  <option value="3"<?php echo ($onsite=='3') ? $selected : '' ?>>Both</option>


  </select>
  <select name="campus" class="search">
  <option value=""><?php echo 'Campus'; ?></option>
  <option value="ORL" <?=($prefixe=='ORL') ? $selected : '' ?>>USA</option>
   <option value="AG" <?=($prefixe=='AG') ? $selected : '' ?>>ALGERIA</option>
    <option value="BF" <?=($prefixe=='BF') ? $selected : '' ?>>BURKINA FASO</option>
     <option value="MOR" <?=($prefixe=='MOR') ? $selected : '' ?>>INTERNATIONAL</option>
      <option value="RB" <?=($prefixe=='RB') ? $selected : '' ?>>RABAT</option>
       <option value="CB" <?=($prefixe=='CB') ? $selected : '' ?>>CASA BLANCA</option>
  <option value="GS" <?=($prefixe=='GS') ? $selected : '' ?>>AGADIR</option>
  <option value="BN" <?=($prefixe=='BN') ? $selected : '' ?>>BENIN</option>
  <option value="CAM" <?=($prefixe=='CAM') ? $selected : '' ?>>CAMEROUN</option>



  </select>
  <select name="date" class="search">

  <option value=""><?php echo "Registration Date" ?></option>
 
  <option value="2011"<?=($date=='2011') ? $selected : '' ?>>2011-2012</option>
  <option value="2012"<?=($date=='2012') ? $selected : '' ?>>2012-2013</option>
  <option value="2013"<?=($date=='2013') ? $selected : '' ?>>2013-2014</option>
  <option value="2014"<?=($date=='2014') ? $selected : '' ?>>2014-2015</option>
  <option value="2015"<?=($date=='2015') ? $selected : '' ?>>2015-2016</option>
  <option value="2016"<?=($date=='2016') ? $selected : '' ?>>2016-2017</option>
  <option value="2017"<?=($date=='2017') ? $selected : '' ?>>2017-2018</option>
  <option value="2018"<?=($date=='2018') ? $selected : '' ?>>2018-2019</option>
  <option value="2019"<?=($date=='2019') ? $selected : '' ?>>2019-2020</option>

<option value="2020"<?=($date=='2020') ? $selected : '' ?>>2020-2021</option>
<option value="2021"<?=($date=='2021') ? $selected : '' ?>>2021-2022</option>



  </select>
	<input type="checkbox" class="input" name="export" value="1" style="width: 15px;margin-left: 5px;"   /> Export


   		   <input type="text" class="input" name="search_student" style="width:125px" value="<?php echo $search_student?>"  />
		   <input type="submit" vname="valider" value="Submit" class="input"  />
		   <input type="submit" value="All" name="tous" class="input"  />
		    <?php if (isset($_POST['export']) && $_POST['export'] == 1) { ?>
				 <a href="students1.xls" target="_blank">Download Students</a>
			 <?php } ?>
  </div>

  <tr align="center">
		 <th width="43">#</th>
		 <th width="43">&nbsp;</th>
		 <th width="43"><?php echo 'Code'; ?></th>
		 <th width="272"><?php echo 'Name'; ?></th>
		 <th width="272"><?php echo 'Status'; ?></th>
		  <th width="272"><?php echo 'Registration Date'; ?></th>
		 <!-- <th width="272"><?php echo 'Accreditation Students'; ?></th>-->
		   <th width="125"><?php echo 'Complete File'; ?></th>
		  <th width="125"><?php echo 'Onsite File'; ?></th>

      <?php if (in_array($user_id,$user_ids)): ?>
        <th width="125"><?php echo 'Registration'; ?></th>
      <?php endif; ?>


   </tr>


	  <?php
		 $i=0;
		 $total = @mysql_query($sql) or die("erreur lors de s&eacute;lection des &eacute;tudiants");
		 $url = $_SERVER['PHP_SELF']."?limit=";
		 $nblignes = mysql_num_rows($total);
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);
		 while ($ligne = mysql_fetch_array($result)) {
		 $i++;
		 $ci=$ligne["code_inscription"];
		 $prefixe=$ligne["prefixe"];
		   ?>

	   <tr height="17px"  class="<?php echo $ci; ?>" prefixe="<?php echo $prefixe; ?>" height="17px">
	 <td align="center">&nbsp;<?=$i?>
	 	<td align="center"><input type="radio" id="<?=$ci?>" name="id" value="<?=$ci?>" onClick="document.adminMenu.boxchecked.value='<?php echo $ci.'&prefixe='.$prefixe.'&gen=2';?>'" onmousedown="document.adminMenu.notefoupasf.value=<?php echo "'".$prefixe."'";?>" /></td>
		 <!--
		 <td align="center">
		 <input type="radio" id="<?=$ci?>" name="id" value="<?=$ci?>"onClick="document.adminMenu.boxchecked.value='<?=$ci?>'" /></td>-->

		 <td class="gras">&nbsp;<?=$prefixe.$ci?></td>
		 <td>&nbsp;<?=ucfirst(stripslashes($ligne["name"]))?></td>
		  <td>&nbsp;<?php if($ligne['archive']== '0')
		  { echo 'Active';}
		  else  if($ligne['archive']== '1')
		  { echo 'Alumni';}
		else  if($ligne['archive']== '2')
		  { echo 'Withdrawal';}
		  else  if($ligne['archive']== '3')
		  { echo 'Rejected';}?></td>
		 <!-- <td>&nbsp;<?php if($ligne['groupe']== '2')
		  { echo 'FH';}
		  else  if($ligne['groupe']== '3')
		  { echo 'FE';} else { echo' ';}?></td>-->
		 <td>&nbsp;<?php
		$date=$ligne["date_inscription"];
		$tab=split('[/.-]',$date);
		echo $tab[1].'-'.$tab[2].'-'.$tab[0];

		?>

	</td>
	<!--	<td class="td_edit" style="text-align: center;" id="" value="finance">
      <?php
 		$sqlZin="select code_inscription,prefixe from tbl_etudiant_all where code_inscription='$ci' and prefixe='$prefixe' ";
		$a1= @mysql_query($sqlZin) or die ('Failure to select branches');
  		$row = mysql_fetch_assoc($a1);
		 $code = $row['code_inscription'];
		 $pre=$row['prefixe'];

      if ($code == $ci and $pre == $prefixe)
      	{ ?>
        <img src="../images/yes.png" border="0" width="18" height="18">
      <?php } else { ?>

        <img src="../images/non.ico" border="0" width="18" height="18">

      <?php } ?>
    </td>-->
	<td class="finance_input_<?php echo $ci; ?>" style="display:none;">
		<input type="radio" name="finance"  value="1" <?php if ($code == $ci and $pre == $prefixe ){echo "checked";} ?>></input> Yes <br>
		<input type="radio" name="finance"  value="0" <?php if ($code != $ci and $pre != $prefixe ){echo "checked";} ?>></input> No <br>

 		<button class="valider" type="button" value="finance" >Confirm</button>
    </td>
     <td class="td_edit" style="text-align: center;" id="" value="files">
          <?php
          if ($ligne["files"] == 0)
          { ?>
            <img src="../images/non.ico" border="0" width="18" height="18">
            <?php } else if ($ligne["files"] == 1) { ?>

              <img src="../images/yes.png" border="0" width="18" height="18">

              <?php }  ?>
              </td>
              <td class="files_input_<?php echo $ci; ?>" style="display:none;">
              <input type="radio" name="files"  value="1" <?php if ($ligne["files"]  == 1) {echo "checked";} ?>></input> Yes <br>
              <input type="radio" name="files"  value="0" <?php if ($ligne["files"]  == 0) {echo "checked";} ?>></input> No <br>
              <button class="valider" type="button" value="files" >Confirm</button>
              </td>



               <td class="td_edit" style="text-align: center;" id="" value="onsite">
          <?php
          if ($ligne["onsite"] == 0)
          { echo 'NO'; ?>
            <!--<img src="../images/non.ico" border="0" width="18" height="18">-->
          <?php }
            else if ($ligne["onsite"] == 1)
            { echo 'ONSITE'; ?>

     <!--<img src="../images/yes.png" border="0" width="18" height="18"> -->
     <?php }
       else if ($ligne["onsite"] == 2)
            { echo 'SKI'; ?>

     <!--<img src="../images/yes.png" border="0" width="18" height="18"> -->
     <?php }
       else if ($ligne["onsite"] == 3)
            { echo 'BOTH'; ?>

     <!--<img src="../images/yes.png" border="0" width="18" height="18"> -->
     <?php } ?>
              </td>
              <td class="onsite_input_<?php echo $ci; ?>" style="display:none;">
              <input type="radio" name="onsite"  value="1" <?php if ($ligne["onsite"]  == 1) {echo "checked";} ?>></input> ONSITE <br>
              <input type="radio" name="onsite"  value="2" <?php if ($ligne["onsite"]  == 2) {echo "checked";} ?>></input> SKI <br>
              <input type="radio" name="onsite"  value="3" <?php if ($ligne["onsite"]  == 3) {echo "checked";} ?>></input> BOTH <br>
              <input type="radio" name="onsite"  value="0" <?php if ($ligne["onsite"]  == 0) {echo "checked";} ?>></input> NO <br>
              <button class="valider" type="button" value="onsite" >Confirm</button>
              </td>
              <?php if (in_array($user_id,$user_ids)): ?>
                <td style="text-align:center">
                    <a target="_blank" href="/administrator/registration.php?inscription=<?php echo $ci ?>&prefixe=<?php echo $prefixe; ?>">Courses</a>
                </td>
              <?php endif; ?>
	</tr>
		 <?php
		  }
		 ?>

   </form>

</table>
  <div id='pagination' align='center'>
         <?php echo pagination($url,$parpage,$nblignes,$nbpages);  ?>
  </div>
  <?php if (isset($_POST['export']) && $_POST['export'] == 1) {

	 $total = @mysql_query($sql) or die("erreur lors de s&eacute;lection des &eacute;tudiants");
	 $data_exported = array();
	// $data_exported[0] = array("#","Code","Name","email","Status","Registration Date","Complete File","Onsite File","Credits");
	 $data_exported[0] = array("#","Code","Name","email","Status","Registration Date","Complete File","Onsite File");
	 $i = 0;
	 while ($ligne = mysql_fetch_array($total)) {
	 $i++;
	 $ci=$ligne["code_inscription"];
	 $cin=$ligne["cin"];
	 $prefixe=$ligne["prefixe"];
	 $email = $ligne['email'];


	 		$data_exported[$i][] = $i;
	 		$data_exported[$i][] = $prefixe.$ci;
			$data_exported[$i][] = ucfirst(stripslashes($ligne["name"]));
			$data_exported[$i][] = $email;
	 		if($ligne['archive']== '0')
			{
				$data_exported[$i][] = 'Active';
			}
			else  if($ligne['archive']== '1')
			{
				$data_exported[$i][] = 'Alumni';
			}
			else  if($ligne['archive']== '2')
			{
				$data_exported[$i][] = 'Withdrawal';
			}
			else  if($ligne['archive']== '3')
			{
				$data_exported[$i][] = 'Rejected';
			}
			$date=$ligne["date_inscription"];
			$tab=split('[/.-]',$date);
			$data_exported[$i][] = $tab[1].'-'.$tab[2].'-'.$tab[0];

			if ($ligne["files"]  == 1)
			 {$data_exported[$i][] = 'Yes';}
			else { $data_exported[$i][] = 'No';}

			if ($ligne["onsite"]  == 1)
			 {$data_exported[$i][] = 'Yes';}
			else { $data_exported[$i][] = 'No';}

	  if($prefixe=='MOR')
         {  $tbl_note='tbl_note_morocco';}
         else  if($prefixe=='AG')
         {     $tbl_note='tbl_note_algeria';}
         else if($prefixe=='ORL')
         {   $tbl_note='tbl_note_usa'; }
         if($prefixe=='BN')
         {    $tbl_note='tbl_note_benin';    }
       if($prefixe=='BF')
         {  $tbl_note='tbl_note_burkina';   }
         elseif ($prefixe=='CAM')
         {  $tbl_note='tbl_note_cameroun';   }
      elseif ($prefixe=='GS')
         {  $tbl_note='tbl_note_GUES';   }


/*$sql2="select e.prefixe,e.code_inscription,e.nom, e.prenom, e.archive,e.`date_inscription`,e.`graduation_date`, sum(nbr_credit)as total
       from tbl_etudiant_all e, $tbl_note n, tbl_cours c
       where
          e.code_inscription=n.code_inscription
          and n.code_cours=c.code_cours
          and(n.letter_grade!='F' and n.letter_grade!='X' and n.letter_grade!='I' and n.letter_grade!='W' and n.letter_grade!='F*' )
          and e.prefixe= '$prefixe' ";

        $res= @mysql_query($sql2) or die('Erreur :: Student information2');
          
	 $row2 = @mysql_fetch_assoc($res);
	 $total=$row2['total'];
	 $data_exported[$i][] = $total;*/




		}
	//	var_dump($data_exported);

	 if (isset($_POST['export']) && $_POST['export'] == 1) {
		 $excel = new ExportDataExcel('file');
		 $excel->filename = "students1.xls";

		 $excel->initialize();
		 foreach ($data_exported as $row) {
			 $excel->addRow($row);
		 }
		 $excel->finalize();


	 }
 }
		?>
<script type="text/javascript">

  jQuery('body').keyup(function(event){
    if ( event.which == 27 ) {
      var ancien_id = jQuery("#open").parent().attr('class');
      var type = jQuery("#open").attr('value');
      jQuery("."+type+"_input_"+ancien_id).hide();
      jQuery("#open").slideDown();
      jQuery("#open").attr('id','');
      jQuery("#open_input").hide();
      jQuery("#open_input").attr('id','');

    }
    if (event.which == 13) {
      alert("don't use enter to update, please click on 'Confirm' to confirm thank you.");
    }
  });

  jQuery(".td_edit").click(function(){
    var type =  jQuery(this).attr('value');
    var id = jQuery(this).parent().attr('class');
    var ancien_id = jQuery("#open").parent().attr('class');
    jQuery("."+type+"_input_"+ancien_id).hide();
    jQuery("#open").slideDown();
    jQuery("#open").attr('id','');
    jQuery("#open_input").hide();
    jQuery("#open_input").attr('id','');
    jQuery(this).hide();
    var selector = "."+type+"_input_"+id;
    jQuery(selector).slideDown();
    jQuery(selector).attr('id','open_input');
    jQuery(this).attr('id','open');
  });

  jQuery(".valider").click(function(){
      var type =  jQuery(this).attr('value');
      var id = jQuery(this).parent().parent().attr('class');
      var value = jQuery("#open_input>input:checked").val();

      var ancien_value = jQuery("#open_input").attr('valueancien');
      var prefixe = jQuery(this).parent().parent().attr('prefixe');
      if (ancien_value != value) {
          jQuery.ajax({
              dataType: "html",
              evalscripts:true,
              type: "POST",
              url: 'gestion_des_etudiants_gen.php?ajaxmod',
              data: ({type:type,id:id,value:value,prefixe:prefixe}),
              beforeSend: function(){

              },
              success: function (data, textStatus){
                  jQuery('#open').html(value);
                  var ancien_id = jQuery("#open").parent().attr('class');
                  var type = jQuery("#open").attr('value');
                  jQuery("."+type+"_input_"+ancien_id).hide();

                    if (value == 1) {
                      jQuery('#open').html('<img src="../images/yes.png" border="0" width="18" height="18">');
                    }
                    if (value == 0) {
                      jQuery('#open').html('<img src="../images/non.ico" border="0" width="18" height="18">');
                    }


                  jQuery("#open").slideDown();
                  jQuery("#open").attr('id','');
                  jQuery("#open_input").hide();
                  jQuery("#open_input").attr('id','');

              }
          });
        }else{
          var ancien_id = jQuery("#open").parent().attr('class');
          var type = jQuery("#open").attr('value');
          jQuery("."+type+"_input_"+ancien_id).hide();
          jQuery("#open").slideDown();
          jQuery("#open").attr('id','');
          jQuery("#open_input").hide();
          jQuery("#open_input").attr('id','');
        }

  });


</script>
