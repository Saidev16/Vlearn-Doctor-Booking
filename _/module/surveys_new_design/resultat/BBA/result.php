<?php
include "../module/surveys/resultat/functions.php";
$id_sondage =$_GET['id'];
$niveau = $_GET['niveau'];
$sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage and `niveau`= \"$niveau\"";
$res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
$row_sondage=mysql_fetch_assoc($res_sondage);
$sondage_title = $row_sondage['titre_en'];
$id_session = $row_sondage['id_session'];
$sqlsession="select idSession, session, annee_academique from $tbl_session WHERE `idSession`= $id_session";
$res=@mysql_query($sqlsession) or die ('erreur de selection des sessions');
$row=mysql_fetch_assoc($res);
$idSession=$row['idSession'];
$session=$row['session'];
$annee=$row['annee_academique'];
//var_dump($sql_sondage);

// les profs
$sql_prof_affectation= "SELECT distinct a.`code_prof`
FROM
`tbl_sondage_affectation` as a ,
`tbl_professeur` as p
WHERE
a.`groupe` = 3 AND
a.`session` = \"$id_session\" AND
a.`code_prof` = p.`code_prof` AND
p.`archive`= 0  AND
a.`archive` = 0 AND
a.`campus` = 'e-learning'
";

//var_dump($sql_prof_affectation);
$req_prof_affectation = @mysql_query($sql_prof_affectation);
?>
<div class="row">
   <div class="col-lg-12">
    <div class="card-header" style="background-color: #fff !important;">
      <div class="row show-grid">
        <div class="col-md-8 col-xs-12 mt-2">
          <a href="?item=69" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Return</a>

        </div>
        <div class="col-md-4 col-xs-12 mt-2">
              <h3 class="text-right">Survey Results "BBA"</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="ribbon-wrapper card">
<div class="row">
<div class="ribbon ribbon-danger"><?php echo $sondage_title; ?></div>
  <p class="ribbon-content"></p>


  <div class="card-body">
    <div class="table-responsive">



<?php
$ttl_pr1 = 0;
$nb_pr1 = 0;
$ttl_pr2 = 0;
$nb_pr2 = 0;
$ttl_pr3 = 0;
$nb_pr3 = 0;
$ttl_pr4 = 0;
$nb_pr4 = 0;
$ttl_pr5 = 0;
$nb_pr5 = 0;
$nb_prof = 0;

