<?php if (isset($_GET['affectation'])){ ?>
  <?php
  $id_sondage =$_GET['id'];
  $id_affectation = $_GET['affectation'];
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
  $sql_affectation= "SELECT * FROM `tbl_sondage_affectation` WHERE `groupe` = 3 AND   `session` = \"$id_session\" AND `id` = \"$id_affectation\" ";
  $req_affectation = @mysql_query($sql_affectation);
  $row_affectation = mysql_fetch_assoc($req_affectation);
  $code_prof = $row_affectation['code_prof'];
  $groupe = $row_affectation['groupe'];
  $code_cour = $row_affectation['code_cours'];
  $type = $row_affectation['type'];
  $sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\" and archive=0";
  $req_prof = @mysql_query($sql_prof);
  $row_prof = mysql_fetch_assoc($req_prof);
  $nom_prof = $row_prof['nom_prenom'];
  $sql_cour = "SELECT * FROM `tbl_cours` WHERE `code_cours` = \"$code_cour\"";
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
  // $sql_etudiant_inscrit = "SELECT count(*) FROM `tbl_inscription_cours_piimt` WHERE `code_cours` = \"$code_cour\"
  // AND `idSession` = $id_session AND `type_cours_id` = $type_cours_id";
  // $req_etudiant_inscrit = @mysql_query($sql_etudiant_inscrit);
  // $row_etudiant_inscrit = mysql_fetch_array($req_etudiant_inscrit);
  // $nb_etudiant_inscrit = $row_etudiant_inscrit['0'];
  $sql_etudiant_inscrit = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_etudiant` as e WHERE `id_affectation` = $id_affectation and r.`code_etudiant` = e.`code_inscription`";
  $req_etudiant_inscrit = @mysql_query($sql_etudiant_inscrit);
  $row_etudiant_inscrit = mysql_fetch_array($req_etudiant_inscrit);
  $nb_etudiant_inscrit = $row_etudiant_inscrit['0'];
  ?>

  <div class="ribbon-wrapper card">
    <div class="row">
      <div class="card-body">
      <div class="ribbon ribbon-danger"><?php echo $sondage_title; ?></div>
      <h3 class="ribbon-content text-primary mt-10 pull-right">
        <?php echo $cour_eng; ?> - <?php echo ucwords($nom_prof); ?>
      </h3>
      <div class="table-responsive">
          <?php
          $sql_question= "SELECT * FROM `tbl_questions`";
          $req_question = @mysql_query($sql_question);
          while ($row_question = mysql_fetch_array($req_question)) {
            $id_question = $row_question['id'];
            $sql_question_existe= "SELECT count(*) FROM `tbl_resultat_sondage` as r , `tbl_etudiant` as e  WHERE r.`id_affectation` = $id_affectation AND r.`id_sondage` in ($id_sondage,2,7) AND
            r.`id_question` = $id_question and r.`code_etudiant` = e.`code_inscription`";
            $req_question_existe = @mysql_query($sql_question_existe);
            $row_question_existe = mysql_fetch_array($req_question_existe);
            $nb_question = $row_question_existe['0'];
            if ($nb_question != 0) { ?>
              <h5 class="mt-30"><?php echo $row_question['question_en']; ?></h5>
              <table class="table color-table primary-table">
                <thead>
                  <tr>
                    <?php
                      $sql_reponse= "SELECT * FROM `tbl_reponse` WHERE `question_id` =$id_question";
                      $req_reponse = @mysql_query($sql_reponse);
                      while ($row_reponse = mysql_fetch_array($req_reponse)) {
                     ?>
                        <th style="text-align:center;" ><?php echo $row_reponse['reponse_en']; ?></th>
                     <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                      $sql_reponse= "SELECT * FROM `tbl_reponse` WHERE `question_id` =$id_question";
                      $req_reponse = @mysql_query($sql_reponse);
                      while ($row_reponse = mysql_fetch_array($req_reponse)) {
                        $id_reponse = $row_reponse['id'];
                        $sql_nb_etudiants = "SELECT count(distinct(r.`code_etudiant`)) FROM `tbl_resultat_sondage` as r , `tbl_etudiant` as e   WHERE `id_affectation` = $id_affectation AND `id_sondage` = $id_sondage AND
                        `id_question` = $id_question AND `id_reponse` = $id_reponse and r.`code_etudiant` = e.`code_inscription`";
                        //var_dump($sql_nb_etudiants);
                        $req_nb_etudiants = @mysql_query($sql_nb_etudiants);
                        $row_nb_etudiants = mysql_fetch_array($req_nb_etudiants);
                        $nb_etudiant = $row_nb_etudiants['0'];
                        $porcentage = ($nb_etudiant/$nb_etudiant_inscrit)*100;
                        $porcentage = round($porcentage,1);
                     ?>
                       <td style="text-align:center;">
                         <div class="mb-30">
                             <?php
                               if ($porcentage <= 40) {
                                 $class_chart = "easy-pie-chart-40";
                               }
                               if ($porcentage <= 70 && $porcentage > 40) {
                                 $class_chart = "easy-pie-chart-70";
                               }
                               if ($porcentage <= 100 && $porcentage > 70) {
                                 $class_chart = "easy-pie-chart-100";
                               }
                             ?>
                             <div class="chart <?php echo $class_chart; ?>" data-percent="<?php echo round($porcentage) ?>"> <span class="percent"><?php echo round($porcentage) ?></span> </div>
                         </div>
                       </td>
                     <?php } ?>
                  </tr>
                </tbody>

            <?php } ?>
          </table>
        <?php } ?>
</div>
</div>
<?php } ?>
