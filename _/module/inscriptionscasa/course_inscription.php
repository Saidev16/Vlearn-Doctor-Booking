<?php

if ($_POST != array()) {
  //var_dump($_POST);
  $date = date('Y-m-d H:m:s');
  $idSession = $_POST['session'];
  $section = "";
  $courses = $_POST['courses'];
  $students = $_POST['students'];


  foreach ($students as $k => $v) {
    $code_inscription = $v;
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
        value('$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section','X')";
        //var_dump($sql);
        @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
      }


    }
  }


  ?>
  <script type="text/javascript" language="JavaScript1.2">
  <!--
  window.location.replace('gestion_inscription_burkina.php?transfer_courses');
  //-->
  </script>

    <?php



}


$sql = "SELECT n.code_inscription FROM `tbl_note_burkina` as n , tbl_etudiant_burkina as e WHERE
e.code_inscription = n.`code_inscription` and n.`letter_grade` = 'T' group by n.code_inscription";

$sql5 = "SELECT code_inscription,nom,prenom FROM `tbl_etudiant_burkina` order by nom";
$req5=mysql_query($sql5);



$sql2="SELECT  code_cours, titre ,nbr_credit,grade FROM $tbl_cours where grade != 0 GROUP BY code_cours order by grade,titre";
$req2=@mysql_query($sql2);




?>
<div class="row">
  <div class="col-md-12" style="margin-top:12px">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="javascript:history.go(-1)" class="btn btn-info btn-sm" style="margin-top: -5px;margin-right: 10px;">Return</a>  Add Transfer Courses to Student</li>

      </ol>
    </nav>
  </div>
</div>
  <form class="row" action="" method="post">
  <div class="col-md-12">
    <button type="submit" name="button" class="btn btn-success btn-sm" style="float: right;margin: 12px;float: right;margin-right: 0px;">submit</button>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Sessions</label>
      <select name="session" class="form-control" required>
        <option value="">Choose Session</option>
        <?php
  		  $sql7="select idSession, session, annee_academique,academic_year from $tbl_session where archive=1 ";
  		  $req=@mysql_query($sql7);
  		  while($row=mysql_fetch_assoc($req)){
  		  $ns=ucfirst($row['session']).' '.$row['annee_academique'];
  		  $cs=$row['idSession'];
  		  	$cc=$row['academic_year'];
  		  ?>
  		  <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
  		  <?php
  		  }
  		  ?>
      </select>
    </div>
    <div class="form-group">
      <label for="">Students</label>
      <select name="students[]" multiple class="form-control select_student" onchange="select_function()" id="" style="height: 300px;" required>
        <?php
          $i = 1;
          while($row=mysql_fetch_assoc($req5)){
            $cd = $row['code_inscription'];
            $name =  $row['nom']." ".$row['prenom'];
        ?>
          <option value="<?php echo $cd; ?>"><?php echo $name; ?></option>
        <?php
            $i++;
          }
        ?>

      </select>

      <script type="text/javascript">
        function select_function(){
          var val = $(".select_student").val();

        }
      </script>
    </div>
  </div>
  <div class="col-md-8 list_transf_add">

      <h5 class="text-danger">Choose Courses</h5>
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
              <td style="color: #000; text-align:center;"><?php echo $grade.'TH';?></td>

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
    $('#example_1').DataTable({
      "paging": false
    });
  } );

</script>
