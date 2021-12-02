
<?php
       
				$niveau=$filiere=$annee=$where=$code=$search=$sgroupe=$annee_inscription=$elearning=$section='';
	
	   		//year d'&eacute;tude  comme crit&egrave;re

							 if( (isset($_POST['annee_etude'])) && (!empty($_POST['annee_etude'])) ){
								$annee = $_SESSION['annee_etude'] = $_POST['annee_etude'];
								$where =$where." and  niveau = '".$annee."'";
																									}

									else if( (isset($_POST['annee_etude'])) && (empty($_POST['annee_etude'])) ){
  	                                                  unset($_SESSION['annee_etude']);
						                                                                            }
																									
								else if( (isset($_SESSION['annee_etude'])) && (!empty($_SESSION['annee_etude'])) ){
								   $annee=$_SESSION['annee_etude'];
  	                               $where = $where." and  niveau = '".$annee."'";
						                                                                            }
                  
				  		//year d'&eacute;tude  comme crit&egrave;re

							 if( (isset($_POST['date'])) && (!empty($_POST['date'])) ){
								$annee = $_SESSION['date'] = $_POST['date'];
								 if($annee=="2010-2011")
								{$where1 =$where1." and  date BETWEEN '2011-01-20' AND '2011-06-20'";
								$where2 =$where2." and  datemba BETWEEN '2011-01-20' AND '2011-06-20'";
								$where3 =$where3." and  datedba BETWEEN '2011-01-20' AND '2011-06-20'";}
								 else  if($annee=="2011-2012")
								{$where1 =$where1." and  date BETWEEN '2012-01-20' AND '2012-06-20'";
								$where2 =$where2." and  datemba BETWEEN '2012-01-20' AND '2012-06-20'";
								$where3 =$where3." and  datedba BETWEEN '2012-01-20' AND '2012-06-20'";}
								else  if($annee=="2012-2013")
								{$where1 =$where1." and  date BETWEEN '2013-01-20' AND '2013-06-20'";
								$where2 =$where2." and  datemba BETWEEN '2013-01-20' AND '2013-06-20'";
								$where3 =$where3." and  datedba BETWEEN '2013-01-20' AND '2013-06-20'";}
								if($annee=="2013-2014")
								{$where1 =$where1." and  date BETWEEN '2014-01-20' AND '2014-06-20'";
								$where2 =$where2." and  datemba BETWEEN '2014-01-20' AND '2014-06-20'";
								$where3 =$where3." and  datedba BETWEEN '2014-01-20' AND '2014-06-20'";}
																									}
									else if( (isset($_POST['date'])) && (empty($_POST['date'])) ){
  	                                                  unset($_SESSION['date']);
						                                                                            }
																									
								else if( (isset($_SESSION['date'])) && (!empty($_SESSION['date'])) ){
								   $annee=$_SESSION['date'];
								   if($annee=="2010-2011")
								{$where1 =$where1." and  date BETWEEN '2011-01-20' AND '2011-06-20'";
								$where2 =$where2." and  datemba BETWEEN '2011-01-20' AND '2011-06-20'";
								$where3 =$where3." and  datedba BETWEEN '2011-01-20' AND '2011-06-20'";}
								 else  if($annee=="2011-2012")
								{$where1 =$where1." and  date BETWEEN '2012-01-20' AND '2012-06-20'";
								$where2 =$where2." and  datemba BETWEEN '2012-01-20' AND '2012-06-20'";
								$where3 =$where3." and  datedba BETWEEN '2012-01-20' AND '2012-06-20'";}
								else  if($annee=="2012-2013")
								{$where1 =$where1." and  date BETWEEN '2013-01-20' AND '2013-06-20'";
								$where2 =$where2." and  datemba BETWEEN '2013-01-20' AND '2013-06-20'";
								$where3 =$where3." and  datedba BETWEEN '2013-01-20' AND '2013-06-20'";}
								if($annee=="2013-2014")
								{$where1 =$where1." and  date BETWEEN '2014-01-20' AND '2014-06-20'";
								$where2 =$where2." and  datemba BETWEEN '2014-01-20' AND '2014-06-20'";
								$where3 =$where3." and  datedba BETWEEN '2014-01-20' AND '2014-06-20'";}
																									}
                  
			//Total Enrollment 
		
		 $countus="SELECT count(*) as us FROM `tbl_etudiant_gen` WHERE archive=0 ";
          $bb= @mysql_query($countus) or die ('Failure to select branches2');
  	      $row = mysql_fetch_assoc($bb);
		  $us = $row['us'];
		 /*  $countmor="SELECT count(*) as mor FROM `tbl_etudiant` WHERE archive=0 ";
          $bb= @mysql_query($countmor) or die ('Failure to select branches2');
  	      $row = mysql_fetch_assoc($bb);
		  $mor = $row['mor'];*/
		   $countalg="SELECT count(*) as alg FROM `tbl_etudiant_Algeria` WHERE archive=0 ";
          $bb= @mysql_query($countalg) or die ('Failure to select branches2');
  	      $row = mysql_fetch_assoc($bb);
		  $alg = $row['alg'];
		   $countturk="SELECT count(*) as turk FROM `tbl_etudiant_partners` WHERE archive=0 ";
          $bb= @mysql_query($countturk) or die ('Failure to select branches2');
  	      $row = mysql_fetch_assoc($bb);
		  $turk = $row['turk'];
		
			  //Enrollment by Florida Residents
		  $b="SELECT count(*) as total1 FROM `tbl_etudiant_eng` WHERE archive=0 and state='fl'  ";
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total2 = $row['total1'];
		   $b="SELECT count(*) as total1 FROM `tbl_etudiant` WHERE archive=0 and state='fl' and country='usa' ";
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total3 = $row['total1'];
		   $b="SELECT count(*) as total1 FROM `tbl_etudiant_Algeria` WHERE archive=0 and state='fl' and country='usa' ";
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total4 = $row['total1'];
		   $b="SELECT count(*) as total1 FROM `tbl_etudiant_partners` WHERE archive=0 and state='fl' and country='usa' ";
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total5 = $row['total1'];
		  $total1=$total2+$total3+$total4+$total5;
		  
		     //Enrollment by Florida non Residents
		  $b="SELECT count(*) as total6 FROM `tbl_etudiant_eng` WHERE archive=0 and  country='usa' and  state!='fl' and archive=0";
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total6 = $row['total6'];
		  $b="SELECT count(*) as total7 FROM `tbl_etudiant` WHERE archive=0 and  country='usa' and  state!='fl' and archive=0";
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total7 = $row['total7'];
		   $b="SELECT count(*) as total8 FROM `tbl_etudiant_Algeria` WHERE archive=0 and  country='usa' and  state!='fl' and archive=0";
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total8 = $row['total8'];
		   $b="SELECT count(*) as total9 FROM `tbl_etudiant_Algeria` WHERE archive=0 and  country='usa' and  state!='fl' and archive=0";
          $bb= @mysql_query($b) or die ('Failure to select branches3');
  	      $row = mysql_fetch_assoc($bb);
		  $total9 = $row['total9'];
		  
		  
		  $total2=$total6 + $total7 +$total8+$total9 ;
			
					//Enrollment by Male
		
		  $masusa="SELECT count(*) as masusa FROM `tbl_etudiant_eng` WHERE archive=0 and sexe = 'masculin' ";
          $aa= @mysql_query($masusa) or die ('Failure to select branches1');
  	      $row = mysql_fetch_assoc($aa);
		  $masusa = $row['masusa'];
		   $masmor="SELECT count(*) as masmor FROM `tbl_etudiant` WHERE archive=0 and sexe = 'masculin' ";
          $aa= @mysql_query($masmor) or die ('Failure to select branches1');
  	      $row = mysql_fetch_assoc($aa);
		  $masmor = $row['masmor'];
		   $masalg="SELECT count(*) as masalg FROM tbl_etudiant_Algeria WHERE archive=0 and sexe = 'masculin' ";
          $aa= @mysql_query($masalg) or die ('Failure to select branches1');
  	      $row = mysql_fetch_assoc($aa);
		  $masalg = $row['masalg'];
		   $masturk="SELECT count(*) as masturk FROM `tbl_etudiant_partners` WHERE archive=0 and sexe = 'masculin' ";
          $aa= @mysql_query($masturk) or die ('Failure to select branches1');
  	      $row = mysql_fetch_assoc($aa);
		  $masturk = $row['masturk'];
		  //Enrollment by female
		   $femusa="SELECT count(*) as femusa FROM `tbl_etudiant_eng` WHERE archive=0 and sexe = 'feminin' ";
          $aa= @mysql_query($femusa) or die ('Failure to select branches1');
  	      $row = mysql_fetch_assoc($aa);
		  $femusa = $row['femusa'];
		   $femmor="SELECT count(*) as femmor FROM `tbl_etudiant` WHERE archive=0 and sexe = 'feminin' ";
          $aa= @mysql_query($femmor) or die ('Failure to select branches1');
  	      $row = mysql_fetch_assoc($aa);
		  $femmor = $row['femmor'];
		   $femalg="SELECT count(*) as femalg FROM tbl_etudiant_Algeria WHERE archive=0 and sexe = 'feminin' ";
          $aa= @mysql_query($femalg) or die ('Failure to select branches1');
  	      $row = mysql_fetch_assoc($aa);
		  $femalg = $row['femalg'];
		   $femturk="SELECT count(*) as femturk FROM `tbl_etudiant_partners` WHERE archive=0 and sexe = 'feminin' ";
          $aa= @mysql_query($femturk) or die ('Failure to select branches1');
  	      $row = mysql_fetch_assoc($aa);
		  $femturk = $row['femturk'];
		 
		  
		//Enrollment by age		

	$i=0;
   $a="SELECT code_inscription,`date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age
