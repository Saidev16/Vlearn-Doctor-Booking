
 <?php
 	 $CGPA=$count=$credit=0;
	 if (isset($_GET['update'])){
	 $code_inscription= addslashes($_GET['update']);
   $prefixe= addslashes($_GET['prefixe']);
	 $gen=$_GET['gen'];

   $page = array(
     'CAM' => 'gestion_des_etudiants_cameroun.php',
     'ORL' => 'gestion_des_etudiants_usa.php',
     'BN' => 'gestion_des_etudiants_benin.php',
     'GS' => 'gestion_des_etudiants_GUES.php',
     'MOR' => 'gestion_des_etudiants_morocco.php',
     'AG' => 'gestion_des_etudiants_algeria.php',
     'BF' => 'gestion_des_etudiants_burkina.php',
     'IC' => 'gestion_des_etudiants_ivory.php'
   );

   $table_etudiant = array(
     'CAM' => 'tbl_etudiant_cameroun',
     'ORL' => 'tbl_etudiant_usa',
     'BN' => 'tbl_etudiant_benin',
     'GS' => 'tbl_etudiant_GUES',
     'MOR' => 'tbl_etudiant_morocco',
     'AG' => 'tbl_etudiant_algeria',
     'BF' => 'tbl_etudiant_burkina',
     'IC' => 'tbl_etudiant_ivory'
   );

   $table_note = array(
     'CAM' => 'tbl_note_cameroun',
     'ORL' => 'tbl_note_usa',
     'BN' => 'tbl_note_benin',
     'GS' => 'tbl_note_GUES',
     'MOR' => 'tbl_note_morocco',
     'AG' => 'tbl_note_algeria',
     'BF' => 'tbl_note_burkina',
     'IC' => 'tbl_note_ivory'
   );

   $table_inscription = array(
     'CAM' => 'tbl_inscription_cours_cameroun',
     'ORL' => 'tbl_inscription_cours_usa',
     'BN' => 'tbl_inscription_cours_benin',
     'GS' => 'tbl_inscription_cours_GUES',
     'MOR' => 'tbl_inscription_cours_morocco',
     'AG' => 'tbl_inscription_cours_algeria',
     'BF' => 'tbl_inscription_cours_burkina',
     'IC' => 'tbl_inscription_cours_ivory'
   );
   $table_etudiant_sql = $table_etudiant["$prefixe"];
   $table_note_sql = $table_note["$prefixe"];
   $table_inscription_sql = $table_inscription["$prefixe"];
   $page_prev = $page["$prefixe"];

   if ($gen == 1) {
     $table_etudiant_sql = "tbl_etudiant_all";
   }

	 // select student information
	 $sql="SELECT e.*
	 FROM $table_etudiant_sql AS e WHERE code_inscription = '$code_inscription' and prefixe = '$prefixe'";
   //var_dump($sql);
	 $res= @mysql_query($sql) or die('Erreur :: Student information');
	 $row = @mysql_fetch_assoc($res);
	 $date=$row['date_naissance'];
	 $nom=$row['nom'];
   $prenom=$row['prenom'];
  	$adresse=$row['adresse'];
  	$lieu_naissance=$row['lieu_naissance'];
  	$code_bac=$row['code_bac'];
  	//$prefixe=$row['prefixe'];
  	$graduation_date=$row['graduation_date'];
    $transcript = $row['new_transcript'];
    $conditions_gen = "";
    if ($transcript == 1) {
      $conditions_gen = "AND n.prefixe = '$prefixe'";
      $table_note_sql = "tbl_note_acc";
      $table_inscription_sql = "tbl_inscription_cours_acc";
    }
    // verification

    $sql_v = "SELECT count(*) as nb FROM $table_note_sql WHERE `code_inscription` = $code_inscription and letter_grade != 'T' and `idSession` = 0";
    $req_v = mysql_query($sql_v) or die('Erreur :: Select session');
    $row_v = mysql_fetch_assoc($req_v);
    $nb_course = $row_v['nb'];
	?>

  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Bulletin </span></td>
	<td width="90">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<td valign="top" align="center" >
		  <a href="http://his.americanhigh.us/module/transcripts/print_tr.php?code_inscription=<?=$code_inscription?>&prefixe=<?=$prefixe?>&gen=<?php echo $gen; ?>" target="_blank"  title="Imprimer">
		  <div class="imprimer"></div>Print</a>
		  </td>
		  <!-- <td valign="top" align="center" >
		  <a href="http://his.americanhigh.us/module/etudiantalgeria/printO.php?printO=<?=$code_inscription?>" target="_blank"  title="Imprimer">
		  <div class="imprimer"></div>Print Official</a>
		  </td>--> <!---
		 <td valign="top" align="center" >
		  <a href="http://piimt.us/piimt/html2pdf_v3.20/html2pdf_v3.20/exemples/exempleB00.php?buletin=<?php echo $code_inscription?>" target="_blank"  title="Imprimer">
		  <div class="imprimer"></div>Imprimer</a>
		  </td>
		   <td align="right">
		 <a href="gestion_des_etudiants_algeria.php"><div class="retour"></div>Back</a>
		 </td>-->

		 <?php if($gen == 1) { ?>
        <td align="right">
        <a href="gestion_des_etudiants_all.php"><div class="retour"></div>Back</a>
        </td>
<?php
}
else { ?>

<td align="right">
<a href="<?php echo $page_prev; ?>"><div class="retour"></div>Back</a>
</td>

	<?php } ?>
		</tr>
	  </table>
	</td>
  </tr>
  </table>

<style>
</style>
</head>

<table width="1000"  cellpadding="0" cellspacing="0" border="0" style="border:1px solid black;" align="center" class="buletin_data" >



      <tr>

     <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px  solid;">
       <b> &nbsp;First Name:</b><br /><?php echo $nom;?>  </td>
	    <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px solid;">
       <b> &nbsp;Date of Birth:</b><br /><?php
       $date=$row['date_naissance'];
       $tab=split('[/.-]',$date);
       echo $tab[1].'-'.$tab[2].'-'.$tab[0]; /*echo $row['date_naissance'];*/

?> </td>

      <td height="50" width=50 colspan="15" align="left" valign="middle" style="border: 1px solid;">
       <b> &nbsp;&nbsp;&nbsp;Previous School Name:</b><br />
       <?php echo $row['lieu_naissance'];  ?> </td>
	    <td width="70" height="30" colspan="20" align="center" valign="middle" class="gras" style="border-right: 1px solid;">&nbsp; <p>&nbsp;</p>
        <p><font color="#E0EBEB">OFFICE USE ONLY</font> </p></td>
  </tr>
       <tr>
      <td colspan="40" align="left" valign="middle" height="30" style="border: 1px solid;">&nbsp;<b>Last Name:</b><br /><?php echo $prenom;?>

	   <td colspan="15" align="left" valign="middle" height="30" style="border-right: 1px solid;"><b> &nbsp;&nbsp;&nbsp;<br />
	       &nbsp;&nbsp;&nbsp;Previous School Address:</b><br />
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $row['code_bac'];?>     </td>
    </tr>
    <tr>
     <td height="30" colspan="40" align="center" valign="middle" style="border: 1px solid;" ><b>Student Address: </b> <br /><?php echo $adresse;?></td>
	   <td colspan="5" align="left" valign="middle" height="23" style="border-right: 1px solid;" >     </td>
	</tr>
</table>

<table width="1000" cellspacing="0" border="1" align="center" class="buletin_data">
    <tr>
      <th width="100%">
        <table width="100%" cellspacing="0" class="gras">
            <tr>
              <td width="75">Course Code</td>
              <td>Course Title</td>
              <td width="50">Type</td>
              <td width="50">Grade</td>
              <td width="50">Credit</td>
            </tr>
          </table>
      </th>
    </tr>
    <tr style="	border-right: 1px solid #000; border-left: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"  >
      <?php
      $transfer=0;
      /*$query="SELECT DISTINCT n.idSession, s.session, s.annee_academique
      FROM $tbl_note AS n, $tbl_session AS s, $tbl_cours AS c
      where n.idSession = s.idSession
      AND n.code_inscription = '$code_inscription'
        AND c.code_cours = n.code_cours
      AND n.archive = 0

        ORDER BY n.idSession";
      $ressource=@mysql_query($query) or die('Erreur :: Select sessions');
      $i =0;
      while ($ligne= mysql_fetch_assoc($ressource)){
      $idSession = $ligne['idSession'];
      $session = $ligne['session'];
      $i++;
      /*if ($i%2) {echo '</tr><tr>'; }*/
      ?>

        <?php

         $GPA = $j = 0;
         $k=0; //indice
         $sql="SELECT n.assig8,n.code_note,c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, n.IdSession, n.code_cours_testing
         FROM $table_note_sql AS n, tbl_cours AS c
         WHERE c.code_cours= n.code_cours
         AND code_inscription = '$code_inscription'
         AND n.archive = 0 AND letter_grade = 'T'
         $conditions_gen
         order by c.ordering ASC";
         $res= @mysql_query($sql) or die('Erreur :: Select notes');

         while($row = mysql_fetch_assoc($res)){

         $ss=$row['IdSession'];
         $code_note = $row['code_note'];
         $assig8 = $row['assig8'];
         $sql2="SELECT session, annee_academique,academic_year from tbl_session where IdSession= '$ss'";
         $res2= @mysql_query($sql2) or die('Erreur :: Select session');
         $ligne=mysql_fetch_assoc($res2);
         $d=$ligne['session'].' '. $ligne['annee_academique'];


         if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I') && ($row['letter_grade']!='') && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){
               $j++;
               }
               $GPA += $row['gpa'];

         if($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!='' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){ $credit+=$row['nbr_credit'];}
               if($row['letter_grade']== 'T')  $transfer+=1 ;

              ?>
              <td width="50%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"   >
              <table width="100%" cellpadding="0" cellspacing="0" style="font-size:11px">
                <tr>
                  <td width="75" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                  <td align="left"><?php echo stripslashes($row['titre']);?></td>
                  <td width="41" align="center"><?php echo $row['letter_grade'];?></td>
                  <td width="41" align="center">
                    <select class="form-control letter_grade_<?php echo $code_note; ?>" name="code_note"
                      onchange="change_letter_grade(<?php echo $code_note ?>,'<?php echo $table_note_sql; ?>')" required>
                      <option value="">Letter Grade</option>
                      <option value="A" <?php if ($assig8 == "A"){echo "selected";} ?>>A</option>
                      <option value="A-" <?php if ($assig8 == "A-"){echo "selected";} ?>>  A-</option>
                      <option value="A+" <?php if ($assig8 == "A+"){echo "selected";} ?>>  A+</option>
                      <option value="B" <?php if ($assig8 == "B"){echo "selected";} ?>>B</option>
                      <option value="B-" <?php if ($assig8 == "B-"){echo "selected";} ?>>  B-</option>
                      <option value="B+" <?php if ($assig8 == "B+"){echo "selected";} ?>>  B+</option>
                      <option value="C" <?php if ($assig8 == "C"){echo "selected";} ?>>C</option>
                      <option value="C-" <?php if ($assig8 == "C-"){echo "selected";} ?>>  C-</option>
                      <option value="C+" <?php if ($assig8 == "C+"){echo "selected";} ?>>  C+</option>
                      <option value="D" <?php if ($assig8 == "D"){echo "selected";} ?>>D</option>
                      <option value="D-" <?php if ($assig8 == "D-"){echo "selected";} ?>>  D-</option>
                      <option value="D+" <?php if ($assig8 == "D+"){echo "selected";} ?>>  D+</option>
                      <option value="F" <?php if ($assig8 == "F"){echo "selected";} ?> >F</option>
                    </select>
                  </td>
                  <td width="61" align="center"><?php echo $row['nbr_credit'];?></td>
                </tr>
        </table>
          </td>
              <?php
        // end fetch notes
         $k++;

         ?>
   </tr>
   <?php
      }
  ?>
