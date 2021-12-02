<?php include "../module/surveys/resultat/functions.php"; ?>

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
  <div class="col-lg-12">
    <div class="card-header" style="background-color: #fff !important;">
      <div class="row show-grid">
        <div class="col-md-10 col-xs-12 mt-2">
          <a href="?item=<?php echo $_GET['item']; ?>" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Return</a>

        </div>
        <div class="col-md-2 col-xs-12">
             <h3 class="text-center">DBA Survey</h3>
    		</div>
      </div>
    </div>
  </div>
</div>

<?php if (isset($_GET['surveys_results_dba']) && isset($_GET['id'])): ?>

  <?php if (isset($_GET['code_prof']) && isset($_GET['annee']) && isset($_GET['periode'])){ ?>
    <?php
    $id_sondage =7;
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
    $sql_cour_affectation= "SELECT a.* FROM `tbl_sondage_affectation_dba` as a  WHERE a.`groupe` = 3 and a.`niveau` = \"dba\" and a.`code_prof` = $code_prof  and a.`annee` = \"$annee_per\" and a.`periode` = \"$periode\" AND a.`archive` = 0 and  a.`type` = 1 ";
    //var_dump($sql_cour_affectation);
    $req_cour_affectation = @mysql_query($sql_cour_affectation);
    $sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\"";
    $req_prof = @mysql_query($sql_prof);
    $row_prof = mysql_fetch_assoc($req_prof);
    $nom_prof = $row_prof['nom_prenom'];
    // les etudiants

    $sql_nb_etudiant_r = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_sondage_affectation_dba` as a ,`tbl_resultat_sondage` as r , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE a.`annee` = \"$annee_per\" and a.`periode` = \"$periode\" and a.`id` = r.`id_affectation` and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
    //var_dump($sql_nb_etudiant_r);
    $req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
    $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
    $sql_nb_etudiant_tt = "SELECT count(distinct `code_inscription`) FROM `tbl_note_piimt` WHERE `idSession` = $id_session and `archive` = 0";
    $req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
    $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
    $nb_etudiant_r = $row_nb_etudiant_r['0'];
    $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
    ?>

    <div class="ribbon-wrapper card">
        <div class="ribbon ribbon-danger">DBA Session: <?php  echo $periode.' '.$annee_per; ?></div>
        <p class="ribbon-content text-primary mt-10 ml-20 mb-20">
          <?php echo ucwords($nom_prof); ?>
        </p>
        <div class="row">

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








          <div class="col-lg-6">
            <div class="card-header" style="background-color: #fff !important;">
              <div class="row show-grid">
                <div class="col-md-12 mt-2">
                  <a style="font-size: 15px;font-weight: bold;" class="text-primary card-title" href="?item=<?php echo $_GET['item']; ?>&surveys_results_dba&id=<?php echo $id_sondage; ?>&affectation=<?php echo $id_affectation; ?>">
                    <?php echo $code_cour." : "; ?>
                    <?php if ($groupe == 3) {echo $cour_eng;} ?>
                    <span class="label label-rounded label-success" style="float: right;font-size: 15px">
                        <i class="ti-arrow-right"></i>
                      </span>
                    </a>
                    <p class="btn btn-success btn-xs" style="display: none;"><?php echo $code_cour." : "; ?>
                      <?php if ($groupe == 3) {echo $cour_eng;} ?></p>
                    </div>
                  </div>
                </div>
                <div class="card ">
                  <div class="card-body">


                    <?php

                    // Porcentage 1
                    $porcentage1 = get_result_DBA($id_affectation,'9,22,21,19,18,17,13',$id_sondage);
                    // Porcentage 2
                    $porcentage2 = get_result_DBA($id_affectation,'1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31',$id_sondage);
                    // $porcentage3
                    $porcentage3 = get_result_DBA($id_affectation,'10,29,28',$id_sondage);
                    // procentage4
                    $porcentage4 = get_result_DBA($id_affectation,'12,14,10',$id_sondage);
                    // procentage5
                    $porcentage5 = get_result_DBA($id_affectation,'11,32,30',$id_sondage);


                    ?>
                    <div class="row">

                    <table class="table table-hover table-striped table-bordered color-table red-table">
                      <thead>
											<tr>
												<th style="text-align: center;">Satisfaction Rate</th>

											</tr>
										</thead>
                      <tbody>
                        <tr>
                          <td>Satisfaction Curriculum </td>
                          <td>
                            <div class="row" style="margin-bottom: 0;">
                              <div class="col-md-3"><?php echo round($porcentage1)." %"; ?></div>
                              <div class="col-md-9">
                                <div class="progress progress-striped active">
                                  <img src="../../../css/stu-prof/<?php
                                if($porcentage1<=20){
                                  echo "progress-bar-danger.png";
                                }elseif($porcentage1>20 && $porcentage1<50){
                                  echo "progress-bar-warning.png";
                                }else{
                                  echo "progress-bar-success.png";
                                }
                                ?>" style="
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
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td> Faculty </td>
                        <td>
                          <div class="row" style="margin-bottom: 0;">
                          <div class="col-md-3"><?php echo round($porcentage2)." %"; ?></div>
                          <div class="col-md-9">
                            <div class="progress progress-striped active">	<img src="../../../css/stu-prof/<?php
                            if($porcentage2<=20){
                              echo "progress-bar-danger.png";
                            }elseif($porcentage2>20 && $porcentage2<50){
                              echo "progress-bar-warning.png";
                            }else{
                              echo "progress-bar-success.png";
                            }
                            ?>" style="
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
                      </div>
                      </td>
                    </tr>
                    <tr>
                      <td> Administration </td>
                      <td>
                        <div class="row" style="margin-bottom: 0;">
                        <div class="col-md-3"><?php echo round($porcentage3)." %"; ?></div>
                        <div class="col-md-9">
                          <div class="progress progress-striped active">
                            <img src="../../../css/stu-prof/<?php
                          if($porcentage3<=20){
                            echo "progress-bar-danger.png";
                          }elseif($porcentage3>20 && $porcentage3<50){
                            echo "progress-bar-warning.png";
                          }else{
                            echo "progress-bar-success.png";
                          }
                          ?>" style="
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
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td> Library </td>
                    <td>
                      <div class="row" style="margin-bottom: 0;">
                        <div class="col-md-3"><?php echo round($porcentage4)." %"; ?></div>
                        <div class="col-md-9">
                          <div class="progress progress-striped active">	<img src="../../../css/stu-prof/<?php
                          if($porcentage4<=20){
                            echo "progress-bar-danger.png";
                          }elseif($porcentage4>20 && $porcentage4<50){
                            echo "progress-bar-warning.png";
                          }else{
                            echo "progress-bar-success.png";
                          }
                          ?>" style="
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
                    </div>
                  </td>
                </tr>
                <tr>
                  <td> Campus Tools </td>
                  <td>
                    <div class="row" style="margin-bottom: 0;">
                      <div class="col-md-3"><?php echo round($porcentage5)." %"; ?></div>
                      <div class="col-md-9">
                          <div class="progress progress-striped active">	<img src="../../../css/stu-prof/<?php
                          if($porcentage5<=20){
                            echo "progress-bar-danger.png";
                          }elseif($porcentage5>20 && $porcentage5<50){
                            echo "progress-bar-warning.png";
                          }else{
                            echo "progress-bar-success.png";
                          }
                          ?>" style="
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
                    </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>

      </div>
    </div>
    <?php
  }
  ?>
</div>

</div>
<?php }elseif (isset($_GET['affectation'])){ ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="card-header" style="background-color: #fff !important;">
        <div class="row show-grid">
  <?php
  $id_sondage =7;
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
  $sql_affectation= "SELECT a.* FROM `tbl_sondage_affectation_dba` as a WHERE a.`groupe` = 3 and  a.`id` = \"$id_affectation\" ";
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
  $sql_etudiant_inscrit = "SELECT count(distinct code_etudiant) FROM `tbl_resultat_sondage` as r  WHERE r.`id_affectation` = $id_affectation";
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
    $sql_question_existe= "SELECT count(*) FROM `tbl_resultat_sondage` as r WHERE r.`id_affectation` = $id_affectation  AND
    `id_question` = $id_question ";
    $req_question_existe = @mysql_query($sql_question_existe);
    $row_question_existe = mysql_fetch_array($req_question_existe);
    $nb_question = $row_question_existe['0'];
    if ($nb_question != 0) { ?>
      <div class="col-lg-12 panel panel-primary">
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
                <th class="col-md-7" style="text-align: center;" colspan="2"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $rep_porcentage = 0;
              $sql_reponse= "SELECT * FROM `tbl_reponse` WHERE `question_id` =$id_question";
              //var_dump($sql_reponse);

              $req_reponse = @mysql_query($sql_reponse);
              while ($row_reponse = mysql_fetch_array($req_reponse)) {
                $id_reponse = $row_reponse['id'];
                $sql_nb_etudiants = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r WHERE r.`id_affectation` = $id_affectation AND `id_question` = $id_question AND `id_reponse` = $id_reponse ";
                //var_dump($sql_nb_etudiants);
                $req_nb_etudiants = @mysql_query($sql_nb_etudiants);
                $row_nb_etudiants = mysql_fetch_array($req_nb_etudiants);
                $nb_etudiant = $row_nb_etudiants['0'];
                $porcentage = ($nb_etudiant/$nb_etudiant_inscrit)*100;
                $porcentage = round($porcentage,1);

                ?>
                <tr>

                  <td>
                    <?php if ($groupe == 2): ?>
                      <?php echo $row_reponse['reponse_en']; ?>
                    <?php endif ?>
                    <?php if ($groupe == 3): ?>
                      <?php echo $row_reponse['reponse_en']; ?>
                    <?php endif ?>
                  </td>
                  <td>
                    <?php echo $porcentage." %"; ?>
                  </td>

                  <td>

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
// get all remarqus
$sql = "SELECT text FROM `tbl_resultat_sondage` WHERE `id_affectation` = $id_affectation and text != ''";
$req = mysql_query($sql);
?>
<div class="col-lg-12">
  <table class="table table-bordered table-responsive">
    <tr>
      <th>student feedbacks</th>
    </tr>
<?php
while ($row = mysql_fetch_assoc($req)) {
  ?>

      <tr>
        <td>
            <?php echo $row['text']; ?>
        </td>
      </tr>

  <?php
}?>
</table>
</div>


</div>
</div>
</div>
</div>
<?php }elseif (isset($_GET['annee']) && isset($_GET['periode'])) { ?>
  <?php
  $periode = $_GET['periode'];
  $annee = $_GET['annee'];
  $sql_prof_affectation= "SELECT DISTINCT a.`code_prof` FROM `tbl_sondage_affectation_dba` as a ,`tbl_professeur` as p , `tbl_aff_etudiant` as e , `tbl_etudiant` as et   WHERE
  a.`groupe` = 3 and a.`niveau` = \"dba\" and a.`annee` = $annee and `periode` = \"$periode\" AND a.`archive` = 0 and a.code_prof = p.code_prof and p.archive = 0
  and a.`id` = e.`id_affectation` and a.`type` = 1  ";
  $req_prof_affectation = @mysql_query($sql_prof_affectation);
  // les etudiants

  $sql_nb_etudiant_r = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_sondage_affectation_dba` as a ,`tbl_resultat_sondage` as r  ,`tbl_professeur` as p , `tbl_aff_etudiant` as e , `tbl_etudiant` as et  WHERE a.`annee` = \"$annee\" and a.`periode` = \"$periode\" and a.`id` = r.`id_affectation` and a.`groupe` = 3 and a.code_prof = p.code_prof and p.archive = 0 and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
  //var_dump($sql_nb_etudiant_r);
  $req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
  $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
  $sql_nb_etudiant_tt = "SELECT count(*) FROM `tbl_sondage_affectation_dba` as a , `tbl_aff_etudiant` as e ,`tbl_professeur` as p , `tbl_etudiant` as et  WHERE a.`niveau` = \"dba\" and a.`annee` = $annee and a.`periode` = \"$periode\"  and a.`id` = e.`id_affectation` and a.`groupe` = 3 and a.code_prof = p.code_prof and p.archive = 0 and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
  //var_dump($sql_nb_etudiant_tt);
  $req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
  $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
  $nb_etudiant_r = $row_nb_etudiant_r['0'];
  $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
  ?>
  <div class="ribbon-wrapper card">
      <div class="row">
          <div class="ribbon ribbon-danger">Session <?php  echo $periode.' '.$annee; ?></div>
          <p class="ribbon-content"></p>
      <?php
      while ($row_prof_affectation = mysql_fetch_array($req_prof_affectation)){
        $code_prof = $row_prof_affectation['code_prof'];
        $sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\"";
        $req_prof = @mysql_query($sql_prof);
        $row_prof = mysql_fetch_assoc($req_prof);
        $nom_prof = $row_prof['nom_prenom'];
        $sql_nb_cour = "SELECT COUNT(*) FROM `tbl_sondage_affectation_dba` as a WHERE a.`groupe` = 3 and  a.`niveau` = \"dba\" and a.`annee` = $annee and a.`periode` = \"$periode\" AND a.`archive` = 0 AND a.`code_prof` = \"$code_prof\"and  a.`type` = 1 ";
        $req_nb_cour = @mysql_query($sql_nb_cour);
        $row_nb_cour = mysql_fetch_array($req_nb_cour);
        $nb_cours = $row_nb_cour['0'];

        ?>

        <div class="col-md-4">
            <div class="card text-center" style="box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.29);">
              <div class="card-body">
                  <h4 class="card-title"><?php echo ucwords($nom_prof); ?></h4>
                  <p class="card-text"></p>
                  <a href="?item=<?php echo $_GET['item']; ?>&surveys_results_dba&id=<?php echo $id_sondage; ?>&code_prof=<?php echo $code_prof; ?>&periode=<?php echo $periode; ?>&annee=<?php echo $annee; ?>" class="btn btn-primary"><?php echo $nb_cours; if ($nb_cours == 1) {echo "  course";}else{echo "  courses";} ?></a>
              </div>
            </div>
        </div>
          <?php
        }
        ?>
      </div>
   </div>
  <?php }else{ ?>
    <div class="row mt-30">
    <?php
    $id_sondage =7;
    //les informations du sondage
    $sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage";
    $res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
    $row_sondage=mysql_fetch_assoc($res_sondage);
    //les periodes ou les sessions
    $sql_periode= "SELECT  `annee` , `periode` FROM  `tbl_sondage_affectation_dba` WHERE `groupe` = 3 and `niveau` =  \"dba\" and `archive` = 0 and `type` = 1 GROUP BY  `annee` ,  `periode` order by `annee` DESC, `periode` DESC";
    //var_dump($sql_periode);
    $req_periode = @mysql_query($sql_periode);
    while ($row_periode = mysql_fetch_array($req_periode)) {
      $periode = $row_periode['periode'];
      $annee = $row_periode['annee'];

      // Porcentage 1
      $porcentage1 = get_result_DBA_By_Session($annee,$periode,'9,22,21,19,18,17,13',$id_sondage);
      // Porcentage 2
      $porcentage2 = get_result_DBA_By_Session($annee,$periode,'1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31',$id_sondage);
      // $porcentage3
      $porcentage3 = get_result_DBA_By_Session($annee,$periode,'10,29,28',$id_sondage);
      // procentage4
      $porcentage4 = get_result_DBA_By_Session($annee,$periode,'12,14,10',$id_sondage);
      // procentage5
      $porcentage5 = get_result_DBA_By_Session($annee,$periode,'11,32,30',$id_sondage);



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
      // overall

      if ($overall != 0) {
        ?>
        <div class="col-lg-6">
          <div class="card-header" style="background-color: #fff !important;">
            <div class="row show-grid">
              <div class="col-md-12 mt-2">
                <a href="?item=<?php echo $_GET['item']; ?>&surveys_results_dba&annee=<?php echo $annee; ?>&periode=<?php echo $periode; ?>&id=<?php echo $id_sondage; ?>" class="btn btn-success btn-xs" style="float: right;">
                  Surveys by Faculty <i class="entypo-check"></i>
                </a>
                <a href="?item=<?php echo $_GET['item']; ?>&resultat_by_prof_dba&annee=<?php echo $annee; ?>&periode=<?php echo $periode; ?>&id=<?php echo $id_sondage; ?>"  style="color: #fff;" class="btn btn-success btn-xs">Export to excel</a>
              </div>
            </div>
          </div>
          <div class="card ">
            <div class="card-body">
              <h4 class="card-title">Session - <?php echo ucfirst($periode)." ".$annee; ?></h4>
              <table class="table table-hover table-striped table-bordered color-table red-table">
                <thead>
                  <tr>
                    <th colspan=2 class="col-md-12" style="text-align: center;">Satisfaction Rate</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="text-align: left;">Satisfaction Curriculum </td>
                    <td>
                      <div class="row" style="margin-bottom: 0;">
                        <div class="col-md-3"><?php echo round($porcentage1)." %"; ?></div>
                        <div class="col-md-9">
                            <div class="progress progress-striped active">	<img src="../../../css/stu-prof/<?php
                            if($porcentage1<=20){
                              echo "progress-bar-danger.png";
                            }elseif($porcentage1>20 && $porcentage1<50){
                              echo "progress-bar-warning.png";
                            }else{
                              echo "progress-bar-success.png";
                            }
                            ?>" style="
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
                      </div>
                  </td>
                </tr>
                <tr>
                  <td style="text-align: left;"> Faculty </td>
                  <td>
                    <div class="row" style="margin-bottom: 0;">
                      <div class="col-md-3"><?php echo round($porcentage2)." %"; ?></div>
                      <div class="col-md-9">
                        <div class="progress progress-striped active">	<img src="../../../css/stu-prof/<?php
                          if($porcentage2<=20){
                            echo "progress-bar-danger.png";
                          }elseif($porcentage2>20 && $porcentage2<50){
                            echo "progress-bar-warning.png";
                          }else{
                            echo "progress-bar-success.png";
                          }
                          ?>" style="
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
                    </div>
                </td>
              </tr>
              <tr>
                <td style="text-align: left;"> Administration </td>
                <td>
                  <div class="row" style="margin-bottom: 0;">
                    <div class="col-md-3"><?php echo round($porcentage3)." %"; ?></div>
                    <div class="col-md-9">
                        <div class="progress progress-striped active">	<img src="../../../css/stu-prof/<?php
                        if($porcentage3<=20){
                          echo "progress-bar-danger.png";
                        }elseif($porcentage3>20 && $porcentage3<50){
                          echo "progress-bar-warning.png";
                        }else{
                          echo "progress-bar-success.png";
                        }
                        ?>" style="
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
                </div>
              </td>
            </tr>
            <tr>
              <td style="text-align: left;"> Library </td>
              <td>
                <div class="row" style="margin-bottom: 0;">
                  <div class="col-md-3"><?php echo round($porcentage4)." %"; ?></div>
                  <div class="col-md-9">
                    <div class="progress progress-striped active">	<img src="../../../css/stu-prof/<?php
                      if($porcentage4<=20){
                        echo "progress-bar-danger.png";
                      }elseif($porcentage4>20 && $porcentage4<50){
                        echo "progress-bar-warning.png";
                      }else{
                        echo "progress-bar-success.png";
                      }
                      ?>" style="
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
                </div>
            </td>
          </tr>
          <tr>
            <td style="text-align: left;"> Campus Tools </td>
            <td>
              <div class="row" style="margin-bottom: 0;">
                <div class="col-md-3"><?php echo round($porcentage5)." %"; ?></div>
                <div class="col-md-9">
                  <div class="progress progress-striped active">	<img src="../../../css/stu-prof/<?php
                    if($porcentage5<=20){
                      echo "progress-bar-danger.png";
                    }elseif($porcentage5>20 && $porcentage5<50){
                      echo "progress-bar-warning.png";
                    }else{
                      echo "progress-bar-success.png";
                    }
                    ?>" style="
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
              </div>
          </td>
        </tr>
        <tr>
          <td style="text-align: left;"> Overall </td>
          <td>
            <div class="row" style="margin-bottom: 0;">
              <div class="col-md-3"><?php echo round($overall)." %"; ?></div>
              <div class="col-md-9">
                <div class="progress progress-striped active">	<img src="../../../css/stu-prof/<?php
                  if($overall<=20){
                    echo "progress-bar-danger.png";
                  }elseif($overall>20 && $overall<50){
                    echo "progress-bar-warning.png";
                  }else{
                    echo "progress-bar-success.png";
                  }
                  ?>" style="
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
            </div>
          </td>
      </tr>
    </tbody>
  </table>
</div>
</div>
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