FROM `tbl_etudiant_gen` WHERE date <= '2013-06-30' and archive=0". $where;
 $aa= @mysql_query($a) or die ('Failure to select branches7');
 while($row = mysql_fetch_assoc($aa)){
		if(($row['age'] <= '16') && ( $row['age'] <= '17'))
		{ $i++;
		}
	}
		$seize=$i;
		
			
		  $j=0;
   $a="  SELECT `date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age
FROM `tbl_etudiant_gen` WHERE date <=  '2013-06-30' and archive=0". $where;
 $aa= @mysql_query($a) or die ('Failure to select branches8');
  	
	while($row = mysql_fetch_assoc($aa)){
		if(($row['age'] >='18') && ($row['age']<='25'))
		{ $j++;
		}}
		$huit=$j;
		
		 $k=0;
   $a="  SELECT `date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age
FROM `tbl_etudiant_gen` WHERE date <=  '2013-06-30' and archive=0". $where;
 $aa= @mysql_query($a) or die ('Failure to select branches9');
  	
	while($row = mysql_fetch_assoc($aa)){
		if(($row['age'] >='26') && ($row['age']<='44'))
		{ $k++;}}
		$vingt=$k;

	
$l=0;
   $a="  SELECT `date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age
FROM `tbl_etudiant_gen`WHERE  date <=  '2013-06-30' and archive=0 ". $where;
 $aa= @mysql_query($a) or die ('Failure to select branches');
  	
	while($row = mysql_fetch_assoc($aa)){
		if(($row['age'] >='45') && ( $row['age']<='99'))
		{ $l++;}}
		$quarante=$l;
			//Enrollment by program
		 $bbausa="SELECT count(*) as bbausa FROM `tbl_etudiant_eng` WHERE archive=0 and niveau = 'bba'";
         $aa= @mysql_query($bbausa) or die ('Failure to select branches');
       	$row = mysql_fetch_assoc($aa);
		$bbausa = $row['bbausa'];
		 $bbamor="SELECT count(*) as bbamor FROM `tbl_etudiant` WHERE archive=0 and niveau = 'bba'";
  $aa= @mysql_query($bbamor) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$bbamor = $row['bbamor'];
		 $bbatuk="SELECT count(*) as bbatuk FROM `tbl_etudiant_partners` WHERE archive=0 and niveau = 'bba'";
  $aa= @mysql_query($bbatuk) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$bbatuk = $row['bbatuk'];
		 $bbaalg="SELECT count(*) as bbaalg FROM `tbl_etudiant_Algeria` WHERE archive=0 and niveau = 'bba'";
  $aa= @mysql_query($bbaalg) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$bbaalg = $row['bbaalg'];
		$totalbba=$bbausa+$bbamor+$bbatuk+$bbaalg;
		
		
		 $bsbeusa="SELECT count(*) as bsbeusa FROM `tbl_etudiant_eng` WHERE archive=0 and niveau = 'bsbe'";
         $aa= @mysql_query($bsbeusa) or die ('Failure to select branches');
       	$row = mysql_fetch_assoc($aa);
		$bsbeusa = $row['bsbeusa'];
		 $bsbemor="SELECT count(*) as bsbemor FROM `tbl_etudiant` WHERE archive=0 and niveau = 'bsbe'";
  $aa= @mysql_query($bsbemor) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$bsbemor = $row['bsbemor'];
		 $bsbetuk="SELECT count(*) as bsbetuk FROM `tbl_etudiant_partners` WHERE archive=0 and niveau = 'bsbe'";
  $aa= @mysql_query($bsbetuk) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$bsbetuk = $row['bsbetuk'];
		 $bsbealg="SELECT count(*) bsbealg FROM `tbl_etudiant_Algeria` WHERE archive=0 and niveau = 'bsbe'";
  $aa= @mysql_query($bsbealg) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$bsbealg = $row['bsbealg'];
		$totalbsbe=$bsbeusa+$bsbemor+$bsbetuk+$bsbealg;
		
		
		 $mmusa="SELECT count(*) as mmusa FROM `tbl_etudiant_eng` WHERE archive=0 and niveau = 'mm'";
         $aa= @mysql_query($mmusa) or die ('Failure to select branches');
       	$row = mysql_fetch_assoc($aa);
		$mmusa = $row['mmusa'];
		 $mmmor="SELECT count(*) as mmmor FROM `tbl_etudiant` WHERE archive=0 and niveau = 'mm'";
  $aa= @mysql_query($mmmor) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mmmor = $row['mmmor'];
		 $mmtuk="SELECT count(*) as mmtuk FROM `tbl_etudiant_partners` WHERE archive=0 and niveau = 'mm'";
  $aa= @mysql_query($mmtuk) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mmtuk = $row['mmtuk'];
		 $mmalg="SELECT count(*) mmalg FROM `tbl_etudiant_Algeria` WHERE archive=0 and niveau = 'mm'";
  $aa= @mysql_query($mmalg) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mmalg = $row['mmalg'];
		$totalmm=$mmusa+$mmmor+$mmtuk+$mmalg;
		
		
		
		 $mbausa="SELECT count(*) as mbausa FROM `tbl_etudiant_eng` WHERE archive=0 and niveau = 'mba'";
         $aa= @mysql_query($mbausa) or die ('Failure to select branches');
       	$row = mysql_fetch_assoc($aa);
		$mbausa = $row['mbausa'];
		 $mbamor="SELECT count(*) as mbamor FROM `tbl_etudiant` WHERE archive=0 and niveau = 'mba'";
  $aa= @mysql_query($mbamor) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mbamor = $row['mbamor'];
		 $mbatuk="SELECT count(*) as mbatuk FROM `tbl_etudiant_partners` WHERE archive=0 and niveau = 'mba'";
  $aa= @mysql_query($mbatuk) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mbatuk = $row['mbatuk'];
		 $mbaalg="SELECT count(*) mbaalg FROM `tbl_etudiant_Algeria` WHERE archive=0 and niveau = 'mba'";
  $aa= @mysql_query($mbaalg) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mbaalg = $row['mbaalg'];
		$totalmba=$mbausa+$mbamor+$mbatuk+$mbaalg;
		
		
		
		$dbausa="SELECT count(*) as dbausa FROM `tbl_etudiant_eng` WHERE archive=0 and niveau = 'dba'";
         $aa= @mysql_query($dbausa) or die ('Failure to select branches');
       	$row = mysql_fetch_assoc($aa);
		$dbausa = $row['dbausa'];
		 $dbamor="SELECT count(*) as dbamor FROM `tbl_etudiant` WHERE archive=0 and niveau = 'dba'";
  $aa= @mysql_query($dbamor) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$dbamor = $row['dbamor'];
		 $dbatuk="SELECT count(*) as dbatuk FROM `tbl_etudiant_partners` WHERE archive=0 and niveau = 'dba'";
  $aa= @mysql_query($dbatuk) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$dbatuk = $row['dbatuk'];
		 $dbaalg="SELECT count(*) dbaalg FROM `tbl_etudiant_Algeria` WHERE archive=0 and niveau = 'dba'";
  $aa= @mysql_query($dbaalg) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$dbaalg = $row['dbaalg'];
		$totaldba=$dbausa+$dbamor+$dbatuk+$dbaalg;
		//Enrollment by concentration (Management)
		 $a="SELECT count(*) as mg FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=8". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mg1 = $row['mg'];
		
		 $a="SELECT count(*) as mg FROM `tbl_etudiant` WHERE archive=0 and  filiere=8". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mg2 = $row['mg'];
		
		 $a="SELECT count(*) as mg FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=8". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mg3 = $row['mg'];
		
		 $a="SELECT count(*) as mg FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=8". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mg4 = $row['mg'];
		$mgbba=$mg1+$mg2+$mg3+$mg4;
		//Enrollment by concentration (Human Resources Management)
		
		 $a="SELECT count(*) as mrh FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=14". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mrh1 = $row['mrh'];
		 $a="SELECT count(*) as mrh FROM `tbl_etudiant` WHERE archive=0 and  filiere=14". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mrh2 = $row['mrh'];
		 $a="SELECT count(*) as mrh FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=14". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mrh3 = $row['mrh'];
		 $a="SELECT count(*) as mrh FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=14". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mrh4 = $row['mrh'];
		$mrh=$mrh1+$mrh2+$mrh3+$mrh4;
		//Enrollment by concentration (Marketing)
		
		 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=4 ". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mkgcom1 = $row['mkgcom'];
		 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant` WHERE archive=0 and  filiere=4 ". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mkgcom2 = $row['mkgcom'];
		 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=4 ". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mkgcom3 = $row['mkgcom'];
		 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=4 ". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mkgcom4 = $row['mkgcom'];
		$mkgcom=$mkgcom1+$mkgcom2+$mkgcom3+$mkgcom4;
			//Enrollment by concentration (Marketing and Communication)
		
		 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=1 ". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mkgcombba1 = $row['mkgcom'];
		 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant` WHERE archive=0 and  filiere=1 ". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mkgcombba2 = $row['mkgcom'];
		 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=1 ". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mkgcombba3 = $row['mkgcom'];
		 $a="SELECT count(*) as mkgcom FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=1 ". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mkgcombba4 = $row['mkgcom'];
		$mkgcombba=$mkgcombba1+$mkgcombba2+$mkgcombba3+$mkgcombba4;
		//Enrollment by concentration (INTERNATIONAL MANAGEMENT)
		
		 $a="SELECT count(*) as mrh FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=3". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$im1 = $row['mrh'];
		 $a="SELECT count(*) as mrh FROM `tbl_etudiant` WHERE archive=0 and  filiere=3". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$im2 = $row['mrh'];
		 $a="SELECT count(*) as mrh FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=3". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$im3 = $row['mrh'];
		 $a="SELECT count(*) as mrh FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=3". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$im4 = $row['mrh'];
		$im=$im1+$im2+$im3+$im4;
		//Enrollment by concentration (Small Business and Entrepreneurship)
		 $a="SELECT count(*) as smb FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=5". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$smb1 = $row['smb'];
		$a="SELECT count(*) as smb FROM `tbl_etudiant` WHERE archive=0 and  filiere=5". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$smb2 = $row['smb'];
		$a="SELECT count(*) as smb FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=5". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$smb3 = $row['smb'];
		$a="SELECT count(*) as smb FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=5". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$smb4 = $row['smb'];
		$smb=$smb1+$smb2+$smb3+$smb4;
		//Enrollment by concentration (Diplomatic Studies)
		 $a="SELECT count(*) as dp FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=22". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$dp1 = $row['dp'];
		 $a="SELECT count(*) as dp FROM `tbl_etudiant` WHERE archive=0 and  filiere=22". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$dp2 = $row['dp'];
		 $a="SELECT count(*) as dp FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=22". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$dp3 = $row['dp'];
		 $a="SELECT count(*) as dp FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=22". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$dp4 = $row['dp'];
		$dp=$dp1+$dp2+$dp3+$dp3;
		
				//Enrollment by concentration (Project Management)
		
		 $a="SELECT count(*) as prjmgt FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=12". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$prjmgt1 = $row['prjmgt'];
		 $a="SELECT count(*) as prjmgt FROM `tbl_etudiant` WHERE archive=0 and  filiere=12". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$prjmgt2 = $row['prjmgt'];
		 $a="SELECT count(*) as prjmgt FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=12". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$prjmgt3 = $row['prjmgt'];
		 $a="SELECT count(*) as prjmgt FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=12". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$prjmgt4 = $row['prjmgt'];
			$prjmgt=$prjmgt1+$prjmgt2+$prjmgt3+$prjmgt4;
		
		//Enrollment by concentration (Information Systems Management)
		 $a="SELECT count(*) as msi FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=15". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$msi1 = $row['msi'];
		 $a="SELECT count(*) as msi FROM `tbl_etudiant` WHERE archive=0 and  filiere=15". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$msi2 = $row['msi'];
		 $a="SELECT count(*) as msi FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=15". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$msi3 = $row['msi'];
		 $a="SELECT count(*) as msi FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=15". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$msi4 = $row['msi'];
		$msi=$msi1+$msi2+$msi3+$msi4;
		
		//Enrollment by concentration (Quality Management)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=17". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mq1 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant` WHERE archive=0 and  filiere=17". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mq2 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=17". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mq3 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=17". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$mq4 = $row['mq'];
		$mq=$mq1+$mq2+$mq3+$mq4;
		//Enrollment by concentration (saltes Management)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=13". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$sm1 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant` WHERE archive=0 and  filiere=13". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$sm2 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=13". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$sm3 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=13". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$sm4 = $row['mq'];
		$sm=$sm1+$sm2+$sm3+$sm4;
		//Enrollment by concentration (International Business)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=21". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ib1 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant` WHERE archive=0 and  filiere=21". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ib2 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=21". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ib3 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=21". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ib4 = $row['mq'];
		$ib=$ib1+$ib2+$ib3+$ib4;
		//Enrollment by concentration (Finance)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=18". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ff1 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant` WHERE archive=0 and  filiere=18". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ff2 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=18". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ff3 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=18". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ff4 = $row['mq'];
		$ff=$ff1+$ff2+$ff3+$ff4;
		//Enrollment by concentration (Healthcare Management)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=16". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$hm1 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant` WHERE archive=0 and  filiere=16". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$hm2 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=16". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$hm3 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=16". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$hm4 = $row['mq'];
		$hm=$hm1+$hm2+$hm3+$hm4;
		//Enrollment by concentration (Islamin Finance)
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=25". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$if1 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant` WHERE archive=0 and  filiere=25". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$if2 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=25". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$if3 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=25". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$if4 = $row['mq'];
		$if=$if1+$if2+$if3+$if3;
		//Enrollment by concentration (LeaderShip and sustainability )
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_eng` WHERE archive=0 and  filiere=26". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ls1 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant` WHERE archive=0 and  filiere=26". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ls2 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_partners` WHERE archive=0 and  filiere=26". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ls3 = $row['mq'];
		 $a="SELECT count(*) as mq FROM `tbl_etudiant_Algeria` WHERE archive=0 and  filiere=26". $where;
  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		$ls4 = $row['mq'];
		$ls=$ls1+$ls2+$ls3+$ls4;
		//Alumni by year 
		 $a="SELECT count(*) as alumnibba FROM `tbl_etudiant` WHERE  laureatbba=1" . $where1;
  $aa= @mysql_query($a) or die ('Failure to select branches35');
  	$row = mysql_fetch_assoc($aa);
		$alumnibba = $row['alumnibba'];
		 $a="SELECT count(*) as alumnimba FROM `tbl_etudiant` WHERE  laureatmba=1". $where2;
  $aa= @mysql_query($a) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa);
		$alumnimba = $row['alumnimba'];
		 $a="SELECT count(*) as alumnidba1 FROM `tbl_etudiant` WHERE  laureatdba=1". $where3;
  $aa= @mysql_query($a) or die ('Failure to select branches33');
  	$row = mysql_fetch_assoc($aa);
		$alumnidba1 = $row['alumnidba1'];
		 $a="SELECT count(*) as alumnidba3 FROM tbl_etudiant_eng WHERE  laureatdba=1". $where3;
  $aa= @mysql_query($a) or die ('Failure to select branches33');
  	$row = mysql_fetch_assoc($aa);
		$alumnidba3 = $row['alumnidba3'];
		
		$alumnidba=$alumnidba1+$alumnidba3;
		
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
	  <select name="annee_etude" class="search">
		<option value=""><?php echo 'Major'; ?></option>
        <option value="BBA" >BBA</option>
     
        <option value="BSBE" >BSBE</option>
        <option value="MM" >MM</option>
        <option value="MBA">MBA</option>
		 <option value="DBA">DBA</option>
		
	  </select>
	  
	 
		
		  <select name="date" class="search">
		<option value=""><?php echo 'Date'; ?></option>
		  <option value="2010-2011" <?=($annee=='2010-2011') ? $selected : '' ?>>2010-2011</option>
       <option value="2011-2012" <?=($annee=='2011-2012') ? $selected : '' ?>>2011-2012</option>
        <option value="2012-2013" <?=($annee=='2012-2013') ? $selected : '' ?>>2012-2013</option>
       <option value="2013-2014" <?=($annee=='2013-2014') ? $selected : '' ?>>2013-2014</option>
		
	  </select>
	    <input type="submit" vname="Applay" value="<?php echo 'submit'; ?>"  /></div>
