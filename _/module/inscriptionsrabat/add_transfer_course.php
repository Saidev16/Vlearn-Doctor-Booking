<?php

$code_inscription = $_GET['add_transfer_course'];


if ($_POST != array()) {
  $date = date('Y-m-d H:m:s');
  $idSession = 0;
  $section = "";
  $courses = $_POST['courses'];
  $code_inscription = $_POST['code_inscription'];
  foreach ($courses as $k_c =>$v_c) {
    $code_cours = $v_c;
    // verification
    $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_burkina
		WHERE code_inscription='$code_inscription'
		AND code_cours= '$code_cours'
		AND idSession= '$idSession'";

    $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
		$row = mysql_fetch_assoc($req);
		$nbr = $row['nbr'];


    if ($nbr == 0) {
      $sql2014 = "SELECT code_cours_testing FROM tbl_cours WHERE code_cours = '$code_cours'";
      $res2014 = mysql_query($sql2014);
      $row = mysql_fetch_assoc($res2014);
      $code_cours_testing = $row['code_cours_testing'];

      $sql = "INSERT INTO tbl_inscription_cours_burkina (`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
      VALUES ('$code_cours', '$code_inscription','$code_cours_testing', '$date', '$idSession');";
      //var_dump($sql);
      @mysql_query($sql)or die ('Erreur :: inscription11');

      // creation de la fiche de notes
      $sql = "insert into tbl_note_burkina (code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,letter_grade)
      value('$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section','T')";
      //var_dump($sql);
      @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
    }
  }


  ?>
  <script type="text/javascript" language="JavaScript1.2">
  <!--
  window.location.replace('gestion_inscription_morocco.php?transfer_detail=<?=$code_inscription?>');

  //-->
  </script>

    <?php

}


$sql = "SELECT code_cours FROM `tbl_note_burkina` as n , tbl_etudiant_burkina as e WHERE
e.code_inscription = n.`code_inscription` and n.code_inscription = $code_inscription  and n.`letter_grade` = 'T' group by n.code_cours";


$sql2="SELECT  code_cours, titre ,nbr_credit,grade FROM $tbl_cours where code_cours not in ($sql) and grade != 0 GROUP BY code_cours order by grade,titre";
$req2=@mysql_query($sql2);

$sql3 = "SELECT e.code_inscription,e.nom,e.prenom,count(n.`code_cours`) as nb FROM `tbl_note_burkina` as n , tbl_etudiant_burkina as e WHERE
e.code_inscription = n.`code_inscription` and n.code_inscription = $code_inscription  and n.`letter_grade` = 'T' group by n.code_inscription";
$req3 = mysql_query($sql3)or die("Error sql");
$row3 = mysql_fetch_assoc($req3);
$student_name = $row3['prenom']." ".$row3['nom'];
$nb_courses = $row3['nb'];

$sql4 = "SELECT c.code_cours, c.titre ,c.nbr_credit,c.grade FROM `tbl_note_burkina` as n , tbl_etudiant_burkina as e, $tbl_cours as c WHERE
e.code_inscription = n.`code_inscription` and n.code_inscription = $code_inscription and c.code_cours = n.code_cours  and n.`letter_grade` = 'T' order by c.grade,c.titre";
// var_dump($sql4);
$req4 = mysql_query($sql4)or die("Error sql");

