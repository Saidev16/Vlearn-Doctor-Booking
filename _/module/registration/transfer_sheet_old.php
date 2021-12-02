<?php
// session_start();
// if(isset($_SESSION['admin_slat']) && $_SESSION['admin_slat']=="kfCCmRpl4r4r5r_irpm!ccWgDZ3S5qsAA9" && !empty($_SESSION['admin_token']) ){
//
// }else {
//     header("Location:../../console.php?erreur=intru");
// }


$bd="hisadm_hisdb";



$login="hisadm_hisusr";



$mdp="hispass11";



$serveur='127.0.0.1';



function connecter($serveur,$login,$mdp,$bd)

{

$connect = @mysql_connect($serveur,$login,$mdp);
mysql_query("SET NAMES 'utf8'", $connect);

if ( ! $connect )

die ('Failed to connect server vnc');

@mysql_select_db($bd, $connect) or die ('Database Select Failed');


}

connecter($serveur,$login,$mdp,$bd);
$code_inscription = $_GET['code_inscrition'];
$prefixe = $_GET['prefixe'];
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

// information student
$table_etudiant_sql = $table_etudiant["$prefixe"];
$table_note_sql = $table_note["$prefixe"];
$table_inscription_sql = $table_inscription["$prefixe"];

$sql = "SELECT * FROM $table_etudiant_sql WHERE `code_inscription` = $code_inscription";

$req = mysql_query($sql) or die("SQL ERROR");
$row = mysql_fetch_assoc($req);
$student_name = ucfirst($row['prenom']." ".$row['nom']);

$ttl_tr = 0;
$ttl_en = 0;