</table>

  <table width="1000" cellspacing="0" border="1" align="center" class="buletin_data">

  	<tr>
    	<th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                <td width="75">Course Code</td>
                <td>Course Title</td>
      					<td width="50">Grade</td>
      					<td width="50">Credit</td>
              </tr>
            </table>
        </th>

		<th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                  <td width="75">Course Code</td>
                  <td>Course Title</td>
        					<td width="50">Grade</td>
        					<td width="50">Credit</td>
                </tr>
            </table>
        </th>
    </tr>

<?php
$nb_course = 1;
if ($nb_course == 0){



  ?>
  <tr>
   <?php



   $transfer=0;
 $query="SELECT DISTINCT n.idSession, s.session, s.annee_academique
 FROM $table_note_sql AS n, $tbl_session AS s, $tbl_cours AS c
 where n.idSession = s.idSession
 AND n.code_inscription = '$code_inscription'
 AND n.letter_grade!='T'
 AND c.code_cours = n.code_cours
 AND n.archive = 0
 ORDER BY n.idSession";

   $ressource=@mysql_query($query) or die('Erreur :: Select sessions');
  $i =0;
 while ($ligne= mysql_fetch_assoc($ressource)){
 $idSession = $ligne['idSession'];
 $session = $ligne['session'];
 //$ac_year = $ligne['academic_year'];
 $i++;
 if ($i%2) {echo '</tr><tr>'; }
 //echo '</tr><tr>';
 ?>
     <td width="50%" valign="top">
         <table width="100%" cellpadding="0" cellspacing="0" style="font-size:11px">
             <tr>
                 <th colspan="4"><?php //if($ligne['annee_academique'] >='2010')

         echo $ligne['session'].' '. $ligne['annee_academique']?></th>
               </tr>
     <?php
           $GPA = $j = 0;
           $sql="SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type
           FROM $table_note_sql AS n, $tbl_cours AS c
           WHERE c.code_cours = n.code_cours
           AND code_inscription = '$code_inscription'
           AND idSession = '$idSession'
           AND n.letter_grade != 'T'
           AND n.archive = 0
           order by c.ordering
           ";


            $res= @mysql_query($sql) or die('Erreur :: Select notes');
            while($row = mysql_fetch_assoc($res)){
            if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X') && ($row['letter_grade']!='' )){
            $j++;
            }
            $GPA += $row['gpa'];
 if($row['letter_grade']!= 'I' && $row['letter_grade']!= 'T' && $row['letter_grade']!= 'F' && $row['letter_grade']!= 'F*' &&  $row['letter_grade']!='' && $row['letter_grade']!= 'W' && $row['letter_grade']!= 'X')

      { $credit+=$row['nbr_credit'];}

            if($row['letter_grade']== 'T' /*or $row['letter_grade']== 'I' or $row['letter_grade']== 'X'or $row['letter_grade']== 'W'*/)
      $transfer+=1 ;

           ?>
            <tr>
               <td width="75" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
               <td width="225" align="left"><?php echo trim(stripslashes($row["titre"]));/*echo stripslashes($row['titre']);*/?> </td>
               <td width="50" align="center"><?php echo $row['nbr_credit'];?></td>
                <td width="50" align="center"><?php /*if(($mid_term=='' or $final_exam=='') and  ($letter_grade!='T' and $letter_grade!='F*' and $letter_grade!='X') and $row['code_cours']!='MEM555')
       { echo 'I';	}
       else {*/echo $row['letter_grade'];//}?></td>
           </tr>

           <?php
     // end fetch notes
      }
                  $CGPA+=$GPA;
                         $count+=$j;
     ?>
          <tr>
              <td colspan="3" class="gras">Grade Point Average(GPA):</td>
              <td align="center" class="gras"><?php echo $j>0 ? round($GPA/$j, 2) : '' ; ?></td>
          </tr>
        </table>
    </td>
  <?php
  // end fetch session
 }
 ?>
 </tr>