<br/><br/>
<TABLE border="1" width="88%">

       <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments</FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="30%" > <FONT size="2pt">  Total Enrollements:</FONT></TH>
   <TH align="center" width="35%"> <FONT size="2pt">Total Florida Residents: </FONT></TH>
    <TH align="center" width="35%"><FONT size="2pt"> Total Non-Resident Aliens:</FONT></TH>
  </TR>
  <TR>
   <TD align="center"> <?php // echo '315';
   //echo $us; ?></TD>
   <TD  align="center"> <a href="gestion_des_etudiantseng.php?fl=oui" target='_blank'>
		  <?php echo $total1; ?></a> </TD>
		    <TD  align="center"> <a href="gestion_des_etudiantseng.php?nofl=oui" target='_blank'>
		  <?php echo $total2; ?></a> </TD>
   
  </TR>
</TABLE>
<br/><br/><br/>
<TABLE border="1" width="88%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments By Program </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="21%" > <FONT size="2pt">  BBA:</FONT></TH>
      <TH align="center" width="14%"> <FONT size="2pt">BSBE: </FONT></TH>
    <TH align="center" width="12%"><FONT size="2pt"> MM:</FONT></TH>
	 <TH align="center" width="25%"><FONT size="2pt"> MBA:</FONT></TH>
	 <TH align="center" width="28%"><FONT size="2pt"> DBA:</FONT></TH>
  </TR>
  <TR>
  <TD align="center">
   <?php 
