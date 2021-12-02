
<?php

		$niveau=$filiere=$annee=$where=$code=$search=$sgroupe=$annee_inscription=$elearning=$section=$idSession='';

               $ordering=' GROUP BY n.code_inscription';

               $sess = 0;

			if( (isset($_POST['year'])) && (!empty($_POST['year']))  )
			{
			  $year=$_POST['year'];


 $wherezin18='';
         $zin2="select idSession from tbl_session where annee='$year'";
        $z2= @mysql_query($zin2) or die ('Failure to select branches2');
  	    while ($ligne= mysql_fetch_assoc($z2))
          {
             $sess2 = $ligne['idSession'];
             $wherezin20 ="  or n.idSession=$sess2  ";
              $wherezin18=  $wherezin18.$wherezin20;
      }



  }

else if(  (isset($_POST['year'])) && (empty($_POST['year'])) ){

  	                                                   unset($_SESSION['year']);

						                                                                            }


else if( (isset($_SESSION['year'])) && (!empty($_SESSION['year'])) ){

 $session=$_POST['session'];
 $year=$_POST['year'];
 $wherezin18="";
   $zin2="select idSession from tbl_session where annee='$year'";
        $z2= @mysql_query($zin2) or die ('Failure to select branches2');
  	      while ($ligne= mysql_fetch_assoc($z2))
          {
             $sess2 = $ligne['idSession'];

             $wherezin20 ="   or n.idSession=$sess2 ";
        $wherezin18=  $wherezin18.$wherezin20;
      }


}
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





																									/****active students*/

	if( (isset($_POST['year'])) && (!empty($_POST['year'])) ){

		$year=$_SESSION['year']=$_POST['year'];
		$year2=$year-1;
		$wherenouv='';
$year1=$year+1;

	$wherenouv =$wherenouv." and e.archive!=2 and e.archive!=3 and e.archive!=10 and
	( e.graduation_date ='0000-00-00' or e.graduation_date BETWEEN '$year-07-20' AND '$year1-07-20')";

	}

	else if( (isset($_POST['year'])) && (empty($_POST['year'])) ){
		unset($_SESSION['year']);
	}