$lanaguages = "''";
$electives = "''";

      $html = "
      <img src='../../images/t_logo.png' style='text-align:center;margin-bottom:10px;width:1041px;height:145px;' />
      <h2 style='text-align:center;font-size: 15px;color: #a93612;margin-bottom:8px'>Transcript Evaluation Record</h2>
      <h2 style='text-align:center;font-size: 15px;margin-bottom:5px'>Student Name: $student_name</h2>
      <h2 style='text-align:center;font-size: 15px;margin-bottom:5px'>Date of Evaluation: ".date('m-d-Y')." </h2>
        ";
      $html .="<table style='width: 100%;
          margin-bottom: 1rem;
          color: #212529;
          border-collapse: collapse;
          border: 1px solid #dee2e6;
          '>
          <tr>
            <th style='padding:5px;border: 1px solid #dee2e6;' colspan='2'>Grade : 9th</th>
            <th style='padding:5px;border: 1px solid #dee2e6;' colspan='2'>1 year courses</th>
          </tr>
          <tr>
            <th style='padding:5px;border: 1px solid #dee2e6;'>Code cours</th>
            <th style='padding:5px;border: 1px solid #dee2e6;text-align:left;' >Title</th>
            <th style='padding:5px;border: 1px solid #dee2e6;'>Cr</th>
            <th style='padding:5px;border: 1px solid #dee2e6;'>Grade</th>
          </tr>";

          $grade = 9;
          $lanaguages = "''";
          $electives = "''";
          $electives_select = "''";
          $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE `tr_partner` = 1 and `grade`= $grade";
          $req = mysql_query($sql) or die("SQL ERROR");
          while($row = mysql_fetch_assoc($req)){
            $code_cours = $row['code_cours'];

            $class = str_replace("/","_",$row['code_cours']);
            $type = "";

            // verify if the cours is tr or enrolled
            $sql_v = "SELECT code_note,letter_grade,idSession FROM $table_note_sql
            WHERE code_inscription='$code_inscription'
            AND code_cours= '$code_cours'";
            $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
            $row_v = mysql_fetch_assoc($req_v);
            $letter_grade = $row_v['letter_grade'];
            $idSession = $row_v['idSession'];
            $code_note = $row_v['code_note'];
            if ($letter_grade != null) {
              if ($letter_grade == "T") {
                $ttl_tr=$ttl_tr+$row['nbr_credit'];
                $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
              }else{
                $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                $ttl_en=$ttl_en+$row['nbr_credit'];
              }
            }
            $html .="<tr>
              <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
              <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >".$row['titre_eng']."</td>
              <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
              <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
            </tr>
            ";
          }

                // verify if the cours is tr or enrolled Language courses
                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (1,3) and `nbr_credit` = 1 and code_cours not in ($lanaguages))";
                //var_dump($sql_v);
                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_language = $row_v['code_cours'];
                $code_note = $row_v['code_note'];
                //var_dump($code_cours_language);
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $type = 0;

                if ($code_cours_language != null) {
                  $lanaguages .= ",'$code_cours_language'";
                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_language'";
                  //var_dump($sql);
                  $req  = @mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }
                  $html .= "
                  <tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['titre_eng']."
                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
                  </tr>";
                }
                // verify if the cours is tr or enrolled Language courses
                $other_language = 0;

                $sql_v = "SELECT count(*) as nb FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (2,3))  and code_cours in ('100990-S1/2','100990')";

                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $other_language = $row_v['nb'];

                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (2,3) and `nbr_credit` = 1 and code_cours not in ($electives))";

                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_elective = $row_v['code_cours'];
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $code_note = $row_v['code_note'];

                if ($code_cours_elective != null) {

                  if ($code_cours_elective != "100990-S1/2" && $code_cours_elective != "100990") {
                    $electives .= ",'$code_cours_elective'";
                    $electives_select .= ",'$code_cours_elective'";
                  }


                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective'";
                  $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }

                  $html .="
                  <tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['titre_eng']."
                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
                  </tr>";

                  if ($code_cours_elective == "100990-S1/2"or $code_cours_elective == "100990") {

                    $other_language = $other_language-1;

                    //var_dump($other_language);
                    if ($other_language == 0) {
                      $electives .= ",'$code_cours_elective'";
                    }
                  }

                }


        $html .="</table>";
        // 10th
          $html .= "<table style='width: 100%;
              margin-bottom: 1rem;
              color: #212529;
              border-collapse: collapse;
              border: 1px solid #dee2e6;
              '>
            <tr>
              <th style='padding:5px;border: 1px solid #dee2e6;' colspan='2'>Grade : 10th</th>
              <th style='padding:5px;border: 1px solid #dee2e6;' colspan='2'>1 year courses</th>
            </tr>
            <tr>
              <th style='padding:5px;border: 1px solid #dee2e6;'>Code cours</th>
              <th style='padding:5px;border: 1px solid #dee2e6;text-align:left;' >Title</th>
              <th style='padding:5px;border: 1px solid #dee2e6;'>Cr</th>
              <th style='padding:5px;border: 1px solid #dee2e6;'>Grade</th>
            </tr>";

                $grade = 10;
                $type = 0;
                $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE `tr_partner` = 1 and `grade`= $grade";
                $req = mysql_query($sql) or die("SQL ERROR");
                while($row = mysql_fetch_assoc($req)){
                  $code_cours = $row['code_cours'];

                  $class = str_replace("/","_",$row['code_cours']);
                  $type = "";

                  // verify if the cours is tr or enrolled
                  $sql_v = "SELECT code_note,letter_grade,idSession FROM $table_note_sql
                  WHERE code_inscription='$code_inscription'
                  AND code_cours= '$code_cours'";
                  $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                  $row_v = mysql_fetch_assoc($req_v);
                  $letter_grade = $row_v['letter_grade'];
                  $idSession = $row_v['idSession'];
                  $code_note = $row_v['code_note'];
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                    }else{
                      $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }

                  $html .= "<tr>
                      <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                      <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >".$row['titre_eng']."</td>
                      <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                      <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
                    </tr>";
                }

                $type = 0;
                // verify if the cours is tr or enrolled Language courses
                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (1,3) and `nbr_credit` = 1) and code_cours not in ($lanaguages)";
                //var_dump($sql_v);
                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_language = $row_v['code_cours'];

                //var_dump($code_cours_language);
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $code_note = $row_v['code_note'];


                if ($code_cours_language != null) {

                  $lanaguages .= ",'$code_cours_language'";
                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_language'";
                  //var_dump($sql);
                  $req  = @mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }
                  $html .= "<tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['titre_eng']."
                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$letter_grade."</td>
                  </tr>";
                }
                // verify if the cours is tr or enrolled Language courses


                $type = 0;
                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (2,3))  and code_cours not in ($electives)";
                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_elective = $row_v['code_cours'];
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $code_note = $row_v['code_note'];

                if ($code_cours_elective != null) {

                  if ($code_cours_elective != "100990-S1/2" and $code_cours_elective != "100990") {
                    $electives .= ",'$code_cours_elective'";
                    $electives_select .= ",'$code_cours_elective'";
                  }

                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective'";
                  $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }

                  $html .="<tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['titre_eng']."
                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$letter_grade."</td>
                  </tr>";

                  if ($code_cours_elective == "100990-S1/2" or $code_cours_elective == "100990") {
                    $other_language = $other_language - 1;
                    if ($other_language == 0) {
                      $electives .= ",'$code_cours_elective'";
                    }
                  }

                }


              $html .="</table>";

              $html .="<table style='width: 100%;
                  margin-bottom: 1rem; color: #212529;
                  border-collapse: collapse;
                  border: 1px solid #dee2e6;
                  '>
                <tr>
                  <th style='padding:5px;border: 1px solid #dee2e6;' colspan='2'>Grade : 11th</th>
                  <th style='padding:5px;border: 1px solid #dee2e6;' colspan='2'>1 year courses</th>
                </tr>
                <tr>
                  <th style='padding:5px;border: 1px solid #dee2e6;'>Code cours</th>
                  <th style='padding:5px;border: 1px solid #dee2e6;text-align:left;' >Title</th>
                  <th style='padding:5px;border: 1px solid #dee2e6;'>Cr</th>
                  <th style='padding:5px;border: 1px solid #dee2e6;'>Grade</th>
                </tr>";

                $grade = 11;
                $type = 0;
                $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE `tr_partner` = 1 and `grade`= $grade";
                $req = mysql_query($sql) or die("SQL ERROR");
                while($row = mysql_fetch_assoc($req)){
                  $code_cours = $row['code_cours'];

                  $class = str_replace("/","_",$row['code_cours']);
                  $type = "";

                  // verify if the cours is tr or enrolled
                  $sql_v = "SELECT code_note,letter_grade,idSession FROM $table_note_sql
                  WHERE code_inscription='$code_inscription'
                  AND code_cours= '$code_cours'";
                  $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                  $row_v = mysql_fetch_assoc($req_v);
                  $letter_grade = $row_v['letter_grade'];
                  $idSession = $row_v['idSession'];
                  $code_note = $row_v['code_note'];
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                    }else{
                      $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }

                  $html .= "<tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >".$row['titre_eng']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
                  </tr>";

                }


                // verify if the cours is tr or enrolled Language courses
                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (1,3) and `nbr_credit` = 1 and code_cours not in ($lanaguages))";
                //var_dump($sql_v);
                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_language = $row_v['code_cours'];
                $code_note = $row_v['code_note'];
                //var_dump($code_cours_language);
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $type = 0;

                if ($code_cours_language != null) {
                  $lanaguages .= ",'$code_cours_language'";
                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_language'";
                  //var_dump($sql);
                  $req  = @mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }
                  $html .= "
                  <tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['titre_eng']."
                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
                  </tr>";
                }

                $type = 0;
                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (2,3))  and code_cours not in ($electives)";
                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_elective = $row_v['code_cours'];
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $code_note = $row_v['code_note'];

                if ($code_cours_elective != null) {

                  if ($code_cours_elective != "100990-S1/2" and $code_cours_elective != "100990") {
                    $electives .= ",'$code_cours_elective'";
                    $electives_select .= ",'$code_cours_elective'";
                  }

                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective'";
                  $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }

                  // $html .= "<tr>
                  //   <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >Electives</td>
                  //   <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >".$row['code_cours']." / ".$row['titre_eng']."</td>
                  //   <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                  //   <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$letter_grade."</td>
                  // </tr>";

                  $html .= "<tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['titre_eng']."
                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$letter_grade."</td>
                  </tr>";

                  if ($code_cours_elective == "100990-S1/2" or $code_cours_elective == "100990") {
                    $other_language = $other_language - 1;
                    if ($other_language == 0) {
                      $electives .= ",'$code_cours_elective'";
                    }
                  }

                }


                $type = 0;
                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (2,3))  and code_cours not in ($electives)";
                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_elective = $row_v['code_cours'];
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $code_note = $row_v['code_note'];

                if ($code_cours_elective != null) {

                  if ($code_cours_elective != "100990-S1/2" and $code_cours_elective != "100990") {
                    $electives .= ",'$code_cours_elective'";
                    $electives_select .= ",'$code_cours_elective'";
                  }

                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective'";
                  $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }

                  $html .="<tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['titre_eng']."
                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>

                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$letter_grade."</td>

                  </tr>";
                  if ($code_cours_elective == "100990-S1/2" or $code_cours_elective == "100990") {
                    $other_language = $other_language - 1;
                    if ($other_language == 0) {
                      $electives .= ",'$code_cours_elective'";
                    }
                  }

                }

                $html .= "</table>";
        // 12th
          $html .= "<table style='width: 100%;
              margin-bottom: 1rem;
              color: #212529;
              border-collapse: collapse;
              border: 1px solid #dee2e6;
              '>
            <tr>
              <th style='padding:5px;border: 1px solid #dee2e6;' colspan='2'>Grade : 12th</th>
              <th style='padding:5px;border: 1px solid #dee2e6;' colspan='2'>1 year courses</th>
            </tr>
            <tr>
              <th style='padding:5px;border: 1px solid #dee2e6;'>Code cours</th>
              <th style='padding:5px;border: 1px solid #dee2e6;text-align:left;' >Title</th>
              <th style='padding:5px;border: 1px solid #dee2e6;'>Cr</th>
              <th style='padding:5px;border: 1px solid #dee2e6;'>Grade</th>
            </tr>";


                $grade = 12;
                $type = 0;
                $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE `tr_partner` = 1 and `grade`= $grade";
                $req = mysql_query($sql) or die("SQL ERROR");
                while($row = mysql_fetch_assoc($req)){
                  $code_cours = $row['code_cours'];

                  $class = str_replace("/","_",$row['code_cours']);
                  $type = "";

                  // verify if the cours is tr or enrolled
                  $sql_v = "SELECT code_note,letter_grade,idSession FROM $table_note_sql
                  WHERE code_inscription='$code_inscription'
                  AND code_cours= '$code_cours'";
                  $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                  $row_v = mysql_fetch_assoc($req_v);
                  $letter_grade = $row_v['letter_grade'];
                  $idSession = $row_v['idSession'];
                  $code_note = $row_v['code_note'];
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                    }else{
                      $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }
                  $html .= "<tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >".$row['titre_eng']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$letter_grade."</td>
                  </tr>";

                }
                // verify if the cours is tr or enrolled Language courses

                // verify if the cours is tr or enrolled Language courses
                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (1,3) and `nbr_credit` = 1 and code_cours not in ($lanaguages))";
                //var_dump($sql_v);
                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_language = $row_v['code_cours'];
                $code_note = $row_v['code_note'];
                //var_dump($code_cours_language);
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $type = 0;

                if ($code_cours_language != null) {
                  $lanaguages .= ",'$code_cours_language'";
                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_language'";
                  //var_dump($sql);
                  $req  = @mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }
                  // $html .= "
                  // <tr>
                  //   <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >Language</td>
                  //   <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                  //     ".$row['code_cours']." / ".$row['titre_eng']."
                  //   </td>
                  //   <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                  //   <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
                  // </tr>";
                  $html .= "
                  <tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['titre_eng']."
                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
                  </tr>";
                }

                $type = 0;
                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (2,3))  and code_cours not in ($electives)";
                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_elective = $row_v['code_cours'];
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $code_note = $row_v['code_note'];

                if ($code_cours_elective != null) {

                  if ($code_cours_elective != "100990-S1/2" and $code_cours_elective != "100990") {
                    $electives .= ",'$code_cours_elective'";
                    $electives_select .= ",'$code_cours_elective'";
                  }

                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective'";
                  $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }

                  $html .="<tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['titre_eng']."
                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$letter_grade."</td>
                  </tr>";
                  if ($code_cours_elective == "100990-S1/2" or $code_cours_elective == "100990") {
                    $other_language = $other_language - 1;
                    if ($other_language == 0) {
                      $electives .= ",'$code_cours_elective'";
                    }
                  }

                }
                // verify if the cours is tr or enrolled Language courses


                $type = 0;
                $sql_v = "SELECT code_note,code_cours,letter_grade,idSession FROM $table_note_sql
                WHERE code_inscription='$code_inscription'
                AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
                `type` in (2,3))  and code_cours not in ($electives)";
                $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
                $row_v = mysql_fetch_assoc($req_v);
                $code_cours_elective = $row_v['code_cours'];
                $letter_grade = $row_v['letter_grade'];
                $idSession = $row_v['idSession'];
                $code_note = $row_v['code_note'];

                if ($code_cours_elective != null) {

                  if ($code_cours_elective != "100990-S1/2" and $code_cours_elective != "100990") {
                    $electives .= ",'$code_cours_elective'";
                    $electives_select .= ",'$code_cours_elective'";
                  }

                  // course info
                  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective'";
                  $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
                  $row = mysql_fetch_assoc($req);
                  $class = str_replace("/","_",$row['code_cours']);
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    $ttl_tr_y=$ttl_tr_y+$row['nbr_credit'];
                  }else{
                    $ttl_en_y=$ttl_en_y+$row['nbr_credit'];
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }

                  $html .="<tr>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >Electives</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >
                      ".$row['code_cours']." / ".$row['titre_eng']."

                    </td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                    <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$letter_grade."</td>
                  </tr>";
                  if ($code_cours_elective == "100990-S1/2" or $code_cours_elective == "100990") {
                    $other_language = $other_language - 1;
                    if ($other_language == 0) {
                      $electives .= ",'$code_cours_elective'";
                    }
                  }

                }

          $html .="</table>";
          $html .="<table style='width: 100%;
              margin-bottom: 1rem;
              color: #212529;
              border-collapse: collapse;
              border: 1px solid #dee2e6;
              '>
            <tr>
              <td style='padding:5px;border: 1px solid #dee2e6;text-align:right;' colspan='3'>Total Transfer credits</td>
              <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;'  colspan='1'>
                $ttl_tr Cr
              </td>
            </tr>
            <tr>
              <td style='padding:5px;border: 1px solid #dee2e6;text-align:right;' colspan='3'>Total Enrolled credits</td>
              <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;'  colspan='1'>
                $ttl_en Cr
              </td>
            </tr>
          </table>";

          // echo $html;
          // die();
          require_once '../../administrator/mpdf/vendor/autoload.php';

          $mpdf = new mPDF('c','A4','','',10,10,10,25,16,13);

          $mpdf->SetDisplayMode('fullpage');

          $mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

          // LOAD a stylesheet
          $stylesheet = file_get_contents('styletable.css');
          $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

          $mpdf->WriteHTML($html,2);

          $mpdf->Output('mpdf.pdf','I');


          // }else{
          //     echo "You don't have Permission please contact Administration, Thank you.";
          // }
      // }

      // <style>
      //
      // .table {
      //     width: 100%;
      //     margin-bottom: 1rem;
      //     color: #212529;
      // }
      // table {
      //     border-collapse: collapse;
      // }
      // .table-bordered {
      //     border: 1px solid #dee2e6;
      // }
      // .table-bordered thead td, .table-bordered thead th {
      //     border-bottom-width: 2px;
      // }
      // .table thead th {
      //     vertical-align: bottom;
      //     border-bottom: 2px solid #dee2e6;
      // }
      // .table-bordered td, .table-bordered th {
      //     border: 1px solid #dee2e6;
      // }
      // .table td, .table th {
      //     padding: .75rem;
      //     vertical-align: top;
      //     border-top: 1px solid #dee2e6;
      // }
      //
      // </style>

    ?>
