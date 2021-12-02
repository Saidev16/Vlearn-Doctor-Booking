<span id="titre_page">Transcript</span>
<?php
if (isset($_SESSION['code_etudiant'])){
$code_inscription=$_SESSION['code_etudiant'];
$prefixe=$_SESSION['prefixe'];
 $sql="SELECT e.*
   FROM tbl_etudiant_all AS e WHERE code_inscription= '$code_inscription' and prefixe= '$prefixe'";
   $res= @mysql_query($sql) or die('Erreur :: Student information');
   $row = @mysql_fetch_assoc($res);
   $date=$row['date_naissance'];
  $nom=$row['nom'];
  $prenom=$row['prenom'];
  $adresse=$row['adresse'];
  $lieu_naissance=$row['lieu_naissance'];
  $code_bac=$row['code_bac'];
  $prefixe=$row['prefixe'];
  $graduation_date=$row['graduation_date'];

   if($prefixe=='MOR')
    { $tbl_note='tbl_note_morocco';}
    else  if($prefixe=='AG')
    {  $tbl_note='tbl_note_algeria';}
    else if($prefixe=='US')
    { $tbl_note='tbl_note_usa'; }
    if($prefixe=='BN')
    {  $tbl_note='tbl_note_benin';    }
    if($prefixe=='BF')
    {  $tbl_note='tbl_note_burkina';   }
    elseif ($prefixe=='CAM')
    {  $tbl_note='tbl_note_cameroun';   }

     $transcript = $row['new_transcript'];
     $conditions_gen = "";
     if ($transcript == 1) {
       $conditions_gen = "AND n.prefixe = '$prefixe'";
       $tbl_note = "tbl_note_acc";
       $table_inscription_sql = "tbl_inscription_cours_acc";
     }
?>
 <br />
<table class="buletin_header" cellspacing="5" width="575" align="center">
  	<!--<tr>
    	<td><span class="gras">Name: </span><?php echo ucfirst($row['name']);?></td>
        <td><span class="gras">I.D Number: </span> <?php echo $row['code_inscription'];?></td>
    </tr>
    <tr>
    	<td><span class="gras">Birth date: </span> <?php echo $row['date_naissance'];?></td>
        <td><span class="gras">Degree pursued: </span> <?php echo $row['niveau'];?></td>
    </tr>
    <tr>
    	<td><span class="gras">First registration: </span><?php echo $row['date_inscription'];?> </td>
        <td><span class="gras">Major: </span><?php echo $row['nom_filiere'];?> </td>
    </tr>-->
     <tr>

     <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px  solid;">
       <b> &nbsp;First Name:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $prenom;?>  </td>
      <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px solid;">
       <b> &nbsp;Date of Birth:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
$date=$row['date_naissance'];
$tab=split('[/.-]',$date);
echo $tab[1].'-'.$tab[2].'-'.$tab[0]; /*echo $row['date_naissance'];*/

?> </td>

      <td height="50" width=50 colspan="15" align="left" valign="middle" style="border: 1px solid;">
       <b> &nbsp;&nbsp;&nbsp;Previous School Name:</b><br />
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['lieu_naissance'];  ?> </td>
      <td width="70" height="30" colspan="20" align="center" valign="middle" class="gras" >&nbsp; <p>&nbsp;</p>
        <p><font color="#E0EBEB">Unofficial/Student Copy </font> </p></td>
  </tr>
       <tr>
      <td colspan="40" align="left" valign="middle" height="30" style="border: 1px solid;">&nbsp;<b>Last Name:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nom;?>

     <td colspan="15" align="left" valign="middle" height="30" style="border-right: 1px solid;"><b> &nbsp;&nbsp;&nbsp;<br />
         &nbsp;&nbsp;&nbsp;Previous School Address:</b><br />
       &nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $row['code_bac'];?>     </td>
    </tr>
    <tr>
     <td height="30" colspan="40" align="center" valign="middle" style="border: 1px solid;" ><b>Student Address: </b> <br /><?php echo $adresse;?></td>
    <td colspan="15" align="left" valign="middle" height="30" style="border-right: 1px solid;"><b> &nbsp;&nbsp;&nbsp;<br />
         &nbsp;&nbsp;&nbsp;</b>
          </td>
  </tr>
  </table>
  <table width="575" cellspacing="0" border="1" align="center" class="buletin_data">
    <tr>
    	<th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                    <td width="75">Course</td>
                    <td>Description</td>
                    <td width="50">Credit</td>
                    <td width="50">Grade</td>
                </tr>
            </table>
        </th>
        <th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                    <td width="75">Course</td>
                    <td>Description</td>
                    <td width="50">Credit</td>
                    <td width="50">Grade</td>
                </tr>
            </table>
        </th>
    </tr>
    <tr>
    <?php
             $transfer=0;


       $GPA = $j = 0;
       $k=0; //indice

       $sql="SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, n.IdSession, n.code_cours_testing
             FROM $tbl_note AS n, tbl_cours AS c
             WHERE c.code_cours = n.code_cours
             AND code_inscription = '$code_inscription'
             $conditions_gen
             AND n.letter_grade = 'T'

       AND n.archive = 0";
       $res= @mysql_query($sql) or die('Erreur :: Select notes');

       while($row = mysql_fetch_assoc($res)){

       $ss=$row['IdSession'];

       $sql2="SELECT session, annee_academique,academic_year from tbl_session where IdSession= '$ss'";
       $res2= @mysql_query($sql2) or die('Erreur :: Select session');
       $ligne=mysql_fetch_assoc($res2);
       $d=$ligne['session'].' '. $ligne['annee_academique'];

       if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I') && ($row['letter_grade']!='') && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X' && $row['letter_grade']!= 'F'){
             $j++;
             }
             $GPA += $row['gpa'];

       if($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!='' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X' && $row['letter_grade']!= 'F'){ $credit+=$row['nbr_credit'];}
             if($row['letter_grade']== 'T')  $transfer+=1 ;

            ?>
            <td width="50%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"   >
            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:11px">
            <tr>
                <td width="89" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                <td width="285" align="left"><?php echo stripslashes($row['titre']);?></td>
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
          <tr style=" border-right: 1px solid #000; border-left: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;" >
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
  	<tr>
    	<th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                    <td width="75">Course</td>
                    <td>Description</td>
                    <td width="50">Credit</td>
                    <td width="50">Grade</td>
                </tr>
            </table>
        </th>
        <th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                    <td width="75">Course</td>
                    <td>Description</td>
                    <td width="50">Credit</td>
                    <td width="50">Grade</td>
                </tr>
            </table>
        </th>
    </tr>
    <tr>
    <?php
       //       $transfer=0;
       //
       //
       // $GPA = $j = 0;
       // $k=0; //indice

       $sql="SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, n.IdSession, n.code_cours_testing
             FROM $tbl_note AS n, tbl_cours AS c
             WHERE c.code_cours = n.code_cours
             AND code_inscription = '$code_inscription'
             $conditions_gen
             AND n.letter_grade != 'T'
             AND n.archive = 0";
       $res= @mysql_query($sql) or die('Erreur :: Select notes');

       while($row = mysql_fetch_assoc($res)){

       $ss=$row['IdSession'];

       $sql2="SELECT session, annee_academique,academic_year from tbl_session where IdSession= '$ss'";
       $res2= @mysql_query($sql2) or die('Erreur :: Select session');
       $ligne=mysql_fetch_assoc($res2);
       $d=$ligne['session'].' '. $ligne['annee_academique'];

       if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I') && ($row['letter_grade']!='') && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X' && $row['letter_grade']!= 'F'){
             $j++;
             }
             $GPA += $row['gpa'];

       if($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!='' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X' && $row['letter_grade']!= 'F'){ $credit+=$row['nbr_credit'];}
             if($row['letter_grade']== 'T')  $transfer+=1 ;

            ?>
            <td width="50%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"   >
            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:11px">
            <tr>
                <td width="89" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                <td width="285" align="left"><?php echo stripslashes($row['titre']);?></td>
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
          <tr style=" border-right: 1px solid #000; border-left: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;" >
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

       // SELECT sum(gpa) , COUNT(n.`code_cours`) FROM tbl_note_acc AS n, tbl_cours AS c WHERE
       // c.code_cours = n.code_cours AND code_inscription = '371' AND n.prefixe = 'BF'
       // and letter_grade not in ('X','T') AND n.archive = 0
        $sql14="SELECT sum(gpa) , COUNT(n.`code_cours`)
                    FROM $tbl_note AS n, tbl_cours AS c
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

       $sql14="SELECT sum(nbr_credit)
                   FROM $tbl_note AS n, tbl_cours AS c
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

   <table width="575" cellspacing="0" border="1" align="center" class="buletin_data">
    <tr>
               <td colspan="0" align="center" class="gras" style="border: 1px  solid;"> <p><u><b>C.G.P.A.</b></u></p>
           <?php

           // var_dump($GPA);
           // var_dump($j);
           echo $j>0 ? round($GPA/$j, 2) : '' ; ?>
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
     } //echo 'January 2015' ; ?>
            </td>
        <td colspan="0"  align="center"class="gras" style="border: 1px  solid;"> <p><u><b> Total Credits Earned:</b></u></p>
    </p>

 <?php echo  $totals.Cr;//'24Cr';?>



            </td>




   </tr>
  </table>

 <?php
 }
?>