else if( (isset($_SESSION['year'])) && (!empty($_SESSION['year'])) ){
		$year=$_SESSION['year'];

	$year1=$year+1;
		$wherenouv='';


	$wherenouv =$wherenouv." and e.archive!=2 and e.archive!=3 and e.archive!=10 and
	( e.graduation_date ='0000-00-00' or e.graduation_date BETWEEN '$year-07-20' AND '$year1-07-20')";


}
/***** fin active students*/



		/*   Enrollment  Rate */
		$count_student = 0;
		$retention_rate = 0;
		$enrollment_rate=$enrollment_rate_bba=$enrollment_rate_mba=$enrollment_rate_dba= 0;
		if ($year == "") {
			$count_student = $us;
		}else{

			$count_student = $count_student+$row['tt_s'];

					}
			$year2 = $year-1;

		$count_student_pre_annee = 0;
		if ($year != "") {
			 $zin2="select idSession from tbl_session where annee='$year2'";
              $z2= @mysql_query($zin2) or die ('Failure to select branches2');
  	        while ($ligne= mysql_fetch_assoc($z2))
               {
             $sess2 = $ligne['idSession'];
             $wherezin20 ="  or n.idSession=$sess2  ";
              $s=  $s.$wherezin20;
              }


		 	$sql = "select count(distinct code_inscription) as tt_s from ( SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c , tbl_etudiant_all as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and e.prefixe='AUL' and (n.idSession=-1".$s.")
		 	UNION ALL
		 	SELECT n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c , tbl_etudiant_all as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and e.prefixe='MOR'  and (n.idSession=-1".$s.")
		 	UNION ALL
		 	SELECT n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c , tbl_etudiant_all as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and e.prefixe='AUPA'  and (n.idSession=-1".$s.")
		 	UNION ALL
		 	SELECT n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c , tbl_etudiant_all as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and(c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and e.prefixe='AUPL' and (n.idSession=-1".$s.")
		 	UNION ALL
		 	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e WHERE c.code_cours = n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (c.type LIKE '%bba%' OR c.type LIKE '%GEN-ED%' OR c.type LIKE '%bba/bscs/bsbe%' OR c.type LIKE '%bba/bsbe%' OR c.type LIKE '%bsbe%' OR c.type LIKE '%bscs%' OR c.type LIKE '%master/mba%' OR c.type LIKE '%mba%' OR c.type LIKE '%mba/mm%' OR c.type LIKE '%mm%' OR c.type LIKE '%dba%') and e.prefixe='AUPBN' and (n.idSession=-1".$s.") ) as us";
			//$req = @mysql_query($sql) or die ('Failure to get idSession Summer2 ');
			$row = mysql_fetch_assoc($req);
			$count_student_pre_annee2 = $count_student_pre_annee+$row['tt_s'];

		}

		if ($year != "") {

			 //$enrollment_rate = round($count_student_pre_annee/($count_student)*100)." %";


			  $enrollment_rate = round($count_student/(($count_student_pre_annee)*2)*100)." %";
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
	<select name="year" class="search">
	<option value=""><?php echo 'Year'; ?></option>
	   <!--   <option value="2014" <?=($year=='2014') ? $selected : '' ?>>2014-2015</option>
	   <option value="2015" <?=($year=='2015') ? $selected : '' ?>>2015-2016</option>
       <option value="2016" <?=($year=='2016') ? $selected : '' ?>>2016-2017</option>-->
       <option value="2017" <?=($year=='2017') ? $selected : '' ?>>2017-2018</option>
       <option value="2018" <?=($year=='2018') ? $selected : '' ?>>2018-2019</option>
        <option value="2019" <?=($year=='2019') ? $selected : '' ?>>2019-2020</option>
         <option value="2020" <?=($year=='2020') ? $selected : '' ?>>2020-2021</option>

	  </select>

		<input type="checkbox" class="input" name="export" value="1" style="width: 15px;margin-left: 5px;"   /> Export
	    <input type="submit" vname="Applay" value="<?php echo 'submit'; ?>"  />

			<?php if (isset($_POST['export']) && $_POST['export'] == 1) { ?>
			 <a href="statistics.xls?<?php echo time(); ?>" target="_blank">Download STATISTICS</a>
		 <?php } ?>

</div>
<div>
	</div>
<br/><br/>
<?php
$data_exported = array();
$i = 0;
$data_exported[$i] = array("");
$data_exported[$i++] = array("Active Students By Program");


 ?>

<TABLE border="1" width="88%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Active Students </FONT></td>

</TABLE>
<!-- Enrollments By Program -->
<?php
		//SQL Enrollments By Program BBA

$year1=$year+1;
$year2=$year+2;
$date3=$year-2;

      /* $sql="SELECT count(e.code_inscription) as c_enroll FROM tbl_etudiant_all as e where  (new_transcript=1 or new_transcript=2) and date_inscription>'$date3-07-01' and
(graduation_date ='0000-00-00' or graduation_date ='0000-00-01' or  graduation_date BETWEEN  '$year-09-01' AND '$year2-08-31') ";*/

$year_conditions = "";
if ($year != "") {
	$year_conditions = " and r.year = $year";
}


  $sql="SELECT count(e.code_inscription) as c_enroll FROM tbl_etudiant_all as e , registration_academic as r
 where  e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe $year_conditions ";

			if ( $year == "") {

	         	$sql="select count(*) as c_enroll from tbl_etudiant_all where archive=20";
	        }
	        //echo $sql."</br>";
			$req = @mysql_query($sql) or die ('Failure Total Enrollment by program ');
			$row = mysql_fetch_assoc($req);
			$active= $row['c_enroll'];

?>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
 <TD  align="center"> <a href="Statistiques.php?details=<?=$year?>" target='_blank'>
	 <?php

	 if ($year != "") {
		 $data_exported[$i++][] = $active;
		 echo $active;
	 }else{
		 $data_exported[$i++][] = '';
	 }


 ?></a> </TD>
 </TR>
</TABLE>
<br/>
<TABLE border="1" width="88%">
</TABLE>

<?php
		$i++;
		$data_exported[$i] = array(" ");
			$data_exported[$i++] = array("Total Non-Resident:","Total USA-Resident:");
			$i++;

 ?>

<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  <TR>
   <TH align="center" width="25%"> <FONT size="2pt">Total Non-Resident: </FONT></TH>
   <TH align="center" width="25%"><FONT size="2pt"> Total USA-Resident:</FONT></TH>
 </TR>
 <TR>
 	<!-- <TD  align="center"> <a href="Statistiques.php?NoResi=<?=$year?>" target='_blank'>-->
   <TD  align="center"> <?php
   	  //Enrollment by Florida Residents

 $b="SELECT count(e.code_inscription) as total1 FROM tbl_etudiant_all as e , registration_academic as r
 where  e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe $year_conditions and ville != 'United States'";
 //var_dump($b);
          $bb= @mysql_query($b) or die ('Failure to select Florida Students');

  	     $row = mysql_fetch_assoc($bb);
				 if ($year != "") {
					 	echo   $total1 = $row['total1'];
					 	$data_exported[$i][] = $total1;
				 }else{
					 $data_exported[$i][] = '';
				 }

		     ?>
			 </TD>
   <TD  align="center">

		 <?php if ($year != ""){ ?>
			 <a href="Statistiques.php?Resi=<?=$year?>" target='_blank'>
  			 <?php
     //Enrollment by Florida non Residents

  		   $b="SELECT count(e.code_inscription) as total6 FROM tbl_etudiant_all as e , registration_academic as r
   where  e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe $year_conditions and  ville = 'United States'  ";
         $bb= @mysql_query($b) or die ('Failure to select not Florida Students2');
    	      $row = mysql_fetch_assoc($bb);
  		  $total2 = $row['total6'];
  		 echo $total2;
  		 $data_exported[$i][] = $total2;

  		 ?></a>
		 <?php }else{
			 $data_exported[$i][] = '';
		 } ?>

	 </TD>

  </TR>
</TABLE>
<br/>

<br/>
<!--  -->
<?php
	//Enrollment by Male

	$f = 0;
	$m = 0;
	if ($year == "" ) {
			// male
			$m=0;
			$f=0;
	}else{


            	     /*  $countm="SELECT  count( e.code_inscription) as m
	FROM tbl_etudiant_all as e
	where     (e.sexe = 'male')".$wherenouv;*/
	 $countm="SELECT count(e.code_inscription) as m FROM tbl_etudiant_all as e , registration_academic as r
 where  e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe $year_conditions and (e.sexe = 'male') ";



  $bb= @mysql_query($countm) or die ('Failure Total Enrollment all MAle');
  	      $row = mysql_fetch_assoc($bb);
		  $m = $row['m'];

	 $countf="SELECT count(e.code_inscription) as f FROM tbl_etudiant_all as e , registration_academic as r
 where  e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe $year_conditions and (e.sexe = 'female' )  ";
  $bb= @mysql_query($countf) or die ('Failure Total Enrollment all Female');
  	      $row = mysql_fetch_assoc($bb);
		  $f = $row['f'];

	}
?>

<?php
		$i++;
		$data_exported[$i] = array(" ");
		$data_exported[$i++] = array("Gender");
		$data_exported[$i++] = array("Male","Female");
		$i++;



 ?>
<TABLE border="1" width="88%">
	<td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Gender </FONT></td>
</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
	<TR>
	   <TH align="center" width="30%" > <FONT size="2pt">  Male </FONT></TH>
	   <TH align="center" width="35%"> <FONT size="2pt">Female </FONT></TH>
	</TR>
  	<TR>
   		<TD align="center">  <?php
					if ($year != "") {
						echo $m;
						$data_exported[$i][] = $m;
				 }else{
					 $data_exported[$i][] = '';
				 }


			?></TD>
   		<TD  align="center"> <?php
						if ($year != "") {
							echo $f;
							$data_exported[$i][] = $f;
					 }else{
						 $data_exported[$i][] = '';
					 }



					?> </TD>
   	</TR>
</TABLE>



<br/>


<?php
$i++;
$data_exported[$i] = array();
$data_exported[$i++] = array("Age");
$data_exported[$i++] = array("<18","18-21","22-29","30-39",">40");
$i++;
// var_dump($i);
// var_dump($data_exported);
// die();
 ?>


<TABLE border="1" width="88%">



         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Age</FONT></td>



</TABLE>

<TABLE width="876" border="1" cellpadding="2" frame="border" span='2'>

  <TR>

   <TH align="center" width="15%" >  <FONT size="2pt"> <18 </FONT></TH>

   <TH align="center" width="15%"> <FONT size="2pt">18-21 </FONT></TH>

    <TH align="center" width="15%"><FONT size="2pt"> 22-29</FONT></TH>

	 <TH align="center" width="15%"><FONT size="2pt"> 30-39</FONT></TH>
	  <TH align="center" width="15%"><FONT size="2pt"> >40</FONT></TH>

  </TR>
<?php


  $a = "SELECT `date_naissance` , CURRENT_DATE, (YEAR( CURRENT_DATE ) - YEAR( date_naissance )) - ( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_naissance, 5 ) ) AS age
      	FROM tbl_etudiant_all as e , registration_academic as r
 where  e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe $year_conditions ";
 $aa= @mysql_query($a) or die ('Failure to select age');

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


?>
  <TR>

  <TD align="center">   <?php
				if ($year != "") {
					echo $seize;
					$data_exported[$i][] = $seize;
				}else{
				 	$data_exported[$i][] = '';
				}
				 ?>
	</TD>
   <TD align="center">   <?php
				 if ($year != "") {
					 echo $huit; $data_exported[$i][] = $huit;
				 }else{
					 $data_exported[$i][] = '';
				 }

				?>
			</TD>
    <TD align="center">	   <?php
				if ($year != "") {
					echo $vingt;
					$data_exported[$i][] = $vingt;
				}else{
					$data_exported[$i][] = '';
				}

				?>
			</TD>
	 <TD align="center">   <?php
			 if ($year != "") {
				 echo $quarante;
				 $data_exported[$i][] = $quarante;
			 }else{
				 $data_exported[$i][] = '';
			 }

			?>
		</TD>
 <TD align="center">   <?php
			 if ($year != "") {
				 echo $quaranteplus;
				 $data_exported[$i][] = $quaranteplus;
			 }else{
				 $data_exported[$i][] = '';
			 }



 ?> </TD>

  </TR>

</TABLE>

<br/>

<!--  New Enrollments By Program/Session  -->

<br/>
<!-- Alumni By Program -->
<?php
$year22=$year+1;

  /* $date11=$year.'-06-21';
  $date22=$year22.'-06-20';*/
  $date11=$year.'-09-01';
  $date22=$year22.'-08-31';
   $sql = "select count(code_inscription) as v3 FROM tbl_etudiant_all as e WHERE   graduation_date  BETWEEN '$date11' AND '$date22'";
					//var_dump($sql);
  if ($year == "") {
  	$sql="select count(code_inscription) as v3 from tbl_etudiant_all where archive=20";

     }
$req = @mysql_query($sql) or die ('Failure Total Alumni ');
$row = mysql_fetch_assoc($req);
$v3 = $row['v3'];
$i++;
$data_exported[$i] = array(" ");
$data_exported[$i++] = array("Alumni");
$i++;
 ?>

<TABLE border="1" width="88%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Alumni  </FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>
  	  	<TR>
  	  		<?php

					if ($year != "") {



					if($v3<1)
						{
							echo "<TD align='center'>N/A</TD>";
							$data_exported[$i][] = "N/A";

						}else {?>

						<TD  align="center"> <a href="Statistiques.php?alumni=<?=$year?>" target='_blank'>
							 <?php
							  /*if ( $year == "2016")  {
						 	$v3='75';}
							  else  if ( $year == "2017")  {
						 	$v3='39';}
							else  if ( $year == "2018")  {
						 	$v3='37';}
						 	else  if ( $year == "2019")  {
						 		$v3='53';}
						 		else  if ( $year == "2020")  {
						 		$v3='5';}*/
						 		$data_exported[$i++][] = $v3;
							 		echo $v3;

						 }?></a>


						 </TD>
					 <?php }else{
						 echo "<TD align='center'></TD>";
		 				 $data_exported[$i][] = '';
		 			 } ?>

   	</TR>
</TABLE>



<br/>

<?php
		$i++;
		$data_exported[$i] = array(" ");
$data_exported[$i++] = array("Graduation Rate");
$i++;
//var_dump($data_exported);
 ?>

<TABLE border="1" width="88%">

<td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Graduation Rate</FONT></td>


</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>

	<?php
$cours=0;

	 $sql10=" select e.prefixe,e.code_inscription,e.nom, e.prenom, e.archive,e.`date_inscription`,e.`graduation_date`, sum(nbr_credit)as total from tbl_etudiant_all e, tbl_note_acc n, tbl_cours c,registration_academic as r where e.code_inscription=n.code_inscription and e.`code_inscription` = r.code_inscription and e.`prefixe` = r.prefixe and e.`prefixe` = n.prefixe and n.code_cours=c.code_cours and(n.letter_grade!='F' and n.letter_grade!='X' and n.letter_grade!='I' and n.letter_grade!='W' and n.letter_grade!='T' ) and r.year='$year' group by n.`code_inscription`";
	 $a10= @mysql_query($sql10) or die ('Failure to select age');

while($row10 = mysql_fetch_assoc($a10)){

	if($row10['total'] > '7')

		{ $cours++;}
		}
	//echo $cours;



	  $year22=$year+1;
    $date11=$year.'-09-01';
  	$date22=$year22.'-09-30';
    ?>
	<TR>
 		<TD align="center"><?php

		if ($year != "") {
			if ($year == 2017) {
				echo $v11='77%';
				$data_exported[$i][] = "77%";
			}elseif ($year == 2018) {
				echo $v11='80.65%';
				$data_exported[$i][] = '80.65%';
			}elseif ($year == 2019) {
				echo $v11='70.97%';
				$data_exported[$i][] = "70.97%";
			}elseif ( $year == "2020")  {
				 	echo $v11=''.'%';
				 	$data_exported[$i][] = "";
			}else{
				echo $v11=round(($v3/$cours)*100,2)." %";
				$data_exported[$i][] = round(($v3/$cours)*100,2)." %";
			}
		}else{
			$data_exported[$i][] = '';
		}

			//$data_exported[$i][] = round(($v3/$active)*100,2)." %";}

			?>
		</TD>

	</TR>
</TABLE>

<br/>
<!-- WithDrawals -->
	<?php
			$wherewithdrawal = "";
			if ($year != ""  )  {

				$date1=$year.'-08-30';

                $date2=$year1.'-07-31';
				$wherewithdrawal= " and `withdrawal_date` BETWEEN '$date1' AND '$date2'";

			}
			else
				{	$wherewithdrawal= " and e.archive!=2";}
		     $sqlwithbba = "SELECT count(*) as c_withdrawal FROM `tbl_etudiant_all` as e WHERE  e.archive=2".$wherewithdrawal;
		     $req = @mysql_query($sqlwithbba) or die ('Failure Total Enrollment withdrawal ');
			$row = mysql_fetch_assoc($req);
			$withdrawalsbba = $row['c_withdrawal'];



 ?>

 <?php
 		$i++;
 		$data_exported[$i] = array();
 $data_exported[$i++] = array("Withdrawals");
 $i++;
//var_dump($data_exported);
  ?>

	<TABLE border="1" width="88%">
       <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Withdrawals</FONT></td>
	</TABLE>
	<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>

	  	<TR>

<TD align="center">
		<?php if ($year != ""){ ?>
		<a href="Statistiques.php?withdrawals=<?=$year?>&&niveau=<?=bba?>" target='_blank'>
			<?php

				echo $withdrawalsbba; $data_exported[$i][] = $withdrawalsbba; ?></a> <?php
			?>
		<?php }else{
			$data_exported[$i][] = '';
		} ?>
</TD>
		</TR>


	</TABLE>
<br/>

<?php
		$i++;
		$data_exported[$i] = array(" ");
$data_exported[$i++] = array("Retention Rate");
$i++;
//var_dump($data_exported);
 ?>



<TABLE border="1" width="88%">
       <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> Retention Rate </FONT></td>
	</TABLE>
	<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>

	    <TR>
	   	<TD align="center">
	   		 <?php

	    $sqlbba = "select count(distinct code_inscription) as c_enroll From (
				SELECT n.code_inscription FROM `tbl_note` as n ,tbl_cours as c, tbl_etudiant_all as e WHERE c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and n.archive=0  and (n.idSession=-1".$wherezin18.")group by n.code_inscription
	           	UNION ALL
	           	SELECT n.code_inscription FROM `tbl_note_morocco` as n ,tbl_cours as c, tbl_etudiant_all as e WHERE c.code_cours=n.code_cours and n.code_inscription = e.code_inscription and   n.archive=0  and (n.idSession=-1".$wherezin18.")group by n.code_inscription
	           	UNION ALL
	        	SELECT n.code_inscription FROM `tbl_note_algeria` as n ,tbl_cours as c, tbl_etudiant_all as e WHERE c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and n.archive=0  and (n.idSession=-1".$wherezin18.")group by n.code_inscription
	         	UNION ALL
	         	SELECT n.code_inscription FROM `tbl_note_burkina` as n ,tbl_cours as c, tbl_etudiant_all as e WHERE c.code_cours=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and (n.idSession=-1".$wherezin18.")group by n.code_inscription
	         	UNION ALL
	         	SELECT n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c ,  tbl_etudiant_all as e WHERE n.code_inscription = e.code_inscription  and c.code_cours=n.code_cours and n.archive=0 and (n.idSession=-1".$wherezin18.") group by n.code_inscription)as us";
			$req = @mysql_query($sqlbba) or die ('Failure Retention Rate');
			$row = mysql_fetch_assoc($req);
			/***Nombre d'etudiants de l'annee choisie***/
			$count_student_bba = $row['c_enroll'];
			//echo $rentention_bba= round ((($count_student_bba-$withdrawalsbba)/$count_student_bba)*100,2).'%';}
			if ($year != "") {
				echo $rentention_bba= round ((($active-$withdrawalsbba)/$active)*100,2).'%';
  			$data_exported[$i][] = $rentention_bba;
		 }else{
			 $data_exported[$i][] = '';
		 }


	   		?>

