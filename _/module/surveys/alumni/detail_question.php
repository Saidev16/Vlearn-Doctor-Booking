<?php


if ($_GET['detail_question'] != "") {
  $id_question = $_GET['detail_question'];

  $sql = "SELECT * FROM `questions_alumni` WHERE `type` = 'EMPLOYER' and id = $id_question";
  $req = @mysql_query($sql);
  $row = @mysql_fetch_assoc($req);

  if ($row['id'] != null) {
    ?>

        <table class="table table-bordered">
          <thead>
      			<tr>
              <th style="width: 20%">
                <button class="btn btn-success" type="button" onclick="window.open('', '_self', ''); window.close();">Close</button>
                <!-- <a class="btn btn-success" href="?result_employer">return</a> -->
              </th>
      				<th colspan="" style="font-size: 16px;font-weight: 500;color: #000;text-align:center">
                  Answers
      				</th>
      			</tr>
      		</thead>
          <thead>
            <tr>
              <th colspan="2" style="font-size: 14px;color: #000;" >Question : <?php echo $row['question']; ?></th>
            </tr>
          </thead>
          <thead>
            <tr>
              <th>Employers</th>
              <th>Answers</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT re.`question_id`,re.`reponse_id`,re.`employer_id`,re.`text` as answer,re.`created`,rep.reponse_en,rep.type,ra.id_reponse,ra.text as employer FROM `result_employer` as re , resultat_alumni as ra , tbl_reponse_alumni as rep WHERE re.question_id = $id_question and re.`reponse_id` = rep.id and re.`employer_id` = ra.id";
              $req = @mysql_query($sql);
              while ($row = mysql_fetch_assoc($req)) {
                ?>
                <tr>
                  <td style="text-align: left;"><?php echo $row['employer']; ?></td>
                  <td style="text-align: left;">
                    <?php
                      if ($row['type'] == "choix"){
                        echo $row['reponse_en'];
                      }else{
                        echo $row['answer'];
                      }
                    ?>
                  </td>
                </tr>
                <?php
              }
             ?>
          </tbody>
        </table>
  <?php
  }
}






 ?>
