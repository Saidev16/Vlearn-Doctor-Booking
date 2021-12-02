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

// information student
$table_etudiant_sql = 'tbl_etudiant_all';
$table_note_sql = 'tbl_note_acc';//$table_note["$prefixe"];
$table_inscription_sql = 'tbl_inscription_cours_acc';//$table_inscription["$prefixe"];

$sql_student = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, e.cin,e.tel,e.email,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
FROM tbl_etudiant_all as e , registration_academic as r
where
e.`code_inscription` = r.code_inscription and
e.`prefixe` = r.prefixe  and
e.new_transcript=1
and e.code_inscription in (300,268,298,295)
and e.prefixe = 'MOR'
and e.archive in (0,1)
ORDER BY name";
$sql_student = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, e.cin,e.tel,e.email,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
FROM tbl_etudiant_all as e
where
e.new_transcript=1
and e.code_inscription in (383,379)
and e.prefixe = 'BF'
and e.archive in (0,1,2)
ORDER BY name";
//var_dump($sql_student);
$req_student = mysql_query($sql_student) or die("SQL ERROR");
$html = "";
while ($row_student = mysql_fetch_assoc($req_student)) {
    $code_inscription = $row_student['code_inscription'];
    $prefixe = $row_student['prefixe'];
    $student_name = ucfirst($row_student['name']);
    $create = 0;
    // if ($prefixe == 'MOR' && $code_inscription == 268) {
    //   $create = 1;
    // }
    // if ($prefixe == 'MOR' && $code_inscription == 295) {
    //   $create = 1;
    // }
    // if ($prefixe == 'MOR' && $code_inscription == 300) {
    //   $create = 1;
    // }
    //
    // if ($prefixe == 'BF' && $code_inscription == 379) {
    //   $create = 1;
    // }
    if ($create == 0) {
        $ttl_tr = 0;
        $ttl_en = 0;

        // <h2>$code_inscription</h2>
        // <h2>$prefixe</h2>
          $html .= "
          <img src='../../images/t_logo.png' style='text-align:center;margin-bottom:5px;width:900px' />
          <h2 style='text-align:center;font-size: 15px;color: #a93612;margin-bottom:8px'>Transcript Evaluation Record</h2>
          <h2 style='text-align:center;font-size: 15px;margin-bottom:10px'>Student Name: $student_name</h2>


            ";
          //<h2 style='text-align:center;font-size: 15px;margin-bottom:5px'>Date of Evaluation: ".date('m-d-Y')." </h2>
          $html .="<table style='width: 100%;

              color: #212529;
              border-collapse: collapse;
              border: 1px solid #dee2e6;
              '>
              <tr>
                <th style='padding:5px;border: 1px solid #dee2e6;'>Code cours</th>
                <th style='padding:5px;border: 1px solid #dee2e6;text-align:left;' >Title</th>
                <th style='padding:5px;border: 1px solid #dee2e6;'>Cr</th>
                <th style='padding:5px;border: 1px solid #dee2e6;'>Grade</th>
              </tr>";
              $sql = "SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, n.IdSession, n.code_cours_testing FROM
              tbl_note_acc AS n, tbl_cours AS c WHERE
              c.code_cours = n.code_cours
              AND code_inscription = '$code_inscription'
              and n.archive = 0
              and n.letter_grade = 'T'
              and n.prefixe = '$prefixe'
              order by c.ordering ASC";
              //var_dump($sql);

              //c.ordering ASC
              $req = mysql_query($sql) or die("SQL ERROR");
              while($row = mysql_fetch_assoc($req)){
                $letter_grade = $row['letter_grade'];
                if ($letter_grade != 'T') {
                  $letter_grade = 'X';
                  $ttl_en = $ttl_en+$row['nbr_credit'];
                }else{
                  $ttl_tr = $ttl_tr+$row['nbr_credit'];
                }
                $html .="<tr>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >".$row['titre']."</td>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
                </tr>
                ";
              }
              $sql = "SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, n.IdSession, n.code_cours_testing FROM
              tbl_note_acc AS n, tbl_cours AS c WHERE
              c.code_cours = n.code_cours
              AND code_inscription = '$code_inscription'
              AND n.archive = 0
              AND n.prefixe = '$prefixe'
              AND n.letter_grade != 'T'
              order by c.ordering ASC";
              //c.ordering ASC
              $req = mysql_query($sql) or die("SQL ERROR");
              while($row = mysql_fetch_assoc($req)){
                $letter_grade = $row['letter_grade'];
                if ($letter_grade != 'T') {
                  $letter_grade = 'X';
                  $ttl_en = $ttl_en+$row['nbr_credit'];
                }else{
                  $ttl_tr = $ttl_tr+$row['nbr_credit'];
                }
                $html .="<tr>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['code_cours']."</td>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:left;'  >".$row['titre']."</td>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >".$row['nbr_credit']."</td>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:center;' >$letter_grade</td>
                </tr>
                ";
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
        }
}
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