</TD>


</tr>


</TABLE>
<br/>


<br/>
<!-- CGPA -->
<?php
	// total BBA
	$b11 = 0;
	$b22 = 0;
	$b33 = 0;
	$b44 = 0;
	$b55 = 0;
	$cgpa2 = 0;
	$where = "";

	      $sql = "select  sum(n.gpa) / count(distinct n.code_cours) as total from tbl_note n, tbl_etudiant_all e, tbl_cours c where n.code_inscription = e.code_inscription and c.`nbr_credit` != 0 and (n.idSession=-1".$wherezin18.") and n.archive = 0 and n.code_cours=c.code_cours and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' ) and e.prefixe='AUL'  and e.date_inscription BETWEEN '$year-06-21' AND '$year1-06-20' group by n.code_inscription
	           	UNION ALL
	           	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_morocco` n, tbl_etudiant_all e, tbl_cours c where n.code_inscription = e.code_inscription  and c.`nbr_credit` != 0 and (n.idSession=-1".$wherezin18.") and n.archive = 0 and n.code_cours=c.code_cours and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' )   and e.prefixe='MOR'  and e.date_inscription BETWEEN '$year-06-21' AND '$year1-06-20' group by n.code_inscription
	           	UNION ALL
	        	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_algeria` n, tbl_etudiant_all e, tbl_cours c where n.code_inscription = e.code_inscription  and c.`nbr_credit` != 0 and (n.idSession=-1".$wherezin18.")and n.archive = 0  and n.code_cours=c.code_cours and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' )  and e.prefixe='AG'  and e.date_inscription BETWEEN '$year-06-21' AND '$year1-06-20' group by n.code_inscription
	         	UNION ALL
	         	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_burkina` n, tbl_etudiant_all e, tbl_cours c where n.code_inscription = e.code_inscription and c.`nbr_credit` != 0 and (n.idSession=-1".$wherezin18.") and n.archive = 0 and n.code_cours=c.code_cours and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' )  and e.prefixe='BF'  and e.date_inscription BETWEEN '$year-06-21' AND '$year1-06-20' group by n.code_inscription
	         	UNION ALL
	         	select sum(n.gpa) / count(distinct n.code_cours) as total from `tbl_note_benin` n, tbl_etudiant_all e, tbl_cours c where n.code_inscription = e.code_inscription  and c.`nbr_credit` != 0 and (n.idSession=-1".$wherezin18.") and n.archive = 0  and n.code_cours=c.code_cours and (letter_grade!='X' and letter_grade!='I' and letter_grade!='W' and letter_grade!='T' and letter_grade!=' ' )  and e.prefixe='BN'  and e.date_inscription BETWEEN '$year-06-21' AND '$year1-06-20' group by n.code_inscription";
	         	//echo $sql;

				$req = @mysql_query($sql) or die ('Failure Undergraduate Academic Performance ');
				$zineb=0;
				while($row = mysql_fetch_assoc($req)) {
$zineb++;
					$cgpa = round($row['total'],2);

					if ($cgpa < 2.0 ) {
						$b1n++;
					}
					if ($cgpa > 2.0 && $cgpa <= 3.0) {
						$b2n++;
					}
					if ($cgpa > 3.0) {
						$b3n++;
					}

				}



 ?>

 <?php
 		$i++;
 		$data_exported[$i] = array();
 $data_exported[$i++] = array("Academic Performance Rate");
 $i++;
  ?>


<TABLE border="1" width="88%">


          <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt">  Academic Performance Rate</FONT></td>

</TABLE>
<TABLE width="877" border="1" cellpadding="2" frame="border" span='2'>

		<TR>
		<TH align="center" width="8%" > <font size="2pt">< 2.0</font></TH>
        <TH align="center" width="8%" > <font size="2pt">between 2.0-3.0</font></TH>
		<TH align="center" width="8%" > <font size="2pt">Above 3.0 </font></TH>
	</TR>
	<TR>

    <TD align="center"><?php
		if ($year != "") {
			$b1=round(($b1n*100)/$active,2);
			echo $b1.'%';
				$data_exported[$i][] = $b1.'%';
	 }else{
		 $data_exported[$i][] = '';
	 }

				?>
			</TD>
		<TD align="center"><?php
		if ($year != "") {
			$b2= round(($b2n*100)/$active,2);
			echo $b2.'%';	$data_exported[$i][] = $b2.'%';
	 }else{
		 $data_exported[$i][] = '';
	 }


		?></TD>
 		<TD align="center">
			<?php
			if ($year != "") {
				$b3= round(($b3n*100)/$active,2);
			 echo $b5=100-($b1+$b2).'%';
			 $data_exported[$i][] = $b5;
			 //echo round((($b5+$b3)*100)/$active,2).'%';
		 }else{
			 $data_exported[$i][] = '';
		 }

 				?>
		</TD>
	</TR>
</TABLE>

<br/>
</form>


<?php
//var_dump($data_exported);
if (isset($_POST['export']) && $_POST['export'] == 1) {
	$excel = new ExportDataExcel('file');
	$excel->filename = "statistics.xls";

	$excel->initialize();
	foreach ($data_exported as $row) {
		$excel->addRow($row);
	}
	$excel->finalize();


}


 ?>
