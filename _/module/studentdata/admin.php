
<?php

		$niveau=$filiere=$annee=$where=$code=$search=$sgroupe=$annee_inscription=$elearning=$section=$idSession=$wherezin='';

               $ordering=' GROUP BY n.code_inscription';

               $sess = 0;

				if( (isset($_POST['year'])) && (!empty($_POST['year'])) || (isset($_POST['session'])) && (!empty($_POST['session'])) )
			{

			 $session=$_POST['session'];
	         $year=$_POST['year'];


         $zin="select idSession from tbl_session where session='$session' and academic_year='$year'";
        $z= @mysql_query($zin) or die ('Failure to select branches2');
  	    $row = mysql_fetch_assoc($z);
        $sess = $row['idSession'];

         $wherezin =$wherezin." or  n.idSession=$sess ";

      }

else if( (isset($_POST['session'])) && (empty($_POST['session'])) && (isset($_POST['year'])) && (empty($_POST['year'])) ){
  	                                                  unset($_SESSION['session']);
  	                                                   unset($_SESSION['year']);

						                                                                            }

else if( (isset($_SESSION['session'])) && (!empty($_SESSION['session'])) && (isset($_SESSION['year'])) && (!empty($_SESSION['year'])) ){

 $session=$_POST['session'];
	 $year=$_POST['year'];


$zin="select idSession from tbl_session where session='$session' and academic_year='$year'";
$z= @mysql_query($zin) or die ('Failure to select branches2');
  	      $row = mysql_fetch_assoc($z);
  echo $sess = $row['idSession'];

  $wherezin =$wherezin." or  n.idSession=$sess group by n.code_inscription";

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


/***** fin active students*/



?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;STUDENT DATA
	 &nbsp;&nbsp;<span class="task"></span>
 	</td>
	<td width="22%">&nbsp;</td>
  </tr>
</table>



 <form action="#" method="post" name="adminMenu" >
	<input type="hidden" name="boxchecked" value="0" />

<div class="container_search">
	<!--<select name="year" class="search">
	   <option value=""><?php echo 'SESSION'; ?></option>
	   <option value="2014" <?=($year=='2014') ? $selected : '' ?>>DEC 2017</option>
	   <option value="2015" <?=($year=='2015') ? $selected : '' ?>>JUNE 2018</option>
       <option value="2016" <?=($year=='2016') ? $selected : '' ?>>DEC 2018</option>
       <option value="2017" <?=($year=='2017') ? $selected : '' ?>>JUNE 2019</option>
       <option value="2018" <?=($year=='2018') ? $selected : '' ?>>DEC 2019</option>
        <option value="2019" <?=($year=='2019') ? $selected : '' ?>>JUNE 2020</option>

	  </select>-->
	    <select name="session" class="search">
		<option value=""><?php echo 'session'; ?></option>
		  <option value="Fall" <?=($session=='Fall') ? $selected : '' ?>>December</option>
       <option value="Spring" <?=($session=='Spring') ? $selected : '' ?>>June</option>
       <!-- <option value="Summer" <?=($session=='Summer') ? $selected : '' ?>>Summer</option>-->

	  </select>
	<select name="year" class="search">
		<option value=""><?php echo 'Year'; ?></option>

       <!--<option value="2017" <?=($year=='2017') ? $selected : '' ?>>2016-2017</option>
       <option value="2018" <?=($year=='2018') ? $selected : '' ?>>2017-2018</option>
        <option value="2019" <?=($year=='2019') ? $selected : '' ?>>2018-2019</option>
         <option value="2020" <?=($year=='2020') ? $selected : '' ?>>2019-2020</option>-->
          <option value="2016/2017" <?=($year=='2016/2017') ? $selected : '' ?>>2016-2017</option>
       <option value="2017/2018" <?=($year=='2017/2018') ? $selected : '' ?>>2017-2018</option>
        <option value="2018/2019" <?=($year=='2018/2019') ? $selected : '' ?>>2018-2019</option>
         <option value="2019/2020" <?=($year=='2019/2020') ? $selected : '' ?>>2019-2020</option>
         <option value="2020/2021" <?=($year=='2020/2021') ? $selected : '' ?>>2020-2021</option>
	  </select>

	 		<input type="checkbox" class="input" name="export" value="1" style="width: 15px;margin-left: 5px;"   /> Export
	    <input type="submit" vname="Applay" value="<?php echo 'submit'; ?>"  />
			<?php if (isset($_POST['export']) && $_POST['export'] == 1) { ?>
				<a href="students_data.xls" target="_blank">Download Students</a>
			<?php } ?>

</div>
<div>
	</div>
<br/>

<TABLE border="1" width="100%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> STUDENT DATA </FONT></td>

</TABLE>
<!-- Enrollments By Program -->
<?php
$data_exported = array();
$data_exported[0] = array("MODULES","CORE COURSE","AVERAGE GRADE","%FAIL","SUCCESS RATE");
$i = 0;


?>
<TABLE width="1000" border="1" cellpadding="2" frame="border" span='2'>
  	<TR>
  		<TH align="center" width="20%" > <FONT size="2pt"> MODULES</FONT></TH>
   		<TH align="center" width="21%" > <FONT size="2pt"> CORE COURSE</FONT></TH>
	 	<!--<TH align="center" width="10%"><FONT size="2pt"> #STUDENTS</FONT></TH>-->
        <TH align="center" width="20%"><FONT size="2pt"> AVERAGE GRADE</FONT></TH>
        <TH align="center" width="10%"><FONT size="2pt"> %FAIL</FONT></TH>
	 	<TH align="center" width="30%"><FONT size="2pt"> SUCCESS RATE</FONT></TH>
  	</TR>

<br/>
<TR>
	<TD align="center">
		<?php
			$i++;
			echo 'LANGUAGE ART';
			$data_exported[$i][] = 'LANGUAGE ART';
		?></TD>
  		<TD align="center"> <?php echo 'ENGLISH 1'; $data_exported[$i][] = 'ENGLISH 1';?></TD>
  	<!--<TD align="center"> -->
  		<?php

		  $sql=" select count( code_inscription) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null' and c.titre ='ENGLISH 1'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 1'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null' and c.titre ='ENGLISH 1'    and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null' and c.titre ='ENGLISH 1'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null' and  c.titre ='ENGLISH 1'    and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";


$aa= @mysql_query($sql) or die ('Failure to select branches1');
$row=mysql_fetch_assoc($aa);
	 $studeng1= $row['eng']; ?>

	<!--</TD>-->
  		<TD align="center"> <?php

		   $sql=" select sum(final_grade) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.titre ='ENGLISH 1'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.titre ='ENGLISH 1'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 1'    and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 1'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 1'    and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";


$aa= @mysql_query($sql) or die ('Failure to select branches2');
$row=mysql_fetch_assoc($aa);
if( $row['eng']/$studeng1=='0')
{ echo ''; $data_exported[$i][] = '';}
	else { echo $sumeng1= round($row['eng']/$studeng1,2).'%'; $data_exported[$i][] = $sumeng1;} ?></TD>
  		<TD align="center">
  		 <?php
  		 $sql=" select count(code_inscription) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.titre ='ENGLISH 1'    and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 1'    and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 1'     and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 1'    and (final_grade between '60' and '65')and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 1'     and (final_grade between '60' and '65')and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";


$aa= @mysql_query($sql) or die ('Failure to select branches3');
$row=mysql_fetch_assoc($aa);
	 $failedeng1= $row['eng'];

	 if (($failedeng1*100)/$studeng1=='0')
{ echo ''; $data_exported[$i][] = '';}
else { echo round(($failedeng1*100)/$studeng1,2).'%'; $data_exported[$i][] = $sumeng1;}
  		?></TD>
  		<TD align="center"> <?php if (($studeng1-$failedeng1)/$studeng1*100 =='0')
  		{ echo ''; $data_exported[$i][] = "";} else { echo round(($studeng1-$failedeng1)/$studeng1*100,2).'%'; $data_exported[$i][] = round(($studeng1-$failedeng1)/$studeng1*100,2).'%';}?></TD>

  	 	<TR>

  		<TR>
	<TD align="center"><?php $i++; $data_exported[$i][] = ''; ?></TD>
  		<TD align="center"> <?php
			echo 'ENGLISH 2'; $data_exported[$i][] = 'ENGLISH 2';?></TD>
  		<!--<TD align="center">-->
  		 <?php

		  $sql=" select count( code_inscription) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 2'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 2'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 2'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 2'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 2' and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";



$aa= @mysql_query($sql) or die ('Failure to select branches');
$row=mysql_fetch_assoc($aa);
	 $studeng2=$row['eng']; ?>

</TD>
  		<TD align="center"> <?php $sql=" select sum(final_grade) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 2'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 2'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and  c.titre ='ENGLISH 2'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 2'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 2' and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";



$aa= @mysql_query($sql) or die ('Failure to select branches');
$row=mysql_fetch_assoc($aa);
if($row['eng']/$studeng2 >'0')
	{echo round($row['eng']/$studeng2,2).'%'; $data_exported[$i][] = round($row['eng']/$studeng2,2).'%';}
		else { echo ''; $data_exported[$i][] = '';}?>
	</TD>
  		<TD align="center"> <?php
  		 $sql=" select count( code_inscription) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 2'   and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 2'   and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 2'   and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 2'    and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and   c.titre ='ENGLISH 2' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";



$aa= @mysql_query($sql) or die ('Failure to select branches');
$row=mysql_fetch_assoc($aa);
	 $failedeng2=$row['eng'];
	 if (($failedeng2*100)/$studeng2 >'0')
	 {echo round(($failedeng2*100)/$studeng2,2).'%';
	$data_exported[$i][] = round(($failedeng2*100)/$studeng2,2).'%';}
	else { echo ''; $data_exported[$i][] = '';}

	 ?></TD>
  		<TD align="center"> <?php if(($studeng2-$failedeng2)/$studeng2*100 >'0') {
  			echo round(($studeng2-$failedeng2)/$studeng2*100,2).'%';
  			$data_exported[$i][] =round(($studeng2-$failedeng2)/$studeng2*100,2).'%'; }
  			else { echo ''; $data_exported[$i][] = '';}?>
  		</TD>


  	<TR>
  		<TR>
	<TD align="center"><?php $i++; $data_exported[$i][] = ''; ?></TD>
  		<TD align="center"> <?php
			echo 'ENGLISH 3';
			$data_exported[$i][] = 'ENGLISH 3';
			?></TD>
  		<!--<TD align="center">-->
  		 <?php

		  $sql=" select count( code_inscription) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'    and  c.titre ='ENGLISH 3'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.titre ='ENGLISH 3'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.titre ='ENGLISH 3' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 3'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 3' and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";



$aa= @mysql_query($sql) or die ('Failure to select branches');
$row=mysql_fetch_assoc($aa);
	 $studeng3=$row['eng']; ?></TD>
  		<TD align="center"> <?php

  		 $sql=" select sum(final_grade) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'    and  c.titre ='ENGLISH 3'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 3'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.titre ='ENGLISH 3' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 3'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 3' and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";



$aa= @mysql_query($sql) or die ('Failure to select branches');
$row=mysql_fetch_assoc($aa);
	if($row['eng']/$studeng3 >'0')
		{echo $sumeng3=round($row['eng']/$studeng3,2).'%';
	$data_exported[$i][] = round($row['eng']/$studeng3,2).'%';
}else{ echo ''; $data_exported[$i][] = '';}
	?></TD>
  		<TD align="center"> <?php
  		  $sql=" select count( code_inscription) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and  c.titre ='ENGLISH 3'  and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 3'  and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 3'  and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 3'  and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 3'  and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";



$aa= @mysql_query($sql) or die ('Failure to select branches');
$row=mysql_fetch_assoc($aa);
	 $failedeng3=$row['eng'];
	 if(($failedeng3*100)/$studeng3 > 0 ){
		 echo round(($failedeng3*100)/$studeng3,2).'%';
		 $data_exported[$i][] = round(($failedeng3*100)/$studeng3,2).'%';
	}else {
		echo ''; $data_exported[$i][] = '';
	}
	?></TD>
  		<TD align="center"> <?php
  		if( ($studeng3-$failedeng3)/$studeng3*100 >'0' ) {
	  		echo round(($studeng3-$failedeng3)/$studeng3*100,2).'%' ;
	  		$data_exported[$i][] = round(($studeng3-$failedeng3)/$studeng3*100,2).'%' ;
			}else {
				echo ''; $data_exported[$i][] = '';
			}
		?>
  </TD>


  	<TR>
  		<TR>
	    <TD align="center"><?php $i++; $data_exported[$i][] = ''; ?></TD>
  		<TD align="center"><?php
			$data_exported[$i][] = 'ENGLISH 4';
			echo 'ENGLISH 4'; ?></TD>
  		<!--<TD align="center">-->
  		 <?php
		  $sql="select count( code_inscription) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.titre ='ENGLISH 4' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 4'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 4'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 4'    and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 4'  and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";



$aa= @mysql_query($sql) or die ('Failure to select branches');
$row=mysql_fetch_assoc($aa);
	 $studeng4=$row['eng']; ?></TD>
  		<TD align="center"> <?php
  		$sql="select sum(final_grade) as eng from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.titre ='ENGLISH 4' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 4'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 4'   and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 4'    and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 4'  and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as eng";



$aa= @mysql_query($sql) or die ('Failure to select branches');
$row=mysql_fetch_assoc($aa);
	if($row['eng']/$studeng4 >'0')  {
		echo $sumeng4=round($row['eng']/$studeng4,2).'%';
		$data_exported[$i][] = round($row['eng']/$studeng4,2).'%';}
		else { echo ''; $data_exported[$i][] = '';}
	?></TD>
  		<TD align="center"> <?php
  		  $sql="select count( code_inscription) as inf from (SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.titre ='ENGLISH 4' and (final_grade between '60' and '65') and  (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 4'   and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.titre ='ENGLISH 4'    and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 4'    and  (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ENGLISH 4'  and ( final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as inf";



$aa= @mysql_query($sql) or die ('Failure to select branches');
$row=mysql_fetch_assoc($aa);
	 $failedeng4=$row['inf'];
	 if(($failedeng4*100)/$studeng4 >'0')
	 {
	echo round(($failedeng4*100)/$studeng4,2).'%';
	$data_exported[$i][] = round(($failedeng4*100)/$studeng4,2).'%';}
	else { echo ''; $data_exported[$i][] = '';}

?></TD>
  		<TD align="center"> <?php
  		if(($studeng4-$failedeng4)/$studeng4*100 >'0')
  			{echo round(($studeng4-$failedeng4)/$studeng4*100,2).'%'; $data_exported[$i][] = round(($studeng4-$failedeng4)/$studeng4*100,2).'%';}

  		else { echo ''; $data_exported[$i][] = '';}
  ?></TD>


  	<TR>
  		<TR><TR><TR><TR>
  		<TR>
  			<TD align="center"> <?php $i++; echo 'MATHEMATICS'; $data_exported[$i][] = 'MATHEMATICS';?></TD>
  		<TD align="center"> <?php echo 'ALGEBRA 1'; $data_exported[$i][] = 'ALGEBRA 1'; ?></TD>
  		<!--<TD align="center">-->
  		 <?php

		 // $sql2="SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,count(*) as nbreCours

		  $sql2=" select count( code_inscription) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 1' and c.module ='Mathematics'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 1' and c.module = 'Mathematics'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	  $studalgb1=$row2['us'];



					  ?></TD>
  		<TD align="center"> <?php

  		$sql2=" select sum(final_grade) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 1' and c.module ='Mathematics'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 1' and c.module = 'Mathematics'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	if($row2['us']/$studalgb1 >'0')
		{ echo $sumalgb1=round($row2['us']/$studalgb1,2).'%';
	$data_exported[$i][] = round($row2['us']/$studalgb1,2).'%';}
	else { echo ''; $data_exported[$i][] = '';}

  ?></TD>
  		<TD align="center"> <?php  $sql2=" select count( code_inscription) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (final_grade between '60' and '65')and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (final_grade between '60' and '65')  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 1' and c.module = 'Mathematics' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 1' and c.module ='Mathematics' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as us";


	 $aa2= @mysql_query($sql2) or die ('Failure to select branches');
	 $row2=mysql_fetch_assoc($aa2);
	 $failedalgb1=$row2['us'];
	 if(($failedalgb1*100)/$studalgb1 >'0')
{	 echo round(($failedalgb1*100)/$studalgb1,2).'%';
	 $data_exported[$i][] = round(($failedalgb1*100)/$studalgb1,2).'%';}
	 else { echo ''; $data_exported[$i][] = '';}

 ?></TD>
  		<TD align="center"> <?php

  		if(($studalgb1-$failedeng1)/$studalgb1*100 >'0') {echo round(($studalgb1-$failedeng1)/$studalgb1*100,2).'%';
				$data_exported[$i][] = round(($studalgb1-$failedeng1)/$studalgb1*100,2).'%';}
				else { echo ''; $data_exported[$i][] = '';}
			?></TD>


  	<TR>
  		<TR>
  			<TD align="center"><?php $i++;  $data_exported[$i][] = ''; ?></TD>
  		<TD align="center"> <?php echo 'ALGEBRA 2'; $data_exported[$i][] = 'ALGEBRA 2'; ?></TD>
  		<!--<TD align="center"> -->
  			<?php
		  $sql2=" select count( code_inscription) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2'  and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2' and c.module ='Mathematics'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 2' and c.module = 'Mathematics'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studalgb2=$row2['us'];



					  ?></TD>
  		<TD align="center"> <?php  $sql2=" select sum(final_grade) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2'  and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 2' and c.module ='Mathematics'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 2' and c.module = 'Mathematics'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2' and c.module ='Mathematics' and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
if($row2['us']/$studalgb2 >'0')
{
	echo $sumalgb2=round($row2['us']/$studalgb2,2).'%';
	$data_exported[$i][] = round($row2['us']/$studalgb2,2).'%';}
	else { echo ''; $data_exported[$i][] = '';}
 ?></TD>
  		<TD align="center"> <?php
		  $sql2=" select count( code_inscription) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and  c.titre ='ALGEBRA 2'  and c.module ='Mathematics' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2' and c.module ='Mathematics' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2' and c.module ='Mathematics'  and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and  c.titre ='ALGEBRA 2' and c.module = 'Mathematics' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and  c.titre ='ALGEBRA 2' and c.module ='Mathematics' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription ) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);

 $failedalgb2=$row2['us'];
 if(($failedalgb2*100)/$studalgb2 > '0')
 {
echo round(($failedalgb2*100)/$studalgb2,2).'%';
	$data_exported[$i][] = round(($failedalgb2*100)/$studalgb2,2).'%';}
else { echo ''; $data_exported[$i][] = '';}
	?></TD>
  		<TD align="center"> <?php if(($studalgb2-$failedalgb2)/$studalgb2*100 >'0')
  		{
  		echo round(($studalgb2-$failedalgb2)/$studalgb2*100,2).'%';
			$data_exported[$i][] =  round(($studalgb2-$failedalgb2)/$studalgb2*100,2).'%';}
else { echo ''; $data_exported[$i][] = '';} ?></TD>

  	<TR>
  		<TR>
  			<TD align="center"><?php $i++;  $data_exported[$i][] = ''; ?></TD>
  		<TD align="center"> <?php echo 'GEOMETRY'; $data_exported[$i][] = 'GEOMETRY'; ?></TD>
  		<!--<TD align="center"> --><?php

		 // $sql2="SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,count(*) as nbreCours

		  $sql2=" select count( code_inscription) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'   and c.module ='Mathematics'
            	and c.titre ='GEOMETRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'
            	and c.titre ='GEOMETRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Mathematics'  and c.titre ='GEOMETRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Mathematics' and c.titre ='GEOMETRY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'  and c.titre ='GEOMETRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studgeom=$row2['us'];



					  ?></TD>
  		<TD align="center"> <?php  $sql2=" select sum(final_grade) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Mathematics'
            	and c.titre ='GEOMETRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'
            	and c.titre ='GEOMETRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Mathematics'  and c.titre ='GEOMETRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Mathematics' and c.titre ='GEOMETRY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'  and c.titre ='GEOMETRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
if($row2['us']/$studgeom >'0')
{
	 echo $sumgeom=round($row2['us']/$studgeom,2).'%';
	 $data_exported[$i][] = round($row2['us']/$studgeom,2).'%';}
	 else { echo ''; $data_exported[$i][] = '';}
  ?></TD>
  		<TD align="center"> <?php  $sql2=" select count( code_inscription) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Mathematics'
            	and c.titre ='GEOMETRY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'
            	and c.titre ='GEOMETRY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Mathematics'  and c.titre ='GEOMETRY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Mathematics' and c.titre ='GEOMETRY' and (final_grade between '60' and '65')  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'  and c.titre ='GEOMETRY' and (final_grade between '60' and '65')  and (n.idSession=-1".$wherezin.") group by n.code_inscription) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedgeom=$row2['us'];
	 if(($failedgeom*100)/$studgeom >'0')
	 {
	echo round(($failedgeom*100)/$studgeom,2).'%';
	$data_exported[$i][] = round(($failedgeom*100)/$studgeom,2).'%';}
	else { echo ''; $data_exported[$i][] = '';}
 ?></TD>
  		<TD align="center"> <?php if(($studgeom-$failedgeom)/$studgeom*100 >'0')
  		{ echo round(($studgeom-$failedgeom)/$studgeom*100,2).'%'; $data_exported[$i][] = round(($studgeom-$failedgeom)/$studgeom*100,2).'%';}
  		else { echo ''; $data_exported[$i][] = '';}
  ?></TD>



  	<TR>
  		<TR>
  			<TD align="center"><?php $i++;  $data_exported[$i][] = ''; ?></TD>
  		<TD align="center"> <?php echo 'PRE-CALCULUS'; $data_exported[$i][] = 'PRE-CALCULUS';?></TD>
  		<!--<TD align="center">-->
  		 <?php
		  $sql2=" select count( code_inscription) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Mathematics'
            	and c.titre ='PRE-CALCULUS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'
            	and c.titre ='PRE-CALCULUS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Mathematics'  and c.titre ='PRE-CALCULUS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Mathematics' and c.titre ='PRE-CALCULUS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'  and c.titre ='PRE-CALCULUS' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studpreca=$row2['us'];



					  ?></TD>
  		<TD align="center"> <?php  $sql2=" select sum(final_grade) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'    and c.module ='Mathematics'
            	and c.titre ='PRE-CALCULUS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'
            	and c.titre ='PRE-CALCULUS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Mathematics'  and c.titre ='PRE-CALCULUS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Mathematics' and c.titre ='PRE-CALCULUS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'  and c.titre ='PRE-CALCULUS' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	if($row2['us']/$studpreca >'0')
		{echo $sumpreca=round($row2['us']/$studpreca,2).'%'; $data_exported[$i][] = round($row2['us']/$studpreca,2).'%';}
	else { echo ''; $data_exported[$i][] = '';} ?></TD>
  		<TD align="center">
  			<?php
  		 $sql2=" select count( code_inscription) as us from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Mathematics'
            	and c.titre ='PRE-CALCULUS' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'
            	and c.titre ='PRE-CALCULUS' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Mathematics'  and c.titre ='PRE-CALCULUS' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Mathematics' and c.titre ='PRE-CALCULUS' and (final_grade between '60' and '65')  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Mathematics'  and c.titre ='PRE-CALCULUS'  and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription) as us";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedpreca=$row2['us'];
	if(($failedpreca*100)/$studpreca >'0') {
		echo round(($failedpreca*100)/$studpreca,2).'%';
	$data_exported[$i][] = round(($failedpreca*100)/$studpreca,2).'%';}
	else { echo ''; $data_exported[$i][] = '';}


	?></TD>
  		<TD align="center"> <?php
  		if(($studpreca-$failedpreca)/$studpreca*100 >'0')
  		{ echo round(($studpreca-$failedpreca)/$studpreca*100,2).'%'; $data_exported[$i][] = round(($studpreca-$failedpreca)/$studpreca*100,2).'%';}
  		else { echo ''; $data_exported[$i][] = '';} ?></TD>


  	<TR>
  		<TR><TR><TR><TR>

  	 			<TD align="center"> <?php echo 'SCIENCE'; $i++; $data_exported[$i][] = 'SCIENCE';?></TD>
  		<TD align="center"> <?php echo 'CHEMISTRY'; $data_exported[$i][] = 'CHEMISTRY';?></TD>
  		<!--<TD align="center"> -->
  			<?php  $sql2=" select count( code_inscription) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'
            	and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'
            	and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'  and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Science' and c.titre ='CHEMISTRY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'  and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	  $stuchim=$row2['sc']; ?></TD>
  		<TD align="center"> <?php
  	 	$sql2=" select sum(final_grade ) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'
            	and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'
            	and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'  and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Science' and c.titre ='CHEMISTRY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'  and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches1');
$row2=mysql_fetch_assoc($aa2);
	if($row2['sc']/$stuchim >'0')
		{echo $sumchim=round($row2['sc']/$stuchim,2).'%';
	$data_exported[$i][] = $sumchim;}
	else { echo ''; $data_exported[$i][] = '';}
	?></TD>
  		<TD align="center"> <?php
  		$sql2=" select count( code_inscription) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'
            	and c.titre ='CHEMISTRY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'
            	and c.titre ='CHEMISTRY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'  and c.titre ='CHEMISTRY'  and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Science' and c.titre ='CHEMISTRY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'  and c.titre ='CHEMISTRY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 //echo $failedchim=$row2['sc'].'   '.$stuchim;
	if(($failedchim*100)/$stuchim >'0')
		{echo round(($failedchim*100)/$stuchim,2).'%';
	 $data_exported[$i][] = round(($failedchim*100)/$stuchim,2).'%';}
	else  { echo ''; $data_exported[$i][] = '';}
	?></TD>
  		<TD align="center"> <?php
  		if(($stuchim-$failedchim)/$stuchim*100 >'0')
  			{echo round(($stuchim-$failedchim)/$stuchim*100,2).'%'; $data_exported[$i][] = round(($stuchim-$failedchim)/$stuchim*100,2).'%';}
  		else { echo ''; $data_exported[$i][] = '';}?></TD>


  	<TR>
  		<TR>
  			<TD align="center"> <?php $i++;  $data_exported[$i][] = ''; ?></TD>
  		<TD align="center"> <?php echo 'PHYSICS'; $data_exported[$i][] = 'PHYSICS' ?></TD>
  		<!--<TD align="center"> -->
  			<?php $sql2=" select count( code_inscription) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'
            	and c.titre ='PHYSICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'
            	and c.titre ='PHYSICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'  and c.titre ='PHYSICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Science' and c.titre ='PHYSICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'  and c.titre ='PHYSICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studphy=$row2['sc']; ?></TD>
  		<TD align="center"> <?php $sql2=" select sum(final_grade) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'
            	and c.titre ='PHYSICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'
            	and c.titre ='PHYSICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'  and c.titre ='PHYSICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'   and c.module = 'Science' and c.titre ='PHYSICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'  and c.titre ='PHYSICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
if($row2['sc']/$studphy)
	{echo $sumphy=round($row2['sc']/$studphy,2).'%';
	$data_exported[$i][] = round($row2['sc']/$studphy,2).'%'; }
else 	{ echo ''; $data_exported[$i][] = '';} ?></TD>
  		<TD align="center"> <?php   $sql2=" select count( code_inscription) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'
            	and c.titre ='PHYSICS' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'
            	and c.titre ='PHYSICS' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'  and c.titre ='PHYSICS' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Science' and c.titre ='PHYSICS' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'  and c.titre ='PHYSICS' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedphy=$row2['sc'];
	 if(($failedphy*100)/$studphy >'0')
	 	{echo round(($failedphy*100)/$studphy,2).'%';
	 $data_exported[$i][] = round(($failedphy*100)/$studphy,2).'%';}
	else  { echo ''; $data_exported[$i][] = '';}
	  ?></TD>
  		<TD align="center"> <?php if(($studphy-$failedphy)/$studphy*100 >'0')
  		{ echo round(($studphy-$failedphy)/$studphy*100,2).'%'; $data_exported[$i][] = round(($studphy-$failedphy)/$studphy*100,2).'%'; }
  	else 	{ echo ''; $data_exported[$i][] = '';}
  		?></TD>


  	<TR>
  		<TR>
  			<TD align="center"> <?php $i++;  $data_exported[$i][] = ''; ?> </TD>
  		<TD align="center"> <?php echo 'BIOLOGY'; $data_exported[$i][] = 'BIOLOGY'; ?></TD>
  		<!--<TD align="center">-->
  		 <?php $sql2=" select count( code_inscription) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'
            	and c.titre ='BIOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'
            	and c.titre ='BIOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'  and c.titre ='BIOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Science' and c.titre ='BIOLOGY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'  and c.titre ='BIOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studbio=$row2['sc'];  ?></TD>
  		<TD align="center"> <?php $sql2=" select sum(final_grade ) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'
            	and c.titre ='BIOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'
            	and c.titre ='BIOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'  and c.titre ='BIOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Science' and c.titre ='BIOLOGY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'  and c.titre ='BIOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	if($row2['sc']/$studbio >'0')
		{echo $sumbio=round($row2['sc']/$studbio,2).'%'; $data_exported[$i][] = $sumbio; }
	else { echo ''; $data_exported[$i][] = '';} ?></TD>
  		<TD align="center"> <?php
  		$sql2=" select count( code_inscription) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Science'
            	and c.titre ='BIOLOGY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'
            	and c.titre ='BIOLOGY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'  and c.titre ='BIOLOGY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'   and c.module = 'Science' and c.titre ='BIOLOGY' and (final_grade between '60' and '65')  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and c.module ='Science'  and c.titre ='BIOLOGY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedbio=$row2['sc'];
	 if(($failedbio*100)/$studbio >'0'){
	 echo round(($failedbio*100)/$studbio,2).'%';
	 $data_exported[$i][] = round(($failedbio*100)/$studbio,2).'%';}
	else  { echo ''; $data_exported[$i][] = '';}
	 ?></TD>
  		<TD align="center">
  			<?php if(($studbio-$failedbio)/$studbio*100 >'0')
  			{echo round(($studbio-$failedbio)/$studbio*100,2).'%'; $data_exported[$i][] =  round(($studbio-$failedbio)/$studbio*100,2).'%';}
  		else { echo ''; $data_exported[$i][] = '';} ?></TD>


  	<TR>
  		<TR>

				<!-- mehdi -->
  		<TD align="center"> <?php echo 'SOCIAL STUDIES'; $i++; $data_exported[$i][] = 'SOCIAL STUDIES';?></TD>
  		<TD align="center"> <?php echo 'U.S. GOVERNMENT'; $data_exported[$i][] = 'U.S. GOVERNMENT'; ?></TD>
  		<!--<TD align="center"> -->
  			<?php  $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='U.S. GOVERNMENT' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='U.S. GOVERNMENT' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='U.S. GOVERNMENT' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='U.S. GOVERNMENT'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='U.S. GOVERNMENT' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studgov=$row2['soc']; ?></TD>
  		<TD align="center"> <?php  $sql2=" select sum(final_grade ) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='U.S. GOVERNMENT' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='U.S. GOVERNMENT' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='U.S. GOVERNMENT' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='U.S. GOVERNMENT'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='U.S. GOVERNMENT' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
if($row2['soc']/$studgov >'0')
{
	echo $sumgov=round($row2['soc']/$studgov,2).'%'; $data_exported[$i][] = $sumgov;}
	else { echo ''; $data_exported[$i][] = '';} ?></TD>
  		<TD align="center"> <?php
  		$sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='U.S. GOVERNMENT' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='U.S. GOVERNMENT' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='U.S. GOVERNMENT' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Socialstudies' and c.titre ='U.S. GOVERNMENT' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='U.S. GOVERNMENT' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedgov=$row2['soc'];
	if(($failedgov*100)/$studgov >'0')
	 	{echo round(($failedgov*100)/$studgov,2).'%';
	 $data_exported[$i][] = round(($failedgov*100)/$studgov,2).'%';}
	 else { echo ''; $data_exported[$i][] = '';}


	?></TD>
  		<TD align="center"> <?php if(($studgov-$failedgov)/$studgov*100 >'0')
  		{echo round(($studgov-$failedgov)/$studgov*100,2).'%'; $data_exported[$i][] = round(($studgov-$failedgov)/$studgov*100,2).'%'; }
  		 else { echo ''; $data_exported[$i][] = '';} ?></TD>



  	<TR>

<TD align="center"><?php $i++;  $data_exported[$i][] = ''; ?></TD>
<TD align="center"> <?php echo 'U.S. HISTORY';  $data_exported[$i][] = 'U.S. HISTORY';?></TD>
  		<!--<TD align="center">-->

  		 <?php  $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Socialstudies' and c.titre ='US.HISTORY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studhis=$row2['soc']; ?></TD>
  		<TD align="center"> <?php

  		$sql2=" select sum(final_grade) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='US.HISTORY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
if($row2['soc']/$studhis >'0')
		{echo $sumhis=round($row2['soc']/$studhis,2).'%'; $data_exported[$i][] = $sumhis;}
	 else { echo ''; $data_exported[$i][] = '';}
	?></TD>
  		<TD align="center"> <?php $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies' and (final_grade between '60' and '65')
            	and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies' and (final_grade between '60' and '65')
            	and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'  and (final_grade between '60' and '65') and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Socialstudies' and (final_grade between '60' and '65') and c.titre ='US.HISTORY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies' and (final_grade between '60' and '65')  and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedhis=$row2['soc'];
if(($failedhis*100)/$studhis >'0')
{	echo round(($failedhis*100)/$studhis,2).'%';
	$data_exported[$i][] = round(($failedhis*100)/$studhis,2).'%';}
	 else { echo ''; $data_exported[$i][] = '';}

	 ?></TD>
  		<TD align="center"> <?php if(($studhis-$failedhis)/$studhis*100 >'0')
  		{echo round(($studhis-$failedhis)/$studhis*100,2).'%'; $data_exported[$i][] = round(($studhis-$failedhis)/$studhis*100,2).'%';}
  		 else { echo ''; $data_exported[$i][] = '';} ?>


  	<TR>
  		<TD align="center"> <?php $i++;  $data_exported[$i][] = ''; ?> </TD>
  		<TD align="center"> <?php echo 'WORLD HISTORY';  $data_exported[$i][] = 'WORLD HISTORY';?></TD>
  		<!--<TD align="center"> -->
  			<?php  $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Socialstudies' and c.titre ='WORLD HISTORY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studworld=$row2['soc']; ?></TD>
  		<TD align="center"> <?php  $sql2=" select sum(final_grade ) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='WORLD HISTORY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
		if($row2['soc']/$studworld >'0')
		{echo $sumworld=round($row2['soc']/$studworld,2).'%';
	$data_exported[$i][] = $sumworld;}
	 else { echo ''; $data_exported[$i][] = '';}
	 ?></TD>
  		<TD align="center"> <?php
  		$sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies' and (final_grade between '60' and '65')
            	and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies' and (final_grade between '60' and '65')
            	and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and (final_grade between '60' and '65') and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Socialstudies' and (final_grade between '60' and '65') and c.titre ='WORLD HISTORY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies' and (final_grade between '60' and '65')  and c.titre ='WORLD HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedworld=$row2['soc'];

	if(($failedworld*100)/$studworld >'0')
{
	 echo round(($failedworld*100)/$studworld,2).'%';
	 $data_exported[$i][] = round(($failedworld*100)/$studworld,2).'%';}
	  else { echo ''; $data_exported[$i][] = '';}
	 ?></TD>
  		<TD align="center"> <?php if(($studworld-$failedworld)/$studworld*100 >'0')
  		{echo round(($studworld-$failedworld)/$studworld*100,2).'%'; $data_exported[$i][] = round(($studworld-$failedworld)/$studworld*100,2).'%'; }
  		 else { echo ''; $data_exported[$i][] = '';}?></TD>


  	<TR>
<TR>
  		<TD align="center"> <?php $i++;  $data_exported[$i][] = ''; ?> </TD>
  		<TD align="center"> <?php echo 'ECONOMICS'; $data_exported[$i][] = 'ECONOMICS'; ?></TD>
  		<!--<TD align="center"> -->
  			<?php  $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'   and c.module = 'Socialstudies' and c.titre ='ECONOMICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studeco=$row2['soc']; ?></TD>
  		<TD align="center"> <?php $sql2=" select sum(final_grade) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='ECONOMICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	if($row2['soc']/$studeco >'0')
		{echo $sumeco=round($row2['soc']/$studeco,2).'%';  $data_exported[$i][] =  round($row2['soc']/$studeco,2).'%'; }
	 else { echo ''; $data_exported[$i][] = '';}
	?></TD>
  		<TD align="center"> <?php

  		 $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies' and (final_grade between '60' and '65')
            	and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies' and (final_grade between '60' and '65')
            	and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies' and (final_grade between '60' and '65') and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and (final_grade between '60' and '65') and c.titre ='ECONOMICS'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies' and (final_grade between '60' and '65') and c.titre ='ECONOMICS' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedeco=$row2['soc'];
	if(($failedeco*100)/$studeco >'0')
	 	{echo round(($failedeco*100)/$studeco,2).'%';
	 $data_exported[$i][] = round(($failedeco*100)/$studeco,2).'%';}
	 else { echo ''; $data_exported[$i][] = '';}
	?></TD>
  		<TD align="center"> <?php if(($studeco-$failedeco)/$studeco*100 >'0')
  		{echo round(($studeco-$failedeco)/$studeco*100,2).'%'; $data_exported[$i][] = round(($studeco-$failedeco)/$studeco*100,2).'%';
  	}
  	else { echo ''; $data_exported[$i][] = '';}?></TD>

  	<TR>
<TR>
  		<TD align="center"> <?php $i++;  $data_exported[$i][] = ''; ?></TD>
  		<TD align="center"> <?php echo 'PHILOSOPHY & HUMANITIES'; $data_exported[$i][] = 'PHILOSOPHY & HUMANITIES'; ?></TD>
  		<!--<TD align="center"> -->
  			<?php  $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='PHILOSOPHY & HUMANITIES' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='PHILOSOPHY & HUMANITIES' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='PHILOSOPHY & HUMANITIES' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='PHILOSOPHY & HUMANITIES'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='PHILOSOPHY & HUMANITIES' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studphu=$row2['soc']; ?></TD>
  		<TD align="center"> <?php
  		$sql2=" select sum(final_grade ) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='PHILOSOPHY & HUMANITIES' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='PHILOSOPHY & HUMANITIES' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='PHILOSOPHY & HUMANITIES' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='PHILOSOPHY & HUMANITIES'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='PHILOSOPHY & HUMANITIES' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	if($row2['soc']/$studphu >'0')
		{echo $sumphu=round($row2['soc']/$studphu,2).'%';
	$data_exported[$i][] = $sumphu;}
	else { echo ''; $data_exported[$i][] = '';}
	 ?></TD>
  		<TD align="center"> <?php
  		 $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='PHILOSOPHY & HUMANITIES' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='PHILOSOPHY & HUMANITIES' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='PHILOSOPHY & HUMANITIES' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Socialstudies' and c.titre ='PHILOSOPHY & HUMANITIES' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='PHILOSOPHY & HUMANITIES' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedphu=$row2['soc'];
	if(($failedphu*100)/$studphu >'0')
	{echo round(($failedphu*100)/$studphu,2).'%';
	 $data_exported[$i][] = round(($failedphu*100)/$studphu,2).'%';}
	 else { echo ''; $data_exported[$i][] = '';}

	 ?></TD>
  		<TD align="center"> <?php  if(($studphu-$failedphu)/$studphu*100 >'0')
  		{echo round(($studphu-$failedphu)/$studphu*100,2).'%';
  		$data_exported[$i][] =  round(($studphu-$failedphu)/$studphu*100,2).'%';}
  		else { echo ''; $data_exported[$i][] = '';} ?></TD>

  	<TR>





<TR>
  		<TD align="center"> <?php $i++;  $data_exported[$i][] = ''; ?></TD>
  		<TD align="center"> <?php echo 'PSYCHOLOGY'; $data_exported[$i][] = 'PSYCHOLOGY'; ?></TD>
  		<!--<TD align="center"> -->
  			<?php  $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='PSYCHOLOGY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studpsyco=$row2['soc']; ?></TD>
  		<TD align="center"> <?php
  		$sql2=" select sum(final_grade ) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'
            	and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='PSYCHOLOGY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.final_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	if($row2['soc']/$studpsyco >'0')
		{echo $sumpsyco=round($row2['soc']/$studpsyco,2).'%';
	$data_exported[$i][] = $sumpsyco;}
	else { echo ''; $data_exported[$i][] = '';}
	 ?></TD>
  		<TD align="center"> <?php
  		 $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='PSYCHOLOGY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'
            	and c.titre ='PSYCHOLOGY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Socialstudies' and c.titre ='PSYCHOLOGY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (final_grade between '60' and '65') and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";


$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $failedpsyco=$row2['soc'];
	if(($failedpsyco*100)/$studpsyco >'0')
	{echo round(($failedpsyco*100)/$studpsyco,2).'%';
	 $data_exported[$i][] = round(($failedpsyco*100)/$studpsyco,2).'%';}
	 else { echo ''; $data_exported[$i][] = '';}

	 ?></TD>
  		<TD align="center"> <?php  if(($studpsyco-$failedpsyco)/$studpsyco*100 >'0')
  		{echo round(($studpsyco-$failedpsyco)/$studpsyco*100,2).'%';
  		$data_exported[$i][] =  round(($studpsyco-$failedpsyco)/$studpsyco*100,2).'%';}
  		else { echo ''; $data_exported[$i][] = '';} ?></TD>

  	<TR>

</TABLE>
<TABLE border="1" width="100%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> STUDENT DATA </FONT></td>

</TABLE>

	<?php
	if (isset($_POST['export']) && $_POST['export'] == 1) {
	 $excel = new ExportDataExcel('file');
	 $excel->filename = "students_data.xls";

	 $excel->initialize();
	 foreach ($data_exported as $row) {
		 $excel->addRow($row);
	 }
	 $excel->finalize();


 }
	 ?>


</form>
