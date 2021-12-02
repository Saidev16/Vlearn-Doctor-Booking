<?php
		$niveau=$filiere=$annee=$where=$code=$search=$sgroupe=$annee_inscription=$elearning=$search_student=$school=$status='';
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
						$where = $where." and e.nom like '%".$search_student."%' or e.prenom like '%".$search_student."%'";
																				  }
					  else if( (isset($_POST['search_student'])) && (empty($_POST['search_student'])) ){
  	                            unset($_SESSION['search_student']);
 						                                                          }

						else if( (isset($_SESSION['search_student']))&& (!empty($_SESSION['search_student'])) ){
								 $groupeFilter="";
								 $search_student=$_SESSION['search_student'];
								 $where = $where." and e.nom like '%".$search_student."%' or e.prenom like '%".$search_student."%'";							                                                                  }

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
								{$where =$where." and  e.archive= 0";}
								else if ($archive=='1')
								 {$where =$where." and  e.archive = 1";}
								 else if ($archive=='2')
								 {$where =$where." and  e.archive = 2 ";}
								else if ($archive=='3')
								 {$where =$where." and  e.archive = 3 ";}


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
								else if ($archive=='3')
								 {$where =$where." and  e.archive = 3 ";}
						                                                                            }



  	//ann&eacute;e d'inscription  comme crit&eacute;re
		$date = "";
		 $date3=$date-2;
if( (isset($_POST['date'])) && ($_POST['date']!= "") ){
		$date = $_SESSION['date'] = $_POST['date'];
		$date1=$date+1;
		$date2=$date+2;
		if ($date < 2017) {
			$where =$where." and  date_inscription<'$date2-07-01'  and (graduation_date ='0000-00-00' or graduation_date ='0000-00-01' or  graduation_date BETWEEN  '$date-09-01' AND '$date2-08-31' )";
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
			$where =$where." and date_inscription<'$date2-07-01'  and  (graduation_date ='0000-00-00' or graduation_date ='0000-00-01' or  graduation_date BETWEEN  '$date-09-01' AND '$date2-08-31' )";
		}else{
			$where .= " and r.year = $date ";
		}
		// $where = $where." and date_inscription BETWEEN '$date-06-21' AND '$date1-06-20'";
		/*
		$where =$where."  and  date_inscription < '$date1-07-31' and (graduation_date ='0000-00-00' or graduation_date ='0000-00-01' or  graduation_date BETWEEN  '$date-09-01' AND '$date1-08-31' or graduation_date >='$date-09-01')";*/
}



	      }

	/* $sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name,
	 		 e.tel, f.nom_filiere, e.date_inscription, g.title, e.annee,e.acces,e.ville
			 FROM $tbl_etudiant_burkina as e, $tbl_filiere as f, $tbl_groupe as g
			 where e.filiere=f.id_filiere and e.groupe=g.id and groupe != 99 AND e.archive = 0"
			 . $where. $groupeFilter. " GROUP BY e.code_inscription ORDER BY name ";*/
			// var_dump($date);
			if ( $date < 2017 ) {
				  $sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, e.cin,e.tel,e.email,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
	 			 ,e.new_transcript FROM tbl_etudiant_all as e
	 			 where    (new_transcript=1 or new_transcript=2) "
	 			 . $where. $groupeFilter. " ORDER BY name ";
			}
			else
			 {
				  $sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, e.cin,e.tel,e.email,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
	 			 ,e.new_transcript FROM tbl_etudiant_all as e , registration_academic as r
	 			 where  e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe  and (e.new_transcript=1 or e.new_transcript=2) "
	 			 . $where . $groupeFilter. " ORDER BY name ";
			}

			// $sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, e.cin,e.tel,e.email,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
		 // ,e.new_transcript FROM tbl_etudiant_all as e
		 // where e.new_transcript=1 ORDER BY name ";




		//SELECT count(*) FROM `tbl_etudiant_all` as e , registration_academic as r WHERE e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe and r.year = 2017

