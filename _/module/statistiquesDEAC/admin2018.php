
<?php
       
		$niveau=$filiere=$annee=$where=$code=$search=$sgroupe=$annee_inscription=$elearning=$section=$idSession='';

               $ordering=' GROUP BY n.code_inscription';
               
               $sess = 0;
		if( (isset($_POST['year'])) && (!empty($_POST['year'])) || (isset($_POST['session'])) && (!empty($_POST['session'])) )
			{

			 $session=$_POST['session'];
	         $year=$_POST['year'];


        $zin="select idSession from tbl_session where session='$session' and annee_academique='$year'";
        $z= @mysql_query($zin) or die ('Failure to select branches2');
  	    $row = mysql_fetch_assoc($z);
        $sess = $row['idSession'];

         $wherezin =$wherezin." and  n.idSession=$sess ";
        
      }

else if( (isset($_POST['session'])) && (empty($_POST['session'])) && (isset($_POST['year'])) && (empty($_POST['year'])) ){
  	                                                  unset($_SESSION['session']);
  	                                                   unset($_SESSION['year']);

						                                                                            }
																									
else if( (isset($_SESSION['session'])) && (!empty($_SESSION['session'])) && (isset($_SESSION['year'])) && (!empty($_SESSION['year'])) ){

 $session=$_POST['session'];
	 $year=$_POST['year'];


$zin="select idSession from tbl_session where session='$session' and annee_academique='$year'";
$z= @mysql_query($zin) or die ('Failure to select branches2');
  	      $row = mysql_fetch_assoc($z);
  $sess = $row['idSession'];

  $wherezin =$wherezin." and  n.idSession=$sess group by n.code_inscription";

}

 	/*if($idSession =='37')
					{   $day=0;
						$ev=0;
						$online=402;
						$full=348;
						$part=62;

					}
					else if($idSession =='36')
						{$day=0;
						$ev=0;
						$online=395;
						$full=341;
						$part=55;}

						else
						{   $day=0;
						$ev=0;
						$online=402;
						$full=348;
						$part=62;

					}*/
	   		
				  		//year d'&eacute;tude  comme crit&egrave;re

							 if( (isset($_POST['date'])) && (!empty($_POST['date'])) ){
								$annee = $_SESSION['date'] = $_POST['date'];
								 if($annee=="2010-2011")
								{$where1 =$where1." and  date_inscription BETWEEN '2011-01-01' AND '2011-12-30'";
								}
								 else  if($annee=="2011-2012")
								{$where1 =$where1." and  date_inscription BETWEEN '2012-01-01' AND '2012-12-30'";
								}
								else  if($annee=="2012-2013")
								{$where1 =$where1." and  date_inscription BETWEEN '2013-01-01' AND '2013-12-30'";
							}
								else if($annee=="2013-2014")
								{$where1 =$where1." and  date_inscription BETWEEN '2014-01-01' AND '2014-12-30'";
								}
									else if($annee=="2014-2015")
								{$where1 =$where1." and  date_inscription BETWEEN '2015-01-01' AND '2015-12-30'";
								}
																									}
									else if( (isset($_POST['date'])) && (empty($_POST['date'])) ){
  	                                                  unset($_SESSION['date']);
						                                                                            }
																									
								else if( (isset($_SESSION['date'])) && (!empty($_SESSION['date'])) ){
								   $annee=$_SESSION['date'];
								   if($annee=="2010-2011")
								{$where1 =$where1." and  date_inscription BETWEEN '2011-01-01' AND '2011-12-30'";
								}
								 else  if($annee=="2011-2012")
								{$where1 =$where1." and  date_inscription BETWEEN '2012-01-01' AND '2012-12-30'";
								}
								else  if($annee=="2012-2013")
								{$where1 =$where1." and  date_inscription BETWEEN '2013-01-01' AND '2013-12-30'";
								}
								 else if($annee=="2013-2014")
								{$where1 =$where1." and  date_inscription BETWEEN '2014-01-01' AND '2014-12-30'";
								}
								else if($annee=="2014-2015")
								{$where1 =$where1." and  date_inscription BETWEEN '2015-01-01' AND '2015-12-30'";
								}
																									}
                  
				  			  
				  
				  //Enrollment by age		

  $a = "   	SELECT `date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age
            	FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  ".$wherezin."group by n.code_inscription 
            	UNION ALL 
            	SELECT `date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age
            	FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  ".$wherezin." group by n.code_inscription
            	UNION ALL 
            	SELECT `date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')   ".$wherezin." group by n.code_inscription
            	UNION ALL  
            	SELECT `date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')   ".$wherezin." group by n.code_inscription
				UNION ALL  
            	SELECT `date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') ".$wherezin."group by n.code_inscription";



 $aa= @mysql_query($a) or die ('Failure to select branches777777');

 while($row = mysql_fetch_assoc($aa)){

		if($row['age'] <= '17')

		{ $seize++;}
		else if(($row['age'] >='18') && ($row['age']<='21'))
		{$huit++;}
		else if(($row['age'] >='22') && ($row['age']<='29'))
		{ $vingt++;}
        else if(($row['age'] >='30') && ( $row['age']<='39'))

        {$quarante++;}
      else if($row['age'] >='40') 

		{ $quaranteplus++;}

	}
		
