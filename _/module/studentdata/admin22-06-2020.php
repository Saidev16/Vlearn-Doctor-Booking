
<?php

		$niveau=$filiere=$annee=$where=$code=$search=$sgroupe=$annee_inscription=$elearning=$section=$idSession=$wherezin='';

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

         $wherezin =$wherezin." or  n.idSession=$sess ";
        
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
       <option value="Spring" <?=($session=='Spring') ? $selected : '' ?>>January</option>
       <!-- <option value="Summer" <?=($session=='Summer') ? $selected : '' ?>>Summer</option>-->
      
	  </select> 
	<select name="year" class="search">
		<option value=""><?php echo 'Year'; ?></option>
		
       <option value="2017" <?=($year=='2017') ? $selected : '' ?>>2016-2017</option>
       <option value="2018" <?=($year=='2018') ? $selected : '' ?>>2017-2018</option>
        <option value="2019" <?=($year=='2019') ? $selected : '' ?>>2018-2019</option>
         <option value="2020" <?=($year=='2020') ? $selected : '' ?>>2019-2020</option>
	  </select>

	 <!-- <input type="checkbox" class="input" name="export" value="1" style="width: 15px;margin-left: 5px;"   /> Export-->
	    <input type="submit" vname="Applay" value="<?php echo 'submit'; ?>"  />

</div>
<div>
	</div>
<br/>

<TABLE border="1" width="100%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> STUDENT DATA </FONT></td>

</TABLE>
<!-- Enrollments By Program -->
<?php
		


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
	<TD align="center"> <?php echo 'LANGUAGE ART'; ?></TD>
  		<TD align="center"> <?php echo 'ENGLISH 1'; ?></TD>
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
	 $studeng1= $row['eng'];?>
		
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
	echo $sumeng1= round($row['eng']/$studeng1,2).'%'; ?></TD>
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
	 echo round(($failedeng1*100)/$studeng1,2).'%';
  		?></TD>
  		<TD align="center"> <?php echo round(($studeng1-$failedeng1)/$studeng1*100,2).'%'; ?></TD>
 
  	 	<TR>

  		<TR>
	<TD align="center"></TD>
  		<TD align="center"> <?php echo 'ENGLISH 2'; ?></TD>
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
	echo round($row['eng']/$studeng2,2).'%'; ?></TD>
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
	 echo round(($failedeng2*100)/$studeng2,2).'%';

	 ?></TD>
  		<TD align="center"> <?php echo round(($studeng2-$failedeng2)/$studeng2*100,2).'%'; ?></TD>
 
  		
  	<TR>
  		<TR>
	<TD align="center"></TD>
  		<TD align="center"> <?php echo 'ENGLISH 3'; ?></TD>
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
	echo $sumeng3=round($row['eng']/$studeng3,2).'%'; ?></TD>
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
	echo round(($failedeng3*100)/$studeng3,2).'%';

	?></TD>
  		<TD align="center"> <?php echo round(($studeng3-$failedeng3)/$studeng3*100,2).'%' ; ?></TD>
 
  		
  	<TR>
  		<TR>
	    <TD align="center"></TD>
  		<TD align="center"> <?php echo 'ENGLISH 4'; ?></TD>
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
	echo $sumeng4=round($row['eng']/$studeng4,2).'%'; ?></TD>
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
	echo round(($failedeng4*100)/$studeng4,2).'%';