?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td class="titre">&nbsp;&nbsp;Student Roster</td>
	<td width="150">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>

		<!-- <td valign="top" align="center">
		   <a href="gestion_des_etudiants_all.php?new=oui">
		  <div class="ajouter"></div>
		  New</a>
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

					 chemin='gestion_des_etudiants_all.php?modifier='+chemin+'&foupasf='+xyz;

				     window.location.replace(chemin);






				   }"> <div class="modifier"></div>
		  Advising/ Resolutions</a>
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
				      xyz=document.adminMenu.notefoupasf.value;
					 chemin='gestion_des_etudiants_all.php?detail='+chemin+'&foupasf='+xyz;
				    window.location.replace(chemin);

				   }

				   " ><div class="detail"></div>
		   Information</a>
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

					 chemin='gestion_des_etudiants_all.php?ild='+chemin+'&foupasf='+xyz;


					  window.location.replace(chemin);

				   }

				   " ><div class="detail"></div>
		   ILP</a>
   		  </td>

      <!--  <td valign="top" align="center">
		   <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants_all.php?CLSC='+chemin;

				     window.location.replace(chemin);

				   }

				   " ><div class="detail"></div>
		   Class Schedule</a>
   		  </td>
     -->
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
				     xyz=document.adminMenu.notefoupasf.value;

					 	 chemin='transcript.php?code_inscription='+chemin+'&prefixe='+xyz+'&gen=1';

				     window.location.replace(chemin);

				   }

				   "><div class="buletin"></div>Transcript </a>
		  </td>

		 <?php } ?>
		  <!--<td valign="top" align="center" >
		  <a href="gestion_des_etudiants_all.php?laureat" title="laureat">
		  <div class="detail"></div><?php echo 'Alumni'; ?></a>
		  </td>
		   <td valign="top" align="center" >
		  <a href="gestion_des_etudiants_all.php?rejected" title="rejected">
		  <div class="detail"></div><?php echo 'Rejected'; ?></a>
		  </td>-->
           <td valign="top" align="center">
		   <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionnez un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				      chemin=document.adminMenu.boxchecked.value;
				      xyz=document.adminMenu.notefoupasf.value;

					 chemin='gestion_des_etudiants_all.php?supprimer='+chemin+'&foupasf='+xyz;

				     window.location.replace(chemin);

				   }

				   "><div class="delete"></div>
		   Delete
		   </a>
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

	  <select name="date" class="search">

		  <option value=""><?php echo "Active Student/Year" ?></option>
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
  </select>
				<input type="checkbox" class="input" name="export" value="1" style="width: 15px;margin-left: 5px;"   /> Export
   		   <input type="text" class="input" name="search_student" style="width:125px" value="<?php echo $search_student?>"  />
		   <input type="submit" vname="valider" value="Submit" class="input"  />
		   <input type="submit" value="All" name="tous" class="input"  />
			 <?php if (isset($_POST['export']) && $_POST['export'] == 1) { ?>
				 <a href="students.xls?<?php echo time(); ?>" target="_blank">Download Students</a>
			 <?php } ?>
  </div>

  <tr align="center">
		 <th width="43">#</th>
		 <th width="43">&nbsp;</th>
		 <th width="43"><?php echo 'Code'; ?></th>
		 <th width="272"><?php echo 'Name'; ?></th>
		 <th width="272"><?php echo 'Status'; ?></th>
		  <th width="272"><?php echo 'Registration Date'; ?></th>



   </tr>


	  <?php
		 $i=0;
		 //var_dump($sql);
		 $total = @mysql_query($sql) or die("erreur lors de s&eacute;lection des &eacute;tudiants");
		 $url = $_SERVER['PHP_SELF']."?limit=";
		 $nblignes = mysql_num_rows($total);
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);
		 while ($ligne = mysql_fetch_array($result)) {
		 $i++;
		 $ci=$ligne["code_inscription"];
		 $cin=$ligne["cin"];
		 $prefixe=$ligne["prefixe"];
		 $new_transcript = $ligne["new_transcript"];

		   ?>

	   <tr height="17px">

	 <td align="center">&nbsp;<?=$i?>

	 	<td align="center">
			<input type="radio" id="<?=$ci?>" name="id" value="<?=$ci?>"onClick="document.adminMenu.boxchecked.value='<?=$ci?>'"
			onmousedown="document.adminMenu.notefoupasf.value=<?php echo "'".$prefixe."'";?>" />
		</td>






 <td class="gras">
	 &nbsp;<?php echo $prefixe.$ci;?>
 </td>
		<!-- <td class="gras">&nbsp;<?php echo'ASL'.$cin;?></td>-->
		 <td>&nbsp;
			 <?php echo ucfirst(stripslashes($ligne["name"]));
			 ?>
		 </td>
		  <td>&nbsp;<?php
			if($ligne['archive']== '0')
			{ echo 'Active';
			}
			else  if($ligne['archive']== '1')
			{ echo 'Alumni';
			}
		else  if($ligne['archive']== '2')
			{ echo 'Withdrawal';
			}
			else  if($ligne['archive']== '3')
			{ echo 'Rejected';
			}
			//var_dump($new_transcript);
			// 	if ($new_transcript != 1) {
			// 			if($ligne['archive']== '0')
			// 		  { echo 'Active';
			// 			}
			// 		  else  if($ligne['archive']== '1')
			// 		  { echo 'Alumni';
			// 			}
			// 		else  if($ligne['archive']== '2')
			// 		  { echo 'Withdrawal';
			// 			}
			// 		  else  if($ligne['archive']== '3')
			// 		  { echo 'Rejected';
			// 			}
			// 	}else{
			// 		 $tbl_note = "tbl_note_acc";
			// 		 $conditions_s = " and prefixe = '$prefixe' ";
			// 		 $sql10="SELECT sum(nbr_credit) as total FROM $tbl_note as n, tbl_cours as c
			// 		 where n.code_cours = c.code_cours and n.code_inscription= '$ci' and n.archive = 0 and n.letter_grade != 'X' $conditions_s ";
			// 		  //var_dump($sql10);
			// 		 $req2=@mysql_query($sql10) or die("erreur lors du chargements  des données");
			//
			// 		 $row=mysql_fetch_assoc($req2);
			//
			// 		 $total_cr = $row['total'];
			//
			// 		 $status_s = "";
			// 		 $archive = 0;
			// 		if($total_cr < 24)
			// 		{
			// 			$archive = 0;
			// 			$status_s = 'Active';
			// 		}
			// 		if($total_cr >= 24)
			// 		{
			// 			$archive = 1;
			// 			$status_s = 'Alumni';
			// 		}
			//
			// 		if ($prefixe == 'MOR' && in_array($ci,array(268,298,295,300))) {
			// 			$archive = 2;
			// 			$status_s = "Withdrawal";
			// 		}
			// 		if ($prefixe == 'BF' && in_array($ci,array(379,371,383))) {
			// 			$archive = 2;
			// 			$status_s = "Withdrawal";
			// 		}
			//
			// 		//  $sql_udpate_s = "UPDATE `tbl_etudiant_all` SET archive = $archive WHERE  code_inscription = '$ci' and prefixe = '$prefixe' and new_transcript = 1";
			// 		//  var_dump($sql_udpate_s);
			// 		//  mysql_query($sql_udpate_s);
			// 		// echo $ligne['archive'];
			// 		// echo $archive;
			// 		echo $status_s;
			// }


			?>

		</td>
		 <td>&nbsp;<?php
		$date=$ligne["date_inscription"];
		$tab=split('[/.-]',$date);
		echo $tab[1].'-'.$tab[2].'-'.$tab[0];
		?></td>

	<!--	 <td>&nbsp;<?=html_entity_decode($ligne["title"])?></td>
		 <td>&nbsp;<?=htmlentities($ligne["annee"])?></td>
		 <td>&nbsp;<?=ucfirst(stripslashes($ligne["nom_filiere"]))?></td>
		 <td>&nbsp;<?=$ligne["date_inscription"]?></td>
		  <td>&nbsp;<?=$ligne["ville"]?></td>
		 <td align="center"> <a href="gestion_des_etudiants_burkina.php?acces=<?=$ligne["acces"]==0 ? 1 : 0 ?>&user_id=<?=$ligne["code_inscription"]?>"><?=$ligne["acces"]=='0' ? $non : $oui ?></a></td>-->
	</tr>
		 <?php
		  }
		 ?>


   </form>

