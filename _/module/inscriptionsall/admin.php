<?php
        $where=$groupe=$search=$pci=$type='';

	   if((isset($_POST['search_par_code'])) && (!empty($_POST['search_par_code'])) ){
		   $search = addslashes(trim($_POST['search_par_code']));
		   $where ="  AND c.code_cours like '".$search."%'";
 	                                                                                 }

	   if((isset($_POST['search_par_title'])) && (!empty($_POST['search_par_title'])) ){
		   $search = addslashes(trim($_POST['search_par_title']));
		   $where ="  AND c.titre like '".$search."%'";
                                                                                        }	
	   if((isset($_POST['code_inscription'])) && (!empty($_POST['code_inscription'])) ){
	   $pci=trim($_POST['code_inscription']);
	   ?>
	   <script language="javascript1.2">
	   <!--
	   		window.location.replace('gestion_inscription_burkina.php?code_inscription=<?=$pci?>');
	   -->
	   </script>
	   	<?php																   }
	       

	   else{

                 

 /* if( (isset($_POST['annee_etude'])) && (!empty($_POST['annee_etude'])) ){
								$annee = $_SESSION['annee_etude'] = $_POST['annee_etude'];
								$where =$where." and  i.cohort = '$annee'";
																									}

									else if( (isset($_POST['annee_etude'])) && (empty($_POST['annee_etude'])) ){
  	                                                  unset($_SESSION['annee_etude']);
						                                                                            }
																									
								else if( (isset($_SESSION['annee_etude'])) && (!empty($_SESSION['annee_etude'])) ){
								   $annee=$_SESSION['annee_etude'];
  	                               $where = $where." and  i.cohort = '$annee'";
						                                                                            }
									 
									                    //session comme critère 

 			/* if( (isset($_POST['idSession'])) && (!empty($_POST['idSession'])) ){
  					 $idSession = $_SESSION['NidSession'] = $_POST['idSession'];
   	                 $where = $where." AND i.idSession='". $idSession."'";
 					                                                        }
 
				else if( (isset($_POST['idSession'])) && (empty($_POST['idSession'])) ){
   	                      unset($_SESSION['NidSession']);
  						                                                          }
 
					else if( (isset($_SESSION['NidSession'])) && (!empty($_SESSION['NidSession'])) ){
						   $idSession=$_SESSION['NidSession'];
   	                       $where = $where." AND i.idSession='".$idSession."'";
  						                                                   }
							   else{
							            $_SESSION['NidSession']=$idSession;
										$where=$where." AND i.idSession='".$idSession."'";
								   }
*/
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

 
 	 /* $sql="SELECT c.titre, i.code_cours,i.cohort, count(i.code_inscription) as inscription from 
 		tbl_cours as c, tbl_inscription_cours_all as i, tbl_etudiant_all as e
		where i.code_cours = c.code_cours  
		AND i.code_inscription=e.code_inscription ". $where." GROUP BY c.code_cours ORDER BY c.titre"; */

      if ( $date < 2017 ) {
				  $sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, e.cin,e.tel,e.email,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
	 			 ,e.new_transcript , c.titre, i.code_cours FROM tbl_etudiant_all as e ,  tbl_note_acc as i ,tbl_cours as c
	 			 where    i.code_cours = c.code_cours  and i.code_inscription=e.code_inscription  and (new_transcript=1 or new_transcript=2) "
	 			 . $where. $groupeFilter. " ORDER BY name ";
			}
			else
			 {
				  $sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, e.cin,e.tel,e.email,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
	 			 ,e.new_transcript ,c.titre, i.code_cours FROM tbl_etudiant_all as e ,  tbl_note_acc as i , registration_academic as r ,tbl_cours as c
	 			 where i.code_cours = c.code_cours  and i.code_inscription=e.code_inscription  and  e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe  and (e.new_transcript=1 or e.new_transcript=2) "
	 			 . $where . $groupeFilter. " ORDER BY name ";
			}
		
		//show the session 
		
                      
		 /* $sqlsql="select  session, annee_academique 
				from $tbl_session where idSession='$idSession' limit 1"; 
				
				
		$reqreq=mysql_query($sqlsql) ;
		$rows=mysql_fetch_assoc($reqreq);
 		$session = $rows['session'];
		$annee = $rows['annee_academique'];*/

 	 ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/horraires.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Listing Registration  
	
	</td>
	<td width="22%">
	 <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<!-- <td valign="top" align="center"><a href="gestion_inscription_all.php?full_add=oui"><div class="ajouter"></div>Add french Course</a></td>-->
		 <td valign="top" align="center"><a href="gestion_inscription_all.php?full_addc=oui"><div class="ajouter"></div>Add Course</a></td
		>
		 <td valign="top" align="center"><a href="gestion_inscription_all.php?full_addT=oui"><div class="ajouter"></div>Add Transfer Course</a></td
		></tr>
	</table>
    </td> 
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist" >

<form action="#" method="post" name="adminMenu">

<div class="container_search"> 
<!--<select name="idSession" class="search" >
 <option value="0"><?php echo 'Select Session'; ?></option>
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
  </select>-->
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
	   <!-- <input type="submit" name="valider" value="Submit"  class="input" title=""   />&nbsp;-->
		 
   </div>
          <input type="hidden" name="boxchecked" value="0" />
   <tr>
     <th width="15" align="center">#</th>
 	  <th width="70" align="center" nowrap="nowrap">Course Code</th>
	 <th width="900" align="center" >Course Title</th> 
	<!-- <th align="center">Inscription</th>-->
   </tr>
       <?php
       $i=0;
       $res=@mysql_query($sql) or die ('erreur de selection des cours');
 	   while ($row = mysql_fetch_assoc($res)) {
	   $i++;
	   $cc=$row['code_cours'];
      ?>

  <tr height="16px">
     <td align="center" width="15px"><?=$i?></td>
	 <td align="left"><a href="gestion_inscription_all.php?code_cours=<?=$cc?>" title="Cliquez pour voir les &eacute;tudiants inscrits dans ce cours">&nbsp;<?=$cc?></a></td>
 	 <td align="left">&nbsp;<?=stripslashes(trim($row["titre"]))?></td>
	 <?php
	/* $inscri="select count(*) as nbre from tbl_inscription_cours_all_all where code_cours='$cc' and idSession='$idSession'";*/
	$inscri="select count(*) as nbre  from tbl_inscription_cours_all as c, tbl_note_all as n 
              where c.code_cours=n.code_cours and c.code_inscription = n.code_inscription  
              and c.code_cours='$cc' and c.archive=0 and 
              n.letter_grade !='t' ";
	 $inscrires=@mysql_query($inscri) or die('erreur lors de la selection des etudiants');
	 $ii=mysql_fetch_assoc($inscrires);
	 ?>
	 <!--<td align="center" title="Nombre d'étudiant inscrit dans ce cours "><?php echo $ii['nbre'];/*$row['inscription']*/?></td>-->
  </tr>
<?php
      }
?>
</form>
<!-- <tr><td colspan="5" class="gras">Nombre de cours : <?=$i?></td></tr>-->
 </table>