/*******Total enrollment */
 if ($session == "" || $year == "")  {
 	$us=0;}
			
            	else
            	{
            	   $countus = "select count(distinct code_inscription) as c_us from ( 
            	SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  ".$wherezin."group by n.code_inscription 
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  ".$wherezin." group by n.code_inscription
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')   ".$wherezin." group by n.code_inscription
            	UNION ALL  
            	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')   ".$wherezin." group by n.code_inscription
				UNION ALL  
            	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') ".$wherezin."group by n.code_inscription) as us";
  $bb= @mysql_query($countus) or die ('Failure Total Enrollment all ');
  	      $row = mysql_fetch_assoc($bb);
		  $us = $row['c_us'];
            }
          
		/******* Fin Total Enrollment */

		  //Total withdrawals
		
  $countus="SELECT count(*) as us FROM `tbl_etudiant_deac` as e WHERE e.archive=2 ".$wherewithdrawal;
          $bb= @mysql_query($countus) or die ('Failure Total withdrawals');
  	      $row = mysql_fetch_assoc($bb);
		  $withdrawals = $row['us'];

		
			  //Enrollment by Florida Residents
		  $b="SELECT count(*) as total1 FROM `tbl_etudiant_deac` WHERE archive=0 and state='fl'   ". $where1;
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total1 = $row['total1'];
		
		     //Enrollment by Florida non Residents
		  $b="SELECT count(*) as total6 FROM `tbl_etudiant_deac` WHERE archive=0 and  country='usa' and  state!='fl' ". $where1;
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total2 = $row['total6'];
		
					
		//Enrollment by concentration (Management)
		 /*$a="SELECT count(*) as mg FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='bba' and  filiere=8". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
	$mgbba = $row['mg'];
	$a="SELECT count(*) as mg FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=8". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
	$mgmba = $row['mg'];
		//$mg1 = $row['mg'];
			//Enrollment by concentration (Human Resources Management)
		
		 $a="SELECT count(*) as mrhbba FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='bba' and  filiere=14". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
	$mrhbba  = $row['mrhbba'];
	 $a="SELECT count(*) as mrhmba FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=14". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
	$mrhmba  = $row['mrhmba'];
	
		 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='bba' and  filiere=1 ". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
	$mkgbba=  $row['mkgcom'];
	 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=1 ". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
	$mkgcommba=  $row['mkgcom'];
		
		 $a="SELECT count(*) as mrh FROM `tbl_etudiant_eng` WHERE archive=0 and niveau='bba' and  filiere=3". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$imbba = $row['mrh'];
		 
		*/
				//Enrollment by concentration (Project Management)
		
		 $a="SELECT count(*) as prjmgtmba FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=12". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$prjmgtmba = $row['prjmgtmba'];
			//Enrollment by concentration (Information Systems Management)
		 $a="SELECT count(*) as msimba FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=15". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$msimba = $row['msimba'];
	
		
		//Enrollment by concentration (Quality Management)
		 $a="SELECT count(*) as mqmba FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=17". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mqmba = $row['mqmba'];
		
		//Enrollment by concentration (saltes Management)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=13". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$smmba = $row['mq'];
	
		//Enrollment by concentration (International Business)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=21". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ibmba = $row['mq'];
		
		//Enrollment by concentration (Finance)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=18". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ffmba = $row['mq'];
	
		//Enrollment by concentration (Healthcare Management)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=16". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$hmmba = $row['mq'];
		//Enrollment by concentration (LeaderShip and sustainability )
		 $a="SELECT count(*) as spmba FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=26". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$spmba = $row['spmba'];
		//Enrollment by concentration (LeaderShip and sustainability )
		 $a="SELECT count(*) as lsmba FROM `tbl_etudiant_deac` WHERE archive=0 and niveau='mba' and  filiere=26". $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$lsmba = $row['lsmba'];
		$count_student = 0;
		$retention_rate = 0;
		$enrollment_rate = 0;
		if ($year == "") {
			$count_student = $us;
		}else{
			 $sql_session = "SELECT idSession FROM `tbl_session` WHERE `annee_academique` = $year and `session`= \"Summer\"";
			
			$req = @mysql_query($sql_session) or die ('Failure to get idSession Summer1');
			$row = mysql_fetch_assoc($req);
			$s = $row['idSession'];
			  $sql = "select count(distinct code_inscription) as tt_s from ( SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s."
			  UNION ALL 
			  SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s." ) as us";
			$req = @mysql_query($sql) or die ('Failure to get idSession Summer12');
			$row = mysql_fetch_assoc($req);
			$count_student = $count_student+$row['tt_s'];
			$sql_session = "SELECT idSession FROM `tbl_session` WHERE `annee_academique` = $year and `session`= \"Spring\"";
			
			$req = @mysql_query($sql_session) or die ('Failure to get idSession Spring1 ');
			$row = mysql_fetch_assoc($req);
			$s = $row['idSession'];
			 $sql = "select count(distinct code_inscription) as tt_s from ( SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')and n.idSession=".$s." 

			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')and n.idSession=".$s." ) as us";
			$req = @mysql_query($sql) or die ('Failure to get idSession Spring1 ');
			$row = mysql_fetch_assoc($req);
			$count_student = $count_student+$row['tt_s'];


			$year = $year-1;
			$sql_session = "SELECT idSession FROM `tbl_session` WHERE `annee_academique` = $year and `session`= \"Fall\"";
			$req = @mysql_query($sql_session) or die ('Failure to get idSession Fall1 ');
			$row = mysql_fetch_assoc($req);
			$s = $row['idSession'];
			  $sql = "select count(distinct code_inscription) as tt_s from ( SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			  UNION ALL 
			  SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s."
			   UNION ALL
			    SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			    UNION ALL 
			    SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s." 
			    UNION ALL 
			    SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." ) as us";
			$req = @mysql_query($sql) or die ('Failure to get idSession Fall1 ');
			$row = mysql_fetch_assoc($req);
			$count_student = $count_student+$row['tt_s'];
		}
		$count_student_pre_annee = 0;
		if ($year != "") {
			
			$sql_session = "SELECT idSession FROM `tbl_session` WHERE `annee_academique` = $year and `session`= \"Summer\"";
			
			$req = @mysql_query($sql_session) or die ('Failure to get idSession Summer2 ');
			$row = mysql_fetch_assoc($req);
			$s = $row['idSession'];
		 	$sql = "select count(distinct code_inscription) as tt_s from ( SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
		 	UNION ALL 
		 	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s." 
		 	UNION ALL 
		 	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s." 
		 	UNION ALL 
		 	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
		 	UNION ALL 
		 	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." ) as us";
			$req = @mysql_query($sql) or die ('Failure to get idSession Summer2 ');
			$row = mysql_fetch_assoc($req);
			$count_student_pre_annee = $count_student_pre_annee+$row['tt_s'];
			$sql_session = "SELECT idSession FROM `tbl_session` WHERE `annee_academique` = $year and `session`= \"Spring\"";
			
			$req = @mysql_query($sql_session) or die ('Failure to get idSession Spring2 ');
			$row = mysql_fetch_assoc($req);
			$s = $row['idSession'];
			 $sql = "select count(distinct code_inscription) as tt_s from ( SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s." ) as us";
			$req = @mysql_query($sql) or die ('Failure to get idSession Spring2 ');
			$row = mysql_fetch_assoc($req);
			$count_student_pre_annee = $count_student_pre_annee+$row['tt_s'];


			$year = $year-1;
			$sql_session = "SELECT idSession FROM `tbl_session` WHERE `annee_academique` = $year and `session`= \"Fall\"";
			$req = @mysql_query($sql_session) or die ('Failure to get idSession Fall2 ');
			$row = mysql_fetch_assoc($req);
			$s = $row['idSession'];
			 $sql = "select count(distinct code_inscription) as tt_s from ( SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." 
			 UNION ALL 
			 SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and n.idSession=".$s." ) as us";
			$req = @mysql_query($sql) or die ('Failure to get idSession Fall2 ');
			$row = mysql_fetch_assoc($req);
			$count_student_pre_annee = $count_student_pre_annee+$row['tt_s'];
		}
		// echo $count_student."</br>";
		// echo $count_student_pre_annee;
		// enrollement rate
		if ($year != "") {
			$year = $year+2;
		}
		
		if ($year != "") {


			//$enrollment_rate = round($count_student/($count_student_pre_annee)*100)." %";  

			//echo $count_student_pre_annee.' '.$count_student;
			$enrollment_rate = round($count_student_pre_annee/($count_student)*100)." %";   
		}
		
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;LISTING STATISTICS 
	 &nbsp;&nbsp;<span class="task"></span>
 	</td>
	<td width="22%">&nbsp;</td> 
  </tr>
