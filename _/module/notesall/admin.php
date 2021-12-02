<?php
       $where=$code_cours=$code_cour="";
   	   if((isset($_POST['code_cours'])) && (!empty($_POST['code_cours'])) ){
  	   $code_cours = $_POST['code_cours'];
  	   ?>
 	   <script language="javascript1.2">
 	   window.location.replace("gestion_notes_all.php?code_cours=<?=$code_cours?>");
 	   </script>
 	   <?php
 	                                                                         }

 	   if((isset($_POST['code_cour'])) && (!empty($_POST['code_cour'])) ){
  	   $code_cour = $_POST['code_cour'];
  	   ?>
 	   <script language="javascript1.2">
 	   window.location.replace("gestion_notes_all.php?code_cours=<?=$code_cour?>");
 	   </script>
 	   <?php
 	                                                                     }


  	   else{


 // if( (isset($_POST['annee_etude'])) && (!empty($_POST['annee_etude'])) ){
	// 							$annee = $_SESSION['annee_etude'] = $_POST['annee_etude'];
	// 							$where =$where." and  n.cohort = '$annee'";
	// 																								}
 //
	// 								else if( (isset($_POST['annee_etude'])) && (empty($_POST['annee_etude'])) ){
 //  	                                                  unset($_SESSION['annee_etude']);
	// 					                                                                            }
 //
	// 							else if( (isset($_SESSION['annee_etude'])) && (!empty($_SESSION['annee_etude'])) ){
	// 							   $annee=$_SESSION['annee_etude'];
 //  	                               $where = $where." and  n.cohort = '$annee'";
	// 					                                                                            }
	// 					                                                                             //session comme critère
 //
 // 			 if( (isset($_POST['idSession'])) && (!empty($_POST['idSession'])) ){
 //  					 $idSession = $_SESSION['NidSession'] = $_POST['idSession'];
 //   	                 $where = $where." AND n.idSession='". $idSession."'";
 // 					                                                        }
 //
	// 			else if( (isset($_POST['idSession'])) && (empty($_POST['idSession'])) ){
 //   	                      unset($_SESSION['NidSession']);
 //  						                                                          }
 //
	// 				else if( (isset($_SESSION['NidSession'])) && (!empty($_SESSION['NidSession'])) ){
	// 					   $idSession=$_SESSION['NidSession'];
 //   	                       $where = $where." AND n.idSession='".$idSession."'";
 //  						                                                   }
	// 						   else{
	// 						            $_SESSION['NidSession']=$idSession;
	// 									$where=$where." AND n.idSession='".$idSession."'";
	// 							   }
 //


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
 		  // $sql="SELECT concat(e.nom,' ', e.prenom) as name, e.annee, n.code_inscription,n.cohort,n.idSession
		  // from  tbl_note_all as n, tbl_etudiant_all as e
	    //   where n.code_inscription = e.code_inscription
		  // ". $where. " group by name ";


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


 		 //show the session


		//   $sql1="select idSession, session, annee_academique
		// 		from $tbl_session where idSession=$idSession limit 1";
    //
    //
		// $req=@mysql_query($sql1) ;
		// $row=mysql_fetch_assoc($req);
		// $idSession=$_SESSION['IidSession']=$row['idSession'];
		// $session = $row['session'];
		// $annee = $row['annee_academique'];

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre"><?php echo 'Listing Grades' ; ?></td>
	<td width="22%">&nbsp;</td>
  </tr>
</table>
<table width="100%" align="center" cellspacing="1"  class="adminlist" >
<form action="#" method="post" name="adminMenu" id="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<div class="container_search">
<!-- <select name="idSession" class="search" >
 <?php
      $sql2="select idSession, session, annee_academique,academic_year   from $tbl_session  order by annee_academique, session";
 	  $req2=@mysql_query($sql2) or die("erreur lors de la sélection des sessions");
 	  while ($row = mysql_fetch_assoc($req2)){
	  $is=$row['idSession'];
	  $ns=$row['session'].' '.$an=$row['annee_academique'];
	  	$cc=$row['academic_year'];
 	  ?>
 	  <option  value="<?=$is?>" <?=($idSession==$is) ? $selected : ''?>><?=$ns?></option>
	  <?php
	  }
	  ?>
  </select> -->
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
<input type="submit" name="valider" value="<?php echo 'submit'; ?>" />
<input type="submit" value="<?php echo 'all'; ?>" name="tous" />
 </div>

  <tr >
     <th width="15" align="center">#</th>
	 <th width="100">code</th>
	 <th width="600"><?php echo 'name'; ?></th>

  </tr>

       <?php
        $i=0;
        $req=@mysql_query($sql) or die ('Failure to select STUDENTS');
  	    while ($ligne = mysql_fetch_assoc($req)) {
	    $i++;
 	    $ci=$ligne["code_inscription"];
      $prefixe = $ligne["prefixe"];
      ?>

  <tr>
      <td align="center" width="15px"><?=$i?></td>
	  <td align="left"><a href="gestion_notes_all.php?code_inscription=<?=$ci?>&prefixe=<?php echo $prefixe; ?>"><?=$prefixe.$ci?></a></td>
	  <td align="left">&nbsp;<?=ucfirst($ligne["name"])?></td>
	 <!-- <td align="center">&nbsp;<?=ucfirst(strtolower($ligne['annee']))?></td>-->
  </tr>

<?php
      }
?>
</form>
<tr class="gras">
	<td colspan="5"><?php echo translate('registrations'); ?>  : <?=$i?></td>
</tr>
 </table>
