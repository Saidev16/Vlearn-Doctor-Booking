<head>
  <!--<style>
  body {
  background-image:url('transcript.jpg') ;
  background-repeat:no-repeat ;
  background-size: 100% ;
  background-position:50% 0%;

}
</style>
<style>
//td { border: 1px solid #000 }

</style>-->
</head>

<?php

$bd="hisadm_hisdb";

$login="hisadm_hisusr";

$mdp="hispass11";

$serveur='127.0.0.1';

function connecter($serveur,$login,$mdp,$bd)
{

  $connect = @mysql_connect($serveur,$login,$mdp);
  mysql_set_charset('utf8', $connect);
  if ( ! $connect )

  die ('Failed to connect server vnc');

  @mysql_select_db($bd, $connect) or die ('Database Select Failed');


}

connecter($serveur,$login,$mdp,$bd);




$CGPA=$count=$credit=0;
if (isset($_GET['printb'])){
  $code_inscription= addslashes($_GET['printb']);
  // select student information
  $sql="SELECT e.*
  FROM tbl_etudiant_usa as e WHERE code_inscription= '$code_inscription'";
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

  ?>

  <html>
  <meta charset="UTF-8">
  <br /> <br /> <br /> <br /> <br /><br />  <br /> <br /> <br /><br />




  <table width="1000"  cellpadding="0" cellspacing="0" border="0" style="border:1px solid black;" align="center" class="buletin_data" >



    <tr>

      <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px  solid;">
        <b> &nbsp;First Name:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($prenom);?>  </td>
        <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px solid;">
          <b> &nbsp;Date of Birth:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
          $date=$row['date_naissance'];
          $tab=split('[/.-]',$date);
          echo $tab[1].'-'.$tab[2].'-'.$tab[0]; /*echo $row['date_naissance'];*/

          ?> </td>

          <td height="21" colspan="15" align="left" valign="center" class="gras" style="border: 1px solid;">
            <b> &nbsp;&nbsp;&nbsp;&nbsp;Previous School Name:</b><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['lieu_naissance'];  ?> </td>
            <td width="19%" colspan="35" rowspan="10" align="center" valign="middle" style="border-right: 1px solid;"><span style="color:#A4A4A4">OFFICE USE ONLY </span></td>



          </tr>

          <tr>
            <td colspan="40" align="left" valign="middle" height="30" style="border: 1px solid;">&nbsp;<b>Last Name:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($nom);?>
              <td colspan="15" align="left" valign="middle" height="30" style="border-right: 1px solid;"><b> &nbsp;&nbsp;<br />&nbsp;&nbsp;&nbsp;&nbsp;Previous School Address:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row['code_bac'];?>     </td>

              <td colspan="15" align="center" valign="middle" height="30" style="border-right: 1px solid;">  </td>



            </tr>

            <tr>

              <td height="30" colspan="40" align="center" valign="middle" style="border: 1px solid;" ><b>Student Address: </b> <br /><?php echo $adresse;?></td>
              <td colspan="5" align="left" valign="middle" height="23" style="border-right: 1px solid;">     </td>




            </tr>

          </table>



          <table width="1000" cellspacing="0" border="1" align="center" class="buletin_data">
            <tr>
              <th width="46%">
                <table width="100%" cellspacing="0" class="gras">
                  <tr>
                    <td width="85" height="44" style="border-right: 1px  solid;">
                      Course Code</td>
                      <td width="260" style="border-right: 1px solid;">Course Title</td>
                      <td width="50" style="border-right: 1px solid;">Grade</td>
                      <td width="50" >Credit</td>

                    </tr>
                  </table>
                </th>

                <th width="38%">
                  <table width="100%" cellspacing="0" class="gras">
                    <tr>
                      <td width="85" height="44" style="border-right: 1px solid;">Course Code</td>
                      <td width="260" style="border-right: 1px solid;">Course Title</td>
                      <td width="50" style="border-right: 1px solid;">Grade</td>
                      <td width="50" >Credit</td>

                    </tr>
                  </table>
                </th>
              </tr>


              <tr>
              <?php
                $transfer=0;
                $query="SELECT DISTINCT n.idSession, s.session, s.annee_academique ,s.ordering
                FROM tbl_note_usa AS n, tbl_session AS s, tbl_cours AS c
                where n.idSession = s.idSession
                AND n.code_inscription = '$code_inscription'
                AND c.code_cours = n.code_cours
                AND n.archive = 0
                ORDER BY s.ordering";
                //var_dump($query);
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
                    <table width="100%" cellpadding="0" cellspacing="0" style="font-size:15px">
                      <tr>
                        <th colspan="4"><?php echo $ligne['session'].' '. $ligne['annee_academique']?></th>
                      </tr>
                      <?php
                      $GPA = $j = 0;
                      $sql="SELECT n.code_cours, c.titre_eng, c.nbr_credit , n.letter_grade, n.gpa, c.type,n.mid_term ,n.final_exam,n.project,n.participation
                      FROM tbl_note_usa AS n, tbl_cours AS c
                      WHERE c.code_cours = n.code_cours
                      AND code_inscription = '$code_inscription'
                      AND idSession = '$idSession'
                      AND n.archive = 0
                      GROUP BY c.code_cours";
                      //var_dump($sql);
                      $res= @mysql_query($sql) or die('Erreur :: Select notes');
                      while($row = mysql_fetch_assoc($res)){

                        if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X') && ($row['letter_grade']!='' )){
                          $j++;
                          $GPA += $row['gpa'];
                        }
                        if($row['letter_grade']!= 'T' &&  $row['letter_grade']!='' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X')
                        { $credit+=$row['nbr_credit'];}

                        if($row['letter_grade']== 'T' /*or $row['letter_grade']== 'I' or $row['letter_grade']== 'X'or $row['letter_grade']== 'W'*/)  $transfer+=1 ;

                        $mid_term=$row['mid_term'];
                        $final_exam=$row['final_exam'];
                        $letter_grade=$row['letter_grade'];

                        ?>
                        <tr>
                          <td width="75" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                          <td width="225" align="left"><?php echo trim(stripslashes($row["titre_eng"]));/*echo stripslashes($row['titre']);*/?> </td>
                          <td width="50" align="center"><?php echo $row['nbr_credit'];?></td>
                          <td width="50" align="center"><?php echo  $row['letter_grade'];?></td>
                        </tr>

                        <?php
                        // end fetch notes
                      }
                      $CGPA+=$GPA;
                      $count+=$j;
                      ?>
                      <tr >
                        <td colspan="3" class="gras" ><b>Grade Point Average(GPA):</b></td>
                        <td align="center" class="gras" rowspan="10"><b><?php echo $j>0 ? round($GPA/$j, 2) : '' ; ?></b></td>
                      </tr>
                    </table>
                  </td>
                  <?php
                  // end fetch session
                }
                //var_dump($i);
                if ($i%2 == 1) {
                  echo "<td width='50%' valign='top'></td>";
                }
                ?>

                <table width="1000"  cellpadding="0" cellspacing="0" border="0" style="border:1px solid black;" align="center" class="buletin_data" >
                  <tr>
                    <td colspan="0" align="center" class="gras" style="border: 1px  solid;"> <p><u><b>C.G.P.A.</b></u></p>
                      <?php
                      if($j>0 )
                      { $zineb= round($GPA/$j, 2) ;
                        echo  number_format($zineb, 1, '.', ' ');
                      }
                      else { echo '' ; }


                      //echo $j>0 ? round($GPA/$j, 2) : '' ; ?>
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

                      echo $tab[1].' '.$tab[0]; //echo 'January 2015' ; ?>
                    </td>
                    <td colspan="0"  align="center"class="gras" style="border: 1px  solid;"> <p><u><b> Total Credits Earned:</b></u></p>
                    </p>
                    <?php

                    $sql14="SELECT sum(nbr_credit)
                    FROM tbl_note_usa AS n, tbl_cours AS c
                    WHERE c.code_cours = n.code_cours
                    AND code_inscription = '$code_inscription'
                    and letter_grade ='T'
                    AND n.archive = 0
                    ";

                    $result14 = mysql_query($sql14) or die (mysql_error());

                    $resultat14=mysql_fetch_row($result14);
                    $transfer14=$resultat14[0]; 	  ?>
                    <?php echo  $transfer14 + $credit.Cr;//'24Cr';?>

                  </tr>
                </table>
              </table>

            </td>
          </tr>
        </table>

        <?php
      }
      ?>
