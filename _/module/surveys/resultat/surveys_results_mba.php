<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp; MBA SURVEYS
      &nbsp;&nbsp;<span class="task"></span>
    </td>
    <td width="22%">&nbsp;</td>
  </tr>
</table>
<div class="row">
  <!-- <div class="col-md-12" style="float:right;padding: 16px;">
  <a href="Surveys.php?list_sondage" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">les sondages</a>
  <a href="Surveys.php?list_affectation" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs"> Les affectations</a>
  <a href="Surveys.php?list_question" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Les quéstions</a>
  <a href="Surveys.php?response_list" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Les réponses</a>
  <a href="Surveys.php?resultat_etudiant&id=<?php echo $_GET['id']; ?>" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Les étudiants</a>
</div> -->
</div>

<style type="text/css">
@media print {
  a {
    display: none !important;
  }
  .p {
    display: block !important;
  }
}
</style>
<div class="row">
<?php if (isset($_GET['surveys_results_mba']) && isset($_GET['id'])): ?>

    <?php if (isset($_GET['code_prof']) && isset($_GET['annee']) && isset($_GET['periode'])){ ?>
      <?php
      $id_sondage =2;
      $code_prof = $_GET['code_prof'];
      $periode = $_GET['periode'];
      $annee_per = $_GET['annee'];
      $sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage";
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
      $sql_cour_affectation= "SELECT a.* FROM `tbl_sondage_affectation` as a , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE a.`groupe` = 3 and a.`niveau` = \"mba\" and a.`code_prof` = $code_prof  and a.`annee` = \"$annee_per\" and a.`periode` = \"$periode\" AND a.`archive` = 0 and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription` and a.code_cours not in('SEM_555','SEM555','SEM 555') group by a.id";
//      var_dump($sql_cour_affectation);
//      die();
      $req_cour_affectation = @mysql_query($sql_cour_affectation);
      $sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\"";
      $req_prof = @mysql_query($sql_prof);
      $row_prof = mysql_fetch_assoc($req_prof);
      $nom_prof = $row_prof['nom_prenom'];
      // les etudiants

      $sql_nb_etudiant_r = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_sondage_affectation` as a ,`tbl_resultat_sondage` as r , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE a.`annee` = \"$annee_per\" and a.`periode` = \"$periode\" and a.`id` = r.`id_affectation` and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
      //var_dump($sql_nb_etudiant_r);
      $req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
      $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
      $sql_nb_etudiant_tt = "SELECT count(distinct `code_inscription`) FROM `tbl_note_piimt` WHERE `idSession` = $id_session and `archive` = 0";
      $req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
      $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
      $nb_etudiant_r = $row_nb_etudiant_r['0'];
      $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
      ?>
      <h1 class="text-info"><?php //echo $sondage_title; ?></h1>
      <h2 class="text-info">MBA Session: <?php  echo $periode.' '.$annee_per; ?></h2>
      <h3 class="text-info"><?php echo ucwords($nom_prof); ?></h3>
      <div class="row">
        <div class=" col-sm-offset-2 col-md-8">
          <?php

          while ($row_cour_affectation = mysql_fetch_array($req_cour_affectation)){
            $code_cour = $row_cour_affectation['code_cours'];
            $type = $row_cour_affectation['type'];
            $campus = $row_cour_affectation['campus'];
            $groupe = $row_cour_affectation['groupe'];
            $sql_cour = "SELECT * FROM `tbl_cours` WHERE `code_cours_psi` = \"$code_cour\"";
            $req_cour = @mysql_query($sql_cour);
            $row_cour = mysql_fetch_assoc($req_cour);
            $cour = $row_cour['titre'];
            $cour_eng = $row_cour['titre_eng'];
            $id_affectation = $row_cour_affectation['id'];
            $sql_nb_etudiant = "SELECT  COUNT( Distinct `code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE   r.`id_affectation` = \"$id_affectation\" AND r.`id_sondage` = \"$id_sondage\" and e.`code_inscription` = et.`code_inscription`";
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

            ?>
            <div style="text-align:left;" class="panel-group" id="accordion-test">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title text-info">
                    <a style="font-size: 12px;" class="collapsed" href="?surveys_results_mba&id=<?php echo $id_sondage; ?>&affectation=<?php echo $id_affectation; ?>">
                      <?php echo $code_cour." : "; ?>
                      <?php if ($groupe == 3) {echo $cour_eng;} ?>
                      <span class="badge badge-success" style="float: right;">

                        <i class="entypo-plus-circled"></i></span>
                      </a>
                      <p class="p" style="display: none;"><?php echo $code_cour." : "; ?>
                        <?php if ($groupe == 3) {echo $cour_eng;} ?></p>
                      </h4>
                    </div>
                    <?php

                    $nb_q_ver = 0;
                    $sql_resultat = "SELECT Distinct `code_etudiant` FROM `tbl_resultat_sondage` as r , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE   r.`id_affectation` = \"$id_affectation\" AND r.`id_sondage` = \"$id_sondage\" and e.`code_inscription` = et.`code_inscription`";
                    //var_dump($sql_resultat);
                    $req_resultat = @mysql_query($sql_resultat);
                    $very_sat = 0;
                    $sat = 0;
                    $slightly_sat = 0;
                    $unsatisfied = 0;
                    $ttl_etudiant = 0;

                    $sql_new = "SELECT r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage,count(r.`id_reponse`) as nb_porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription`group by rep.`porcentage`";
                    //var_dump($sql_new);
                    $req_new = @mysql_query($sql_new);

                    while ($row_new = mysql_fetch_array($req_new)) {
                      if ($row_new['porcentage'] == 100) {
                        $very_sat = $row_new['nb_porcentage'];
                        $ttl_etudiant = $ttl_etudiant + $very_sat;
                      }
                      if ($row_new['porcentage'] == 90) {
                        $sat = $row_new['nb_porcentage'];
                        $ttl_etudiant = $ttl_etudiant + $sat;
                      }
                      if ($row_new['porcentage'] == 80) {
                        $slightly_sat = $row_new['nb_porcentage'];
                        $ttl_etudiant = $ttl_etudiant + $slightly_sat;
                      }
                      if ($row_new['porcentage'] == 70) {
                        $unsatisfied = $row_new['nb_porcentage'];
                        $ttl_etudiant = $ttl_etudiant + $unsatisfied;
                      }

                    }
                    // Q9
                    $ttl_etudiant = 0;
                    $satisfaction = 0;
                    $porcentage1 = 0;
                    $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription` and r.id_question in (9,22,21,19,18,17,13) group by rep.`porcentage`,`code_etudiant`,`id_question`";
                    //var_dump($sql_new);
                    $req_new = @mysql_query($sql_new);
                    while ($row_new = mysql_fetch_array($req_new)) {
                      $satisfaction = $satisfaction + $row_new['porcentage'];
                      $ttl_etudiant++;
                    }
                    $porcentage1 = $satisfaction/$ttl_etudiant;
                    //echo "$satisfaction/$ttl_etudiant";

                    // Q1 --> Q8
                    $very_sat = 0;
                    $sat = 0;
                    $slightly_sat = 0;
                    $unsatisfied = 0;
                    $ttl_etudiant = 0;
                    $porcentage2 = 0;
                    $cl = 0;
                    $nb_q = 0;

                    // calcule
                    $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,r.code_etudiant,r.`id_question`, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription` and r.id_question in (1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31) group by rep.`porcentage` , r.`id_question`, r.`code_etudiant` order by `id_question`
                    	";
                    //var_dump($sql_new);
                    $req_new = @mysql_query($sql_new);
                    $satisfaction = 0;
                    while ($row_new = mysql_fetch_array($req_new)) {
                      $satisfaction = $satisfaction + $row_new['porcentage'];
                      $ttl_etudiant++;
                    }
                    $porcentage2 = $satisfaction/$ttl_etudiant;
                    // Q10
                    $ttl_etudiant = 0;
                    $satisfaction = 0;
                    $porcentage3 = 0;
                    $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription` and r.id_question in (10,29,28) group by rep.`porcentage`,`code_etudiant`,`id_question`";
                    //var_dump($sql_new);
                    $req_new = @mysql_query($sql_new);
                    while ($row_new = mysql_fetch_array($req_new)) {
                      $satisfaction = $satisfaction + $row_new['porcentage'];
                      $ttl_etudiant++;
                    }
                    $porcentage3 = $satisfaction/$ttl_etudiant;
                    // Q12
                    $ttl_etudiant = 0;
                    $satisfaction = 0;
                    $porcentage4 = 0;
                    $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription` and r.id_question in (12,14,10) group by rep.`porcentage`,`code_etudiant`,`id_question`";
                    //var_dump($sql_new);
                    $req_new = @mysql_query($sql_new);
                    while ($row_new = mysql_fetch_array($req_new)) {
                      $satisfaction = $satisfaction + $row_new['porcentage'];
                      $ttl_etudiant++;
                    }
                    $porcentage4 = $satisfaction/$ttl_etudiant;
                    // Q11
                    $ttl_etudiant = 0;
                    $satisfaction = 0;
                    $porcentage5 = 0;
                    $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription` and r.id_question in (11,32,30) group by rep.`porcentage`,`code_etudiant`,`id_question`";
                    //var_dump($sql_new);
                    $req_new = @mysql_query($sql_new);
                    while ($row_new = mysql_fetch_array($req_new)) {
                      $satisfaction = $satisfaction + $row_new['porcentage'];
                      $ttl_etudiant++;
                    }
                    $porcentage5 = $satisfaction/$ttl_etudiant;


                    ?>
                    <div class="panel-body with-table">
                      <table class="table table-bordered table-responsive">
                        <tbody>
                          <tr>
                            <td>Satisfaction Curriculum </td>
                            <td>
                              <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage1)." %"; ?></div>
                              <div class="col-md-10" style="width:300px; float:left;">
                                <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                                if($porcentage1<=20){
                                  echo "progress-bar-danger.png";
                                }elseif($porcentage1>20 && $porcentage1<50){
                                  echo "progress-bar-warning.png";
                                }else{
                                  echo "progress-bar-success.png";
                                }
                                ?>" style=" position: absolute;
                                width: <?php if ($porcentage1 == 0) {
                                  echo "0%";
                                }else{
                                  echo $porcentage1."%";
                                }
                                ?>;
                                height: 17px;
                                ">
                                <img src="./../../css/stu-prof/sous-bar.png" style="">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> Faculty </td>
                          <td>
                            <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage2)." %"; ?></div>
                            <div class="col-md-10" style="width:300px; float:left;">
                              <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                              if($porcentage2<=20){
                                echo "progress-bar-danger.png";
                              }elseif($porcentage2>20 && $porcentage2<50){
                                echo "progress-bar-warning.png";
                              }else{
                                echo "progress-bar-success.png";
                              }
                              ?>" style=" position: absolute;
                              width: <?php if ($porcentage2 == 0) {
                                echo "0%";
                              }else{
                                echo $porcentage2."%";
                              } ?>;
                              height: 17px;
                              ">
                              <img src="./../../css/stu-prof/sous-bar.png" style="">
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td> Administration </td>
                        <td>
                          <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage3)." %"; ?></div>
                          <div class="col-md-10" style="width:300px; float:left;">
                            <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                            if($porcentage3<=20){
                              echo "progress-bar-danger.png";
                            }elseif($porcentage3>20 && $porcentage3<50){
                              echo "progress-bar-warning.png";
                            }else{
                              echo "progress-bar-success.png";
                            }
                            ?>" style=" position: absolute;
                            width: <?php if ($porcentage3 == 0) {
                              echo "0%";
                            }else{
                              echo $porcentage3."%";
                            } ?>;
                            height: 17px;
                            ">
                            <img src="./../../css/stu-prof/sous-bar.png" style="">
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td> Library </td>
                      <td>
                        <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage4)." %"; ?></div>
                        <div class="col-md-10" style="width:300px; float:left;">
                          <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                          if($porcentage4<=20){
                            echo "progress-bar-danger.png";
                          }elseif($porcentage4>20 && $porcentage4<50){
                            echo "progress-bar-warning.png";
                          }else{
                            echo "progress-bar-success.png";
                          }
                          ?>" style=" position: absolute;
                          width: <?php if ($porcentage4 == 0) {
                            echo "0%";
                          }else{
                            echo $porcentage4."%";
                          } ?>;
                          height: 17px;
                          ">
                          <img src="./../../css/stu-prof/sous-bar.png" style="">
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td> Campus Tools </td>
                    <td>
                      <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage5)." %"; ?></div>
                      <div class="col-md-10" style="width:300px; float:left;">
                        <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                        if($porcentage5<=20){
                          echo "progress-bar-danger.png";
                        }elseif($porcentage5>20 && $porcentage5<50){
                          echo "progress-bar-warning.png";
                        }else{
                          echo "progress-bar-success.png";
                        }
                        ?>" style=" position: absolute;
                        width: <?php if ($porcentage5 == 0) {
                          echo "0%";
                        }else{
                          echo $porcentage5."%";
                        } ?>;
                        height: 17px;
                        ">
                        <img src="./../../css/stu-prof/sous-bar.png" style="">
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
      <?php
    }
    ?>
    </div>

  </div>
<?php }elseif (isset($_GET['affectation'])){ ?>
  <?php

  $id_sondage =2;
  $id_affectation = $_GET['affectation'];
  $sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage";
  //var_dump($sql_sondage);
  $res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
  $row_sondage=mysql_fetch_assoc($res_sondage);
  $sondage_title = $row_sondage['titre_eng'];
  //var_dump($sondage_title);
  $id_session = $row_sondage['id_session'];
  $sqlsession="select idSession, session, annee_academique from $tbl_session WHERE `idSession`= $id_session";
  $res=@mysql_query($sqlsession) or die ('erreur de selection des sessions');
  $row=mysql_fetch_assoc($res);
  $idSession=$row['idSession'];
  $session=$row['session'];
  $annee=$row['annee_academique'];
  $sql_affectation= "SELECT a.* FROM `tbl_sondage_affectation` as a WHERE a.`groupe` = 3 and  a.`id` = \"$id_affectation\" ";
  $req_affectation = @mysql_query($sql_affectation);
  $row_affectation = mysql_fetch_assoc($req_affectation);
  $code_prof = $row_affectation['code_prof'];
  $groupe = $row_affectation['groupe'];
  $code_cour = $row_affectation['code_cours'];
  $type = $row_affectation['type'];
  $sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\"";
  $req_prof = @mysql_query($sql_prof);
  $row_prof = mysql_fetch_assoc($req_prof);
  $nom_prof = $row_prof['nom_prenom'];
  $sql_cour = "SELECT * FROM `tbl_cours` WHERE `code_cours_psi` = \"$code_cour\"";

  $req_cour = @mysql_query($sql_cour);
  $row_cour = mysql_fetch_assoc($req_cour);
  $cour = $row_cour['titre'];
  $cour_eng = $row_cour['titre_eng'];
  //nombre d'etudiant
  if ($type == 0) {
    $type_cours_id = 1;
  }
  if ($type == 1) {
    $type_cours_id = 6;
  }
  $sql_etudiant_inscrit = "SELECT count(*) FROM `tbl_note_piimt` WHERE `code_cours` = \"$code_cour\" and  `idSession` = $id_session AND `type_cours_id` = $type_cours_id";
  $req_etudiant_inscrit = @mysql_query($sql_etudiant_inscrit);
  $row_etudiant_inscrit = mysql_fetch_array($req_etudiant_inscrit);
  $nb_etudiant_inscrit = $row_etudiant_inscrit['0'];
  $req_etudiant_inscrit = @mysql_query($sql_etudiant_inscrit);
  $row_etudiant_inscrit = mysql_fetch_array($req_etudiant_inscrit);
  $nb_etudiant_surveys = $row_etudiant_inscrit['0'];
  $sql_etudiant_inscrit = "SELECT count(distinct code_etudiant) FROM `tbl_resultat_sondage` as r , `tbl_aff_etudiant` as e , `tbl_etudiant` as et   WHERE r.`id_affectation` = $id_affectation and r.`id_affectation` = e.`id_affectation` and e.`code_inscription` = et.`code_inscription`";
  //var_dump($sql_etudiant_inscrit);
  $req_etudiant_inscrit = @mysql_query($sql_etudiant_inscrit);
  $row_etudiant_inscrit = mysql_fetch_array($req_etudiant_inscrit);
  $nb_etudiant_inscrit = $row_etudiant_inscrit['0'];
  ?>

  <div class="tile-progress tile-green">
    <div class="tile-header">
      <h3><?php echo ucwords($nom_prof); ?></h3>
      <h3>
        <?php if ($groupe == 2): ?>
          <?php echo $cour; ?>
        <?php endif ?>
        <?php if ($groupe == 3): ?>
          <?php echo $cour_eng; ?>
        <?php endif ?>
      </h3>
      <span><?php echo $sondage_title; ?>  Session <?php  echo $row_affectation['periode'].' '.$row_affectation['annee']; ?></span>

    </div>
  </div>
  <?php
  $sql_question= "SELECT * FROM `tbl_questions`";
  $req_question = @mysql_query($sql_question);
  while ($row_question = mysql_fetch_array($req_question)) {
    $id_question = $row_question['id'];
    $sql_question_existe= "SELECT count(*) FROM `tbl_resultat_sondage` as r , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE r.`id_affectation` = $id_affectation AND `id_sondage` = $id_sondage AND
    `id_question` = $id_question and r.`id_affectation` = e.`id_affectation` and e.`code_inscription` = et.`code_inscription`";
    //var_dump($sql_question_existe);
    $req_question_existe = @mysql_query($sql_question_existe);
    $row_question_existe = mysql_fetch_array($req_question_existe);
    $nb_question = $row_question_existe['0'];
    if ($nb_question != 0) { ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title" style="text-align: center;width: 100%;">
            <h4 class="text-success">
              <?php echo $row_question['question_en']; ?>
            </h4>
          </div>

        </div>
        <div class="panel-body with-table">
          <table class="table table-bordered table-responsive">
            <thead>
              <tr class="col-md-12">
                <th class="col-md-3" style="text-align: center;">Response</th>
                <th class="col-md-7" style="text-align: center;"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $rep_porcentage = 0;
              $sql_reponse= "SELECT * FROM `tbl_reponse` WHERE `question_id` =$id_question";
              //var_dump($sql_reponse);

              $req_reponse = @mysql_query($sql_reponse);
              while ($row_reponse = mysql_fetch_array($req_reponse)) {  ?>
                <tr>
                  <td>
                    <?php if ($groupe == 2): ?>
                      <?php echo $row_reponse['reponse_en']; ?>
                    <?php endif ?>
                    <?php if ($groupe == 3): ?>
                      <?php echo $row_reponse['reponse_en']; ?>
                    <?php endif ?>
                  </td>
                  <?php
                  $id_reponse = $row_reponse['id'];
                  $sql_nb_etudiants = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_aff_etudiant` as e , `tbl_etudiant` as et WHERE r.`id_affectation` = $id_affectation AND `id_sondage` = $id_sondage AND `id_question` = $id_question AND `id_reponse` = $id_reponse and r.`id_affectation` = e.`id_affectation` and e.`code_inscription` = et.`code_inscription`";

                  //var_dump($sql_nb_etudiants);
                  $req_nb_etudiants = @mysql_query($sql_nb_etudiants);
                  $row_nb_etudiants = mysql_fetch_array($req_nb_etudiants);
                  $nb_etudiant = $row_nb_etudiants['0'];
                  ?>
                  <td>
                    <?php
                    $porcentage = ($nb_etudiant/$nb_etudiant_inscrit)*100;
                    $porcentage = round($porcentage,1);
                    ?>
                    <div class="col-md-10" style="width:300px; float:left;">
                      <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                      if($porcentage<=20){
                        echo "progress-bar-danger.png";
                      }elseif($porcentage>20 && $porcentage<50){
                        echo "progress-bar-warning.png";
                      }else{
                        echo "progress-bar-success.png";
                      }
                      ?>" style=" position: absolute;
                      width: <?php echo $porcentage; ?>%;
                      height: 17px;
                      ">
                      <img src="./../../css/stu-prof/sous-bar.png" style="">
                    </div>
                  </div>

                </td>
              </tr>
              <?php
              $rep_porcentage = $rep_porcentage + ($nb_etudiant * $row_reponse['porcentage']);
            }
            ?>
            <!-- <tr>
            <td>total satisfaction </td>
            <td><?php echo $rep_porcentage/$nb_etudiant_inscrit; ?></td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>
  <?php
}
}
?>
<?php }elseif (isset($_GET['annee']) && isset($_GET['periode'])) { ?>
  <?php
  $periode = $_GET['periode'];
  $annee = $_GET['annee'];
  $sql_prof_affectation= "SELECT DISTINCT a.`code_prof` FROM `tbl_sondage_affectation` as a ,`tbl_professeur` as p , `tbl_aff_etudiant` as e , `tbl_etudiant` as et   WHERE a.`groupe` = 3 and a.`niveau` = \"mba\" and a.`annee` = $annee and `periode` = \"$periode\" AND a.`archive` = 0 and a.code_prof = p.code_prof and p.archive = 0 and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription` ";
  //var_dump($sql_prof_affectation);
  $req_prof_affectation = @mysql_query($sql_prof_affectation);
  // les etudiants

  $sql_nb_etudiant_r = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_sondage_affectation` as a ,`tbl_resultat_sondage` as r  ,`tbl_professeur` as p , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE a.`annee` = \"$annee\" and a.`periode` = \"$periode\" and a.`id` = r.`id_affectation` and a.`groupe` = 3 and a.code_prof = p.code_prof and p.archive = 0 and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
  //var_dump($sql_nb_etudiant_r);
  $req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
  $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
  $sql_nb_etudiant_tt = "SELECT count(*) FROM `tbl_sondage_affectation` as a , `tbl_aff_etudiant` as e ,`tbl_professeur` as p , `tbl_etudiant` as et  WHERE a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\"  and a.`id` = e.`id_affectation` and a.`groupe` = 3 and a.code_prof = p.code_prof and p.archive = 0 and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
  //var_dump($sql_nb_etudiant_tt);
  $req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
  $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
  $nb_etudiant_r = $row_nb_etudiant_r['0'];
  $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
  ?>
  <h2 class="text-info">Session <?php  echo $periode.' '.$annee; ?></h2>

  <div class="row">
    <div class=" col-sm-offset-2 col-md-8">
      <?php
      while ($row_prof_affectation = mysql_fetch_array($req_prof_affectation)){
        $code_prof = $row_prof_affectation['code_prof'];
        $sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\"";
        $req_prof = @mysql_query($sql_prof);
        $row_prof = mysql_fetch_assoc($req_prof);
        $nom_prof = $row_prof['nom_prenom'];
        $sql_nb_cour = "SELECT COUNT(distinct(a.id)) FROM `tbl_sondage_affectation` as a , `tbl_aff_etudiant` as e , `tbl_etudiant` as et WHERE a.`groupe` = 3 and  a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\" AND a.`archive` = 0 AND a.`code_prof` = \"$code_prof\" and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription` and a.code_cours not in ('SEM_555','SEM 555')";
        //var_dump($sql_nb_cour);
        $req_nb_cour = @mysql_query($sql_nb_cour);
        $row_nb_cour = mysql_fetch_array($req_nb_cour);
        $nb_cours = $row_nb_cour['0'];
        // Q9
        $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
        `tbl_resultat_sondage` as r ,
        `tbl_reponse` as rep , `tbl_etudiant` as et WHERE
        r.id_affectation in (SELECT distinct(a.id) FROM `tbl_sondage_affectation` as a WHERE a.`groupe` = 3 and  a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\" AND a.`archive` = 0 AND a.`code_prof` = \"$code_prof\" and a.`type` = 1 and a.code_cours not in ('SEM_555','SEM 555')) and r.`id_reponse` = rep.`id`and
        r.id_question in (9,22,21,19,18,17,13) and
        r.`code_etudiant` = et.`code_inscription`
        group by rep.`porcentage`,`code_etudiant`,`id_question`";
        //var_dump($sql_new);
        //die();
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
        $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription` and r.id_question in (1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31)
        ";
        //var_dump($sql_new);
        $req_new = @mysql_query($sql_new);
        $row_new = mysql_fetch_array($req_new);

        // calcule
        $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
        `tbl_resultat_sondage` as r ,
        `tbl_reponse` as rep , `tbl_etudiant` as et WHERE
        r.id_affectation in (SELECT distinct(a.id) FROM `tbl_sondage_affectation` as a WHERE a.`groupe` = 3 and  a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\" AND a.`archive` = 0 AND a.`code_prof` = \"$code_prof\" and a.`type` = 1 and a.code_cours not in ('SEM_555','SEM 555')) and r.`id_reponse` = rep.`id`and
        r.id_question in (1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31) and
        r.`code_etudiant` = et.`code_inscription`
        group by rep.`porcentage`,`code_etudiant`,`id_question`";

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
        `tbl_resultat_sondage` as r ,
        `tbl_reponse` as rep , `tbl_etudiant` as et WHERE
        r.id_affectation in (SELECT distinct(a.id) FROM `tbl_sondage_affectation` as a WHERE a.`groupe` = 3 and  a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\" AND a.`archive` = 0 AND a.`code_prof` = \"$code_prof\" and a.`type` = 1 and a.code_cours not in ('SEM_555','SEM 555')) and r.`id_reponse` = rep.`id`and
        r.id_question in (10,29,28) and
        r.`code_etudiant` = et.`code_inscription`
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
        `tbl_resultat_sondage` as r ,
        `tbl_reponse` as rep , `tbl_etudiant` as et WHERE
        r.id_affectation in (SELECT distinct(a.id) FROM `tbl_sondage_affectation` as a WHERE a.`groupe` = 3 and  a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\" AND a.`archive` = 0 AND a.`code_prof` = \"$code_prof\" and a.`type` = 1 and a.code_cours not in ('SEM_555','SEM 555')) and r.`id_reponse` = rep.`id`and
        r.id_question in (12,14,10) and
        r.`code_etudiant` = et.`code_inscription`
        group by rep.`porcentage`,`code_etudiant`,`id_question`";
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
        `tbl_resultat_sondage` as r ,
        `tbl_reponse` as rep , `tbl_etudiant` as et WHERE
        r.id_affectation in (SELECT distinct(a.id) FROM `tbl_sondage_affectation` as a WHERE a.`groupe` = 3 and  a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\" AND a.`archive` = 0 AND a.`code_prof` = \"$code_prof\" and a.`type` = 1 and a.code_cours not in ('SEM_555','SEM 555')) and r.`id_reponse` = rep.`id`and
        r.id_question in (11,32,30) and
        r.`code_etudiant` = et.`code_inscription`
        group by rep.`porcentage`,`code_etudiant`,`id_question`";
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

        // overall

        $overall = ($porcentage1+$porcentage2+$porcentage3+$porcentage4+$porcentage5)/5;

        if ($nb_cours != 0) {


        ?>



        <div style="text-align:left;" class="panel-group" id="accordion-test">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title text-info">
                <a class="collapsed" href="?surveys_results_mba&id=<?php echo $id_sondage; ?>&
                  code_prof=<?php echo $code_prof; ?>&periode=<?php echo $periode; ?>&annee=<?php echo $annee; ?>">
                  <?php echo ucwords($nom_prof); ?> <span class="badge badge-success" style="float: right;"><?php echo $nb_cours; if ($nb_cours == 1) {echo "  course";}else{echo "  courses";} ?> <i class="entypo-plus-circled"></i></span>
                </a>
                <p class="p" style="display: none;"><?php echo ucwords($nom_prof); ?> <span class="badge badge-success" style="float: right;"><?php echo $nb_cours; if ($nb_cours == 1) {echo "  course";}else{echo "  courses";} ?> </p>

                </h4>
              </div>
            </div>
          </div>

          <div class="panel-body with-table">
            <table class="table table-bordered table-responsive">
              <thead>
                <tr  class="col-md-12">
                  <th colspan=2 class="col-md-12" style="text-align: center;">Satisfaction Rate</th>

                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: left;">Satisfaction Curriculum </td>
                  <td>
                    <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage1)." %"; ?></div>
                    <div class="col-md-10" style="width:300px; float:left;">
                      <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                      if($porcentage1<=20){
                        echo "progress-bar-danger.png";
                      }elseif($porcentage1>20 && $porcentage1<50){
                        echo "progress-bar-warning.png";
                      }else{
                        echo "progress-bar-success.png";
                      }
                      ?>" style=" position: absolute;
                      width: <?php if ($porcentage1 == 0) {
                        echo "0%";
                      }else{
                        echo $porcentage1."%";
                      }
                      ?>;
                      height: 17px;
                      ">
                      <img src="./../../css/stu-prof/sous-bar.png" style="">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="text-align: left;"> Faculty </td>
                <td>
                  <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage2)." %"; ?></div>
                  <div class="col-md-10" style="width:300px; float:left;">
                    <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                    if($porcentage2<=20){
                      echo "progress-bar-danger.png";
                    }elseif($porcentage2>20 && $porcentage2<50){
                      echo "progress-bar-warning.png";
                    }else{
                      echo "progress-bar-success.png";
                    }
                    ?>" style=" position: absolute;
                    width: <?php if ($porcentage2 == 0) {
                      echo "0%";
                    }else{
                      echo $porcentage2."%";
                    } ?>;
                    height: 17px;
                    ">
                    <img src="./../../css/stu-prof/sous-bar.png" style="">
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td style="text-align: left;"> Administration </td>
              <td>
                <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage3)." %"; ?></div>
                <div class="col-md-10" style="width:300px; float:left;">
                  <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                  if($porcentage3<=20){
                    echo "progress-bar-danger.png";
                  }elseif($porcentage3>20 && $porcentage3<50){
                    echo "progress-bar-warning.png";
                  }else{
                    echo "progress-bar-success.png";
                  }
                  ?>" style=" position: absolute;
                  width: <?php if ($porcentage3 == 0) {
                    echo "0%";
                  }else{
                    echo $porcentage3."%";
                  } ?>;
                  height: 17px;
                  ">
                  <img src="./../../css/stu-prof/sous-bar.png" style="">
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td style="text-align: left;"> Library </td>
            <td>
              <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage4)." %"; ?></div>
              <div class="col-md-10" style="width:300px; float:left;">
                <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                if($porcentage4<=20){
                  echo "progress-bar-danger.png";
                }elseif($porcentage4>20 && $porcentage4<50){
                  echo "progress-bar-warning.png";
                }else{
                  echo "progress-bar-success.png";
                }
                ?>" style=" position: absolute;
                width: <?php if ($porcentage4 == 0) {
                  echo "0%";
                }else{
                  echo $porcentage4."%";
                } ?>;
                height: 17px;
                ">
                <img src="./../../css/stu-prof/sous-bar.png" style="">
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td style="text-align: left;"> Campus Tools </td>
          <td>
            <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage5)." %"; ?></div>
            <div class="col-md-10" style="width:300px; float:left;">
              <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
              if($porcentage5<=20){
                echo "progress-bar-danger.png";
              }elseif($porcentage5>20 && $porcentage5<50){
                echo "progress-bar-warning.png";
              }else{
                echo "progress-bar-success.png";
              }
              ?>" style=" position: absolute;
              width: <?php if ($porcentage5 == 0) {
                echo "0%";
              }else{
                echo $porcentage5."%";
              } ?>;
              height: 17px;
              ">
              <img src="./../../css/stu-prof/sous-bar.png" style="">
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;"> Overall </td>
        <td>
          <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($overall)." %"; ?></div>
          <div class="col-md-10" style="width:300px; float:left;">
            <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
            if($overall<=20){
              echo "progress-bar-danger.png";
            }elseif($overall>20 && $overall<50){
              echo "progress-bar-warning.png";
            }else{
              echo "progress-bar-success.png";
            }
            ?>" style=" position: absolute;
            width: <?php if ($overall == 0) {
              echo "0%";
            }else{
              echo $overall."%";
            } ?>;
            height: 17px;
            ">
            <img src="./../../css/stu-prof/sous-bar.png" style="">
          </div>
        </div>
      </td>
    </tr>
  </tbody>
  </table>
  </div>
          <?php
          }
        }
        ?>

      </div>
    </div>
  <?php }else{ ?>
    <?php
    $id_sondage =2;
    //les informations du sondage
    $sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage ";
    $res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
    $row_sondage=mysql_fetch_assoc($res_sondage);
    //les periodes ou les sessions
    $sql_periode= "SELECT  `annee` , `periode` FROM  `tbl_sondage_affectation` WHERE `groupe` = 3 and `niveau` =  \"mba\" and `archive` = 0 and `type` = 1 GROUP BY  `annee` ,  `periode` order by `annee` DESC, `periode` DESC";

    //var_dump($sql_periode);
    $req_periode = @mysql_query($sql_periode);
    while ($row_periode = mysql_fetch_array($req_periode)) {
      $periode = $row_periode['periode'];
      $annee = $row_periode['annee'];
      // les satisfactions
      // le calcule des resultats
      // Q9
        //if ($periode == "fall" && $annee == 2019){
            
        
      $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
      `tbl_sondage_affectation` as a ,
      `tbl_resultat_sondage` as r ,
      `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et WHERE
      a.`groupe` = 3 and
      a.`niveau` = \"mba\" and
      a.`annee` = $annee and
      a.`periode` = \"$periode\" and
      a.`id` = r.`id_affectation` and
      r.`id_reponse` = rep.`id`and
      r.id_question in (9,22,21,19,18,17,13) and
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
      $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and e.`code_inscription` = et.`code_inscription` and r.id_question in (1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31)
      ";
      //var_dump($sql_new);
      $req_new = @mysql_query($sql_new);
      $row_new = mysql_fetch_array($req_new);

      // calcule
      $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
      `tbl_sondage_affectation` as a ,
      `tbl_resultat_sondage` as r ,
      `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et WHERE
      a.`groupe` = 3 and
      a.`niveau` = \"mba\" and
      a.`annee` = $annee and
      a.`periode` = \"$periode\" and
      a.`id` = r.`id_affectation` and
      r.`id_reponse` = rep.`id`and
      r.id_question in (1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31) and
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
      `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et WHERE
      a.`groupe` = 3 and
      a.`niveau` = \"mba\" and
      a.`annee` = $annee and
      a.`periode` = \"$periode\" and
      a.`id` = r.`id_affectation` and
      r.`id_reponse` = rep.`id`and
      r.id_question in (10,29,28) and
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
      `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et WHERE
      a.`groupe` = 3 and
      a.`niveau` = \"mba\" and
      a.`annee` = $annee and
      a.`periode` = \"$periode\" and
      a.`id` = r.`id_affectation` and
      r.`id_reponse` = rep.`id`and
      r.id_question in (12,14,10) and
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
      `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant` as et WHERE
      a.`groupe` = 3 and
      a.`niveau` = \"mba\" and
      a.`annee` = $annee and
      a.`periode` = \"$periode\" and
      a.`id` = r.`id_affectation` and
      r.`id_reponse` = rep.`id`and
      r.id_question in (11,32,30) and
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
      // overall
      $overall = ($porcentage1+$porcentage2+$porcentage3+$porcentage4+$porcentage5)/$div;
      // var_dump($overall);
        //}
      if ($overall != 0) {
        ?>
        <div class="panel-body with-table">
          <table class="table table-bordered table-responsive">
            <thead>
              <tr  class="col-md-12">
                <th colspan=2 class="col-md-12" style="text-align: left;color: black;font-weight: bold;">
                  Session - <?php echo ucfirst($periode)." ".$annee; ?>
                  <a href="Surveys.php?surveys_results_mba&annee=<?php echo $annee; ?>&periode=<?php echo $periode; ?>&id=<?php echo $id_sondage; ?>" class="btn btn-success" style="float: right;">
                    Surveys by Faculty <i class="entypo-check"></i>
                  </a>
                  <a href="Surveys.php?resultat_by_prof_mba&annee=<?php echo $annee; ?>&periode=<?php echo $periode; ?>&id=<?php echo $id_sondage; ?>"  style="color: #fff;" class="btn btn-success btn-xs">Export to excel</a>
                </th>
              </tr>

              <tr  class="col-md-12">
                <th colspan=2 class="col-md-12" style="text-align: center;">Satisfaction Rate</th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: left;">Satisfaction Curriculum </td>
                <td>
                  <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage1)." %"; ?></div>
                  <div class="col-md-10" style="width:300px; float:left;">
                    <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                    if($porcentage1<=20){
                      echo "progress-bar-danger.png";
                    }elseif($porcentage1>20 && $porcentage1<50){
                      echo "progress-bar-warning.png";
                    }else{
                      echo "progress-bar-success.png";
                    }
                    ?>" style=" position: absolute;
                    width: <?php if ($porcentage1 == 0) {
                      echo "0%";
                    }else{
                      echo $porcentage1."%";
                    }
                    ?>;
                    height: 17px;
                    ">
                    <img src="./../../css/stu-prof/sous-bar.png" style="">
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td style="text-align: left;"> Faculty </td>
              <td>
                <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage2)." %"; ?></div>
                <div class="col-md-10" style="width:300px; float:left;">
                  <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                  if($porcentage2<=20){
                    echo "progress-bar-danger.png";
                  }elseif($porcentage2>20 && $porcentage2<50){
                    echo "progress-bar-warning.png";
                  }else{
                    echo "progress-bar-success.png";
                  }
                  ?>" style=" position: absolute;
                  width: <?php if ($porcentage2 == 0) {
                    echo "0%";
                  }else{
                    echo $porcentage2."%";
                  } ?>;
                  height: 17px;
                  ">
                  <img src="./../../css/stu-prof/sous-bar.png" style="">
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td style="text-align: left;"> Administration </td>
            <td>
              <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage3)." %"; ?></div>
              <div class="col-md-10" style="width:300px; float:left;">
                <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
                if($porcentage3<=20){
                  echo "progress-bar-danger.png";
                }elseif($porcentage3>20 && $porcentage3<50){
                  echo "progress-bar-warning.png";
                }else{
                  echo "progress-bar-success.png";
                }
                ?>" style=" position: absolute;
                width: <?php if ($porcentage3 == 0) {
                  echo "0%";
                }else{
                  echo $porcentage3."%";
                } ?>;
                height: 17px;
                ">
                <img src="./../../css/stu-prof/sous-bar.png" style="">
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td style="text-align: left;"> Library </td>
          <td>
            <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage4)." %"; ?></div>
            <div class="col-md-10" style="width:300px; float:left;">
              <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
              if($porcentage4<=20){
                echo "progress-bar-danger.png";
              }elseif($porcentage4>20 && $porcentage4<50){
                echo "progress-bar-warning.png";
              }else{
                echo "progress-bar-success.png";
              }
              ?>" style=" position: absolute;
              width: <?php if ($porcentage4 == 0) {
                echo "0%";
              }else{
                echo $porcentage4."%";
              } ?>;
              height: 17px;
              ">
              <img src="./../../css/stu-prof/sous-bar.png" style="">
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;"> Campus Tools </td>
        <td>
          <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage5)." %"; ?></div>
          <div class="col-md-10" style="width:300px; float:left;">
            <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
            if($porcentage5<=20){
              echo "progress-bar-danger.png";
            }elseif($porcentage5>20 && $porcentage5<50){
              echo "progress-bar-warning.png";
            }else{
              echo "progress-bar-success.png";
            }
            ?>" style=" position: absolute;
            width: <?php if ($porcentage5 == 0) {
              echo "0%";
            }else{
              echo $porcentage5."%";
            } ?>;
            height: 17px;
            ">
            <img src="./../../css/stu-prof/sous-bar.png" style="">
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td style="text-align: left;"> Overall </td>
      <td>
        <div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($overall)." %"; ?></div>
        <div class="col-md-10" style="width:300px; float:left;">
          <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
          if($overall<=20){
            echo "progress-bar-danger.png";
          }elseif($overall>20 && $overall<50){
            echo "progress-bar-warning.png";
          }else{
            echo "progress-bar-success.png";
          }
          ?>" style=" position: absolute;
          width: <?php if ($overall == 0) {
            echo "0%";
          }else{
            echo $overall."%";
          } ?>;
          height: 17px;
          ">
          <img src="./../../css/stu-prof/sous-bar.png" style="">
        </div>
      </div>
    </td>
  </tr>
</tbody>
</table>
</div>
<?php
$ttl_very_sat_result = $ttl_very_sat_result+$ttl_very_sat;
$ttl_sat_result = $ttl_sat_result+$ttl_sat;
$ttl_slightly_sat_result = $ttl_slightly_sat_result+$ttl_slightly_sat;
$ttl_unsatisfied_result = $ttl_unsatisfied_result+$ttl_unsatisfied;
$ttl_etudiant_result = $ttl_etudiant_result+$ttl_etudiant;
}
}?>
<?php } ?>

<?php endif ?>

</div>
<?php
$_SESSION['message_error'] = "";
$_SESSION['message'] = "";
$_SESSION['message_success'] = "";
?>

<?php
$_SESSION['programme'] = '';
$_SESSION['session'] = '';
$_SESSION['annee'] = '';
$_SESSION['titre'] = '';
$_SESSION['code_inscription'] = '';
$_SESSION['message_file1'] = '';
$_SESSION['message_file2'] = '';
$_SESSION['message_file3'] = '';
$_SESSION['message_file'] = '';
$_SESSION['message_programme'] = '';
$_SESSION['message_titre'] = '';
$_SESSION['message_session'] = '';
$_SESSION['message_annee'] = '';
$_SESSION['message_success'] = '';
$_SESSION['message_etudiant'] = '';
$_SESSION['specialite'] = "";
?>