?></TD>
  		<TD align="center"> <?php echo round(($studeng4-$failedeng4)/$studeng4*100,2).'%';   ?></TD>
 
  		
  	<TR>
  		<TR><TR><TR><TR>
  		<TR>
  			<TD align="center"> <?php echo 'MATHEMATICS'; ?></TD>
  		<TD align="center"> <?php echo 'ALGERBA 1'; ?></TD>
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
	echo $sumalgb1=round($row2['us']/$studalgb1,2).'%';

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
	 echo round(($failedalgb1*100)/$studalgb1,2).'%';


 ?></TD>
  		<TD align="center"> <?php echo round(($studalgb1-$failedeng1)/$studalgb1*100,2).'%';  ?></TD>
  	
  	
  	<TR>
  		<TR>
  			<TD align="center"></TD>
  		<TD align="center"> <?php echo 'ALGERBRA 2'; ?></TD>
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
	echo $sumalgb2=round($row2['us']/$studalgb2,2).'%';
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
echo round(($failedalgb2*100)/$studalgb2,2).'%';

	?></TD>
  		<TD align="center"> <?php echo round(($studalgb2-$failedalgb2)/$studalgb2*100,2).'%';  ?></TD>
  	
  	
  	<TR>
  		<TR>
  			<TD align="center"></TD>
  		<TD align="center"> <?php echo 'GEOMETRY'; ?></TD>
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
	 echo $sumgeom=round($row2['us']/$studgeom,2).'%';

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
	echo round(($failedgeom*100)/$studgeom,2).'%';
 ?></TD>
  		<TD align="center"> <?php echo round(($studgeom-$failedgeom)/$studgeom*100,2).'%';
  ?></TD>
  	
  	
  	<TR>
  		<TR>
  			<TD align="center"></TD>
  		<TD align="center"> <?php echo 'PRE-CALCULUS'; ?></TD>
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
	echo $sumpreca=round($row2['us']/$studpreca,2).'%'; ?></TD>
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
	echo round(($failedpreca*100)/$studpreca,2).'%';


	?></TD>
  		<TD align="center"> <?php  echo round(($studpreca-$failedpreca)/$studpreca*100,2).'%'; ?></TD>
  	
  	
  	<TR>
  		<TR><TR><TR><TR>
  		  	
  	 			<TD align="center"> <?php echo 'SCIENCE'; ?></TD>
  		<TD align="center"> <?php echo 'CHEMISTRY'; ?></TD>
  		<!--<TD align="center"> -->
  			<?php $sql2=" select count( code_inscription) as sc from (
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
	 $stuchim=$row2['sc'];  ?></TD>
  		<TD align="center"> <?php  
  		$sql2=" select sum(letter_grade ) as sc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science' 
            	and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science' 
            	and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Science'  and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Science' and c.titre ='CHEMISTRY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Science'  and c.titre ='CHEMISTRY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as sc";

               
$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	echo $sumchim=round($row2['sc']/$stuchim,2).'%'; 
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
	 $failedchim=$row2['sc']; 
	 echo round(($failedchim*100)/$stuchim,2).'%';

	?></TD>
  		<TD align="center"> <?php echo round(($stuchim-$failedchim)/$stuchim*100,2).'%'; ?></TD>
  	
  	
  	<TR>
  		<TR>
  			<TD align="center"> </TD>
  		<TD align="center"> <?php echo 'PHYSICS'; ?></TD>
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
	echo $sumphy=round($row2['sc']/$studphy,2).'%';  ?></TD>
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
	 echo round(($failedphy*100)/$studphy,2).'%';

	  ?></TD>
  		<TD align="center"> <?php  echo round(($studphy-$failedphy)/$studphy*100,2).'%'; ?></TD>
  	
  	
  	<TR>
  		<TR>
  			<TD align="center"> </TD>
  		<TD align="center"> <?php echo 'BIOLOGY'; ?></TD>
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
	echo $sumbio=round($row2['sc']/$studbio,2).'%';  ?></TD>
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
	 echo round(($failedbio*100)/$studbio,2).'%';

	 ?></TD>
  		<TD align="center"> <?php echo round(($studbio-$failedbio)/$studbio*100,2).'%'; ?></TD>
  	
  	
  	<TR>
  		<TR>
  		<TD align="center"> <?php echo 'SOCIAL STUDIES'; ?></TD>
  		<TD align="center"> <?php echo 'U.S. GOVERNMENT'; ?></TD>
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
	echo $sumgov=round($row2['soc']/$studgov,2).'%';?></TD>
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
	 echo round(($failedgov*100)/$studgov,2).'%';


	?></TD>
  		<TD align="center"> <?php echo round(($studgov-$failedgov)/$studgov*100,2).'%'; ?></TD>
  	
  	
  	<TR>

