<style type="text/css">
@media print {
  a {
    display: none !important;
  }
  .p {
    display: block !important;
  }
}
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
  position: relative;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <div class="ribbon ribbon-danger">MBA Surveys</div>
                <div class="table-responsive mt-50">

<?php
include "../module/surveys/resultat/functions.php";
$id_sondage =2;
//les informations du sondage
$sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage ";
$res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
$row_sondage=mysql_fetch_assoc($res_sondage);
//les periodes ou les sessions
$year = date("Y");
$sql_periode= "SELECT  `annee` , `periode` FROM  `tbl_sondage_affectation` WHERE `groupe` = 3 and `niveau` =  \"mba\" and `archive` = 0 and `type` = 1 and annee <= $year GROUP BY  `annee` ,  `periode` order by `annee` DESC, `periode` DESC";

//var_dump($sql_periode);
$req_periode = @mysql_query($sql_periode);
while ($row_periode = mysql_fetch_array($req_periode)) {
  $periode = $row_periode['periode'];
  $annee = $row_periode['annee'];
  $nb_of_students = get_student_number_in_survey($periode,$year);
    if($nb_of_students != 0){
   
  ?>
    

  <table class="table color-table primary-table">
      <thead>
        <tr>
          <th colspan="6" >
            Session - <?php echo ucfirst($periode)." ".$annee; ?>

            <button type="button" name="button" onclick="getResult('<?php echo $periode ?>',<?php echo $annee; ?>)">Get Result</button>
            <a href="?item=<?php echo $_GET['item']; ?>&surveys_results_mba&annee=<?php echo $annee; ?>&periode=<?php echo $periode; ?>&id=<?php echo $id_sondage; ?>" class="btn btn-success btn-xs" style="float: right;">
                            Surveys by Faculty <i class="entypo-check"></i>
                          </a>
          </th>
        </tr>
      </thead>
      <tbody>
          <tr>
              <th style="text-align:center;" >Satisfaction Curriculm</th>
              <th style="text-align:center;" >Faculty</th>
              <th style="text-align:center;" >Administration</th>
              <th style="text-align:center;" >Library</th>
              <th style="text-align:center;" >Campus Tools</th>
              <th style="text-align:center;" >Overall</th>
          </tr>
      </tbody>
      <tbody>
        <tr class="<?php echo $periode.$annee."load"; ?>">

        </tr>
        <tr class="<?php echo $periode.$annee."chart" ?>" style="display:hidden">
          <td style="text-align:center;">
            <div class="mb-30 <?php echo $periode.$annee."1"; ?>" >
                <?php
                  if ($porcentage1 <= 40) {
                    $class_chart = "easy-pie-chart-40";
                  }
                  if ($porcentage1 <= 70 && $porcentage1 > 40) {
                    $class_chart = "easy-pie-chart-70";
                  }
                  if ($porcentage1 <= 100 && $porcentage1 > 70) {
                    $class_chart = "easy-pie-chart-100";
                  }
                ?>

            </div>
          </td>
          <td style="text-align:center;">
            <div class="mb-30 <?php echo $periode.$annee."2"; ?>">
              <?php
                if ($porcentage2 <= 40) {
                  $class_chart = "easy-pie-chart-40";
                }
                if ($porcentage2 <= 70 && $porcentage2 > 40) {
                  $class_chart = "easy-pie-chart-70";
                }
                if ($porcentage2 <= 100 && $porcentage2 > 70) {
                  $class_chart = "easy-pie-chart-100";
                }
              ?>

            </div>
          </td>
          <td style="text-align:center;">
            <div class="mb-30 <?php echo $periode.$annee."3"; ?>">
              <?php
                if ($porcentage3 <= 40) {
                  $class_chart = "easy-pie-chart-40";
                }
                if ($porcentage3 <= 70 && $porcentage3 > 40) {
                  $class_chart = "easy-pie-chart-70";
                }
                if ($porcentage3 <= 100 && $porcentage3 > 70) {
                  $class_chart = "easy-pie-chart-100";
                }
              ?>

            </div>
          </td>
          <td style="text-align:center;">
            <div class="mb-30 <?php echo $periode.$annee."4"; ?>">
              <?php
                if ($porcentage4 <= 40) {
                  $class_chart = "easy-pie-chart-40";
                }
                if ($porcentage4 <= 70 && $porcentage4 > 40) {
                  $class_chart = "easy-pie-chart-70";
                }
                if ($porcentage4 <= 100 && $porcentage4 > 70) {
                  $class_chart = "easy-pie-chart-100";
                }
              ?>

            </div>
          </td>
          <td style="text-align:center;">
            <div class="mb-30 <?php echo $periode.$annee."5"; ?>">
              <?php
                if ($porcentage5 <= 40) {
                  $class_chart = "easy-pie-chart-40";
                }
                if ($porcentage5 <= 70 && $porcentage5 > 40) {
                  $class_chart = "easy-pie-chart-70";
                }
                if ($porcentage5 <= 100 && $porcentage5 > 70) {
                  $class_chart = "easy-pie-chart-100";
                }
              ?>

            </div>
          </td>
          <td style="text-align:center;">
            <div class="mb-30 <?php echo $periode.$annee."6"; ?>">
              <?php
                if ($overall <= 40) {
                  $class_chart = "easy-pie-chart-40";
                }
                if ($overall <= 70 && $overall > 40) {
                  $class_chart = "easy-pie-chart-70";
                }
                if ($overall <= 100 && $overall > 70) {
                  $class_chart = "easy-pie-chart-100";
                }
              ?>

            </div>
          </td>
        </tr>

  </tbody>
</table>
<?php
    }
}
?>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  function getResult (periode,year) {
    $("."+periode+year+"load").html('<td colspan="6"><div class="loader" ></div></td>');
    $("."+periode+year+"chart").hide();
    $.ajax({
        url: "../module/surveys/resultat/AJAX/function_ajax.php",
        type: 'POST',
        data:
        {
          periode : periode,
          year : year,
          type : "resultMbaBySession"
        },
        dataType: 'json',
        success: function(reponse) {
          console.log(reponse);
          $("."+periode+year+"chart").show();
          $("."+periode+year+"load").hide();
          $.each(reponse, function(index, prc) {
                $("."+periode+year+"load").html('');
                chart = "<div class='chart easy-pie-chart' data-percent='"+prc+"'> <span class='percent'>"+prc+"</span></div>";
                $("."+periode+year+index).show();
                $("."+periode+year+index).html(chart);

                $('.easy-pie-chart').easyPieChart({
                    easing: 'easeOutBounce',
                    barColor : '#856404',
                    lineWidth: 3,
                    trackColor : false,
                    lineCap : 'butt',
                    onStep: function(from, to, percent) {
                      $(this.el).find('.percent').text(Math.round(percent));
                    }
                 });
          });
        }
    });


  }


</script>
