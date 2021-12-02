<?php

$code_inscription = $_GET['code_inscription'];


$sql = "SELECT r.*,r.text,q.question,rep.reponse_en,rep.type FROM `resultat_alumni` as r , `questions_alumni` as q , `tbl_reponse_alumni` as rep WHERE r.`code_inscription` = 9710395 and r.`id_question` = q.`id` and r.`id_reponse` = rep.id";

$req = @mysql_query($sql);


 ?>

 <table class="table table-bordered">
   <thead>
     <tr>
       <th colspan="2">Number of Students : <?php echo $i; ?></th>
       <!-- <th colspan="2">sondage lu : <?php echo $lu; ?></th> -->
       <!-- <th colspan="2">sondage envoyer : <?php echo $send; ?></th>  -->
       <!-- <th colspan="3">sondage completer : <?php echo $completed; ?></th> -->
     </tr>
   </thead>
   <thead>
     <tr>
       <th>Question</th>
       <th>Answers</th>
     </tr>
   </thead>
   <tbody>
     <?php
       while ($row = mysql_fetch_array($req)) {
          $question = $row['question'];
          $reponse = $row['reponse_en'];
          $type = $row['type'];

          if ($type == "text" or $type == "textaerea") {
            var_dump($type);
            $text = $row['text'];
            var_dump($text);
          }
     ?>
       <tr>
         <td style="text-align:left;"><?php echo $question ?></td>
         <td style="text-align:left;"><?php echo $reponse ?></td>
       </tr>
     <?php
       }

      ?>
  </tbody>
</table>