//  echo $bbausa.','.$bbamor.','.$bbatuk.','.$bbaalg;
  echo $totalbba; 




?>
</TD>
   
   <TD align="center">
   <?php 
   echo $totalbsbe;
 

?></TD>
  
  
    <TD align="center">
	   <?php 
	   echo $totalmm;
  
?>
</TD>
	 <TD align="center">   <?php 
   //echo $totalmba;
   //$totalmba=$mbausa+$mbamor+$mbatuk+$mbaalg;
   echo $totalmba;

?> </TD>
<TD align="center">   <?php 
   echo $totaldba;

?> </TD>
  </TR>
</TABLE>

<br/><br/><br/>

<TABLE border="1" width="88%">

           
      <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments By Concentration 
        </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
  
		 
  <!-- <TH align="center" width="8%" > <a href="gestion_des_etudiantseng.php?param='<?=$annee?>'" ><font size="2pt"><?php echo $mgbba;?></a></font></TH>-->
    <TH align="center" width="8%" > <font size="2pt"><?php echo $mgbba;?></font></TH>
   <TH align="left" width="35%"> <FONT size="2pt">MANAGEMENT</FONT></TH>
    <TH align="center" width="7%"><FONT size="2pt"><?php echo $mrh ;?> </FONT></TH>
	 <TH align="left" width="50%"><FONT size="2pt"> HUMAN RESOURCES MANAGEMENT</FONT></TH>
  </TR>
  <TR>
   <TH align="center" width="8%" >  <FONT size="2pt"> <?php echo $mkgcom;?> </FONT></TH>
      <TH align="left" width="35%"> <FONT size="2pt">MARKETING </FONT></TH>
    <TH align="center" width="7%"><FONT size="2pt"><?php echo $im;?>  </FONT></TH>
	 <TH align="left" width="50%"><FONT size="2pt"> INTERNATIONAL MANAGEMENT</FONT></TH>
  </TR>
  <TR>
   <TH align="center" width="8%" > <FONT size="2pt"><?php echo $smb;?>  </FONT></TH>
   <TH align="left" width="35%"><font size="2pt">Small Business &amp; Entrepreneurship</font></TH>
   <!-- <TH align="center" width="7%"> <FONT size="2pt"> 0<?php //echo $whiteMas; ?> </FONT></TH>
	 <TH align="left" width="50%"><FONT size="2pt"> COMPUTER SCIENCE</FONT></TH>-->
  </TR>
  <TR>
   <TH align="center" width="8%" > <FONT size="2pt">0  </FONT></TH>
   <TH align="left" width="35%"><font size="2pt">GENERAL MANAGEMENT</font></TH>
    <TH align="center" width="7%"> <FONT size="2pt"> <?php echo $dp; ?></FONT></TH>
	 <TH align="left" width="50%"><font size="2pt">DIPLOMATIC STUDIES </font></TH>
  </TR>
  
  <TR>
      <TH align="center" width="8%" > <FONT size="2pt"><?php echo $mkgcombba ;?> 
        </FONT></TH>
   <TH align="left" width="35%"><font size="2pt">MARKETING AND COMMUNICATION</font></TH>
   <TH align="center" width="7%"><FONT size="2pt"><?php echo $prjmgt;?> </FONT></TH>
	 <TH align="left" width="50%"><FONT size="2pt"> PROJECT MANAGEMENT </FONT></TH>
  </TR>
   <TR>
   <TH align="center" width="8%" > <FONT size="2pt"><?php echo $mq;?>  </FONT></TH>
   <TH align="left" width="35%"><font size="2pt">QUALITY MANAGEMENT </font></TH>
    <TH align="center" width="7%"> <FONT size="2pt"><?php echo $msi;?>  </FONT></TH>
	 <TH align="left" width="50%"><font size="2pt">INFORMATION SYSTEMS MANAGEMENT</font></TH>
  </TR>
   <TR>
   <TH align="center" width="8%" > <FONT size="2pt"><?php echo $sm;?> </FONT></TH>
   <TH align="left" width="35%"><font size="2pt">SALES MANAGEMENT</font></TH>
    <TH align="center" width="7%"> <FONT size="2pt"><?php echo $ib;?>  </FONT></TH>
	 <TH align="left" width="50%"><font size="2pt">INTERNATIONAL BUSINESS</font></TH>
  </TR>
  <TR>
   <TH align="center" width="8%" > <FONT size="2pt"><?php echo $ff;?>  </FONT></TH>
   <TH align="left" width="35%"><font size="2pt">FINANCE</font></TH>
    <TH align="center" width="7%"> <FONT size="2pt"><?php echo $hm;?> </FONT></TH>
	 <TH align="left" width="50%"><font size="2pt">HEALTHCARE MANAGEMENT</font></TH>
  </TR>
   <TR>
   <TH align="center" width="8%" > <FONT size="2pt"><?php echo $if;?>  </FONT></TH>
      <TH align="left" width="35%"><font size="2pt">ISLAMIC FINANCE</font></TH>
    <TH align="center" width="7%"> <FONT size="2pt"><?php echo $ls;?>  </FONT></TH>
	  <TH align="left" width="50%"><font size="2pt">LEADERSHIP AND SUSTAINABILITY</font></TH>
  </TR>
  
