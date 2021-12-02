<?php


$bd="hisadm_hisdb";

$login="hisadm_hisusr";

$mdp="llhispass11";
//hispass11
$serveur='127.0.0.1';

function connecter($serveur,$login,$mdp,$bd)
{

$connect = @mysql_connect($serveur,$login,$mdp);

if ( ! $connect )

die ('Failed to connect server vnc');

@mysql_select_db($bd, $connect) or die ('Database Select Failed');

}

connecter($serveur,$login,$mdp,$bd);

die();

$student = array(
  31 => array('BF',350,7),
  27 => array('BF',341,6),
  20 => array('AG',33,7),
  25 => array('AG',34,7),
  21 => array('BF',336,6),
  22 => array('BF',337,6),
  41 => array('BF',367,6),
  42 => array('BF',368,6),
  43 => array('BF',369,6),
  45 => array('BF',371,6),
  46 => array('BF',372,7),
  47 => array('BF',376,7)
);
// $code_inscription = "243";
// $prefixe = "MOR";
// $nb_credit = 12;
foreach ($student as $v) {
  $prefixe = $v['0'];
  $code_inscription = $v['1'];
  $nb_credit = $v['2'];
  echo "<br>";
  echo "------------";
  echo "<br>";
  echo $code_inscription;
  echo "<br>";
  echo $prefixe;
  echo "<br>";
  echo $nb_credit;
  echo "<br>";

  // $nb_credit = 14.5;
  // $half_number = 0;
  if (is_float($nb_credit)) {
      // $half_number = 1;
      $nb_credit = $nb_credit-0.5;
  }

  // update student
  $sql_update = "UPDATE `tbl_etudiant_all` SET `new_transcript` = 1 WHERE `prefixe` = '$prefixe' and `code_inscription` = '$code_inscription'";
  //var_dump($sql_update);
  $req_update = mysql_query($sql_update);

  $total_credit = 0;
  $nb_crecit_inscri = 0;
  $nb_credit_ele_inscri = 0;
  $nb_transfer = 0;
  $default_transfer_courses = array('1200315','1001315','1001345');
  $code_eng_4 = 1001402;
  $default_course_inscription = array('1200335','1206315','1202340');
  $date = date('Y-m-d H:m:s');
  $idSession = 0;
  $d1 = 2021;
  $date1=$d1+1;
  $conditions  = "''";


  // English 4
  if ($nb_credit <= 7) {
    $code_cours = $code_eng_4;

    $sql2014 = "SELECT nbr_credit,code_cours_testing FROM tbl_cours WHERE code_cours = '$code_cours'";
    $res2014 = mysql_query($sql2014);
    $row = mysql_fetch_assoc($res2014);
    $code_cours_testing = $row['code_cours_testing'];
    $nbr_credit = $row['nbr_credit'];
    // combien d'inscription de cours dans cette annee max 14

    $nb_cours = 0;


    $sql_student = "SELECT code_inscription,prefixe FROM tbl_etudiant_all as e where
    date_inscription>'2016-07-01' and
    e.archive != 5 and
    date_inscription < '$date1-07-31' and
    (
      graduation_date ='0000-00-00' or
      graduation_date ='0000-00-01' or
      graduation_date BETWEEN '$d1-09-01' AND '$date1-08-31'
    )
    ORDER BY e.code_inscription";

    $req_student = mysql_query($sql_student);
    $nb_cours = 0;
    while ($row_s = mysql_fetch_assoc($req_student)) {
      $code_inscription_year = $row_s['code_inscription'];
      $prefixe_year = $row_s['prefixe'];
      // verification d'inscription
      $sql_ver = "SELECT COUNT(*) AS nbr FROM tbl_note_acc
      WHERE code_cours= '$code_cours' and code_inscription = '$code_inscription_year' and prefixe = '$prefixe'
      ";
      $req_ver = mysql_query($sql_ver);
      $row_ver = mysql_fetch_assoc($req_ver);
      $nb_ver = $row_ver['nbr'];
      if ($nb_ver != 0) {
        $nb_cours = $nb_cours+1;
      }
    }

    if ($nb_cours <= 14 and !in_array($code_cours,$default_transfer_courses)) {

      $final_exam = mt_rand(77, 100);
      $data = get_letter_grade($final_exam);
      //var_dump($data);
      $letter_grade = $data['letter_grade'];
      $gpa = $data['gpa'];
      // inscription
      $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
      WHERE code_inscription='$code_inscription'
      AND code_cours= '$code_cours'
      AND prefixe = '$prefixe'
      ";

      $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
      VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
      //var_dump($sql);
      @mysql_query($sql)or die ('Erreur :: inscription11');

      // creation de la fiche de notes
      $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
      letter_grade,final_exam,final_grade,gpa)
      value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
      '$letter_grade','$final_exam','$final_exam','$gpa')";
      //var_dump($sql);
      @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');

      $total_credit = $total_credit+$nbr_credit;
      $nb_crecit_inscri = $nb_crecit_inscri+$nbr_credit;
    }else{
      // Transfer
      $letter_grade = 'T';
      $gpa = 0;
      // inscription
      $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
      WHERE code_inscription='$code_inscription'
      AND code_cours= '$code_cours'
      AND prefixe = '$prefixe'
      ";

      $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
      VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
      //var_dump($sql);
      @mysql_query($sql)or die ('Erreur :: inscription11');

      // creation de la fiche de notes
      $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
      letter_grade)
      value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
      '$letter_grade')";
      //var_dump($sql);
      @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
      $total_credit = $total_credit+$nbr_credit;
      $nb_transfer = $nb_transfer+$nbr_credit;
    }

    $conditions .= ",$code_eng_4";
  }
  //
  if ($nb_credit >= 8 && $nb_credit <= 14) {
    foreach ($default_course_inscription as $v) {
      $code_cours = $v;

      $sql2014 = "SELECT nbr_credit,code_cours_testing FROM tbl_cours WHERE code_cours = '$code_cours'";
      $res2014 = mysql_query($sql2014);
      $row = mysql_fetch_assoc($res2014);
      $code_cours_testing = $row['code_cours_testing'];
      $nbr_credit = $row['nbr_credit'];
      // combien d'inscription de cours dans cette annee max 14

      $nb_cours = 0;
      $sql_student = "SELECT code_inscription,prefixe FROM tbl_etudiant_all as e where
      date_inscription>'2016-07-01' and
      e.archive != 5 and
      date_inscription < '$date1-07-31' and
      (
        graduation_date ='0000-00-00' or
        graduation_date ='0000-00-01' or
        graduation_date BETWEEN '$d1-09-01' AND '$date1-08-31'
      )
      ORDER BY e.code_inscription";

      $req_student = mysql_query($sql_student);
      $nb_cours = 0;
      while ($row_s = mysql_fetch_assoc($req_student)) {
        $code_inscription_year = $row_s['code_inscription'];
        $prefixe_year = $row_s['prefixe'];
        // verification d'inscription
        $sql_ver = "SELECT COUNT(*) AS nbr FROM tbl_note_acc
        WHERE code_cours= '$code_cours' and code_inscription = '$code_inscription_year' and prefixe = '$prefixe'
        ";
        $req_ver = mysql_query($sql_ver);
        $row_ver = mysql_fetch_assoc($req_ver);
        $nb_ver = $row_ver['nbr'];
        if ($nb_ver != 0) {
          $nb_cours = $nb_cours+1;
        }
      }

      if ($nb_cours <= 14 and !in_array($code_cours,$default_transfer_courses)) {

        $final_exam = mt_rand(77, 100);
        $data = get_letter_grade($final_exam);
        //var_dump($data);
        $letter_grade = $data['letter_grade'];
        $gpa = $data['gpa'];
        // inscription
        $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
        WHERE code_inscription='$code_inscription'
        AND code_cours= '$code_cours'
        AND prefixe = '$prefixe'
        ";

        $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
        VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
        //var_dump($sql);
        @mysql_query($sql)or die ('Erreur :: inscription11');

        // creation de la fiche de notes
        $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
        letter_grade,final_exam,final_grade,gpa)
        value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
        '$letter_grade','$final_exam','$final_exam','$gpa')";
        //var_dump($sql);
        @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
        $total_credit = $total_credit+$nbr_credit;
        $nb_crecit_inscri = $nb_crecit_inscri+$nbr_credit;
      }else{
        // Transfer
        $letter_grade = 'T';
        $gpa = 0;
        // inscription
        $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
        WHERE code_inscription='$code_inscription'
        AND code_cours= '$code_cours'
        AND prefixe = '$prefixe'
        ";

        $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
        VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
        //var_dump($sql);
        @mysql_query($sql)or die ('Erreur :: inscription11');

        // creation de la fiche de notes
        $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
        letter_grade)
        value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
        '$letter_grade')";
        //var_dump($sql);
        @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
        $total_credit = $total_credit+$nbr_credit;
        $nb_transfer = $nb_transfer+$nbr_credit;
      }

      $conditions .= ",$v";
    }

    // Language
    // $nb_credit_l_e = 5;
    // $nb_credit = $nb_credit-$nb_credit_l_e;
    $langugaes = array('0701320','0708340','0701330','0708350');


    $c_n = 3;
    $v = 0;
    $count = 0;
    do {
      $c = mt_rand(0,$c_n);
      $code_cours = $langugaes["$c"];
      if ($code_cours != NULL) {
          $sql2014 = "SELECT nbr_credit,code_cours_testing FROM tbl_cours WHERE code_cours = '$code_cours'";
          // var_dump($sql2014);
          $res2014 = mysql_query($sql2014);
          $row = mysql_fetch_assoc($res2014);
          $code_cours_testing = $row['code_cours_testing'];
          // var_dump($code_cours_testing);
          $nbr_credit = $row['nbr_credit'];
          // combien d'inscription de cours dans cette annee max 14

          $nb_cours = 0;
          $sql_student = "SELECT code_inscription,prefixe FROM tbl_etudiant_all as e where
          date_inscription>'2016-07-01' and
          e.archive != 5 and
          date_inscription < '$date1-07-31' and
          (
            graduation_date ='0000-00-00' or
            graduation_date ='0000-00-01' or
            graduation_date BETWEEN '$d1-09-01' AND '$date1-08-31'
          )
          ORDER BY e.code_inscription";

          $req_student = mysql_query($sql_student);
          $nb_cours = 0;
          while ($row_s = mysql_fetch_assoc($req_student)) {
            $code_inscription_year = $row_s['code_inscription'];
            $prefixe_year = $row_s['prefixe'];
            // verification d'inscription
            $sql_ver = "SELECT COUNT(*) AS nbr FROM tbl_note_acc
            WHERE code_cours= '$code_cours' and code_inscription = '$code_inscription_year' and prefixe = '$prefixe'
            ";
            $req_ver = mysql_query($sql_ver);
            $row_ver = mysql_fetch_assoc($req_ver);
            $nb_ver = $row_ver['nbr'];
            if ($nb_ver != 0) {
              $nb_cours = $nb_cours+1;
            }
          }

          if ($nb_cours <= 14 and !in_array($code_cours,$default_transfer_courses)) {

            $final_exam = mt_rand(77, 100);
            $data = get_letter_grade($final_exam);
            //var_dump($data);
            $letter_grade = $data['letter_grade'];
            $gpa = $data['gpa'];
            // inscription
            $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
            WHERE code_inscription='$code_inscription'
            AND code_cours= '$code_cours'
            AND prefixe = '$prefixe'
            ";

            $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
            VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
            // var_dump($sql);
            // echo "</br>";
            @mysql_query($sql)or die ('Erreur :: inscription11');

            // creation de la fiche de notes
            $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
            letter_grade,final_exam,final_grade,gpa)
            value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
            '$letter_grade','$final_exam','$final_exam','$gpa')";
            // var_dump($sql);
            // echo "</br>";
            @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');

            $total_credit = $total_credit+$nbr_credit;
            $nb_crecit_inscri = $nb_crecit_inscri+$nbr_credit;
            $count=$count+1;
            unset($langugaes["$c"]);

          }else{
            // Transfer
            $letter_grade = 'T';
            $gpa = 0;
            // inscription
            $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
            WHERE code_inscription='$code_inscription'
            AND code_cours= '$code_cours'
            AND prefixe = '$prefixe'
            ";

            $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
            VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
            // var_dump($sql);
            // echo "</br>";
            @mysql_query($sql)or die ('Erreur :: inscription11');

            // creation de la fiche de notes
            $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
            letter_grade)
            value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
            '$letter_grade')";
            // var_dump($sql);
            // echo "</br>";
            @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
            $total_credit = $total_credit+$nbr_credit;
            $nb_transfer = $nb_transfer+$nbr_credit;
            $nb_credit = $nb_credit+1;
            $count = $count+1;
            unset($langugaes["$c"]);

          }
      }
    }while ($count <= 1);

    // var_dump($count);
    // echo "</br>";

    // ELECTIVES
    $electives = array('0200310','1700380','2001310','2400300');

    $c_n = 3;
    $v = 0;
    $count = 0;
    do {
      $c = mt_rand(0,$c_n);
      $code_cours = $electives["$c"];
      if ($code_cours != NULL) {
          $sql2014 = "SELECT nbr_credit,code_cours_testing FROM tbl_cours WHERE code_cours = '$code_cours'";
          $res2014 = mysql_query($sql2014);
          $row = mysql_fetch_assoc($res2014);
          $code_cours_testing = $row['code_cours_testing'];
          $nbr_credit = $row['nbr_credit'];
          // combien d'inscription de cours dans cette annee max 14

          $nb_cours = 0;
          $sql_student = "SELECT code_inscription,prefixe FROM tbl_etudiant_all as e where
          date_inscription>'2016-07-01' and
          e.archive != 5 and
          date_inscription < '$date1-07-31' and
          (
            graduation_date ='0000-00-00' or
            graduation_date ='0000-00-01' or
            graduation_date BETWEEN '$d1-09-01' AND '$date1-08-31'
          )
          ORDER BY e.code_inscription";

          $req_student = mysql_query($sql_student);
          $nb_cours = 0;
          while ($row_s = mysql_fetch_assoc($req_student)) {
            $code_inscription_year = $row_s['code_inscription'];
            $prefixe_year = $row_s['prefixe'];
            // verification d'inscription
            $sql_ver = "SELECT COUNT(*) AS nbr FROM tbl_note_acc
            WHERE code_cours= '$code_cours' and code_inscription = '$code_inscription_year' and prefixe = '$prefixe'
            ";
            $req_ver = mysql_query($sql_ver);
            $row_ver = mysql_fetch_assoc($req_ver);
            $nb_ver = $row_ver['nbr'];
            if ($nb_ver != 0) {
              $nb_cours = $nb_cours+1;
            }
          }

          if ($nb_cours <= 14 and !in_array($code_cours,$default_transfer_courses)) {

            $final_exam = mt_rand(77, 100);
            $data = get_letter_grade($final_exam);
            //var_dump($data);
            $letter_grade = $data['letter_grade'];
            $gpa = $data['gpa'];
            // inscription
            $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
            WHERE code_inscription='$code_inscription'
            AND code_cours= '$code_cours'
            AND prefixe = '$prefixe'
            ";

            $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
            VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
            // var_dump($sql);
            // echo "</br>";
            @mysql_query($sql)or die ('Erreur :: inscription11');

            // creation de la fiche de notes
            $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
            letter_grade,final_exam,final_grade,gpa)
            value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
            '$letter_grade','$final_exam','$final_exam','$gpa')";
            // var_dump($sql);
            // echo "</br>";
            @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');

            $total_credit = $total_credit+$nbr_credit;
            $nb_crecit_inscri = $nb_crecit_inscri+$nbr_credit;
            $count = $count+1;
            unset($electives["$c"]);

          }else{
            // Transfer
            $letter_grade = 'T';
            $gpa = 0;
            // inscription
            $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
            WHERE code_inscription='$code_inscription'
            AND code_cours= '$code_cours'
            AND prefixe = '$prefixe'
            ";

            $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
            VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
            // var_dump($sql);
            // echo "</br>";
            @mysql_query($sql)or die ('Erreur :: inscription11');

            // creation de la fiche de notes
            $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
            letter_grade)
            value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
            '$letter_grade')";
            // var_dump($sql);
            // echo "</br>";
            @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
            $total_credit = $total_credit+$nbr_credit;
            $nb_transfer = $nb_transfer+$nbr_credit;
            $nb_credit = $nb_credit+1;
            $count = $count+1;
            unset($electives["$c"]);

          }
      }
    }while ($count <= 2);
    // var_dump($count);
    // echo "</br>";


  }

  // echo "</br>";
  // echo "Transfer Credits :".$nb_transfer;
  // echo "</br>";
  // echo "total inscription Credits :".$nb_crecit_inscri;
  // echo "</br>";
  // echo "Total Credits :".$total_credit;
  // echo "</br>";
  //die();


  //
  $sql_cours = "SELECT `code_cours`, `code_cours_duplicata`, `titre_eng`, `ordering`, `nbr_credit`, `grade`,`type`,code_cours_testing FROM `tbl_cours`
  WHERE `grade` != 0 and `nbr_credit` = 1 and `type` = 0 and archive = 0 and code_cours not in($conditions)  ORDER by `ordering`";
  //var_dump($sql_cours);
  $req = mysql_query($sql_cours);

  $courses = array();
  $i_course = 0;
  while ($row = mysql_fetch_assoc($req)) {
    $code_cours_i = $row['code_cours'];
    $courses[$i_course] = "$code_cours_i";
    $i_course = $i_course+1;
  }
  //var_dump($i_course);
  //var_dump($courses);
  $v = 0;
  $count_courses = count($courses);
  $count = 0;
  do {

    $c = array_rand($courses);
    //var_dump($c);
    $code_cours = $courses["$c"];

     if ($code_cours != NULL) {

      $sql2014 = "SELECT nbr_credit,code_cours_testing FROM tbl_cours WHERE code_cours = '$code_cours'";
      $res2014 = mysql_query($sql2014);
      $row = mysql_fetch_assoc($res2014);
      $code_cours_testing = $row['code_cours_testing'];
      $nbr_credit = $row['nbr_credit'];

      // var_dump($nb_crecit_inscri);
      // var_dump($nb_credit);
      // test si le nombre de credit attient
      if ($nb_crecit_inscri >= $nb_credit) {
        // Transfer
        // Transfer
        $letter_grade = 'T';
        $gpa = 0;
        // inscription
        $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
        WHERE code_inscription='$code_inscription'
        AND code_cours= '$code_cours'
        AND prefixe = '$prefixe'
        ";

        $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
        VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
        //var_dump($sql);
        @mysql_query($sql)or die ('Erreur :: inscription11');

        // creation de la fiche de notes
        $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
        letter_grade)
        value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
        '$letter_grade')";
        //var_dump($sql);
        @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
        $total_credit = $total_credit+$nbr_credit;
        $nb_transfer = $nb_transfer+$nbr_credit;
        $count = $count+1;
        unset($courses["$c"]);
      }else{
        // combien d'inscription de cours dans cette annee max 14
        $nb_cours = 0;
        $sql_student = "SELECT code_inscription,prefixe FROM tbl_etudiant_all as e where
        date_inscription>'2016-07-01' and
        e.archive != 5 and
        date_inscription < '$date1-07-31' and
        (
          graduation_date ='0000-00-00' or
          graduation_date ='0000-00-01' or
          graduation_date BETWEEN '$d1-09-01' AND '$date1-08-31'
        )
        ORDER BY e.code_inscription";
        //var_dump($sql_student);
        $req_student = mysql_query($sql_student);
        $nb_cours = 0;
        while ($row_s = mysql_fetch_assoc($req_student)) {
          $code_inscription_year = $row_s['code_inscription'];
          $prefixe_year = $row_s['prefixe'];
          // verification d'inscription
          $sql_ver = "SELECT COUNT(*) AS nbr FROM tbl_note_acc
          WHERE code_cours= '$code_cours' and code_inscription = '$code_inscription_year' and prefixe = '$prefixe'
          ";
          $req_ver = mysql_query($sql_ver);
          $row_ver = mysql_fetch_assoc($req_ver);
          $nb_ver = $row_ver['nbr'];
          if ($nb_ver != 0) {
            $nb_cours = $nb_cours+1;
          }
        }
        //var_dump($nb_cours);
        if ($nb_cours <= 14 and !in_array($code_cours,$default_transfer_courses)) {

          $final_exam = mt_rand(77, 100);
          $data = get_letter_grade($final_exam);
          //var_dump($data);
          $letter_grade = $data['letter_grade'];
          $gpa = $data['gpa'];
          // inscription
          $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
          WHERE code_inscription='$code_inscription'
          AND code_cours= '$code_cours'
          AND prefixe = '$prefixe'
          ";

          $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
          VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
          //var_dump($sql);
          @mysql_query($sql)or die ('Erreur :: inscription11');

          // creation de la fiche de notes
          $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
          letter_grade,final_exam,final_grade,gpa)
          value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
          '$letter_grade','$final_exam','$final_exam','$gpa')";
          //var_dump($sql);
          @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');

          $total_credit = $total_credit+$nbr_credit;
          $nb_crecit_inscri = $nb_crecit_inscri+$nbr_credit;
          $count = $count+1;
          unset($courses["$c"]);
        }else{
          // Transfer
          $letter_grade = 'T';
          $gpa = 0;
          // inscription
          $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
          WHERE code_inscription='$code_inscription'
          AND code_cours= '$code_cours'
          AND prefixe = '$prefixe'
          ";

          $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
          VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
          //var_dump($sql);
          @mysql_query($sql)or die ('Erreur :: inscription11');

          // creation de la fiche de notes
          $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
          letter_grade)
          value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
          '$letter_grade')";
          //var_dump($sql);
          @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
          $total_credit = $total_credit+$nbr_credit;
          $nb_transfer = $nb_transfer+$nbr_credit;
          $count = $count+1;
          unset($courses["$c"]);
        }
      }
    }

    //var_dump($count);
    //var_dump($i_course);
    // die();
    // inscription
  }while($count < $i_course);


  // die();


  // // half Credits
  // $half_course = (24-$total_credit)/2;
  //
  // $courses_half_credits = array('2102315','0800300','0800310');
  // if (is_float($half_course)) {
  //   $half_course = 1;
  // }
  //
  // $v = 0;
  // $count = 0;
  // do {
  //   $c = mt_rand(0,$c_n);
  //   $code_cours = $courses_half_credits["$c"];
  //   if ($code_cours != NULL) {
  //     if ($half_number != 0) {
  //       $sql2014 = "SELECT nbr_credit,code_cours_testing FROM tbl_cours WHERE code_cours = '$code_cours'";
  //       $res2014 = mysql_query($sql2014);
  //       $row = mysql_fetch_assoc($res2014);
  //       $code_cours_testing = $row['code_cours_testing'];
  //       $nbr_credit = $row['nbr_credit'];
  //       // combien d'inscription de cours dans cette annee max 14
  //
  //       $nb_cours = 0;
  //       $sql_student = "SELECT code_inscription,prefixe FROM tbl_etudiant_all as e where
  //       date_inscription>'2016-07-01' and
  //       e.archive != 5 and
  //       date_inscription < '$date1-07-31' and
  //       (
  //         graduation_date ='0000-00-00' or
  //         graduation_date ='0000-00-01' or
  //         graduation_date BETWEEN '$d1-09-01' AND '$date1-08-31'
  //       )
  //       ORDER BY e.code_inscription";
  //
  //       $req_student = mysql_query($sql_student);
  //       $nb_cours = 0;
  //       while ($row_s = mysql_fetch_assoc($req_student)) {
  //         $code_inscription_year = $row_s['code_inscription'];
  //         $prefixe_year = $row_s['prefixe'];
  //         // verification d'inscription
  //         $sql_ver = "SELECT COUNT(*) AS nbr FROM tbl_note_acc
  //         WHERE code_cours= '$code_cours' and code_inscription = '$code_inscription_year' and prefixe = '$prefixe'
  //         ";
  //         $req_ver = mysql_query($sql_ver);
  //         $row_ver = mysql_fetch_assoc($req_ver);
  //         $nb_ver = $row_ver['nbr'];
  //         if ($nb_ver != 0) {
  //           $nb_cours = $nb_cours+1;
  //         }
  //       }
  //
  //       if ($nb_cours <= 14 and !in_array($code_cours,$default_transfer_courses)) {
  //
  //         $final_exam = mt_rand(77, 100);
  //         $data = get_letter_grade($final_exam);
  //         //var_dump($data);
  //         $letter_grade = $data['letter_grade'];
  //         $gpa = $data['gpa'];
  //         // inscription
  //         $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
  //         WHERE code_inscription='$code_inscription'
  //         AND code_cours= '$code_cours'
  //         AND prefixe = '$prefixe'
  //         ";
  //
  //         $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
  //         VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
  //         var_dump($sql);
  //         echo "</br>";
  //         @mysql_query($sql)or die ('Erreur :: inscription11');
  //
  //         // creation de la fiche de notes
  //         $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
  //         letter_grade,final_exam,final_grade,gpa)
  //         value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
  //         '$letter_grade','$final_exam','$final_exam','$gpa')";
  //         var_dump($sql);
  //         echo "</br>";
  //         @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
  //
  //         $total_credit = $total_credit+$nbr_credit;
  //         $nb_crecit_inscri = $nb_crecit_inscri+$nbr_credit;
  //         $count=$count+1;
  //         unset($courses_half_credits["$c"]);
  //         $half_number = $half_number-1;
  //       }else{
  //         // Transfer
  //         $letter_grade = 'T';
  //         $gpa = 0;
  //         // inscription
  //         $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
  //         WHERE code_inscription='$code_inscription'
  //         AND code_cours= '$code_cours'
  //         AND prefixe = '$prefixe'
  //         ";
  //
  //         $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
  //         VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
  //         var_dump($sql);
  //         echo "</br>";
  //         @mysql_query($sql)or die ('Erreur :: inscription11');
  //
  //         // creation de la fiche de notes
  //         $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
  //         letter_grade)
  //         value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
  //         '$letter_grade')";
  //         var_dump($sql);
  //         echo "</br>";
  //         @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
  //         $total_credit = $total_credit+$nbr_credit;
  //         $nb_transfer = $nb_transfer+$nbr_credit;
  //         $nb_credit = $nb_credit+1;
  //         $count = $count+1;
  //         unset($courses_half_credits["$c"]);
  //
  //       }
  //     }else{
  //       // Transfer
  //       $letter_grade = 'T';
  //       $gpa = 0;
  //       // inscription
  //       $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_acc
  //       WHERE code_inscription='$code_inscription'
  //       AND code_cours= '$code_cours'
  //       AND prefixe = '$prefixe'
  //       ";
  //
  //       $sql = "INSERT INTO tbl_inscription_cours_acc (prefixe,`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
  //       VALUES ('$prefixe','$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
  //       // var_dump($sql);
  //       // echo "</br>";
  //       @mysql_query($sql)or die ('Erreur :: inscription11');
  //
  //       // creation de la fiche de notes
  //       $sql = "insert into tbl_note_acc (prefixe,code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,
  //       letter_grade)
  //       value('$prefixe','$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section',
  //       '$letter_grade')";
  //       // var_dump($sql);
  //       // echo "</br>";
  //       @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
  //       $total_credit = $total_credit+$nbr_credit;
  //       $nb_transfer = $nb_transfer+$nbr_credit;
  //       $nb_credit = $nb_credit+1;
  //       $count = $count+1;
  //       unset($courses_half_credits["$c"]);
  //
  //
  //     }
  //   }
  // }while ($count <= $half_course);



  echo "Transfer Credits :".$nb_transfer;
  echo "</br>";
  echo "total inscription Credits :".$nb_crecit_inscri;
  echo "</br>";
  echo "Total Credits :".$total_credit;
  echo "</br>";



}


