<?php }else{ ?>
	<tr style="	border-right: 1px solid #000; border-left: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"  >
    <?php
    $transfer=0;

  	?>

			<?php

			 $GPA = $j = 0;
			 $k=0; //indice
       $sql="SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, n.IdSession, n.code_cours_testing
         FROM $table_note_sql AS n, tbl_cours AS c
         WHERE c.code_cours = n.code_cours
         AND code_inscription = '$code_inscription'
         AND letter_grade != 'T'
  			 AND n.archive = 0
         $conditions_gen
         order by c.ordering ASC";
         // var_dump($sql);
			 $res= @mysql_query($sql) or die('Erreur :: Select notes');

			 while($row = mysql_fetch_assoc($res)){

			 $ss=$row['IdSession'];

			 $sql2="SELECT session, annee_academique,academic_year from tbl_session where IdSession= '$ss'";
			 $res2= @mysql_query($sql2) or die('Erreur :: Select session');
			 $ligne=mysql_fetch_assoc($res2);
			 $d=$ligne['session'].' '. $ligne['annee_academique'];

			 if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I') && ($row['letter_grade']!='') && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){
             $j++;
             }
             $GPA += $row['gpa'];

			 if($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!='' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){ $credit+=$row['nbr_credit'];}
             if($row['letter_grade']== 'T')  $transfer+=1 ;

            ?>
            <td width="50%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"   >
                <table width="100%" cellpadding="0" cellspacing="0" style="font-size:11px">
    			          <tr>
                      <td width="75" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                      <td align="left"><?php echo stripslashes($row['titre']);?></td>
                      <td width="41" align="center"><?php echo $row['letter_grade'];?></td>
      				        <td width="61" align="center"><?php echo $row['nbr_credit'];?></td>
                    </tr>
                </table>
         		</td>
            <?php
			// end fetch notes
			 $k++;
			 if($k%2==0)
			 {
			 ?>
 </tr>

		   		<tr style="	border-right: 1px solid #000; border-left: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;" >
		     <?php
		      } // fin if
		   } // fin while

		   if($k%2==1)
			 {
		   ?>
    		   <td width="50%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"  >
    		   </td>
		    <?php
		    }
		?>
		   </tr>
		   <?php

			             $CGPA+=$GPA;
                         $count+=$j;
 			?>
    <?php } ?>
    </table>
    <?php
    $sql14="SELECT sum(gpa) , COUNT(n.`code_cours`)
                FROM $table_note_sql AS n, tbl_cours AS c
                WHERE c.code_cours = n.code_cours
                AND code_inscription = '$code_inscription'
                $conditions_gen
           and letter_grade not in ('X','T')
          AND n.archive = 0
          ";
          //var_dump($sql14);

       $result14 = mysql_query($sql14) or die (mysql_error());

    $resultat14=mysql_fetch_row($result14);
    $GPA=$resultat14[0];
    $j = $resultat14[1];
    // var_dump($GPA);
    // var_dump($j);
    $sql14="SELECT sum(nbr_credit)
                FROM $table_note_sql AS n, tbl_cours AS c
                WHERE c.code_cours = n.code_cours
                AND code_inscription = '$code_inscription'
                $conditions_gen
           and letter_grade !='X'
          AND n.archive = 0
          ";
          //var_dump($sql14);

       $result14 = mysql_query($sql14) or die (mysql_error());

    $resultat14=mysql_fetch_row($result14);
    $transfer14=$resultat14[0];