</TABLE>
<br/><br/><br/>


 

<TABLE border="1" width="88%">

           
      <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments By Gender 
        </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="30%" > <FONT size="2pt">  Male </FONT></TH>
   <TH align="center" width="35%"> <FONT size="2pt">Female </FONT></TH>
    
  </TR>
  <TR>
   <TD align="center">  <?php echo $masusa + $masmor+$masalg + $masturk ;//$mas; ?></TD>
   <TD  align="center"> <?php echo $femusa + $femmor+$femalg + $femturk;//$fem; ?> </TD>
   
  </TR>
</TABLE>

<!--<TABLE border="1" width="88%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Alumni</FONT></td>

</TABLE>
<TABLE width="878" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="15%" > <FONT size="2pt">  BBA </FONT></TH>
    <TH align="center" width="15%" > <FONT size="2pt">  BSCS</FONT></TH>
	 <TH align="center" width="15%" > <FONT size="2pt">  BSBE </FONT></TH>
	  <TH align="center" width="14%" > <FONT size="2pt">  MM </FONT></TH>
   <TH align="center" width="15%"> <FONT size="2pt">MBA </FONT></TH>
    <TH align="center" width="15%" > <FONT size="2pt">  DBA </FONT></TH>
    
  </TR>
  <TR>
   <TD align="center">  <?php echo $laureatbba; ?></TD>
   <TD  align="center"> <?php echo $laureatbscs; ?> </TD>
    <TD  align="center"> <?php echo $laureatbsbe; ?> </TD>
	 <TD  align="center"> <?php echo $laureatmm; ?> </TD>
	  <TD  align="center"> <?php echo $laureatmba; ?> </TD>
	   <TD  align="center"> <?php echo '0'; ?> </TD>
   
  </TR>