</table>
 <form action="#" method="post" name="adminMenu" >
	<input type="hidden" name="boxchecked" value="0" />

<div class="container_search">
	<!--  <select name="annee_etude" class="search">
		<option value=""><?php echo 'Major'; ?></option>
        <option value="BBA" >BBA</option>
     
        <option value="BSBE" >BSBE</option>
        <option value="MM" >MM</option>
        <option value="MBA">MBA</option>
		 <option value="DBA">DBA</option>
		
	  </select>
	  
	-->
		
		  <select name="session" class="search">
		<option value=""><?php echo 'session'; ?></option>
		  <option value="Fall" <?=($session=='Fall') ? $selected : '' ?>>Fall</option>
       <option value="Spring" <?=($session=='Spring') ? $selected : '' ?>>Spring</option>
        <option value="Summer" <?=($session=='Summer') ? $selected : '' ?>>Summer</option>
      
	  </select> 
	<select name="year" class="search">
		<option value=""><?php echo 'Year'; ?></option>
		 <option value="2014" <?=($year=='2014') ? $selected : '' ?>>2014</option>
		  <option value="2015" <?=($year=='2015') ? $selected : '' ?>>2015</option>
       <option value="2016" <?=($year=='2016') ? $selected : '' ?>>2016</option>
       <option value="2017" <?=($year=='2017') ? $selected : '' ?>>2017</option>
       <option value="2018" <?=($year=='2018') ? $selected : '' ?>>2018</option>
	  </select>
	 <!-- <select name="year" class="search">
		<option value=""><?php echo 'Year'; ?></option>
		  <option value="2015" <?=($year=='2015') ? $selected : '' ?>>2015</option>
       <option value="2016" <?=($year=='2016') ? $selected : '' ?>>2016</option>
       <option value="2017" <?=($year=='2017') ? $selected : '' ?>>2017</option>
	  </select>-->
	  <input type="checkbox" class="input" name="export" value="1" style="width: 15px;margin-left: 5px;"   /> Export
	    <input type="submit" vname="Applay" value="<?php echo 'submit'; ?>"  />
	
</div>
<br/><br/>


<TABLE border="1" width="88%">

       <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Active Students/Session</FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="25%" > <FONT size="2pt">  Total Active Students:</FONT></TH>
      <TH align="center" width="25%" > <FONT size="2pt"> Enrollment Rate/Year:</FONT></TH>
   <TH align="center" width="25%"> <FONT size="2pt">Total Florida Residents: </FONT></TH>
    <TH align="center" width="25%"><FONT size="2pt"> Total Non-Resident:</FONT></TH>
  </TR>
  <TR>
   <TD align="center"> <?php echo $us; ?></TD>
   <TD align="center"> <?php echo $enrollment_rate; ?></TD>
   <TD  align="center"> <a href="gestion_des_etudiantseng.php?fl=oui" target='_blank'> <?php echo $total1; ?></a> </TD>
   <TD  align="center"> <a href="gestion_des_etudiantseng.php?nofl=oui" target='_blank'> <?php echo $total2; ?></a> </TD>
   
  </TR>
</TABLE>
<br/>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="21%" > <FONT size="2pt">  Day:</FONT></TH>
      <TH align="center" width="14%"> <FONT size="2pt">Evening/weekends: </FONT></TH>
    <TH align="center" width="12%"><FONT size="2pt"> Online:</FONT></TH>
	 <TH align="center" width="25%"><FONT size="2pt"> Full Time:</FONT></TH>
	 <TH align="center" width="28%"><FONT size="2pt"> Part Time:</FONT></TH>
  </TR>
  <TR>
  <TD align="center">
   <?php echo '0'; ?>
</TD>   
   <TD align="center">
   <?php echo '0'; ?>
   </TD>
 
    <TD align="center">
	   <?php  echo $us; ?>
</TD>
<?php

$sql="SELECT n.code_inscription,e.nom, e.prenom,count(*) as nbreCours              
     FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
		OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%') and `letter_grade`!='T' ".$wherezin." group by n.code_inscription 
            	UNION ALL 
            	SELECT n.code_inscription,e.nom, e.prenom,count(*) as nbreCours FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0  and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')and `letter_grade`!='T' ".$wherezin." group by n.code_inscription 
            	UNION ALL 
            	SELECT n.code_inscription,e.nom, e.prenom,count(*) as nbreCours FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0  and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%') and `letter_grade`!='T' ".$wherezin."group by n.code_inscription 
            	UNION ALL 
            	SELECT n.code_inscription,e.nom, e.prenom,count(*) as nbreCours FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0  and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%') and `letter_grade`!='T' ".$wherezin."  group by n.code_inscription 
            	UNION ALL 
            	SELECT n.code_inscription,e.nom, e.prenom,count(*) as nbreCours FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0  and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%') and `letter_grade`!='T' ".$wherezin."  group by n.code_inscription ";

$aa= @mysql_query($sql) or die ('Failure to select branches');	
$full=$part=0;
	while($row = mysql_fetch_assoc($aa)){

		if($row['nbreCours'] >=4)

		{ $full++;}

else if($row['nbreCours'] <=3)

		{ $part++;}
}
?>
 <TD align="center">   
<?php  echo $full+($us-$full-$part); ?>
  </TD>
<TD align="center">  
 <?php  echo $part; ?> 
 </TD>
  </TR>
