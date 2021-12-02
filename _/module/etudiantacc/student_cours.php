<?php
 include("../../administrator/secure.php");


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
 $years = array(2017,2018,2019,2020);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">

  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a href="<?php echo $url["$prefixe"]; ?>" type="button" class="btn btn-success">Return</a>
      <a class="navbar-brand" href="#">
        HIS
        <img src="ASL.png" width="30"  class="d-inline-block align-top" alt="" loading="lazy">

      </a>
    </nav>
    <div class="container">
      <div class="row" style="margin:80px">
        <div class="col-md-12">
          <table id="example" class="table table-bordered">
            <thead>
              <tr>
                <th>Courses/students</th>
                <th></th>
              </tr>

            </thead>
            <tbody>
            <?php foreach ($years as $v): ?>

            <tr>
              <td >Year : <?php echo $v ?>-<?php echo $v+1; ?></td>
              <td></td>
            </tr>
            <?php
              $sql = "SELECT * FROM `tbl_cours` WHERE `archive` = 0";
              $req = mysql_query($sql);
              while ($row = mysql_fetch_assoc($req)) {
                $code_cours = $row['code_cours'];
                $title = $row['titre_eng'];
                $nb_credit =$row['nbr_credit'];
             ?>

            <tr>
              <td><?php echo $code_cours ?> : <?php echo $title; ?></td>
              <td><?php echo $nb_credit." Cr" ?></td>
            </tr>
            <?php
              $date = $v;
              $date1=$date+1;
              $sql_student = "SELECT distinct e.code_inscription,e.prefixe, concat(e.nom, ' ' ,e.prenom) as name FROM tbl_etudiant_all as e where
              date_inscription>'2016-07-01' and
              e.archive != 5 and
              date_inscription < '$date1-07-31' and
              (
                graduation_date ='0000-00-00' or
                graduation_date ='0000-00-01' or
                graduation_date BETWEEN '$date-09-01' AND '$date1-08-31'
              )
              ORDER BY e.code_inscription";
              $req_student = mysql_query($sql_student);
              while ($row_s = mysql_fetch_assoc($req_student)) {
                $code_inscription = $row_s['code_inscription'];
                $prefixe = $row_s['prefixe'];
                $name = $row_s['name'];
                $table_note_sql = $table_note["$prefixe"];


                $sql_v = "SELECT count(*) as nb FROM $table_note_sql WHERE code_inscription = $code_inscription and code_cours = '$code_cours' and  letter_grade != 'T' and archive = 0";
                //var_dump($sql_v);
                $req_v = mysql_query($sql_v);
                $row_v = mysql_fetch_assoc($req_v);
                $nb_cours = $row_v['nb'];
                if ($nb_cours != 0) {


              ?>
                  <tr>
                    <td><?php echo ucwords($name); ?></td>
                    <td></td>
                  </tr>
                <?php }  ?>
              <?php } ?>
          <?php } ?>
          <?php endforeach; ?>


          </tbody>
          </table>
        </div>
      </div>
    </div>




  </body>

  <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable({
          "paging":   false,
          "ordering": false,
          "info":     false,
          dom: 'Bfrtip',
          buttons: [
            'excel'
          ]
        });
      } );
    </script>



</html>
