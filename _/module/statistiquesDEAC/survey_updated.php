<?php
// BBA Surveys

$curriculum = array();
$faculty = array();
$administration = array();
$library = array();
$campus_tools = array();
$overall_satisfaction = array();
$years = array(2014,2015,2016,2017,2018);

// calcule des stastistiques par session

foreach ($years as $k => $v) {
  $count_session = 0;
  $curriculum_session = 0;
  $faculty_session = 0;
  $administration_session = 0;
  $library_session = 0;
  $campus_tools_session = 0;
  $sql_session = "SELECT `idSession` FROM `tbl_session` WHERE `annee` = \"$v\" and `archive` = 0";
  //echo $sql_session;
  $ressource=@mysql_query($sql_session) or die('Erreur :: Select sessions');
  while ($row= mysql_fetch_assoc($ressource)){
      $id_session = $row['idSession'];

      //survey information
      $niveau = "bba";
      $sql_sondage = "SELECT * FROM `tbl_sondage` WHERE id_session = $id_session and niveau= \"$niveau\"";
      $res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
      $row_sondage=mysql_fetch_assoc($res_sondage);
      $idSession=$row_sondage['idSession'];


      // les profs
      $sql_prof_affectation= "SELECT distinct a.`code_prof` FROM `tbl_sondage_affectation` as a , `tbl_professeur` as p WHERE a.`groupe` = 3 AND a.`session` = \"$id_session\" AND a.`code_prof` = p.`code_prof` AND p.`archive`= 0  AND a.`archive` = 0 AND a.`campus` = \"e-learning\"";
      $req_prof_affectation = @mysql_query($sql_prof_affectation);
      $ttl_pr1 = 0;
      $ttl_pr2 = 0;
      $ttl_pr3 = 0;
      $ttl_pr4 = 0;
      $ttl_pr5 = 0;
      $nb_prof = 0;

      while ($row_prof_affectation = mysql_fetch_array($req_prof_affectation)){
        $code_prof = $row_prof_affectation['code_prof'];
        $sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\" and archive=0";
        $req_prof = @mysql_query($sql_prof);
        $row_prof = mysql_fetch_assoc($req_prof);
        $nom_prof = $row_prof['nom_prenom'];
        $nb_prof++;
        $sql_nb_cour = "SELECT COUNT(distinct(a.id)) FROM `tbl_sondage_affectation` as a , tbl_resultat_sondage as r
        WHERE
        a.`groupe` = 3 AND
        a.`session` = \"$id_session\" AND
        a.`archive` = 0 AND
        a.id = r.id_affectation AND
        a.`code_prof` = \"$code_prof\" AND
        a.`campus` = 'e-learning'";
        $req_nb_cour = @mysql_query($sql_nb_cour);
        $row_nb_cour = mysql_fetch_array($req_nb_cour);
        $nb_cours = $row_nb_cour['0'];
        //
        $sql_cour_affectation= "SELECT distinct(r.id_affectation), a.* FROM `tbl_sondage_affectation` as a, tbl_resultat_sondage as r WHERE
        a.`groupe` = 3 AND
        a.`session` = \"$id_session\" AND
        a.`code_prof` = \"$code_prof\" AND
        a.`campus` = 'e-learning' AND a.id = r.id_affectation";
        $porcentage1 = 0;
        $porcentage2 = 0;
        $porcentage3 = 0;
        $porcentage4 = 0;
        $porcentage5 = 0;
        $req_cour_affectation = @mysql_query($sql_cour_affectation);
        while ($row_cour_affectation = mysql_fetch_array($req_cour_affectation)){
          $code_cour = $row_cour_affectation['code_cours'];
          $type = $row_cour_affectation['type'];
          $campus = $row_cour_affectation['campus'];
          $groupe = $row_cour_affectation['groupe'];
          $sql_cour = "SELECT * FROM `tbl_cours` WHERE `code_cours` = \"$code_cour\"";
          $req_cour = @mysql_query($sql_cour);
          $row_cour = mysql_fetch_assoc($req_cour);
          $cour = $row_cour['titre'];
          $cour_eng = $row_cour['titre_eng'];
          $id_affectation = $row_cour_affectation['id'];
          $sql_nb_etudiant = "SELECT  COUNT( Distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_resultat_sondage` as e WHERE   `id_affectation` = \"$id_affectation\" and `id_sondage` = \"$id_sondage\" and r.`code_etudiant` = e.`code_inscription`";
          $req_nb_etudiant = @mysql_query($sql_nb_etudiant);
          $row_nb_etudiant = mysql_fetch_array($req_nb_etudiant);
          $nb_etudiants = $row_nb_etudiant['0'];
          $t = 0;
          if ($type == 0) {
            $t = 1;
          }
          if ($type == 1) {
            $t = 6;
          }
          $sql_nb_etudiant_cour = "SELECT count(*) FROM `tbl_note_piimt`as n , `tbl_etudiant_deac`as e , `tbl_inscription_cours_piimt` as i WHERE
          n.`code_inscription` = e.`code_inscription` and
          n.`code_cours` = i.`code_cours` and
          n.`code_inscription` = i.`code_inscription` and
          n.`idSession` = i.`idSession` and
          i.`archive` != 1 and
          i.`idSession` = \"$id_session\" and
          n.`code_cours` = \"$code_cour\" and
          n.`letter_grade` != \"T\" and
          n.`archive` != 1 and ";
          if ($campus != "e-learning") {
            $sql_nb_etudiant_cour .= "e.`ville` = \"$campus\" and ";
          }
          $sql_nb_etudiant_cour .= "e.`groupe` = $groupe and i.`type_cours_id` = $t";
          $req_nb_etudiant_cour = @mysql_query($sql_nb_etudiant_cour);
          $row_nb_etudiant_cour = mysql_fetch_array($req_nb_etudiant_cour);
          $nb_etudiants_cour = $row_nb_etudiant_cour['0'];
          //////////////
          $nb_q_ver = 0;
          $sql_resultat = "SELECT Distinct `code_etudiant` FROM `tbl_resultat_sondage` where  `id_affectation` = $id_affectation  and `id_sondage` = $id_sondage";
          $req_resultat = @mysql_query($sql_resultat);
          //Q9
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e, `tbl_reponse` as rep WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and id_question = 9 group by rep.`porcentage`,`code_etudiant`,`id_question`";
          $req_new = @mysql_query($sql_new);
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
          $satisfaction = $satisfaction + $row_new['porcentage'];
          $nbQ++;
          }
          $porcentage1 = $porcentage1 + ($satisfaction/$nbQ);
          //Q1-->Q8
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e, `tbl_reponse` as rep WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and id_question in (1,2,3,4,5,6,7,8) group by rep.`porcentage`,`code_etudiant`,`id_question`";
          $req_new = @mysql_query($sql_new);
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
            $satisfaction = $satisfaction + $row_new['porcentage'];
            $nbQ++;
          }
          $porcentage2 = $porcentage2 + ($satisfaction/$nbQ);
          //Q10
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e, `tbl_reponse` as rep WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and id_question = 10 group by rep.`porcentage`,`code_etudiant`,`id_question`";
          $req_new = @mysql_query($sql_new);
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
          $satisfaction = $satisfaction + $row_new['porcentage'];
          $nbQ++;
          }
          $porcentage3 = $porcentage3 + ($satisfaction/$nbQ);
          //Q12
          $sql_new = "
            SELECT
              count(distinct(r.code_etudiant)) as nb ,
              `id_question`,r.code_etudiant,
              r.`id_affectation` ,
              r.`id_reponse` ,
              rep.`porcentage` as porcentage
              FROM `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_etudiant_deac` as e,
              `tbl_reponse` as rep
              WHERE  a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id` and
              a.`id` = $id_affectation and
              r.`code_etudiant` = e.`code_inscription` and
              id_question = 12 group by
              rep.`porcentage`,
              `code_etudiant`,
              `id_question`";
          $req_new = @mysql_query($sql_new);
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
            $satisfaction = $satisfaction + $row_new['porcentage'];
            $nbQ++;
          }
          $porcentage4 = $porcentage4 + ($satisfaction/$nbQ);
          //Q11
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e, `tbl_reponse` as rep WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and id_question = 10 group by rep.`porcentage`,`code_etudiant`,`id_question`";
          $req_new = @mysql_query($sql_new);
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
          $satisfaction = $satisfaction + $row_new['porcentage'];
          $nbQ++;
          }
          $porcentage5 = $porcentage5 + ($satisfaction/$nbQ);

        }
            $porcentage1 = $porcentage1/$nb_cours;
            $porcentage2 = $porcentage2/$nb_cours;
            $porcentage3 = $porcentage3/$nb_cours;
            $porcentage4 = $porcentage4/$nb_cours;
            $porcentage5 = $porcentage5/$nb_cours;

            $ttl_pr1 = $ttl_pr1 + $porcentage1;
            $ttl_pr2 = $ttl_pr2 + $porcentage2;
            $ttl_pr3 = $ttl_pr3 + $porcentage3;
            $ttl_pr4 = $ttl_pr4 + $porcentage4;
            $ttl_pr5 = $ttl_pr5 + $porcentage5;




        }

        $ttl_pr1 = $ttl_pr1/$nb_prof;
        $ttl_pr2 = $ttl_pr2/$nb_prof;
        $ttl_pr3 = $ttl_pr3/$nb_prof;
        $ttl_pr4 = $ttl_pr4/$nb_prof;
        $ttl_pr5 = $ttl_pr5/$nb_prof;
        $curriculum_session = $curriculum_session+$ttl_pr1;
        $faculty_session = $faculty_session+$ttl_pr2;
        $administration_session = $administration_session+$ttl_pr3;
        $library_session = $library_session+$ttl_pr4;
        $campus_tools_session = $campus_tools_session+$ttl_pr5;
        $overall = $ttl_pr1+$ttl_pr2+$ttl_pr3+$ttl_pr4+$ttl_pr5;
        if ($overall != 0) {
          $count_session++;
        }


  }
  $curriculum[$k] = $curriculum_session/$count_session;
  $faculty[$k] = $faculty_session/$count_session;
  $administration[$k] = $administration_session/$count_session;
  $library[$k] = $library_session/$count_session;
  $campus_tools[$k] = $campus_tools_session/$count_session;
  $overall_satisfaction[$k] = ($curriculum[$k]+$faculty[$k]+$administration[$k]+$library[$k]+$campus_tools[$k])/5;
}


?>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<div class="" style="margin:10px">
  <a href="http://sis.aulm.us/administrator/Statistiques.php" style="
    color: #fff;
    background-color: #5bc0de;
    border-color: #46b8da;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    text-decoration: none;
">Return </a>

</div>


<h2>BBA Surveys</h2>

<table>
  <tr>
    <th>Summative Results</th>
    <?php foreach ($years as $k => $v) { ?>
        <th><?php echo $v; ?></th>
    <?php } ?>

  </tr>
  <tr>
    <td>Satisfaction with Curriculum</td>
    <?php foreach ($curriculum as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with Faculty</td>
    <?php foreach ($faculty as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with Administration</td>
    <?php foreach ($administration as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with Library</td>
    <?php foreach ($library as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with campus tools</td>
    <?php foreach ($campus_tools as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Overall Student Satisfaction</td>
    <?php foreach ($overall_satisfaction as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
</table>

<?php

// MBA Surveys
$id_sondage =2;
$curriculum = array();
$faculty = array();
$administration = array();
$library = array();
$campus_tools = array();
$overall_satisfaction = array();


// calcule des stastistiques par session
foreach ($years as $k => $v) {
  $count_session = 0;
  $curriculum_session = 0;
  $faculty_session = 0;
  $administration_session = 0;
  $library_session = 0;
  $campus_tools_session = 0;
  // years session
  $sql_session = "SELECT `annee_academique`, `session` FROM `tbl_session` WHERE `annee` = \"$v\" and `archive` = 0";
  //echo $sql_session;
  $ressource=@mysql_query($sql_session) or die('Erreur :: Select sessions');
  while ($row= mysql_fetch_assoc($ressource)){
      $periode = $row['session'];
      $annee = $row['annee_academique'];
      // les satisfactions
          // le calcule des resultats
          // Q9
          $porcentage1 = 0;
          $porcentage2 = 0;
          $porcentage3 = 0;
          $porcentage4 = 0;
          $porcentage5 = 0;
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"mba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question = 9 and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation`
              group by rep.`porcentage`,`code_etudiant`,`id_question`";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $porcentage1 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
          $porcentage1 = $satisfaction/$nbQ;

          // Q1 --> Q8
          // nb etudiants
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription` and r.id_question in (1,2,3,4,5,6,7,8)
              ";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $row_new = mysql_fetch_array($req_new);

          // calcule
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"mba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question in (1,2,3,4,5,6,7,8) and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation`
              group by rep.`porcentage`,`code_etudiant`,`id_question` order by id_question";
          $req_new = @mysql_query($sql_new);
          $porcentage2 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
          $porcentage2 = $satisfaction/$nbQ;

          // Q10
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"mba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question = 10 and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation`
              group by rep.`porcentage`,`code_etudiant`,`id_question`";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $porcentage3 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
          $porcentage3 = $satisfaction/$nbQ;
          // Q12 - B
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"mba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question = 12 and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation` group by rep.`porcentage`,`code_etudiant`,`id_question`";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $porcentage4 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
          $porcentage4 = $satisfaction/$nbQ;
          // Q11
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"mba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question = 11 and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation` group by rep.`porcentage`,`code_etudiant`,`id_question`";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $porcentage5 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
      $porcentage5 = $satisfaction/$nbQ;
      //
      $curriculum_session = $curriculum_session+$porcentage1;
      $faculty_session = $faculty_session+$porcentage2;
      $administration_session = $administration_session+$porcentage3;
      $library_session = $library_session+$porcentage4;
      $campus_tools_session = $campus_tools_session+$porcentage5;
      $overall = $porcentage1+$porcentage2+$porcentage3+$porcentage4+$porcentage5;
      if ($overall != 0) {
        $count_session++;
      }
    }
    $curriculum[$k] = $curriculum_session/$count_session;
    $faculty[$k] = $faculty_session/$count_session;
    $administration[$k] = $administration_session/$count_session;
    $library[$k] = $library_session/$count_session;
    $campus_tools[$k] = $campus_tools_session/$count_session;
    $overall_satisfaction[$k] = ($curriculum[$k]+$faculty[$k]+$administration[$k]+$library[$k]+$campus_tools[$k])/5;
}
 ?>