?>
<div class="row">
  <div class="col-md-12" style="margin-top:12px">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="javascript:history.go(-1)" class="btn btn-info btn-sm" style="margin-top: -5px;margin-right: 10px;">Return</a>  Add Transfer Courses to Student : <?php echo $student_name; ?></li>
        <li class="breadcrumb-item active" aria-current="page">Nomber of transfer courses : <?php echo $nb_courses; ?>
          <button onclick="display_list()" type="button" name="button" class="btn btn-info btn-sm b-show" style="margin-top: -5px;margin-left: 10px;">Show Transfer Courses</button>
        </li>
      </ol>
    </nav>
  </div>
  <div class="col-md-12 list_transf" style="display:none">
    <h1 class="display-5 text-danger">List of transfer Courses</h1>
    <table class="table table-bordered" id="example_1">
      <thead>
        <tr class="bg-danger">
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">#</th>
          <th scope="col" style="background-color: #dc3545!important;color: #fff;">Code Cours</th>
          <th scope="col" style="background-color: #dc3545!important;color: #fff;">Title</th>
          <th scope="col" style="background-color: #dc3545!important;color: #fff;">Credits</th>
          <th scope="col" style="background-color: #dc3545!important;color: #fff;">Grade</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
          while($row=mysql_fetch_assoc($req4)){
            $cc=$row['code_cours'];
            $tc=$row['titre'];
            $cr=$row['nbr_credit'];
            $grade = $row['grade'];
        ?>
          <tr>
            <th class="text-center"><?php echo $i; ?></th>
            <td style="color: #000;"><?=$cc?></td>
            <td style="color: #000;"><?=$tc?></td>
            <td style="color: #000; text-align:center;"><?=$cr?></td>
            <td style="color: #000; text-align:center;">
              <?php
                //echo $grade."TH";
                  if ($row['grade'] == 0) {
                    echo "<span class='badge badge-pill badge-danger' >Not defined</span>";
                  }else{
                    echo $grade."TH";
                  }
               ?>
            </td>
          </tr>
        <?php
            $i++;
          }
        ?>

      </tbody>
    </table>
  </div>
  <div class="col-md-12 list_transf_add">
    <form class="" action="" method="post">
      <input type="hidden" name="code_inscription" value="<?php echo $code_inscription ?>">
      <h1 class="display-5 text-danger">Choose Courses to transfer</h1>
      <table class="table table-bordered" id="example">
        <thead>
          <tr class="bg-danger">
            <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">#</th>
            <th scope="col" style="background-color: #dc3545!important;color: #fff;">Code Cours</th>
            <th scope="col" style="background-color: #dc3545!important;color: #fff;">Title</th>
            <th scope="col" style="background-color: #dc3545!important;color: #fff;">Credits</th>
            <th scope="col" style="background-color: #dc3545!important;color: #fff;">Grade</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 1;
            while($row=mysql_fetch_assoc($req2)){
              $cc=$row['code_cours'];
              $tc=$row['titre'];
              $cr=$row['nbr_credit'];
              $grade = $row['grade'];
          ?>
            <tr>
              <th class="text-center"> <input type="checkbox" name="courses[]" value="<?=$cc?>"></th>
              <td style="color: #000;"><?=$cc?></td>
              <td style="color: #000;"><?=$tc?></td>
              <td style="color: #000; text-align:center;"><?=$cr?></td>
              <td style="color: #000; text-align:center;">
                <?php
                //echo $grade."TH";
                    if ($row['grade'] == 0) {
                      echo "<span class='badge badge-pill badge-danger' >Not defined</span>";
                    }else{
                      echo $grade."TH";
                    }
                 ?>
              </td>
            </tr>
          <?php
              $i++;
            }
          ?>

        </tbody>
      </table>
      <button type="submit" name="button" class="btn btn-success btn-sm" style="margin: 12px;float: right;margin-right: 0px;">submit</button>
    </form>
  </div>
</div>

<script type="text/javascript">
  d = 0;
  function display_list(){
    $(".list_transf").toggle();
    if (d == 0) {
      $(".b-show").html('Hide Transfer Courses');
      $(".list_transf_add").hide();
      d++;
    }else{
      $(".b-show").html("Show Transfer Courses");
      $(".list_transf_add").show();
      d=0;
    }
  }
  $(document).ready(function() {

    $('#example').DataTable( {
    "paging": false
} );
    $('#example_1').DataTable();
  } );

</script>