$totals = $transfer14;


  ?>


   <table width="1000" cellspacing="0" align="center" style="border: 1px solid #000; font-size:11px; font-weight:bold; margin-top:10px">
    <tr>
               <td colspan="0" align="center" class="gras" style="border: 1px  solid;"> <p><u><b>C.G.P.A.</b></u></p>
			     <?php echo $j>0 ? round($GPA/$j, 2) : '' ; ?>
            </td>
			<td colspan="0" align="center" class="gras" style="border: 1px  solid;"> <p><u><b>Legend</b></u></p>
			     <?php echo 'T=Transferred'; ?><br />
				  <?php echo 'A thru F = ASL Course'; ?>
            </td>
			<td colspan="0"  align="center"class="gras" style="border: 1px  solid;"> <p><u><b>Graduation Date:</b></u></p>
			     <?php
		$tab=split('[/.-]',$graduation_date);
		 if($tab[1]=='1')
		 {$tab[1]='January';}
		 else  if($tab[1]=='2')
		 {$tab[2]='February';}
		  else  if($tab[1]=='3')
		 {$tab[1]='March';}
		  else  if($tab[1]=='4')
		 {$tab[1]='April';}
		  else  if($tab[1]=='5')
		 {$tab[1]='May';}
		  else  if($tab[1]=='6')
		 {$tab[1]='June';}
		  else  if($tab[1]=='7')
		 {$tab[1]='July';}
		  else  if($tab[1]=='8')
		 {$tab[1]='August';}
		  else  if($tab[1]=='9')
		 {$tab[1]='September';}
		  else  if($tab[1]=='10')
		 {$tab[1]='October';}
		  else  if($tab[1]=='11')
		 {$tab[1]='November';}
		  else  if($tab[1]=='12')
		 {$tab[1]='December';}

     if ($totals >= 24) {
       echo $tab[1].' '.$tab[0];
     }
		 //echo 'January 2015' ; ?>
            </td>
				<td colspan="0"  align="center"class="gras" style="border: 1px  solid;"> <p><u><b> Total Credits Earned:</b></u></p>
		</p>

 <?php echo  $totals.Cr;//'24Cr';?>