</table>
  <div id='pagination' align='center'>
         <?php echo pagination($url,$parpage,$nblignes,$nbpages);
		 ?>
  </div>
	 <?php if (isset($_POST['export']) && $_POST['export'] == 1) { ?>
	<?php
	//var_dump($sql);
		if ( $date < 2017 ) {
				$sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, e.cin,e.tel,e.email,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
			 ,e.new_transcript FROM tbl_etudiant_all as e
			 where e.export = 0 and   (new_transcript=1 or new_transcript=2) "
			 . $where. $groupeFilter. " ORDER BY name ";
		}
		else
		 {
				$sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, e.cin,e.tel,e.email,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
			 ,e.new_transcript FROM tbl_etudiant_all as e , registration_academic as r
			 where e.export = 0 and  e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe  and (e.new_transcript=1 or e.new_transcript=2) "
			 . $where . $groupeFilter. " ORDER BY name ";
		}
	 $total = @mysql_query($sql) or die("erreur lors de s&eacute;lection des &eacute;tudiants");
	 $data_exported = array();
	 //$data_exported[0] = array("#","Code","Name","email","Status","Registration Date","Graduation Date","Total Credit");
	  $data_exported[0] = array("#","Code","Name");
	 $i = 0;
	 while ($ligne = mysql_fetch_array($total)) {
		 $i++;
		 $ci=$ligne["code_inscription"];
		 $cin=$ligne["cin"];
		 $prefixe=$ligne["prefixe"];
		 $email = $ligne['email'];
		 $new_transcript = $ligne['new_transcript'];
		 $conditions_s = "";
		 if ( $new_transcript == '1' ) {
			 $tbl_note = "tbl_note_acc";
			 $conditions_s = " and prefixe = '$prefixe' ";
		 }
		 else
		{
			if($prefixe=='MOR')
					 {   $tbl_note='tbl_note_morocco';}
					 else  if($prefixe=='AG')
					 {   $tbl_note='tbl_note_algeria';}
					 else if($prefixe=='ORL')
					 {   $tbl_note='tbl_note_usa'; }
				 else   if($prefixe=='BN')
					 {   $tbl_note='tbl_note_benin';    }
				else  if($prefixe=='BF')
					 {   $tbl_note='tbl_note_burkina';   }
					 else if ($prefixe=='CAM')
					 {  $tbl_note='tbl_note_cameroun';   }
				else if ($prefixe=='GS')
					 {  $tbl_note='tbl_note_GUES';   }

	 }



	   $sql10="SELECT sum(nbr_credit) as total FROM $tbl_note as n, tbl_cours as c
		 where n.code_cours = c.code_cours and n.code_inscription= '$ci' and n.archive = 0 and n.letter_grade not in ('X') $conditions_s ";
		 // var_dump($sql10);
		 $req2=@mysql_query($sql10) or die("erreur lors du chargements  des données");

	   $row=mysql_fetch_assoc($req2);

		 $total_cr = $row['total'];

	 		$data_exported[$i][] = $i;
	 		$data_exported[$i][] = $prefixe.$ci;
			$data_exported[$i][] = ucfirst(stripslashes($ligne["name"]));
			// $data_exported[$i][] = $email;
			//
			// $status_s = "";

			// if($total_cr < 24)
			// {
			// 	$status_s = 'Active';
			// }
			// if($total_cr >= 24)
			// {
			// 	$status_s = 'Alumni';
			// }
			//
			// if ($prefixe == 'MOR' && $ci == 268) {
	    //   $status_s = "Withdrawal";
	    // }
	    // if ($prefixe == 'MOR' && $ci == 295) {
	    //   $status_s = "Withdrawal";
	    // }
	    // if ($prefixe == 'MOR' && $ci == 300) {
	    //   $status_s = "Withdrawal";
	    // }
	    // if ($prefixe == 'BF' && $ci == 379) {
	    //   $status_s = "Withdrawal";
	    // }
			// if ($prefixe == 'BF' && $ci == 371) {
			//  $status_s = "Withdrawal";
			// }

		// 	if($ligne['archive']== '0')
		// 	{ $status_s = 'Active';
		// 	}
		// 	else  if($ligne['archive']== '1')
		// 	{ $status_s = 'Alumni';
		// 	}
		// else  if($ligne['archive']== '2')
		// 	{ $status_s = 'Withdrawal';
		// 	}
		// 	else  if($ligne['archive']== '3')
		// 	{ $status_s = 'Rejected';
		// 	}
		//
		//
		// 	$data_exported[$i][] = $status_s;
		//
		// 	$date=$ligne["date_inscription"];
		// 	$tab=split('[/.-]',$date);
		// 	$di =  $tab[1].'-'.$tab[2].'-'.$tab[0];
		// 	$data_exported[$i][] = $di;
		//
		// 	$date1=$ligne["graduation_date"];
		// 	$tab1=split('[/.-]',$date1);
		// 	$data_exported[$i][] = $tab1[1].'-'.$tab1[2].'-'.$tab1[0];
		//
		//
		//
		//
		// 	 $data_exported[$i][] = $total_cr;

	?>
	 <?php
		}
		//var_dump($data_exported);
	 ?>

	 <?php
	 if (isset($_POST['export']) && $_POST['export'] == 1) {
		 $excel = new ExportDataExcel('file');
		 $excel->filename = "students.xls";

		 $excel->initialize();
			 foreach ($data_exported as $k => $row) {
				 $excel->addRow($row);
			 }
		 $excel->finalize();


	 }
 }
		?>
