<?php

$sql = "SELECT * FROM `tbl_cours` WHERE 1 order by titre";

$req = mysql_query($sql)or die("Error sql");



?>
<div class="row">
  <div class="col-md-6">
    <h2 id="headings">
      <span class="bd-content-title">Courses List</span>
    </h2>
    <p>Organize courses by Grades</p>
  </div>
  <!-- <div class="col-md-6">
    <a href="?transfer_courses_by_student" class="btn btn-sm btn-success" style="float: right;margin: 10px;margin-right: 0px;">Transfer Courses</a>
  </div> -->


  <div class="col-md-12">
    <table class="table table-bordered" id="example">
      <thead>
        <tr class="bg-danger">
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">#</th>
          <th scope="col" style="background-color: #dc3545!important;color: #fff;">Code Course</th>
          <th scope="col" style="background-color: #dc3545!important;color: #fff;">Title</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Credit</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Grade</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Change Grade</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Change Type</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Direct TR</th>
          <th class="text-center" scope="col" style="background-color: #dc3545!important;color: #fff;">Partner TR</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
          while ($row = mysql_fetch_assoc($req)) {
             $grade = $row['grade'];
             $type = $row['type'];
             $direct = $row['tr_direct'];
             $partner = $row['tr_partner'];
             $code_cours = $row['code_cours'];
             $class = str_replace("/","_",$row['code_cours']);
             //$class = str_replace("/","_",$class);
        ?>
          <tr>
            <th class="text-center"><?php echo $i; ?></th>
            <td style="color: #000;"><?php echo $row['code_cours']; ?></td>
            <td style="color: #000;"><?php echo $row['titre']; ?></td>
            <td class="text-center" style="color: #000;"><?php echo $row['nbr_credit']; ?></td>
            <td class="text-center" style="color: #000;">
              <?php
                  if ($row['grade'] == 0) {
                    echo "<span class='badge badge-pill badge-danger gradeBadge_".$row['code_cours']."'>Not defined</span>";
                  }else{
                    echo "<span class='badge badge-pill badge-success gradeBadge_".$row['code_cours']."'>$grade TH</span>";
                  }
               ?>
            </td>
            <td class="text-center" style="color: #000;">
              <select class="form-control grade_<?php echo $class; ?>" onchange="change_grade('<?php echo $class; ?>')">
                <option <?php if ($grade == 0){ echo "selected";} ?> value="0">Not defined</option>
        				<option <?php if ($grade == 9){ echo "selected";} ?> value="9">9TH</option>
        				<option <?php if ($grade == 10){ echo "selected";} ?> value="10">10TH</option>
        				<option <?php if ($grade == 11){ echo "selected";} ?> value="11">11TH</option>
        			  <option <?php if ($grade == 12){ echo "selected";} ?> value="12">12TH</option>
        			</select>
            </td>
            <td class="text-center" style="color: #000;">
              <select class="form-control type_<?php echo $class; ?>" onchange="change_type('<?php echo $class; ?>')">
                <option <?php if ($type == 0){ echo "selected";} ?> value="0">Normal</option>
                <option <?php if ($type == 1){ echo "selected";} ?> value="1">Languages</option>
        				<option <?php if ($type == 2){ echo "selected";} ?> value="2">Electives</option>
                <option <?php if ($type == 3){ echo "selected";} ?> value="3">Languages/Electives</option>
        			</select>
            </td>
            <td class="text-center" style="color: #000;">
              <select class="form-control direct_<?php echo $class; ?>" onchange="change_direct('<?php echo $class; ?>')">
                <option <?php if ($direct == 0){ echo "selected";} ?> value="0">No</option>
        				<option <?php if ($direct == 1){ echo "selected";} ?> value="1">YES</option>
        			</select>
            </td>
            <td class="text-center" style="color: #000;">
              <select class="form-control partner_<?php echo $class; ?>" onchange="change_partner('<?php echo $class; ?>')">
                <option <?php if ($partner == 0){ echo "selected";} ?> value="0">No</option>
        				<option <?php if ($partner == 1){ echo "selected";} ?> value="1">YES</option>
        			</select>
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



<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
  } );

  function change_grade(id){
    var val = $(".grade_"+id).val();
    $.ajax({
         url: '/module/inscriptionsmorocco/change_grade.php',
         type: 'POST',
            data:
            {   
               id : id,//id du catégorie 
               grade : val                 
            },
            dataType: 'json',
            success: function(reponse) {
             // console.log(reponse);
             // console.log(reponse.status);
             if (reponse.status == 1) {
               $(".grade_"+id).addClass('is-valid');
               if (val == 0) {
                 $(".gradeBadge_"+id).removeClass('badge-success');
                 $(".gradeBadge_"+id).addClass('badge-danger');
                 $(".gradeBadge_"+id).html("Not defined");
               }else{
                 $(".gradeBadge_"+id).removeClass('badge-danger');
                 $(".gradeBadge_"+id).addClass('badge-success');
                 $(".gradeBadge_"+id).html(val+" TH");
               }
             }else{
               $(".grade_"+id).addClass('is-invalid');
             }
           }
     });

  }

  function change_type(id){
    var val = $(".type_"+id).val();
    $.ajax({
         url: '/module/inscriptionsmorocco/change_type.php',
         type: 'POST',
            data:
            {   
               id : id,//id du catégorie 
               val : val                 
            },
            dataType: 'json',
            success: function(reponse) {
             // console.log(reponse);
             // console.log(reponse.status);
             if (reponse.status == 1) {
               $(".type_"+id).addClass('is-valid');
               if (val == 0) {

               }else{

               }
             }else{
               $(".type_"+id).addClass('is-invalid');
             }
           }
     });

  }

  function change_direct(id){
    var val = $(".direct_"+id).val();
    $.ajax({
         url: '/module/inscriptionsmorocco/change_direct.php',
         type: 'POST',
            data:
            {   
               id : id,//id du catégorie 
               val : val                 
            },
            dataType: 'json',
            success: function(reponse) {
             // console.log(reponse);
             // console.log(reponse.status);
             if (reponse.status == 1) {
               $(".direct_"+id).addClass('is-valid');
             }else{
               $(".direct_"+id).addClass('is-invalid');
             }
           }
     });

  }

  function change_partner(id){
    var val = $(".partner_"+id).val();
    $.ajax({
         url: '/module/inscriptionsmorocco/change_partner.php',
         type: 'POST',
            data:
            {   
               id : id,//id du catégorie 
               val : val                 
            },
            dataType: 'json',
            success: function(reponse) {
             // console.log(reponse);
             // console.log(reponse.status);
             if (reponse.status == 1) {
               $(".partner_"+id).addClass('is-valid');
             }else{
               $(".partner_"+id).addClass('is-invalid');
             }
           }
     });

  }

</script>