<h2>MBA Surveys</h2>

<table>
  <tr>
    <th>Summative Results</th>
    <?php foreach ($years as $k => $v) { ?>
        <th><?php echo $v; ?></th>
    <?php } ?>

  </tr>
  <tr>
    <td>Satisfaction with Curriculum</td>
    <?php foreach ($curriculum as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with Faculty</td>
    <?php foreach ($faculty as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with Administration</td>
    <?php foreach ($administration as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with Library</td>
    <?php foreach ($library as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with campus tools</td>
    <?php foreach ($campus_tools as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Overall Student Satisfaction</td>
    <?php foreach ($overall_satisfaction as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
</table>


<?php

// MBA Surveys
$id_sondage =7;
$curriculum = array();
$faculty = array();
$administration = array();
$library = array();
$campus_tools = array();
$overall_satisfaction = array();


// calcule des stastistiques par session
foreach ($years as $k => $v) {
  $count_session = 0;
  $curriculum_session = 0;
  $faculty_session = 0;
  $administration_session = 0;
  $library_session = 0;
  $campus_tools_session = 0;
  // years session
  $sql_session = "SELECT `annee_academique`, `session` FROM `tbl_session` WHERE `annee` = \"$v\" and `archive` = 0";
  //echo $sql_session;
  $ressource=@mysql_query($sql_session) or die('Erreur :: Select sessions');
  while ($row= mysql_fetch_assoc($ressource)){
      $periode = $row['session'];
      $annee = $row['annee_academique'];
      // les satisfactions
          // le calcule des resultats
          // Q9
          $porcentage1 = 0;
          $porcentage2 = 0;
          $porcentage3 = 0;
          $porcentage4 = 0;
          $porcentage5 = 0;
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"dba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question = 9 and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation`
              group by rep.`porcentage`,`code_etudiant`,`id_question`";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $porcentage1 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
          $porcentage1 = $satisfaction/$nbQ;

          // Q1 --> Q8
          // nb etudiants
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription` and r.id_question in (1,2,3,4,5,6,7,8)
              ";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $row_new = mysql_fetch_array($req_new);

          // calcule
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"dba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question in (1,2,3,4,5,6,7,8) and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation`
              group by rep.`porcentage`,`code_etudiant`,`id_question` order by id_question";
          $req_new = @mysql_query($sql_new);
          $porcentage2 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
          $porcentage2 = $satisfaction/$nbQ;

          // Q10
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"dba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question = 10 and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation`
              group by rep.`porcentage`,`code_etudiant`,`id_question`";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $porcentage3 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
          $porcentage3 = $satisfaction/$nbQ;
          // Q12 - B
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"dba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question = 12 and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation` group by rep.`porcentage`,`code_etudiant`,`id_question`";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $porcentage4 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
          $porcentage4 = $satisfaction/$nbQ;
          // Q11
          $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
              `tbl_sondage_affectation` as a ,
              `tbl_resultat_sondage` as r ,
              `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE
              a.`groupe` = 3 and
              a.`niveau` = \"dba\" and
              a.`annee` = $annee and
              a.`periode` = \"$periode\" and
              a.`id` = r.`id_affectation` and
              r.`id_reponse` = rep.`id`and
              r.id_question = 11 and
              a.`type` = 1 and
              e.`code_inscription` = et.`code_inscription`   and a.`id` = e.`id_affectation` group by rep.`porcentage`,`code_etudiant`,`id_question`";
          //var_dump($sql_new);
          $req_new = @mysql_query($sql_new);
          $porcentage5 = 0;
          $satisfaction = 0;
          $nbQ = 0;
          while ($row_new = mysql_fetch_array($req_new)) {
              $satisfaction = $satisfaction + $row_new['porcentage'];
              $nbQ++;
          }
      $porcentage5 = $satisfaction/$nbQ;
      //
      $curriculum_session = $curriculum_session+$porcentage1;
      $faculty_session = $faculty_session+$porcentage2;
      $administration_session = $administration_session+$porcentage3;
      $library_session = $library_session+$porcentage4;
      $campus_tools_session = $campus_tools_session+$porcentage5;
      $overall = $porcentage1+$porcentage2+$porcentage3+$porcentage4+$porcentage5;
      if ($overall != 0) {
        $count_session++;
      }
    }
    $curriculum[$k] = $curriculum_session/$count_session;
    $faculty[$k] = $faculty_session/$count_session;
    $administration[$k] = $administration_session/$count_session;
    $library[$k] = $library_session/$count_session;
    $campus_tools[$k] = $campus_tools_session/$count_session;
    $overall_satisfaction[$k] = ($curriculum[$k]+$faculty[$k]+$administration[$k]+$library[$k]+$campus_tools[$k])/5;
}
 ?>

<h2>DBA Surveys</h2>

<table>
  <tr>
    <th>Summative Results</th>
    <?php foreach ($years as $k => $v) { ?>
        <th><?php echo $v; ?></th>
    <?php } ?>

  </tr>
  <tr>
    <td>Satisfaction with Curriculum</td>
    <?php foreach ($curriculum as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with Faculty</td>
    <?php foreach ($faculty as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with Administration</td>
    <?php foreach ($administration as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with Library</td>
    <?php foreach ($library as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Satisfaction with campus tools</td>
    <?php foreach ($campus_tools as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Overall Student Satisfaction</td>
    <?php foreach ($overall_satisfaction as $k => $v) { ?>
        <th><?php echo round($v)."%"; ?></th>
    <?php } ?>
  </tr>
</table>


<?php

// Alumni Surveys
$id_sondage =6;
$id_question = array(7,5,6,10);
$porcentage = array();
$total = array();

foreach ($years as $k => $v) {
  // Alumni students by year
  // Quality of Education
  $ttl_satisfaction = 0;
  foreach ($id_question as $id) {
    if ($id != 6) {
      $sql_new = "SELECT count(distinct(r.`code_inscription`)) as nb ,`id_question`, r.`id_reponse` , rep.`porcentage` as porcentage FROM `resultat_alumni` as r , `tbl_reponse_alumni` as rep , `tbl_etudiant_deac` as et WHERE
      (et.`date` like '%$v%' or et.`datemba` like '%$v%' or et.`datedba` like '%$v%') and
      r.`id_reponse` = rep.`id`and
      r.`id_question` = $id and
      r.`code_inscription` = et.`code_inscription`
      group by rep.`porcentage`,et.`code_inscription`,`id_question`";
      //var_dump($sql_new);
      $req_new = @mysql_query($sql_new);
      $satisfaction = 0;
      $nbQ = 0;
      while ($row_new = mysql_fetch_array($req_new)) {
          $satisfaction = $satisfaction + $row_new['porcentage'];
          $nbQ++;
      }
      $ttl_satisfaction = $ttl_satisfaction+(round($satisfaction/$nbQ));
      $porcentage[$v][] = round($satisfaction/$nbQ);
    }else{
      $sql_new = "SELECT count(distinct(r.`code_inscription`)) as nb ,`id_question`, r.`id_reponse` , rep.`porcentage` as porcentage FROM `resultat_alumni` as r , `tbl_reponse_alumni` as rep , `tbl_etudiant_deac` as et WHERE
      (et.`date` like '%$v%' or et.`datemba` like '%$v%' or et.`datedba` like '%$v%') and
      r.`id_reponse` = rep.`id`and
      r.`id_question` in (6,2,3) and
      r.`code_inscription` = et.`code_inscription`
      group by rep.`porcentage`,et.`code_inscription`,`id_question`";
      //var_dump($sql_new);
      $req_new = @mysql_query($sql_new);
      $satisfaction = 0;
      $nbQ = 0;
      while ($row_new = mysql_fetch_array($req_new)) {
          $satisfaction = $satisfaction + $row_new['porcentage'];
          $nbQ++;
      }
      $ttl_satisfaction = $ttl_satisfaction+(round($satisfaction/$nbQ));
      $porcentage[$v][] = round($satisfaction/$nbQ);
    }

  }
  //Overall satisfactions
  $total[] = $ttl_satisfaction/4;
}
// Placement rate
$placement_rate = array();
foreach ($years as $k => $v) {
    // nb of employer + continuing education
    $sql_new = "SELECT count(distinct(r.`code_inscription`)) as nb FROM `resultat_alumni` as r , `tbl_etudiant_deac` as et WHERE
        (et.`date` like '%$v%' or et.`datemba` like '%$v%' or et.`datedba` like '%$v%') and
        r.`id_question` = 12 and
        r.`id_reponse` in (47,48,49) and
        r.`code_inscription` = et.`code_inscription`";
    $req_new = @mysql_query($sql_new);
    $row_new = mysql_fetch_array($req_new);
    $nb_e_c = $row_new['nb'];
    // nb of alumni student by year
    $sql_new = "SELECT count(distinct(r.`code_inscription`)) as nb FROM `resultat_alumni` as r ,`tbl_etudiant_deac` as et WHERE
        (et.`date` like '%$v%' or et.`datemba` like '%$v%' or et.`datedba` like '%$v%') and r.`code_inscription` = et.`code_inscription`";
    $req_new = @mysql_query($sql_new);
    $row_new = mysql_fetch_array($req_new);
    $nb_alumni_student = $row_new['nb'];
    $placement_rate[] = round(($nb_e_c/$nb_alumni_student)*100);
}

 ?>

<h2>Alumni Surveys</h2>

<table>
  <tr>
    <th>Summative Results</th>
    <?php foreach ($years as $k => $v) { ?>
        <th><?php echo $v; ?></th>
    <?php } ?>

  </tr>
  <tr>
    <th>Quality of Education</th>
    <?php foreach ($years as $k => $v) { ?>
        <th><?php echo $porcentage[$v][0]."%"; ?></th>
    <?php } ?>

  </tr>
  <tr>
    <td>Value Education/Tuition</td>

    <?php foreach ($years as $k => $v) { ?>
        <th><?php echo $porcentage[$v][1]."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Performance Improvement </td>
    <?php foreach ($years as $k => $v) { ?>
        <th><?php echo $porcentage[$v][2]."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Referral rate</td>
    <?php foreach ($years as $k => $v) { ?>

        <th><?php echo $porcentage[$v][3]."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Overall Satisfaction </td>
    <?php foreach ($total as $k => $v) { ?>
        <th><?php echo $v."%"; ?></th>
    <?php } ?>
  </tr>
  <tr>
    <td>Placement Rate</td>
    <?php foreach ($placement_rate as $k => $v) { ?>
        <th><?php echo $v."%"; ?></th>
    <?php } ?>
  </tr>
</table>
