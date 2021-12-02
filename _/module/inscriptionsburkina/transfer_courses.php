<?php

$sql = "SELECT e.code_inscription,e.nom,e.prenom,count(n.`code_cours`) as nb FROM `tbl_note_burkina` as n , tbl_etudiant_burkina as e WHERE
e.code_inscription = n.`code_inscription` and n.`letter_grade` = 'T' group by e.code_inscription";

$req = mysql_query($sql)or die("Error sql");



?>
<div class="row">
  <div class="col-md-6">
    <h2 id="headings">
      <span class="bd-content-title">Transfer Student</span>
    </h2>
    <p>List of students</p>
  </div>
  <div class="col-md-6">
    <a href="?course_inscription" class="btn btn-sm btn-success" style="float: right;margin: 10px;margin-right: 0px;">Add New Course</a>
    <a href="?transfer_courses_by_student" class="btn btn-sm btn-success" style="float: right;margin: 10px;margin-right: 0px;">Transfer Courses</a>
  </div>


  <div class="col-md-12">
    <table class="table table-bordered" id="example">
      <thead>
        <tr class="bg-danger">
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">#</th>
          <th scope="col" style="background-color: #dc3545!important;color: #fff;">Student name</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Number of courses</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Details</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Action</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Generate</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
          while ($row = mysql_fetch_assoc($req)) {
        ?>
          <tr>
            <th class="text-center"><?php echo $i; ?></th>
            <td style="color: #000;"><?php echo $row['nom']." ".$row['prenom']; ?></td>
            <td class="text-center" style="color: #000;"><?php echo $row['nb']; ?> Courses</td>
            <td class="text-center" style="color: #000;">
              <a href="?transfer_detail=<?php echo $row['code_inscription'] ?>" class="btn btn-sm btn-info">Details</a>
            </td>
            <td class="text-center" style="color: #000;">
              <a href="?add_transfer_course=<?php echo $row['code_inscription'] ?>" class="btn btn-sm btn-success">Add Transfer courses</a>
            </td>

            <td class="text-center" style="color: #000;">
              <a href="/module/inscriptionsburkina/transfer_sheet.php?transfer_sheet=<?php echo $row['code_inscription'] ?>" target="_blank" class="btn btn-sm btn-success">transfer sheet</a>
            </td>
          </tr>
        <?php
            $i++;
          }
        ?>

      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
  } );
</script>