<!-- <p>&nbsp;<u><b> Transfer Credits :</b></u> <?php echo  $transfer14 .Cr;//'24Cr';?>
</p>
			 <p>&nbsp;<u><b>  Total Credits Earned:</b></u>  <?php echo  $transfer14 + $credit.Cr;//'24Cr';?></p>
			 <p></p>
			 <p></p>
			 <p></p>-->

            </td>




   </tr>
  </table>
  <style media="screen">
        .is-valid {
            border-color: #198754;
            /* padding-right: calc(1.5em + .75rem); */
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-position: right calc(.375em + .1875rem) center;
            background-size: calc(.75em + .375rem) calc(.75em + .375rem);
        }
  </style>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
<script type="text/javascript">
    function change_letter_grade(id,table){
      var x = confirm("Are you sure ?");
      if (x) {
          var val = $(".letter_grade_"+id).val();
          //alert(val);
          $.ajax({
               url: '/module/transcripts/change_letter_grade.php',
               type: 'POST',
                  data:
                  {   
                     id : id,//id du catégorie 
                     table : table,
                     val : val               
                  },
                  dataType: 'json',
                  success: function(reponse) {
                   // console.log(reponse);
                   // console.log(reponse.status);
                   if (reponse.status == 1) {
                     $(".letter_grade_"+id).addClass('is-valid');

                     //window.location.reload();
                   }else{
                     $(".letter_grade_"+id).addClass('is-invalid');
                   }
                 }
           });
      }

    }
</script>
 <?php
 }
?>