</TABLE>

<br/>

<!-- Enrollments By Program -->
<?php 
		//SQL Enrollments By Program BBA 
		$niveau = array(
					"(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')",
					"(c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%')",
					"(c.type LIKE '%dba%')"
				);
		$c_enroll =  array();
		$i=0;
		foreach ($niveau as $k => $v) {
			  $sql = "select count(distinct code_inscription) as c_enroll From ( 
				SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription  and n.archive=0 and ".$v."  ".$wherezin." group by n.code_inscription
	           	UNION ALL 
	           	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and   n.archive=0 and".$v."  ".$wherezin."group by n.code_inscription
	           	UNION ALL 
	        	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and ".$v." ".$wherezin."group by n.code_inscription
	         	UNION ALL 
	         	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and".$v." ".$wherezin."group by n.code_inscription
	         	UNION ALL 
	         	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c ,  tbl_etudiant_deac as e WHERE n.code_inscription = e.code_inscription  and c.code_cours=n.code_cours and n.archive=0 and".$v."  ".$wherezin." group by n.code_inscription)as us";
	      
			if ($session == "" || $year == "") {
			
	         	$sql="select count(*) as c_enroll from tbl_etudiant_deac where archive=20";
	         
	        }
	        //echo $sql."</br>";
			$req = @mysql_query($sql) or die ('Failure Total Enrollment by program ');
			$row = mysql_fetch_assoc($req);
			$c_enroll[$i] = $row['c_enroll'];
			$i++;
		}
		
	
?>
<TABLE border="1" width="88%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Active Students By Program/Session </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  	<TR>
   		<TH align="center" width="21%" > <FONT size="2pt">  BBA:</FONT></TH>
	 	<TH align="center" width="25%"><FONT size="2pt"> MBA:</FONT></TH>
	 	<TH align="center" width="28%"><FONT size="2pt"> DBA:</FONT></TH>
  	</TR>
  	<TR>
  		<?php foreach ($c_enroll as $k => $v) {
  			echo "<TD align='center'>".$v."</TD>";
  		} ?>
  		
   	</TR>
</TABLE>

<br/>

<!-- Enrollments By Program -->
<?php 
		//SQL Enrollments By Program BBA 
		$niveau = array(
					"(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')",
					"(c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%')",
					"(c.type LIKE '%dba%')"
				);
		$c_enroll =  array();
		$i=0;
		foreach ($niveau as $k => $v2) {
			 $sql = "select count(distinct code_inscription) as c_enroll From ( 
				SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and date_inscription>='$year-01-01' and ".$v2."  ".$wherezin." group by n.code_inscription
	           	UNION ALL 
	           	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and date_inscription>='$year-01-01' and".$v2."  ".$wherezin."group by n.code_inscription
	           	UNION ALL 
	        	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and date_inscription>='$year-01-01' and ".$v2." ".$wherezin."group by n.code_inscription
	         	UNION ALL 
	         	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and date_inscription>='$year-01-01'and".$v2." ".$wherezin."group by n.code_inscription
	         	UNION ALL 
	         	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c ,  tbl_etudiant_deac as e WHERE n.code_inscription = e.code_inscription and c.code_cours=n.code_cours and n.archive=0 and date_inscription>='$year-01-01' and".$v2."  ".$wherezin." group by n.code_inscription)as us";
	      
			if ($session == "" || $year == "") {

				
	         	$sql="select count(*) as c_enroll from tbl_etudiant_deac where archive=20";
	         
	        }
	        //echo $sql."</br>";
			$req = @mysql_query($sql) or die ('Failure Total Enrollment by program ');
			$row = mysql_fetch_assoc($req);
			$c_enroll[$i] = $row['c_enroll'];
			$i++;
		}
		
	
?>
<TABLE border="1" width="88%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> New Enrollments By Program/Session </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  	<TR>
   		<TH align="center" width="21%" > <FONT size="2pt">  BBA:</FONT></TH>
	 	<TH align="center" width="25%"><FONT size="2pt"> MBA:</FONT></TH>
	 	<TH align="center" width="28%"><FONT size="2pt"> DBA:</FONT></TH>
  	</TR>
  	<TR>
  		<?php foreach ($c_enroll as $k => $v2) {
  			echo "<TD align='center'>".$v2."</TD>";
  		} ?>
  		
   	</TR>
</TABLE>



<br/>
<!-- Alumni By Program -->
<?php 

if($session == 'Fall')
{ $date11=$year.'-08-01';
  $date22=$year.'-01-20';
}
else if ($session == 'Spring')
{$date11=$year.'-01-21';
$date22=$year.'-06-20';
}
	else if ($session == 'Summer')
	{$date11=$year.'-06-21';
    $date22=$year.'-07-31';
}
		//SQL Enrollments By Program BBA 
		$niveau = array(
					"(e.laureatbba=1 and date  BETWEEN '$date11' AND '$date22')",
					"(e.laureatmba=1 and datemba  BETWEEN '$date11' AND '$date22')",
					"(e.laureatdba=1 and datedba  BETWEEN '$date11' AND '$date22')"
				);
		$c_enroll =  array();
		$i=0;
		foreach ($niveau as $k => $v3) {
			  $sql = "select count(distinct code_inscription) as c_enroll From ( 
				SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0  and ".$v3."  ".$wherezin." group by n.code_inscription
	           	UNION ALL 
	           	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0  and".$v3."  ".$wherezin."group by n.code_inscription
	           	UNION ALL 
	        	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0  and ".$v3." ".$wherezin."group by n.code_inscription
	         	UNION ALL 
	         	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and".$v3." ".$wherezin."group by n.code_inscription
	         	UNION ALL 
	         	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c ,  tbl_etudiant_deac as e WHERE n.code_inscription = e.code_inscription and c.code_cours=n.code_cours and n.archive=0  and".$v3."  ".$wherezin." group by n.code_inscription)as us";
	      
			if ($session == "" || $year == "") {

				
	         	$sql="select count(*) as c_enroll from tbl_etudiant_deac where archive=20";
	         
	        }
	        //echo $sql."</br>";
			$req = @mysql_query($sql) or die ('Failure Total Enrollment by program ');
			$row = mysql_fetch_assoc($req);
			$c_enroll[$i] = $row['c_enroll'];
			$i++;
		}
		
	