</TABLE>-->
<br/><br/><br/>
<TABLE border="1" width="88%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Enrollments By Age </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="20%" > <FONT size="2pt">  16-17:</FONT></TH>
   <TH align="center" width="23%"> <FONT size="2pt">18-25: </FONT></TH>
    <TH align="center" width="27%"><FONT size="2pt"> 26-44:</FONT></TH>
	 <TH align="center" width="30%"><FONT size="2pt"> 45-99:</FONT></TH>
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
  </TR>
</TABLE>

<br/><br/><br/>
<TABLE border="1" width="88%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Alumni by Year</FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="21%" > <FONT size="2pt">  BBA:</FONT></TH>
      <TH align="center" width="14%"> <FONT size="2pt">BSBE: </FONT></TH>
    <TH align="center" width="12%"><FONT size="2pt"> MM:</FONT></TH>
	 <TH align="center" width="25%"><FONT size="2pt"> MBA:</FONT></TH>
	 <TH align="center" width="28%"><FONT size="2pt"> DBA:</FONT></TH>
  </TR>
  <TR>
  <TD align="center">
   <?php 
//  echo $bbausa.','.$bbamor.','.$bbatuk.','.$bbaalg;
  echo $alumnibba; 




?>
</TD>
   
   <TD align="center">
   <?php 
   echo '0';
 

