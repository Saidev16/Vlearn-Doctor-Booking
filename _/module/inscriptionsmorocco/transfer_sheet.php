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

    //get information

    $exist = "";
    //if (isset($_GET['code_inscription']) && isset($_GET['prefixe']) && isset($_GET['u']) && $_GET['code_inscription'] != "" && $_GET['prefixe'] != "" && $_GET['u'] != "") {

        // admin exist or no
        // $user_id = $_SESSION['admin_id_user'];
        // $sql = "SELECT * FROM `tbl_admin` WHERE `id` = $user_id";
        // $res= @mysql_query($sql) or die('Erreur :: Student information');
        // $row = @mysql_fetch_assoc($res);
        // $exist = $row['id'];
        // if ($exist != "") {
            $code_inscription = $_GET['transfer_sheet'];
            $prefixe = $_GET['prefixe'];
              $table='tbl_etudiant_morocco';
              $table_note='tbl_note_morocco';
            // if($prefixe=='MOR')
            // {
            //   $table='tbl_etudiant';
            //   $table_note='tbl_note_psi';
            // }
            // else  if($prefixe=='AUPA')
            // {
            //   $table='tbl_etudiant_Algeria';
            //   $table_note='tbl_note_Algeria';
            // }
            // else if($prefixe=='AUL')
            // {
            //   $table='tbl_etudiant_eng';
            //   $table_note='tbl_note';
            // }
            // else if($prefixe=='AUPBN')
            // {
            //   $table='tbl_etudiant_benin';
            //   $table_note='tbl_note_benin';
            // }
            // else if($prefixe=='AUPL')
            // {
            //   $table='tbl_etudiant_Libya';
            //   $table_note='tbl_note_Libya';
            // }

          $courses = array("CIS 100","COM 101","COM 102","COM 200","COM 300","ECO 100","ECO 200","ENC 101","ENC 102","ENC 201","ENC 202","LDR 200","MAT 100","PSY 100","STA 102","ACCT 100","ACCT 200","BUL 100","CIS 300","FIN 100","FIN 200","FIN 300","GEB 100","GEB 300","GEB 356","ISM 300","MAN 100","MAN 200","MAN 300","MAN 305","MAR 100","MAR 200","STA 300","GEB 400");

          $sql = "select * from $table where code_inscription = $code_inscription";

          $query = mysql_query($sql);
          $row = mysql_fetch_assoc($query);

          $name = trim($row['nom']." ".$row['prenom']);
          // parameters code_inscrition && prefixe

          // <tr>
          //   <th scope="col" style="padding:5px;text-align:center;">Code</th>
          //   <th scope="col" style="padding:5px;text-align:center;">Course Title</th>
          //   <th scope="col" style="padding:5px;text-align:center;">Transfer</th>
          //   <th scope="col" style="padding:5px;text-align:center;">Pre-Req</th>
          //   <th scope="col" style="padding:5px;text-align:center;">Original Course (Non-MOU Only)</th>
          // </tr>


          $html = '
          <img src="../../images/t_logo.png" style="text-align:center;margin-bottom:10px;width:1041px;height:145px;" />
          <h2 style="text-align:center;font-size: 15px;color: #a93612;margin-bottom:8px">Transcript Evaluation Record</h2>
          <h2 style="text-align:center;font-size: 15px;margin-bottom:5px">Evaluator Name: '.$name.'</h2>
          <h2 style="text-align:center;font-size: 15px;margin-bottom:5px">Date of Evaluation: '.date("Y-m-d").' </h2>
          <table style="width: 100%;
          margin-bottom: 1rem;
          color: #212529;
          border-collapse: collapse;
          border: 1px solid #dee2e6;
          ">

            <tbody>
            <tr>
              <td colspan="1" style="padding:5px;border: 1px solid #dee2e6;">Legend</td>
              <td colspan="2" style="padding:5px;border: 1px solid #dee2e6;"></td>
            </tr>
            ';
              $sql5 = "SELECT c.code_cours, c.titre ,c.nbr_credit,c.grade,n.letter_grade FROM `tbl_note_morocco` as n , tbl_etudiant_morocco as e, tbl_cours as c WHERE
              e.code_inscription = n.`code_inscription` and n.code_inscription = $code_inscription and c.code_cours = n.code_cours group by c.grade  order by c.grade";

              $req5 = mysql_query($sql5)or die("Error sql");
              $tt_credits = 0;
              while ($row5 = mysql_fetch_assoc($req5)) {
              $grade = $row5['grade'];
              $html .= "
              <tr>
                <td colspan='3' scope='col' style='padding:5px;text-align:center;border: 1px solid #dee2e6;'>".$grade."TH Grade</td>
              </tr>
              <tr>
                <td style='padding:5px;border: 1px solid #dee2e6;'>Title</td>
                <td style='padding:5px;border: 1px solid #dee2e6;text-align:center'>Cr</td>
                <td style='padding:5px;border: 1px solid #dee2e6;text-align:center'>Transfer</td>
              </tr>
              ";
              $sql4 = "SELECT c.code_cours, c.titre ,c.nbr_credit,c.grade,n.letter_grade FROM `tbl_note_morocco` as n , tbl_etudiant_morocco as e, tbl_cours as c WHERE
              e.code_inscription = n.`code_inscription` and n.code_inscription = $code_inscription and c.grade = $grade and c.code_cours = n.code_cours  order by c.grade,c.titre";

              $req4 = mysql_query($sql4)or die("Error sql");
              $tt_credits_grade = 0;

              while ($row4 = mysql_fetch_assoc($req4)) {
                $code_cours = $row4['code_cours'];
                $title = $row4['titre'];
                $cr = $row4['nbr_credit'];
                $grade = $row4['grade'];
                $letter_grade = $row4['letter_grade'];
                $transfer = "NO";

                if ($letter_grade == 'T') {
                  $transfer = "YES";
                  $tt_credits_grade += $cr;
                  $tt_credits += $cr;
                }
                $html .="
                <tr>
                  <td style='padding:5px;border: 1px solid #dee2e6;'>$title</td>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:center'>$cr</td>
                  <td style='padding:5px;border: 1px solid #dee2e6;text-align:center'>$transfer</td>
                </tr>
                ";
              }
              $html .= "
                <tr>
                  <td colspan='2' style='padding:5px;border: 1px solid #dee2e6;text-align:right'>Grade Total $grade th Credits Transferred</td>
                  <td colspan='1' style='padding:5px;border: 1px solid #dee2e6;text-align:center'>$tt_credits_grade Cr</td>
                </tr>
              ";

            }
          $html .='
            <tr>
              <td colspan="2" style="padding:5px;border: 1px solid #dee2e6;text-align:right">TOTAL Credits</td>
              <td colspan="1" style="padding:5px;border: 1px solid #dee2e6;text-align:center"> '.$tt_credits.' Cr</td>
            </tr>

          </tbody>
          </table>
          ';
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
