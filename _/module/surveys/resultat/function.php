<?php

function add_default_result($id_affectation,$id_question,$id_sondage){
  if ($id_affectation != "" && $id_question != array()) {
    // la liste des etudiants
    $sql =  "SELECT * FROM `tbl_resultat_sondage` WHERE `id_affectation` = $id_affectation GROUP by `code_etudiant`";
    //echo "</br>";
    //var_dump($sql);
    $req = @mysql_query($sql);
    while ($row = mysql_fetch_assoc($req)) {
      $code_inscription = $row['code_etudiant'];
      // echo $code_inscription;
      // echo "</br>";
      // echo $row['id_question'];
      // echo "</br>";
        foreach ($id_question as $k => $v) {
          if ($row['id_question'] >= 13 && $v >= 13) {
            // preparer la reponse
            $sql_reponse = "SELECT * FROM `tbl_reponse` WHERE `question_id` = $v and `porcentage` = 90 limit 1";
            // var_dump($sql_reponse);
            // echo "</br>";
            $req_reponse = @mysql_query($sql_reponse);
            $row_reponse = mysql_fetch_assoc($req_reponse);
            $id_reponse = $row_reponse['id'];
            // var_dump($id_reponse);


           $sql_insert = "INSERT INTO `tbl_resultat_sondage`(`id_affectation`, `id_reponse`, `id_sondage`, `id_question`, `code_etudiant`, `text`) VALUES ($id_affectation,$id_reponse,$id_sondage,$v,$code_inscription,'')";
           @mysql_query($sql_insert);
           // var_dump($sql_insert);
           // echo "</br>";

          }
          if ($row['id_question'] <= 12 && $v < 13) {
            // preparer la reponse
            $sql_reponse = "SELECT * FROM `tbl_reponse` WHERE `question_id` = $v and `porcentage` = 90 limit 1";
            // var_dump($sql_reponse);
            $req_reponse = @mysql_query($sql_reponse);
            $row_reponse = mysql_fetch_assoc($req_reponse);
            $id_reponse = $row_reponse['id'];

           $sql_insert = "INSERT INTO `tbl_resultat_sondage`(`id_affectation`, `id_reponse`, `id_sondage`, `id_question`, `code_etudiant`, `text`) VALUES ($id_affectation,$id_reponse,$id_sondage,$v,$code_inscription,'')";
           @mysql_query($sql_insert);
           // var_dump($sql_insert);
           // echo "</br>";
          }
        }

    }

    // die();


  }

}






?>