?>
<TABLE border="1" width="88%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Alumni By Program/Session </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  	<TR>
   		<TH align="center" width="21%" > <FONT size="2pt">  BBA:</FONT></TH>
	 	<TH align="center" width="25%"><FONT size="2pt"> MBA:</FONT></TH>
	 	<TH align="center" width="28%"><FONT size="2pt"> DBA:</FONT></TH>
  	</TR>
  	<TR>
  		<?php foreach ($c_enroll as $k => $v3) {
  			echo "<TD align='center'>".$v3."</TD>";
  		} ?>
  		
   	</TR>
</TABLE>



<br/>
<!-- WithDrawals -->
	<?php 
			$wherewithdrawal = "";
			if ($year != "" && $session != "" )  {

				if($session =='Fall')
{ $date1=$year.'-08-01';
  $date2=$year.'-01-20';
}
else if ($session =='Spring')
{ $date1=$year.'-01-21';
 $date2=$year.'-06-20';
}
	else if ($session =='Summer')
	{$date1=$year.'-06-21';
    $date2=$year.'-07-31';
}

				$wherewithdrawal= " and `withdrawl_date` BETWEEN '$date1' AND '$date2'";

			}
			else 
				{	$wherewithdrawal= " and e.archive!=2";}
			 $sql = "SELECT count(*) as c_withdrawal FROM `tbl_etudiant_deac` as e WHERE e.archive=2".$wherewithdrawal;
			$req = @mysql_query($sql) or die ('Failure Total Enrollment withdrawal ');
			$row = mysql_fetch_assoc($req);
			$withdrawals = $row['c_withdrawal'];
			// Retention Rate
			$retention_rate = round((($count_student - $withdrawals)/$count_student)*100,2);

	 ?>
	<TABLE border="1" width="88%">
       <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Withdrawals/Session</FONT></td>
	</TABLE>
	<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
	  	<TR>
	   		<TH align="center" width="30%" > <FONT size="2pt">  Withdrawals:</FONT></TH>
	   		<TH align="center" width="35%"> <FONT size="2pt">Retention Rate/Year: </FONT></TH>
	    </TR>
	  	<TR>
	   		<TD align="center"> <?php echo $withdrawals; ?></TD>
	   		<TD align="center"> <?php echo $retention_rate." %"; ?></TD>
		</TR>
	</TABLE>
<br/>


<TABLE border="1" width="88%">

           
        <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments By BBA Concentration   </FONT></td>

</TABLE>
<?php
$mgbba1=$mrhbba1=$mkgbba1=$imbba1=0;
 $sql="SELECT n.code_inscription,e.nom,e.prenom,e.filiere FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')  ".$wherezin."group by n.code_inscription
UNION ALL 
SELECT n.code_inscription,e.nom,e.prenom,e.filiere FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')  ".$wherezin."group by n.code_inscription
UNION ALL 
SELECT n.code_inscription,e.nom,e.prenom,e.filiere FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')  ".$wherezin."group by n.code_inscription
UNION ALL 
SELECT n.code_inscription,e.nom,e.prenom,e.filiere FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')  ".$wherezin."group by n.code_inscription
UNION ALL 
SELECT n.code_inscription,e.nom,e.prenom,e.filiere FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')  ".$wherezin."group by n.code_inscription
order by filiere";
$aa= @mysql_query($sql) or die ('Failure to select branches');	

	while($row = mysql_fetch_assoc($aa)){

		if($row['filiere'] =='8' || $row['filiere'] =='12')

		{ $mgbba1++;
		}

else if($row['filiere'] =='14')

		{ $mrhbba1++;
		}
else if($row['filiere'] =='4' || $row['filiere'] =='1' )

		{ $mkgbba1++;
		}
else if($row['filiere'] =='3')

		{ $imbba1++;
		}
/*$i++;
$mgbba1=$mgbba11;
$mrhbba1=$mrhbba11;
$mkgbba1=$mkgbba11;
$imbba1=$imbba11;*/
	}
 
?>

<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
 <TH align="center" width="8%" > <font size="2pt"><?php echo $mgbba1;?></font></TH>
   <TH align="left" width="35%"><font size="2pt">GENERAL MANAGEMENT</font></TH>
    <TH align="center" width="7%"><FONT size="2pt"><?php echo $mrhbba1;?> </FONT></TH>
	 <TH align="left" width="50%"><FONT size="2pt"> HUMAN RESOURCES MANAGEMENT</FONT></TH>
  </TR>
  <TR>
   <TH align="center" width="8%" ><font size="2pt"><?php echo $mkgbba1;?></font></TH>
      <TH align="left" width="35%"> <FONT size="2pt">MARKETING </FONT></TH>
    <TH align="center" width="7%"><FONT size="2pt"><?php echo $imbba1;?>  </FONT></TH>
	 <TH align="left" width="50%"><FONT size="2pt"> INTERNATIONAL MANAGEMENT</FONT></TH>
  </TR>
</TABLE>
<br/>

<TABLE border="1" width="88%">

           
          <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments By MBA Concentration (Not Yet)
        </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
  
    <TH align="center" width="8%" > <font size="2pt"><?php echo $mgmba;?></font></TH>
   <TH align="left" width="35%"> <FONT size="2pt">MANAGEMENT</FONT></TH>
    <TH align="center" width="7%"><FONT size="2pt"><?php echo $mrhmba ;?> </FONT></TH>
	 <TH align="left" width="50%"><FONT size="2pt"> HUMAN RESOURCES </FONT></TH>
  </TR>
  <TR>
   <TH align="center" width="8%" >  <FONT size="2pt"> <?php echo $mkgcommba;?> </FONT></TH>
      <TH align="left" width="35%"> <FONT size="2pt">MARKETING AND COMMUNICATION </FONT></TH>
     <TH align="center" width="7%"> <FONT size="2pt"><?php echo $msimba;?>  </FONT></TH>
	 <TH align="left" width="50%"><font size="2pt">INFORMATION SYSTEM</font></TH>
  </TR>
 <TR>
   <TH align="center" width="8%" > <FONT size="2pt"><?php echo $mqmba;?>  </FONT></TH>
   <TH align="left" width="35%"><font size="2pt">QUALITY MANAGEMENT </font></TH>
    <TH align="center" width="8%" > <FONT size="2pt"><?php echo $smmba;?> </FONT></TH>
   <TH align="left" width="35%"><font size="2pt">SALES MANAGEMENT</font></TH>
  </TR>
  <TR>
    <TH align="center" width="8%" > <FONT size="2pt"><?php echo $ffmba;?>  </FONT></TH>
   <TH align="left" width="35%"><font size="2pt">FINANCE</font></TH>
     <TH align="center" width="7%"> <FONT size="2pt"><?php echo $ibmba;?>  </FONT></TH>
	 <TH align="left" width="50%"><font size="2pt">INTERNATIONAL BUSINESS</font></TH>
  </TR>
  
  <TR>
      <TH align="center" width="7%"> <FONT size="2pt"><?php echo $hmmba;?> </FONT></TH>
	 <TH align="left" width="50%"><font size="2pt">HEALTHCARE MANAGEMENT</font></TH>
   <TH align="center" width="7%"><FONT size="2pt"><?php echo $prjmgtmba;?> </FONT></TH>
	 <TH align="left" width="50%"><FONT size="2pt"> PROJECT MANAGEMENT </FONT></TH>
  </TR>
   
   <TR>
   
    <TH align="center" width="7%"> <FONT size="2pt"><?php echo $lsmba;?>  </FONT></TH>
	  <TH align="left" width="50%"><font size="2pt">LEADERSHIP AND SUSTAINABILITY</font></TH>
	   <TH align="center" width="7%"> <FONT size="2pt"><?php echo '0';?>  </FONT></TH>
	  <TH align="left" width="50%"><font size="2pt">SPORT MANAGEMENT</font></TH>
  </TR>
   
  