while ($row_prof_affectation = mysql_fetch_array($req_prof_affectation)){

  $code_prof = $row_prof_affectation['code_prof'];
  $sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\" and archive=0";
  $req_prof = @mysql_query($sql_prof);
  $row_prof = mysql_fetch_assoc($req_prof);
  $nom_prof = $row_prof['nom_prenom'];

  $sql_nb_cour = "SELECT COUNT(distinct(a.id)) FROM `tbl_sondage_affectation` as a , tbl_resultat_sondage as r
  WHERE
  a.`groupe` = 3 AND
  a.`session` = \"$id_session\" AND
  a.`archive` = 0 AND
  a.id = r.id_affectation AND
  a.`code_prof` = \"$code_prof\" AND
  a.`campus` = 'e-learning'";
  //var_dump($sql_nb_cour);
  $req_nb_cour = @mysql_query($sql_nb_cour);
  $row_nb_cour = mysql_fetch_array($req_nb_cour);
  $nb_cours = $row_nb_cour['0'];
  //var_dump($nb_cours);
  //
  $sql_cour_affectation= "SELECT distinct(r.id_affectation), a.* FROM `tbl_sondage_affectation` as a, tbl_resultat_sondage as r WHERE
  a.`groupe` = 3 AND
  a.`session` = \"$id_session\" AND
  a.`code_prof` = \"$code_prof\" AND
  a.`archive` = 0 AND
  a.`campus` = 'e-learning' AND a.id = r.id_affectation";
  // var_dump($sql_cour_affectation);
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


    //
    $sql_cour = "SELECT * FROM `tbl_cours` WHERE `code_cours` = \"$code_cour\"";
    $req_cour = @mysql_query($sql_cour);
    $row_cour = mysql_fetch_assoc($req_cour);
    $cour = $row_cour['titre'];
    $cour_eng = $row_cour['titre_eng'];
    $id_affectation = $row_cour_affectation['id'];
    $sql_nb_etudiant = "SELECT  COUNT( Distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_etudiant` as e WHERE   `id_affectation` = \"$id_affectation\" and `id_sondage` in (\"$id_sondage\",2,7) and r.`code_etudiant` = e.`code_inscription`";
    //var_dump($sql_nb_etudiant);
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
    $sql_nb_etudiant_cour = "SELECT count(*) FROM `tbl_note_piimt`as n , `tbl_etudiant`as e , `tbl_inscription_cours_piimt` as i WHERE
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

    //Satisfaction Curriculm

    $id_question = '9,22,21,19,18,17,13';
    $porcentage = get_global_result_By_questions($id_question,$id_affectation);
    $porcentage1 = $porcentage1 + $porcentage;


    //Faculty

    $id_question = '1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31';
    $porcentage = get_global_result_By_questions($id_question,$id_affectation);
    $porcentage2 = $porcentage2 + $porcentage;

    //Administration

    $id_question = '10,29,28';
    $porcentage = get_global_result_By_questions($id_question,$id_affectation);
    $porcentage3 = $porcentage3 + $porcentage;

    //Library

    $id_question = '12,14,10';
    $porcentage = get_global_result_By_questions($id_question,$id_affectation);
    $porcentage4 = $porcentage4 + $porcentage;

    //Campus Tools

    $id_question = '11,32,30';
    $porcentage = get_global_result_By_questions($id_question,$id_affectation);
    $porcentage5 = $porcentage5 + $porcentage;



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

  $div = 0;

  if ($porcentage1 != 0) {
    $div++;
    $nb_pr1++;
  }
  if ($porcentage2 != 0) {
    $div++;
    $nb_pr2++;
  }
  if ($porcentage3 != 0) {
    $div++;
    $nb_pr3++;
  }
  if ($porcentage4 != 0) {
    $div++;
    $nb_pr4++;
  }
  if ($porcentage5 != 0) {
    $div++;
    $nb_pr5++;
  }

  $overall = ($porcentage1+$porcentage2+$porcentage3+$porcentage4+$porcentage5)/$div;


  // class chart color
  $class_chart = "";

  ?>

  <?php if ($nb_cours != 0):
    $nb_prof = $nb_prof+1;
    ?>

        <table class="table color-table primary-table">
            <thead>
              <tr>
                <th colspan="6"><?php echo ucwords($nom_prof); ?>
                  <a class="text-primary card-title" href="?item=<?php echo $_GET['item']; ?>&resultSBP&id=<?php echo $id_sondage; ?>&code_prof=<?php echo $code_prof; ?>">
                    <span class="label label-rounded label-success" style="float: right;font-size: 15px">
                      <i class="ti-arrow-right"></i>
                    </span>
                    <span class="badge badge-success" style="float: right;margin-top: 2px;"><?php echo $nb_cours; if ($nb_cours == 1) {echo "  Course";}else{echo "  Courses";} ?>
                  </span>

                  </a>
                  <p class="btn btn-success btn-xs" style="display: none;"><?php echo ucwords($nom_prof); ?> <span class="badge badge-success" style="float: right;"><?php echo $nb_cours; if ($nb_cours == 1) {echo "  Course";}else{echo "  Courses";} ?></span>

                  </p>
                </th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="text-align:center;" >Satisfaction Curriculm</th>
                    <th style="text-align:center;" >Faculty</th>
                    <th style="text-align:center;" >Administration</th>
                    <th style="text-align:center;" >Library</th>
                    <th style="text-align:center;" >Campus Tools</th>
                    <th style="text-align:center;" >Overall</th>
                </tr>
            </tbody>
            <tbody>
              <tr>
                <td style="text-align:center;">
                  <div class="mb-30">
                      <?php
                        if ($porcentage1 <= 40) {
                          $class_chart = "easy-pie-chart-40";
                        }
                        if ($porcentage1 <= 70 && $porcentage1 > 40) {
                          $class_chart = "easy-pie-chart-70";
                        }
                        if ($porcentage1 <= 100 && $porcentage1 > 70) {
                          $class_chart = "easy-pie-chart-100";
                        }
                      ?>
                      <div class="chart <?php echo $class_chart; ?>" data-percent="<?php echo round($porcentage1) ?>"> <span class="percent"><?php echo round($porcentage1) ?></span> </div>
                  </div>
                </td>
                <td style="text-align:center;">
                  <div class="mb-30">
                    <?php
                      if ($porcentage2 <= 40) {
                        $class_chart = "easy-pie-chart-40";
                      }
                      if ($porcentage2 <= 70 && $porcentage2 > 40) {
                        $class_chart = "easy-pie-chart-70";
                      }
                      if ($porcentage2 <= 100 && $porcentage2 > 70) {
                        $class_chart = "easy-pie-chart-100";
                      }
                    ?>
                      <div class="chart <?php echo $class_chart; ?>" data-percent="<?php echo round($porcentage2) ?>"> <span class="percent"><?php echo round($porcentage2) ?></span> </div>
                  </div>
                </td>
                <td style="text-align:center;">
                  <div class="mb-30">
                    <?php
                      if ($porcentage3 <= 40) {
                        $class_chart = "easy-pie-chart-40";
                      }
                      if ($porcentage3 <= 70 && $porcentage3 > 40) {
                        $class_chart = "easy-pie-chart-70";
                      }
                      if ($porcentage3 <= 100 && $porcentage3 > 70) {
                        $class_chart = "easy-pie-chart-100";
                      }
                    ?>
                      <div class="chart <?php echo $class_chart; ?>" data-percent="<?php echo round($porcentage3) ?>"> <span class="percent"><?php echo round($porcentage3) ?></span> </div>
                  </div>
                </td>
                <td style="text-align:center;">
                  <div class="mb-30">
                    <?php
                      if ($porcentage4 <= 40) {
                        $class_chart = "easy-pie-chart-40";
                      }
                      if ($porcentage4 <= 70 && $porcentage4 > 40) {
                        $class_chart = "easy-pie-chart-70";
                      }
                      if ($porcentage4 <= 100 && $porcentage4 > 70) {
                        $class_chart = "easy-pie-chart-100";
                      }
                    ?>
                      <div class="chart <?php echo $class_chart; ?>" data-percent="<?php echo round($porcentage4) ?>"> <span class="percent"><?php echo round($porcentage4) ?></span> </div>
                  </div>
                </td>
                <td style="text-align:center;">
                  <div class="mb-30">
                    <?php
                      if ($porcentage5 <= 40) {
                        $class_chart = "easy-pie-chart-40";
                      }
                      if ($porcentage5 <= 70 && $porcentage5 > 40) {
                        $class_chart = "easy-pie-chart-70";
                      }
                      if ($porcentage5 <= 100 && $porcentage5 > 70) {
                        $class_chart = "easy-pie-chart-100";
                      }
                    ?>
                      <div class="chart <?php echo $class_chart; ?>" data-percent="<?php echo round($porcentage5) ?>"> <span class="percent"><?php echo round($porcentage5) ?></span> </div>
                  </div>
                </td>
                <td style="text-align:center;">
                  <div class="mb-30">
                    <?php
                      if ($overall <= 40) {
                        $class_chart = "easy-pie-chart-40";
                      }
                      if ($overall <= 70 && $overall > 40) {
                        $class_chart = "easy-pie-chart-70";
                      }
                      if ($overall <= 100 && $overall > 70) {
                        $class_chart = "easy-pie-chart-100";
                      }
                    ?>
                      <div class="chart <?php echo $class_chart; ?>" data-percent="<?php echo round($overall) ?>"> <span class="percent"><?php echo round($overall) ?></span> </div>
                  </div>
                </td>
              </tr>

        </tbody>
      </table>

    <?php endif ?>
    <?php
  }
  $ttl_pr1 = $ttl_pr1/$nb_pr1;
  $ttl_pr2 = $ttl_pr2/$nb_pr2;
  $ttl_pr3 = $ttl_pr3/$nb_pr3;
  $ttl_pr4 = $ttl_pr4/$nb_pr4;
  $ttl_pr5 = $ttl_pr5/$nb_pr5;
  $div = 0;
  if ($ttl_pr1 != 0) {
    $div++;
  }
  if ($ttl_pr2 != 0) {
    $div++;
  }
  if ($ttl_pr3 != 0) {
    $div++;
  }
  if ($ttl_pr4 != 0) {
    $div++;
  }
  if ($ttl_pr5 != 0) {
    $div++;
  }

  ?>
</div>
</div>