<TD align="center"></TD>
<TD align="center"> <?php echo 'U.S. HISTORY'; ?></TD>
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

  		$sql2=" select sum(letter_grade) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies' 
            	and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies' 
            	and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='US.HISTORY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='US.HISTORY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";

               
$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	echo $sumhis=round($row2['soc']/$studhis,2).'%'; ?></TD>
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
	echo round(($failedhis*100)/$studhis,2).'%';

	 ?></TD>
  		<TD align="center"> <?php echo round(($studhis-$failedhis)/$studhis*100,2).'%'; ?></TD>
  	
  	
  	<TR>
  		<TD align="center"> </TD>
  		<TD align="center"> <?php echo 'WORLD HISTORY'; ?></TD>
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
	echo $sumworld=round($row2['soc']/$studworld,2).'%';
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

	 echo round(($failedworld*100)/$studworld,2).'%';

	 ?></TD>
  		<TD align="center"> <?php echo round(($studworld-$failedworld)/$studworld*100,2).'%'; ?></TD>
  	
  	
  	<TR>
<TR>
  		<TD align="center"> </TD>
  		<TD align="center"> <?php echo 'ECONOMICS'; ?></TD>
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
	echo $sumeco=round($row2['soc']/$studeco,2).'%';   ?></TD>
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
	 echo round(($failedeco*100)/$studeco,2).'%';

	?></TD>
  		<TD align="center"> <?php echo round(($studeco-$failedeco)/$studeco*100,2).'%'; ?></TD>
  	
  	
  	<TR>
<TR>
  		<TD align="center"> </TD>
  		<TD align="center"> <?php echo 'PHILOSOPHY & HUMANITIES'; ?></TD>
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
	echo $sumphu=round($row2['soc']/$studphu,2).'%'; 
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
	 echo round(($failedphu*100)/$studphu,2).'%';

	
	 ?></TD>
  		<TD align="center"> <?php  echo round(($studphu-$failedphu)/$studphu*100,2).'%'; ?></TD>
  	
  	
  	<TR>
  		<TR>
  		<TD align="center"> </TD>
  		<TD align="center"> <?php echo 'PSYCHOLOGY'; ?></TD>
  		<!--<TD align="center"> -->
  			<?php  $sql2=" select count( code_inscription) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies' 
            	and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies' 
            	and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module = 'Socialstudies' and c.titre ='PSYCHOLOGY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";

               
$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	 $studpsyco=$row2['soc']; ?></TD>
  		<TD align="center"> <?php  $sql2=" select sum(letter_grade ) as soc from (
		 SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_usa` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies' 
            	and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom, e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_algeria` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies' 
            	and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_benin` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'   and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_burkina` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T'  and final_grade!='null'  and c.module = 'Socialstudies' and c.titre ='PSYCHOLOGY'  and (n.idSession=-1".$wherezin.") group by n.code_inscription
            	UNION ALL
            	SELECT n.code_inscription,e.nom, e.prenom,e.niveau,c.module,c.titre,n.letter_grade
                FROM `tbl_note_morocco` as n ,tbl_cours as c , tbl_etudiant_all as e
                WHERE   c.code_cours=n.code_cours and n.code_inscription = e.code_inscription  and `letter_grade`!='T' and final_grade!='null'  and c.module ='Socialstudies'  and c.titre ='PSYCHOLOGY' and (n.idSession=-1".$wherezin.") group by n.code_inscription) as soc";

               
$aa2= @mysql_query($sql2) or die ('Failure to select branches');
$row2=mysql_fetch_assoc($aa2);
	echo $sumpsyco=round($row2['soc']/$studpsyco,2).'%'; ?></TD>
  		<TD align="center"> 
  			<?php $sql2=" select count( code_inscription) as soc from (
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
	 echo round(($failedpsyco*100)/$studpsyco,2).'%';

	 
	?></TD>
  		<TD align="center"> <?php echo round(($studpsyco-$failedpsyco)/$studpsyco*100,2).'%';  ?></TD>

</TABLE>
<TABLE border="1" width="100%">

         <td align="center" bgcolor="#CCCCCC" ><FONT size="4pt"> STUDENT DATA </FONT></td>

</TABLE>

</form>