</TABLE>
<br/>
<TABLE border="1" width="88%">

           
          <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Graduate Academic Performance/Session  </FONT></td>

</TABLE>

<!-- CGPA -->
<?php 
	// total MBA
	$b1 = 0;
	$b2 = 0;
	$b3 = 0;
	$b4 = 0;
	$cgpa = 0;
	$where = "";
	if ($sess != 0) {
		$sql = "
				select  sum(n.gpa) / count(distinct n.code_cours) as total from tbl_note_piimt n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[1]." and n.code_cours=c.code_cours_psi and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription  
	           	UNION ALL 
	           	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_piimt` n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[1]." and n.code_cours=c.code_cours_psi and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription 
	           	UNION ALL 
	        	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_Algeria` n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[1]." and n.code_cours=c.code_cours_psi and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription 
	         	UNION ALL 
	         	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_Libya` n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[1]." and n.code_cours=c.code_cours_psi and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription 
	         	UNION ALL 
	         	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_benin` n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[1]." and n.code_cours=c.code_cours and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription";
	         	//echo $sql;

				$req = @mysql_query($sql) or die ('Failure Graduate Academic Performance');
				while($row = mysql_fetch_assoc($req)) {

					$cgpa = round($row['total'],2);

					if ($cgpa >= 2.5 && $cgpa < 3.0) {
						$b1++;
					}
					if ($cgpa >= 3.0 && $cgpa < 3.5) {
						$b2++;	
					}
					if ($cgpa >= 3.5) {
						$b3++;
					}
				}
				$b4 = round((($b2+$b3)/($b1+$b2+$b3))*100,2); 
	}			
	
	
 ?>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
	<TR>
		<TH align="center" width="8%" > <font size="2pt">Between 2.5-3.0</font></TH>
		<TH align="center" width="8%" > <font size="2pt">between 3.0-3.5</font></TH>
		<TH align="center" width="8%" > <font size="2pt">Above 3.5</font></TH>
		<TH align="center" width="8%" > <font size="2pt">Students with above 3.0 CGPA</font></TH>
	</TR>
 	<TR>
 		<TD align="center"><?php echo $b1;  ?></TD>
		<TD align="center"><?php echo $b2;  ?></TD>
 		<TD align="center"><?php echo $b3;  ?></TD>
		<TD align="center"><?php echo $b4." %";  ?></TD>
	</TR>
</TABLE>

<br/>
<!-- CGPA -->
<?php 
	// total BBA
	$b1 = 0;
	$b2 = 0;
	$b3 = 0;
	$b4 = 0;
	$b5 = 0;
	$cgpa = 0;
	$where = "";
	if ($sess != 0) {
		echo $sql = "
				select  sum(n.gpa) / count(distinct n.code_cours) as total from tbl_note_piimt n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[0]." and n.code_cours=c.code_cours_psi and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription  
	           	UNION ALL 
	           	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_piimt` n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[0]." and n.code_cours=c.code_cours_psi and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription 
	           	UNION ALL 
	        	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_Algeria` n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[0]." and n.code_cours=c.code_cours_psi and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription 
	         	UNION ALL 
	         	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_Libya` n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[0]." and n.code_cours=c.code_cours_psi and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription 
	         	UNION ALL 
	         	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_benin` n, tbl_etudiant_deac e, tbl_cours c where n.code_inscription = e.code_inscription and e.laureatbba=1 and c.`nbr_credit` != 0 and n.idSession = ".$sess." and n.archive = 0 and ".$niveau[0]." and n.code_cours=c.code_cours and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) group by n.code_inscription";
	         	//echo $sql;

				$req = @mysql_query($sql) or die ('Failure Undergraduate Academic Performance ');
				while($row = mysql_fetch_assoc($req)) {

					$cgpa = round($row['total'],2);

					if ($cgpa <= 1.5) {
						$b1++;
					}
					if ($cgpa > 1.5 && $cgpa <= 2.5) {
						$b2++;	
					}
					if ($cgpa > 2.5 && $cgpa <= 3.5) {
						$b3++;
					}
					if ($cgpa > 3.5 && $cgpa <= 4.0) {
						$b4++;	
					}
				} 
				$b5 = round((($b3+$b4)/($b1+$b2+$b3+$b4))*100,2);
	}			
	
	
 ?>

<TABLE border="1" width="88%">

           
          <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Undergraduate Academic Performance/Session  </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
	<TR>
		<TH align="center" width="8%" > <font size="2pt"><=1.5</font></TH>
		<TH align="center" width="8%" > <font size="2pt">Between 1.5-2.5</font></TH>
		<TH align="center" width="8%" > <font size="2pt">between 2.5-3.5</font></TH>
		<TH align="center" width="8%" > <font size="2pt">Between 3.5-4.0</font></TH>
		<TH align="center" width="8%" > <font size="2pt">Percentage of students with above 2.5 CGPA</font></TH>

	</TR>
	<TR>
 		<TD align="center"><?php echo $b1;  ?></TD>
		<TD align="center"><?php echo $b2;  ?></TD>
 		<TD align="center"><?php echo $b3;  ?></TD>
		<TD align="center"><?php echo $b4;  ?></TD>
		<TD align="center"><?php echo $b5." %";  ?></TD>
	</TR>
