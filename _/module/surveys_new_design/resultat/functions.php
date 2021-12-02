<?php


///BBA
function get_global_result_By_questions($id_question = "",$id_affectation = ""){
  $porcentage = 0;
  if ($id_question != "" && $id_affectation != "") {
    $sql = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant` as e, `tbl_reponse` as rep WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and r.id_question in ($id_question) group by rep.`porcentage`,`code_etudiant`,`id_question`";
    //var_dump($sql);
    $req = @mysql_query($sql);
    $satisfaction = 0;
    $nbQ = 0;
    while ($row = mysql_fetch_array($req)) {
      $satisfaction = $satisfaction + $row['porcentage'];
      $nbQ++;
    }
    //var_dump($satisfaction);
    //var_dump($nbQ);
    $porcentage = $satisfaction/$nbQ;
  }
  return $porcentage;
}

///MBA
function get_global_result_by_session($id_question = "",$periode = "",$year = ""){
  $porcentage = 0;
  if ($id_question != "" && $periode != "" && $year != "") {
    $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM
    `tbl_sondage_affectation` as a ,
    `tbl_resultat_sondage` as r ,
    `tbl_reponse` as rep WHERE
    a.`groupe` = 3 and
    a.`niveau` = \"mba\" and
    a.`annee` = $year and
    a.`periode` = \"$periode\" and
    a.`id` = r.`id_affectation` and
    r.`id_reponse` = rep.`id`and
    r.id_question in ($id_question) and
    a.`type` = 1
    group by rep.`porcentage`,`id_question` order by id_question";
    //var_dump($sql_new);
    $req_new = @mysql_query($sql_new);
    $satisfaction = 0;
    $nbQ = 0;
    while ($row_new = mysql_fetch_array($req_new)) {
      $satisfaction = $satisfaction + $row_new['porcentage'];
      $nbQ++;
    }
    $porcentage = $satisfaction/$nbQ;
  }
  //var_dump($porcentage);
  return $porcentage;
}


function get_student_number_in_survey($periode = "",$year = ""){
    $sql = "SELECT count(DISTINCT `code_etudiant`) as nb FROM `tbl_resultat_sondage` as r , tbl_sondage_affectation as a WHERE a.periode = '$periode' and a.annee = $year and r.`id_affectation` = a.id";
    //var_dump($sql);
    $req = mysql_query($sql);
    $row = mysql_fetch_assoc($req);

    return $row['nb'];
}


/// Add default result
function add_default_result($id_affectation,$id_question,$id_sondage){
  if ($id_affectation != "" && $id_question != array()) {
    // la liste des etudiants
    $sql =  "SELECT * FROM `tbl_resultat_sondage` WHERE `id_affectation` = $id_affectation GROUP by `code_etudiant`";
    //echo "</br>";
    // var_dump($sql);
    // die();
    $req = @mysql_query($sql);
    while ($row = mysql_fetch_assoc($req)) {
      $code_inscription = $row['code_etudiant'];
      // echo $code_inscription;
      // echo "</br>";
      // echo $row['id_question'];
      // echo "</br>";
        foreach ($id_question as $k => $v) {
          if ($row['id_question'] >= 13 && $v >= 13) {
            // preparer la reponse
            $sql_reponse = "SELECT * FROM `tbl_reponse` WHERE `question_id` = $v and `porcentage` = 90 limit 1";
            // var_dump($sql_reponse);
            // echo "</br>";
            $req_reponse = @mysql_query($sql_reponse);
            $row_reponse = mysql_fetch_assoc($req_reponse);
            $id_reponse = $row_reponse['id'];
            // var_dump($id_reponse);


           $sql_insert = "INSERT INTO `tbl_resultat_sondage`(`id_affectation`, `id_reponse`, `id_sondage`, `id_question`, `code_etudiant`, `text`) VALUES ($id_affectation,$id_reponse,$id_sondage,$v,$code_inscription,'')";
           @mysql_query($sql_insert);
           //var_dump($sql_insert);
           // echo "</br>";

          }
          if ($row['id_question'] <= 12 && $v < 13) {
            // preparer la reponse
            $sql_reponse = "SELECT * FROM `tbl_reponse` WHERE `question_id` = $v and `porcentage` = 90 limit 1";
            // var_dump($sql_reponse);
            $req_reponse = @mysql_query($sql_reponse);
            $row_reponse = mysql_fetch_assoc($req_reponse);
            $id_reponse = $row_reponse['id'];

           $sql_insert = "INSERT INTO `tbl_resultat_sondage`(`id_affectation`, `id_reponse`, `id_sondage`, `id_question`, `code_etudiant`, `text`) VALUES ($id_affectation,$id_reponse,$id_sondage,$v,$code_inscription,'')";
           @mysql_query($sql_insert);
           //var_dump($sql_insert);
           // echo "</br>";
          }
        }

    }
    return false;
    // die();


  }else{
    return false;
  }


}



// GET result
function get_result_DBA($id_affectation,$id_question,$id_sondage){

  $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage
  FROM `tbl_sondage_affectation_dba` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep
  WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation
  and r.`id_sondage` in ($id_sondage,2,7)
  and id_question in ($id_question) group by rep.`porcentage`,`code_etudiant`,`id_question`";
  $req_new = @mysql_query($sql_new);

  //echo $sql_new."<br>";
  $porcentage = 0;
  $satisfaction = 0;
  $nbQ = 0;
  while ($row_new = mysql_fetch_array($req_new)) {
    $satisfaction = $satisfaction + $row_new['porcentage'];
    $nbQ++;
  }


  //echo $nbQ;
  $porcentage = $porcentage + ($satisfaction/$nbQ);
  if ($porcentage == 0) {
    //echo $sql_new."<br>";
    $array_question = explode(",", $id_question);
    $insert = add_default_result($id_affectation,$array_question,$id_sondage);
    if ($insert) {
      get_result($id_affectation,$id_question,$id_sondage);
    }
  }
  return $porcentage;

  //die();
}


// Get Result By Session
function get_result_DBA_By_Session($annee,$periode,$id_question,$id_sondage){

  $sql_new = "SELECT  distinct r.`id_affectation` FROM
  `tbl_sondage_affectation_dba` as a ,
  `tbl_resultat_sondage` as r ,
  `tbl_reponse` as rep , `tbl_etudiant_eng` as et WHERE
  a.`groupe` = 3 and
  a.`niveau` = \"dba\" and
  a.`annee` = $annee and
  a.`periode` = \"$periode\" and
  a.`id` = r.`id_affectation` and
  r.`id_reponse` = rep.`id`and
  r.id_question  in ($id_question) and
  a.`type` = 1
  group by rep.`porcentage`,`code_etudiant`,`id_question`";
  $req_new = @mysql_query($sql_new);

  //echo $sql_new."<br>";
  $porcentage = 0;
  $satisfaction = 0;
  $nbQ = 0;
  while ($row_new = mysql_fetch_array($req_new)) {
    $id_affectation = $row_new['id_affectation'];
    $porcentage_aff = get_result_DBA($id_affectation,$id_question,$id_sondage);
    //echo $porcentage_aff.'<br>';
    $satisfaction = $satisfaction + $porcentage_aff;

    $nbQ++;
  }
  //var_dump($nbQ);


  //echo $nbQ;
  $porcentage = $porcentage + ($satisfaction/$nbQ);
  //var_dump($porcentage);
  return $porcentage;

  //die();
}


function get_result($id_affectation,$id_question,$id_sondage){

  $sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage
  FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep
  WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and a.`campus`= 'e-learning' and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation
  and r.`id_sondage` in ($id_sondage,2,7)
  and id_question in ($id_question) group by rep.`porcentage`,`code_etudiant`,`id_question`";
  $req_new = @mysql_query($sql_new);


  $porcentage = 0;
  $satisfaction = 0;
  $nbQ = 0;
  while ($row_new = mysql_fetch_array($req_new)) {
    $satisfaction = $satisfaction + $row_new['porcentage'];
    $nbQ++;
  }


  //echo $nbQ;
  $porcentage = $porcentage + ($satisfaction/$nbQ);
  if ($porcentage == 0) {
    //echo $sql_new."<br>";
    $array_question = explode(",", $id_question);
    $insert = add_default_result($id_affectation,$array_question,$id_sondage);
    if ($insert) {
      get_result($id_affectation,$id_question,$id_sondage);
    }
  }
  return $porcentage;

  //die();
}





 ?>