function get_letter_grade($final_grade){
  //var_dump($final_grade);
  $return = array();
  if (round($final_grade) <= 59 && $final_grade!=''){
    $letter_grade= 'F';
    $GPA=0;
  }
  if(isset($_POST['withdrawal']) and $_POST['withdrawal']=='withdrawal'){
    $mid_term = $project = $participation =  $final_grade = '';
    $letter_grade= 'W';
    $GPA= 0;
  }
  if ( round($final_grade) <= 63  &&  round($final_grade) >= 60  ){
    $letter_grade= 'D-';
    $GPA=0.67;
  }

  if ( round($final_grade) <= 66  &&  round($final_grade) >= 64 ){
    $letter_grade= 'D';
    $GPA=1;
  }

  if ( round($final_grade) <= 69  &&  round($final_grade) >= 67 ){
    $letter_grade= 'D+';
    $GPA=1.33;
  }

  if ( round($final_grade) <= 73  &&  round($final_grade) >= 70  ){
    $letter_grade= 'C-';
    $GPA=1.67;
  }

  if ( round($final_grade) <= 76  &&  round($final_grade) >= 74  ){
    $letter_grade= 'C';
    $GPA=2;
  }

  if ( round($final_grade) <= 79  &&  round($final_grade) >= 77  ){
    $letter_grade= 'C+';
    $GPA=2.33;
  }

  if (  round($final_grade) <= 83  &&  round($final_grade) >= 80  ){
    $letter_grade= 'B-';
    $GPA=2.67;
  }

  if (  round($final_grade) <= 86  &&  round($final_grade) >= 84  ){
    $letter_grade= 'B';
    $GPA=3;
  }

  if (  round($final_grade) <= 89  &&  round($final_grade) >= 87  ){
    $letter_grade= 'B+';
    $GPA=3.33;
  }

  if ( round($final_grade) <= 93  &&  round($final_grade) >= 90  ){
    $letter_grade= 'A-';
    $GPA=3.67;
  }

  if ( round($final_grade) <= 100  &&  round($final_grade) >= 94  ){
    $letter_grade= 'A';
    $GPA=4;
  }
  $return['letter_grade'] = $letter_grade;
  $return['gpa'] = $GPA;

  return $return;
}














?>
