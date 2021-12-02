<?php
if (isset($_GET["resultat_excel"]) or isset($_GET["resultat_excel_mba"]) or isset($_GET["resultat_excel_dba"])) {
    $name = $_GET['name'];
    //var_dump($name);
    header('Content-type: application/xls');
    header("Content-Disposition: attachment; filename=$name.xls");
}
include("secure.php");
include("../include/fonctions.inc.php");
?>
<?php if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ADMINISTRATION -- SURVEYS MANAGEMENT --</title>
<?php if (!isset($_GET['resultat_excel'])  && !isset($_GET["resultat_excel_mba"]) && !isset($_GET["resultat_excel_dba"])): ?>
  <link rel="shortcut icon" href="images/icone.gif" />
  <link rel="stylesheet" type="text/css" href="css/global.css">
  <link rel="stylesheet" type="text/css" href="css/print.css" media="print">
  <!-- <link rel="stylesheet" href="../js/stu-prof/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
  <link rel="stylesheet" href="../css/stu-prof/font-icons/entypo/css/entypo.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
  <!-- <link rel="stylesheet" href="../css/stu-prof/bootstrap.css">
  <link rel="stylesheet" href="../css/stu-prof/neon-core.css">
  <link rel="stylesheet" href="../css/stu-prof/neon-theme.css">
  <link rel="stylesheet" href="../css/stu-prof/neon-forms.css">
  <link rel="stylesheet" href="../css/stu-prof/custom.css">
  <link rel="stylesheet" href="../css/stu-prof/blue.css">
  <link rel="stylesheet" href="../js/stu-prof/vertical-timeline/css/component.css">
  <link rel="stylesheet" href="../js/stu-prof/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

  <script src="../js/stu-prof/jquery-1.11.0.min.js"></script>
<?php endif ?>