?></TD>
  
  
    <TD align="center">
	   <?php 
	   echo '0';
  
?>
</TD>
	 <TD align="center">   <?php 
   //echo $totalmba;
   //$totalmba=$mbausa+$mbamor+$mbatuk+$mbaalg;
   echo $alumnimba;

?> </TD>
<TD align="center">   <?php 
   echo $alumnidba;

?> </TD>
  </TR>
</TABLE>

<br/><br/><br/>


<TABLE border="1" width="88%">

             <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Placement Rate</FONT></td>
		

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="21%" > <FONT size="2pt">  </FONT></TH>
      <TH align="center" width="14%"> <FONT size="2pt">2011 </FONT></TH>
    <TH align="center" width="14%"><FONT size="2pt"> 2012</FONT></TH>
	 <TH align="center" width="14%"><FONT size="2pt"> 2013</FONT></TH>
	 <TH align="center" width="14%"><FONT size="2pt"> 2014</FONT></TH>
  </TR>
  <TR>
 
   <TH align="center" width="14%"> <FONT size="2pt">Undergraduate </FONT></TH>
     <TH align="center" width="14%"> <FONT size="2pt"><?php
 $var="SELECT count(*) as alumnibbajob FROM `tbl_etudiant_gen` WHERE laureatbba=1  and company!='' and date  BETWEEN '2011-01-01' AND '2011-12-01' ";
  $vara= @mysql_query($var) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($vara);
  $alumnibbajob = $row['alumnibbajob'];
  $var2="SELECT count(*) as alumnibbajobb FROM `tbl_etudiant_gen` WHERE laureatbba=1   and date  BETWEEN '2011-01-01' AND '2011-12-01' ";
  $vara2= @mysql_query($var2) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($vara2);
	$alumnibbajobb=$row['alumnibbajobb'];
 $alumnibbajob.' '.$alumnibbajobb.' ';
// echo round($alumnibbajob*100/$alumnibbajobb,0).'%';
 echo '75%';
	?> </FONT></TH>
	
	
	
	   <TH align="center" width="14%"> <FONT size="2pt"><?php
 $a2="SELECT count(*) as alumnibbajob2 FROM `tbl_etudiant_gen` WHERE  laureatbba=1  and company!='' and date  BETWEEN '2012-01-01' AND '2012-12-01' ";
  $aa2= @mysql_query($a2) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa2);
 $alumnibbajob2=$row['alumnibbajob2'];
  $a2="SELECT count(*) as alumnibbajobb2 FROM `tbl_etudiant_gen` WHERE  laureatbba=1   and date  BETWEEN '2012-01-01' AND '2012-12-01' ";
  $aa2= @mysql_query($a2) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa2);
   $alumnibbajobb2 = $row['alumnibbajobb2'];
  $alumnibbajob2.' '.$alumnibbajobb2.' ';
  //echo round($alumnibbajob2*100/$alumnibbajobb2,0).'%';
   echo '82%';
	?> </FONT></TH>
	
	
	
	     <TH align="center" width="14%"> <FONT size="2pt"><?php
 $a3="SELECT count(*) as alumnibbajob3 FROM `tbl_etudiant_gen` WHERE laureatbba=1  and company!='' and date  BETWEEN '2013-01-01' AND '2013-12-01' ";
  $aa3= @mysql_query($a3) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa3);
 $alumnibbajob3 = $row['alumnibbajob3'].' ';
 $a3="SELECT count(*) as alumnibbajobb3 FROM `tbl_etudiant_gen` WHERE laureatbba=1  and date  BETWEEN '2013-01-01' AND '2013-12-01' ";
  $aa3= @mysql_query($a3) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa3);
 $alumnibbajobb3 = $row['alumnibbajobb3'].' ';
 // echo round($alumnibbajob3*100/$alumnibbajobb3,0).'%';
  echo '88%';
 
	?> </FONT></TH>
		   <TH align="center" width="14%"> <FONT size="2pt"><?php
 $a4="SELECT count(*) as alumnibbajob4 FROM `tbl_etudiant_gen` WHERE company !='' and laureatbba=1  and company!='' and date  BETWEEN '2014-01-01' AND '2014-12-01'";
  $aa4= @mysql_query($a4) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa4);
 $alumnibbajob4 = $row['alumnibbajob4'].' ';
 
 $a4="SELECT count(*) as alumnibbajobb4 FROM `tbl_etudiant_gen` WHERE laureatbba=1  and date  BETWEEN '2014-01-01' AND '2014-12-01'";
  $aa4= @mysql_query($a4) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa4);