</TABLE>

<br/>
<TABLE border="1" width="88%">

<?php 
	//BBA 
	$Undergraduate = 0;
	$Graduate = 0;
	$Doctorate = 0;
	$laureatbba = 0;
	$laureatmba = 0;
	$laureatdba = 0;
	$g1=$g2=$g3=$g4=0;
	if($year != ""){

		$sql = "SELECT count(gen.code_inscription) as laureatbba FROM  tbl_etudiant_gen as gen where gen.laureatbba=1 and gen.date like \"%$year%\" ";
		$req = @mysql_query($sql) or die ('ungraduate ratebba');
		$row = mysql_fetch_assoc($req);
		$laureatbba = $row['laureatbba'];

		 /* $sql = "SELECT count(gen.code_inscription) as laureatbba FROM `tbl_etudiant_deac` as de , tbl_etudiant_gen as gen where gen.laureatbba=1 and gen.date like \"%$year%\" and de.`code_inscription` = gen.`code_inscription`";
		$req = @mysql_query($sql) or die ('ungraduate ratebba');
		$row = mysql_fetch_assoc($req);
		$laureatbba = $row['laureatbba'];
		 $sql = "SELECT count(gen.code_inscription) as laureatmba FROM `tbl_etudiant_deac` as de , tbl_etudiant_gen as gen where gen.laureatmba=1 and gen.datemba like \"%$year%\" and de.`code_inscription` = gen.`code_inscription`";
		$req = @mysql_query($sql) or die ('ungraduate ratemba');
		$row = mysql_fetch_assoc($req);
		$laureatmba = $row['laureatmba'];
		$sql = "SELECT count(gen.code_inscription) as laureatdba FROM `tbl_etudiant_deac` as de , tbl_etudiant_gen as gen where gen.laureatdba=1 and gen.datedba like \"%$year%\" and de.`code_inscription` = gen.`code_inscription`";
		$req = @mysql_query($sql) or die ('ungraduate ratedba');
		$row = mysql_fetch_assoc($req);
		$laureatdba = $row['laureatdba'];*/
		 $sql2 = "SELECT count(de.code_inscription) as bbawithdrawal FROM `tbl_etudiant_gen` as de  where de.archive=2 and niveau='bba' and `withdrawl_date` BETWEEN '$year-01-01' AND '$year-12-30'";
		$req = @mysql_query($sql2) or die ('bbawithdrawal');
		$row = mysql_fetch_assoc($req);
		$bbawithdrawal = $row['bbawithdrawal'];

       /* $sql2 = "SELECT count(de.code_inscription) as bbawithdrawal FROM `tbl_etudiant_deac` as de  where de.archive=2 and niveau='bba' and `withdrawl_date` BETWEEN '$year-01-01' AND '$year-12-30'";
		$req = @mysql_query($sql2) or die ('bbawithdrawal');
		$row = mysql_fetch_assoc($req);
		$bbawithdrawal = $row['bbawithdrawal'];

         $sql2 = "SELECT count(de.code_inscription) as mbawithdrawal FROM `tbl_etudiant_deac` as de  where de.archive=2 and niveau='mba'and `withdrawl_date` BETWEEN '$year-01-01' AND '$year-12-30'";
		$req = @mysql_query($sql2) or die ('mbawithdrawal');
		$row = mysql_fetch_assoc($req);
		$mbawithdrawal = $row['mbawithdrawal'];

        $sql2 = "SELECT count(de.code_inscription) as dbawithdrawal FROM `tbl_etudiant_deac` as de  where de.archive=2 and niveau='dba'and `withdrawl_date` BETWEEN '$year-01-01' AND '$year-12-30'";
		$req = @mysql_query($sql2) or die ('dbawithdrawal');
		$row = mysql_fetch_assoc($req);
		$dbawithdrawal = $row['$dbawithdrawal'];*/

		/*total bba*/


$totalbba=$totalmba=$totaldba=$sumbba=$summba=$sumdba=0;

 $sql=" select idSession from tbl_session where academic_year like '%$year'";
      $ressource=@mysql_query($sql) or die('Erreur :: Select sessions');
    $i =0;
    while ($ligne= mysql_fetch_assoc($ressource)) {
 $idSession = $ligne['idSession'];
  $i++;


 /* $countus = "select count(distinct code_inscription) as c_us from ( 
            
            	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_gen as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')) as us";*/
 $countus = "select count(distinct code_inscription) as c_us from ( 
            	SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%') 
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%') ) as us";
$req = @mysql_query($countus) or die ('ungraduate rate');
		$row = mysql_fetch_assoc($req);
		$sumbba += $row['c_us'];
}

$totalbba+=$sumbba;

/*fin total bba*/
/*total mba*/

 $sql=" select idSession from tbl_session where academic_year like '%$year'";
      $ressource=@mysql_query($sql) or die('Erreur :: Select sessions');
    $i =0;
    while ($ligne= mysql_fetch_assoc($ressource)) {
 $idSession = $ligne['idSession'];
  $i++;

 /* $countus = "select count(distinct code_inscription) as c_us from ( 
            	
            	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_gen as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%')        	 ) as us";*/
 $countus = "select count(distinct code_inscription) as c_us from ( 
            	SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and(c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and(c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and(c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%') ) as us";
$req = @mysql_query($countus) or die ('ungraduate rate');
		$row = mysql_fetch_assoc($req);
		$summba += $row['c_us'];
}

$totalmba+=$summba;

/*fin total bba*/
/*total dba*/


$sql=" select idSession from tbl_session where academic_year like '%$year'";
      $ressource=@mysql_query($sql) or die('Erreur :: Select sessions');
    $i =0;
    while ($ligne= mysql_fetch_assoc($ressource)) {
 $idSession = $ligne['idSession'];
  $i++;
 /*$countus = "select count(distinct code_inscription) as c_us from ( 
            	
            	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_gen as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%dba%')
            	 ) as us";*/
            $countus = "select count(distinct code_inscription) as c_us from ( 
            	SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%dba%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%dba%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%dba%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%dba%')
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and n.idSession = '$idSession' and (c.type LIKE '%dba%') ) as us";
$req = @mysql_query($countus) or die ('ungraduate rate');
		$row = mysql_fetch_assoc($req);
		$sumdba += $row['c_us'];
}

$totaldba+=$sumdba;

/*fin total bba*/
	
}

?>           
<td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Graduation Rate/year  </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
	<TR>
		<TH align="center" width="8%" > <font size="2pt">Undergraduate</font></TH>
		<TH align="center" width="8%" > <font size="2pt">Graduate</font></TH>
		<TH align="center" width="8%" > <font size="2pt">Doctorate</font></TH>
		<TH align="center" width="8%" > <font size="2pt">Total</font></TH>
		

	</TR>
	<TR>
 		<TD align="center"><?php //echo 'laureatbba:'.$laureatbba.' '.'active bba:'. $totalbba.' '.'bbawith:'.$bbawithdrawal;
 		echo round(($laureatbba/$totalbba-$bbawithdrawal)*100,2)." %";  ?></TD>
		<TD align="center"><?php echo round(($laureatmba/ $totalmba-$mbawithdrawal)*100,2)." %";  ?></TD>
 		<TD align="center"><?php echo round(($laureatdba/ $totaldba-$dbawithdrawal)*100,2)." %";  ?></TD>
		<TD align="center"><?php echo round(($laureatbba/$totalbba-$bbawithdrawal)*100,2)+round(($laureatmba/ $totalmba-$mbawithdrawal)*100,2)+round(($laureatdba/ $totaldba-$dbawithdrawal)*100,2)." %";
		 ?></TD>
	</TR>
</TABLE>

<br/>
<!--<TABLE border="1" width="88%">
         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments By Ethnicity(not yet) </FONT></td>
</TABLE>

<TABLE width="876" border="1" cellpadding="2" frame="border" span='2'>

  <TR>

   	<TH align="center" width="15%"><FONT size="2pt">Caucasian or White, non-Hispanic</FONT></TH>
   	<TH align="center" width="15%"><FONT size="2pt">African-American or Black, non-Hispanic</FONT></TH>
    <TH align="center" width="15%"><FONT size="2pt">Hispanic</FONT></TH>
	<TH align="center" width="15%"><FONT size="2pt">Asian or Pacific Islanders</FONT></TH>
	<TH align="center" width="15%"><FONT size="2pt">American Indian or Alaskan Native</FONT></TH>
	<TH align="center" width="15%"><FONT size="2pt">Undisclosed</FONT></TH>

  </TR>

  <TR>

  <TD align="center">

   <?php 

  //echo 86+17+24;
  echo 268;
?>

</TD>
   <TD align="center">

   <?php 
   echo 127;
?></TD>
    <TD align="center">

	   <?php 

	   echo '0';
?>

</TD>

	 <TD align="center">  
	  <?php echo '15';?>
	 </TD>
    <TD align="center"> 
     <?php echo '0';?> 
    </TD>
     <TD align="center">  
      <?php echo '0';?>
       </TD>

  </TR>

</TABLE>
-->


<br/>

<TABLE border="1" width="88%">



         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments By Age</FONT></td>



</TABLE>

<TABLE width="876" border="1" cellpadding="2" frame="border" span='2'>

  <TR>

   <TH align="center" width="15%" >  <FONT size="2pt"> <18 </FONT></TH>

   <TH align="center" width="15%"> <FONT size="2pt">18-21 </FONT></TH>

    <TH align="center" width="15%"><FONT size="2pt"> 22-29</FONT></TH>

	 <TH align="center" width="15%"><FONT size="2pt"> 30-39</FONT></TH>
	  <TH align="center" width="15%"><FONT size="2pt"> >40</FONT></TH>

  </TR>

  <TR>

  <TD align="center">

   <?php 

  echo $seize;
?>

</TD>
   <TD align="center">

   <?php 
   echo $huit;
?></TD>
    <TD align="center">

	   <?php 

	   echo $vingt;
?>

</TD>

	 <TD align="center">   <?php 

   echo $quarante;



?> </TD>
 <TD align="center">   <?php 

   echo $quaranteplus;
?> </TD>

  </TR>

</TABLE>



<br/>
<!--  -->
<?php 
	//Enrollment by Male
	
	$f = 0;
	$m = 0;
	if ($year == "" || $session=="") {
			// male
			$m=0;
			$f=0;
	}else{
		
 $countm = "select count(distinct code_inscription) as m from ( 
            	SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and  (e.sexe = 'masculin' or e.sexe = 'M') and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  ".$wherezin."group by n.code_inscription 
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and  (e.sexe = 'masculin' or e.sexe = 'M')and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  ".$wherezin." group by n.code_inscription
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and  (e.sexe = 'masculin' or e.sexe = 'M')and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')   ".$wherezin." group by n.code_inscription
            	UNION ALL  
            	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and  (e.sexe = 'masculin' or e.sexe = 'M')and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')   ".$wherezin." group by n.code_inscription
				UNION ALL  
            	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and  (e.sexe = 'masculin' or e.sexe = 'M') and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') ".$wherezin."group by n.code_inscription) as us";
  $bb= @mysql_query($countm) or die ('Failure Total Enrollment all ');
  	      $row = mysql_fetch_assoc($bb);
		  $m = $row['m'];




		  $countf = "select count(distinct code_inscription) as f from ( 
            	SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (e.sexe = 'feminin' or e.sexe = 'F') and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  ".$wherezin."group by n.code_inscription 
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (e.sexe = 'feminin' or e.sexe = 'F') and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')  ".$wherezin." group by n.code_inscription
            	UNION ALL 
            	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (e.sexe = 'feminin' or e.sexe = 'F') and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')   ".$wherezin." group by n.code_inscription
            	UNION ALL  
            	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (e.sexe = 'feminin' or e.sexe = 'F') and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%')   ".$wherezin." group by n.code_inscription
				UNION ALL  
            	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_deac as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (e.sexe = 'feminin' or e.sexe = 'F')and  (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%'
					OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') ".$wherezin."group by n.code_inscription) as us";
  $bb= @mysql_query($countf) or die ('Failure Total Enrollment all ');
  	      $row = mysql_fetch_assoc($bb);
		  $f = $row['f'];
		
	}
?>
<TABLE border="1" width="88%">
	<td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments By Gender </FONT></td>
</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
	<TR>
	   <TH align="center" width="30%" > <FONT size="2pt">  Male </FONT></TH>
	   <TH align="center" width="35%"> <FONT size="2pt">Female </FONT></TH> 
	</TR>
  	<TR>
   		<TD align="center">  <?php echo $m ;?></TD>
   		<TD  align="center"> <?php echo $f; ?> </TD>
   	</TR>
</TABLE>
</form>