</head>
<body>


  <?php if (!isset($_GET['resultat_excel'])  && !isset($_GET["resultat_excel_mba"]) && !isset($_GET["resultat_excel_dba"])): ?>
      <div id="container">
        <?php require 'includes/main_menu.php'; ?>
          <div id="banner">
          Login:
          <?php echo (isset($_SESSION['login'])) ? $_SESSION['login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
          <br><a href="deconexion.php">Déconnexion</a>&nbsp;&nbsp;&nbsp;
          </div>
              <div id="content">
                <table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%" >
        <tr>
          <td valign="top" >
  <?php endif ?>
<?php endif ?>

  <?php

    if(isset($_GET["new_sondage"])){
        include("../module/surveys/sondage/ajouter.php");
      }else  if(isset($_GET["add_prof"])){
        include("../module/surveys/affectation/add_prof.php");
      }else  if(isset($_GET["edit_affictaion"])){
        include("../module/surveys/affectation/modifier.php");
      }else  if(isset($_GET["resultat_by_prof"])){
        include("../module/surveys/resultat/resultat_by_prof.php");
      }else  if(isset($_GET["resultat_excel"])){
        include("../module/surveys/resultat/resultat_excel.php");
      }else  if(isset($_GET["resultat_excel_mba"])){
        include("../module/surveys/resultat/resultat_excel_mba.php");
      }else  if(isset($_GET["resultat_excel_dba"])){
        include("../module/surveys/resultat/resultat_excel_dba.php");
      }else  if(isset($_GET["resultat_etudiant"])){
        include("../module/surveys/resultat/resultat_etudiant.php");
      }else  if(isset($_GET["activer_affectation"])){
        include("../module/surveys/affectation/archive.php");
      }else  if(isset($_GET["desactiver_affectation"])){
        include("../module/surveys/affectation/archive.php");
      }else  if(isset($_GET["list_affectation"])){
        include("../module/surveys/affectation/index.php");
      }else  if(isset($_GET["surveys_results"])){
        include("../module/surveys/resultat/surveys_results.php");
      }else  if(isset($_GET["surveys_results_dba"])){
        include("../module/surveys/resultat/surveys_results_dba.php");
      }else  if(isset($_GET["surveys_results_mba"])){
        include("../module/surveys/resultat/surveys_results_mba.php");
      }else  if(isset($_GET["new_affectation"])){
        include("../module/surveys/affectation/ajouter.php");
      }else  if(isset($_GET["edit_sondage"])){
        include("../module/surveys/sondage/modifier.php");
      }else  if(isset($_GET["activer_sondage"])){
        include("../module/surveys/sondage/statut.php");
      }else  if(isset($_GET["desactiver_sondage"])){
        include("../module/surveys/sondage/statut.php");
      }else  if(isset($_GET["new_question"])){
        include("../module/surveys/question/ajouter.php");
      }else  if(isset($_GET["edit_question"])){
        include("../module/surveys/question/modifier.php");
      }else  if(isset($_GET["list_question"])){
        include("../module/surveys/question/index.php");
      }else  if(isset($_GET["activer_question"])){
        include("../module/surveys/question/statut.php");
      }else  if(isset($_GET["desactiver_question"])){
        include("../module/surveys/question/statut.php");
      }else  if(isset($_GET["response_list"])){
        include("../module/surveys/reponse/index.php");
      }else  if(isset($_GET["new_response"])){
        include("../module/surveys/reponse/ajouter.php");
      }else  if(isset($_GET["edit_response"])){
        include("../module/surveys/reponse/modifier.php");
      }else  if(isset($_GET["activer_response"])){
        include("../module/surveys/reponse/statut.php");
      }else  if(isset($_GET["desactiver_response"])){
        include("../module/surveys/reponse/statut.php");
      }else  if(isset($_GET["detail"])){
        include("../module/surveys/detail.php");
      }else  if(isset($_GET["recu"])){
        include("../module/surveys/recu.php");
      }else  if(isset($_GET["cofirm"])){
        include("../module/surveys/confirm.php");
      }else  if(isset($_GET["admin_alumni"])){
        include("../module/surveys/alumni/questions/index.php");
      }else  if(isset($_GET["admin_alumni_add"])){
        include("../module/surveys/alumni/questions/ajouter.php");
      }else  if(isset($_GET["admin_alumni_modifier"])){
        include("../module/surveys/alumni/questions/modifier.php");
      }else  if(isset($_GET["admin_alumni_statut"])){
        include("../module/surveys/alumni/questions/statut.php");
      }else  if(isset($_GET["admin_alumni_student"])){
        include("../module/surveys/alumni/student.php");
      }else  if(isset($_GET["admin_alumni_result_rep"])){
        include("../module/surveys/alumni/result_rep.php");
      }else  if(isset($_GET["detail_question"])){
        include("../module/surveys/alumni/detail_question.php");
      }else  if(isset($_GET["admin_alumni_send"])){
        include("../module/surveys/alumni/send.php");
      }else  if(isset($_GET["admin_alumni_result"])){
        include("../module/surveys/alumni/result.php");
      }else  if(isset($_GET["result_employer"])){
        include("../module/surveys/alumni/result_employer.php");
      }else  if(isset($_GET["result_employer_t"])){
        include("../module/surveys/alumni/result_employer_t.php");
      }else  if(isset($_GET["resultat_by_prof_mba"])){
        include("../module/surveys/resultat/resultat_by_prof_mba.php");
      }else  if(isset($_GET["resultat_by_prof_dba"])){
        include("../module/surveys/resultat/resultat_by_prof_dba.php");
      }else  if(isset($_GET["resultat_detail"])){
        include("../module/surveys/alumni/resultat_detail.php");
      }else{
        include("../module/surveys/admin.php");
      }

  ?>
<?php if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php if (!isset($_GET['resultat_excel'])  && !isset($_GET["resultat_excel_mba"]) && !isset($_GET["resultat_excel_dba"])): ?>

          </td>
        </tr>
      </table>
                  </div>
            </div>
    <?php endif ?>



</body>
<?php if (!isset($_GET['resultat_excel'])  && !isset($_GET["resultat_excel_mba"]) && !isset($_GET["resultat_excel_dba"])): ?>
  <!-- <script src="../js/stu-prof/gsap/main-gsap.js"></script>
  <script src="../js/stu-prof/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
  <script src="../js/stu-prof/bootstrap.js"></script>
  <script src="../js/stu-prof/joinable.js"></script>
  <script src="../js/stu-prof/resizeable.js"></script>
  <script src="../js/stu-prof/neon-api.js"></script>
  <script src="../js/stu-prof/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="../js/stu-prof/jquery.sparkline.min.js"></script>

  <script src="../js/stu-prof/raphael-min.js"></script>

  <script src="../js/stu-prof/toastr.js"></script>

  <script src="../js/stu-prof/jquery.bootstrap.wizard.min.js"></script>
  <script src="../js/stu-prof/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
  <script src="../js/stu-prof/neon-chat.js"></script>
  <script src="../js/stu-prof/neon-custom.js"></script> -->

  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<?php endif ?>

</html>
<?php endif ?>