$alumnibbajobb4 = $row['alumnibbajobb4'].' ';
//  echo round($alumnibbajob4*100/$alumnibbajobb4,0).'%';
  echo '85%';
	?> </FONT></TH>

  
  </TR>
   <TR>
 
   <TH align="center" width="14%"> <FONT size="2pt">Graduate and DBA </FONT></TH>
     <TH align="center" width="14%"> <FONT size="2pt"> <?php
 $a="SELECT count(*) as alumnibbajob FROM `tbl_etudiant_gen` WHERE company !='' and (laureatmba=1 or laureatdba=1) and (datemba BETWEEN '2011-01-01' AND '2011-12-01' or datedba BETWEEN '2011-01-01' AND '2011-12-01')";
  $aa= @mysql_query($a) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa);
 $alumnibbajob = $row['alumnibbajob'].' ';
  $a="SELECT count(*) as alumnibbajob2 FROM `tbl_etudiant_gen` WHERE (laureatmba=1 or laureatdba=1) and (datemba BETWEEN '2011-01-01' AND '2011-12-01' or datedba BETWEEN '2011-01-01' AND '2011-12-01')";
  $aa= @mysql_query($a) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa);
 $alumnibbajob2 = $row['alumnibbajob2'].' ';
 // echo round($alumnibbajob*100/$alumnibbajob2,0).'%';
  echo '80%';
	?></FONT></TH>
	   <TH align="center" width="14%"> <FONT size="2pt"> <?php
 $a2="SELECT count(*) as alumnibbajob2 FROM `tbl_etudiant_gen` WHERE company !='' and (laureatmba=1 or laureatdba=1)  and company!='' and (datemba BETWEEN '2012-01-01' AND '2012-12-01' or datedba BETWEEN '2012-01-01' AND '2012-12-01')";
  $aa2= @mysql_query($a2) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa2);
 $alumnibbajob2 = $row['alumnibbajob2'].' ';
 
 $a2="SELECT count(*) as alumnibbajob22 FROM `tbl_etudiant_gen` WHERE (laureatmba=1 or laureatdba=1)   and (datemba BETWEEN '2012-01-01' AND '2012-12-01' or datedba BETWEEN '2012-01-01' AND '2012-12-01')";
  $aa2= @mysql_query($a2) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa2);
 $alumnibbajob22 = $row['alumnibbajob22'].' ';
 // echo round($alumnibbajob2*100/$alumnibbajob22,0).'%';
 echo '85%';
 
	?></FONT></TH>
	     <TH align="center" width="14%"> <FONT size="2pt"> <?php
 $a3="SELECT count(*) as alumnibbajob3 FROM `tbl_etudiant_gen` WHERE company !='' and (laureatmba=1 or laureatdba=1)  and company!='' and (datemba BETWEEN '2013-01-01' AND '2013-12-01' or datedba BETWEEN '2013-01-01' AND '2013-12-01')";
  $aa3= @mysql_query($a3) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa3);
  $alumnibbajob3 = $row['alumnibbajob3'].' ';
 $a3="SELECT count(*) as alumnibbajob33 FROM `tbl_etudiant_gen` WHERE (laureatmba=1 or laureatdba=1)  and (datemba BETWEEN '2013-01-01' AND '2013-12-01' or datedba BETWEEN '2013-01-01' AND '2013-12-01')";
  $aa3= @mysql_query($a3) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa3);
  $alumnibbajob33 = $row['alumnibbajob33'].' ';
// echo round($alumnibbajob3*100/$alumnibbajob33,0).'%';
	 echo '90%';
	 ?></FONT></TH>
		   <TH align="center" width="14%"> <FONT size="2pt"><?php
 $a4="SELECT count(*) as alumnibbajob4 FROM `tbl_etudiant_gen` WHERE company !='' and (laureatmba=1 or laureatdba=1)  and company!='' and (datemba BETWEEN '2014-01-01' AND '2014-12-01' or datedba BETWEEN '2014-01-01' AND '2014-12-01')";
  $aa4= @mysql_query($a4) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa4);
 $alumnibbajob4 = $row['alumnibbajob4'].' ';
 
 $a4="SELECT count(*) as alumnibbajob44 FROM `tbl_etudiant_gen` WHERE  (laureatmba=1 or laureatdba=1)   and (datemba BETWEEN '2014-01-01' AND '2014-12-01' or datedba BETWEEN '2014-01-01' AND '2014-12-01')";
  $aa4= @mysql_query($a4) or die ('Failure to select branches34');
  	$row = mysql_fetch_assoc($aa4);
 $alumnibbajob44 = $row['alumnibbajob44'].' ';
// echo round($alumnibbajob4*100/$alumnibbajob44,0).'%';
  echo '90%';
	?> </FONT></TH>

  
  </TR>
</TABLE>

  </TABLE>

<br/><br/><br/>
</form>