<?php

$code_inscription = $_GET['inscription'];
$prefixe = $_GET['prefixe'];
$table_etudiant = array(
  'CAM' => 'tbl_etudiant_cameroun',
  'ORL' => 'tbl_etudiant_usa',
  'BN' => 'tbl_etudiant_benin',
  'GS' => 'tbl_etudiant_GUES',
  'MOR' => 'tbl_etudiant_morocco',
  'AG' => 'tbl_etudiant_algeria',
  'BF' => 'tbl_etudiant_burkina',
  'CB' => 'tbl_etudiant_casa',
  'RB' => 'tbl_etudiant_rabat',
   'MARB' => 'tbl_etudiant_marbella',
  'IC' => 'tbl_etudiant_ivory'
);

$table_note = array(
  'CAM' => 'tbl_note_cameroun',
  'ORL' => 'tbl_note_usa',
  'BN' => 'tbl_note_benin',
  'GS' => 'tbl_note_GUES',
  'MOR' => 'tbl_note_morocco',
  'AG' => 'tbl_note_algeria',
  'BF' => 'tbl_note_burkina',
  'CB' => 'tbl_note_casa',
  'RB' => 'tbl_note_rabat',
  'MARB' => 'tbl_note_marbella',
  'IC' => 'tbl_note_ivory'
);

$table_inscription = array(
  'CAM' => 'tbl_inscription_cours_cameroun',
  'ORL' => 'tbl_inscription_cours_usa',
  'BN' => 'tbl_inscription_cours_benin',
  'GS' => 'tbl_inscription_cours_GUES',
  'MOR' => 'tbl_inscription_cours_morocco',
  'AG' => 'tbl_inscription_cours_algeria',
  'BF' => 'tbl_inscription_cours_burkina',
  'CB' => 'tbl_inscription_cours_casa',
  'RB' => 'tbl_inscription_cours_rabat',
   'MARB' => 'tbl_inscription_cours_marbella',
  'IC' => 'tbl_inscription_cours_ivory'
);

// information student
$table_etudiant_sql = $table_etudiant["$prefixe"];
$table_note_sql = $table_note["$prefixe"];
$table_inscription_sql = $table_inscription["$prefixe"];


$sql = "SELECT * FROM $table_etudiant_sql WHERE `code_inscription` = $code_inscription";

$req = mysql_query($sql) or die("SQL ERROR");
$row = mysql_fetch_assoc($req);
$student_name = ucfirst($row['prenom']." ".$row['nom']);

$ttl_tr = 0;
$ttl_en = 0;

// verification



?>


<div class="row" style="margin:20px">
  <div class="col-md-12">
    <h4>
      Student : <?php echo $student_name; ?>
      <small class="text-muted">Courses registred</small>
    </h4>
    <a href="/module/registration/transfer_sheet.php?code_inscrition=<?php echo $code_inscription ?>&prefixe=<?php echo $prefixe ?>" class="btn btn-success btn-sm" style='float:right' target="_blank">Generate Transfer sheet</a>
  </div>
  <hr>
  <!-- 9th -->
  <div class="col-md-12" style="margin-top:10px">
    <table class="table table-bordered">
      <tr class="text-center">
        <th colspan="3">Grade : 9th</th>
        <th colspan="4">1 year courses</th>
      </tr>
      <tr class="text-center">
        <th>Code cours</th>
        <th class="text-left">Title</th>
        <th>Cr</th>
        <th>Type</th>
        <th>Session</th>
        <th>Grade</th>
        <th>action</th>
      </tr>

        <?php
          //
          $grade = 9;
          $lanaguages = "''";
          $electives = "''";
          $electives_select = "''";
          $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE `tr_partner` = 1 and `grade`= $grade";
          $req = mysql_query($sql) or die("SQL ERROR");
          while($row = mysql_fetch_assoc($req)){
            $code_cours = $row['code_cours'];
            $class = str_replace("/","_",$row['code_cours']);
            $type = "";

            // verify if the cours is tr or enrolled
            $sql_v = "SELECT code_note,letter_grade,idSession FROM $table_note_sql
            WHERE code_inscription='$code_inscription'
            AND code_cours= '$code_cours'";
            $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
            $row_v = mysql_fetch_assoc($req_v);
            $letter_grade = $row_v['letter_grade'];
            $idSession = $row_v['idSession'];
            $code_note = $row_v['code_note'];
        ?>
        <!-- Modifier -->
        <?php if ($letter_grade != ""): ?>
          <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
            <td><?php echo $row['code_cours']; ?></td>
            <td class="text-left"><?php echo $row['titre_eng']; ?></td>
            <td><?php echo $row['nbr_credit']; ?></td>
            <td class="td_edit_<?php echo $class; ?>">
              <?php
                  if ($letter_grade == "T") {
                    $type = 1;
                  }
                  if ($letter_grade != "" && $letter_grade != "T") {
                      $type = 2;
                  }
              ?>
                  <select class="form-control type_<?php echo $class; ?>"
                    onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                  </select>
              <?php

               ?>

            </td>
            <td class="td_session_edit_<?php echo $class; ?>">
                  <?php
                  if ($idSession == 0){ ?>
                      <select class="form-control session_<?php echo $class; ?>"
                        onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                        <?php
                       $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                       $req7=@mysql_query($sql7);
                       while($row7=mysql_fetch_assoc($req7)){
                           $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                           $cs=$row7['idSession'];
                           $cc=$row7['academic_year'];
                       ?>
                         <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                       <?php
                       }
                       ?>
                     </select>
                  <?php }else{ ?>
                    <select class="form-control session_<?php echo $class; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
            </td>
            <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
            <td>
              <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
            </td>
          </tr>
        <?php endif; ?>

        <!-- ajouter -->
          <tr class="text-center tr_<?php echo $class; ?>">
            <td><?php echo $row['code_cours']; ?></td>
            <td class="text-left"><?php echo $row['titre_eng']; ?></td>
            <td><?php echo $row['nbr_credit']; ?></td>
            <td class="td_<?php echo $class; ?>">
              <?php
                if ($letter_grade != null) {
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    echo "Transfer";
                  }else{
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                    echo "Enrolled";
                  }
                }else{
              ?>
                  <select class="form-control type_<?php echo $class; ?>"
                    onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>
              <?php
                }
               ?>

            </td>
            <td class="td_session_<?php echo $class; ?>">
              <?php if ($idSession != null){ ?>
                  <?php if ($idSession == 0){ ?>
                      <?php echo "-"; ?>
                  <?php }else{
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                          $req7=@mysql_query($sql7);
                          $row7=mysql_fetch_assoc($req7);
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                		      echo $ns;
                        } ?>
              <?php }else{ ?>
                  <select class="form-control session_<?php echo $class; ?>"
                    onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
              		  $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
              		  $req7=@mysql_query($sql7);
              		  while($row7=mysql_fetch_assoc($req7)){
              		      $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
              		      $cs=$row7['idSession'];
              		      $cc=$row7['academic_year'];
              		  ?>
              		    <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
              		  <?php
              		  }
              		  ?>
            			</select>
                <?php } ?>
            </td>
            <td class="td_grade_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
            <td>
              <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php
          }
        ?>
        <!-- Electives 9th 1 -->
        <?php
          // verify if the cours is tr or enrolled Language courses
          $_number = 1;
          $type = 0;
          $other_language = 0;

          $sql_v = "SELECT count(*) as nb FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3))  and code_cours in ('10099012','100990') ";

          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $other_language = $row_v['nb'];
        //  var_dump($other_language);



          $sql_v = "SELECT code_note,code_cours,letter_grade,idSession,stage FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3) and code_cours not in ($electives)) and stage = $grade order by code_note";
          //var_dump($sql_v);
          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $code_cours_elective = $row_v['code_cours'];
          $letter_grade = $row_v['letter_grade'];
          $idSession = $row_v['idSession'];
          $code_note = $row_v['code_note'];
          $stage = $row_v['stage'];
      //    var_dump($code_cours_elective);

          if ($code_cours_elective != null) {

            if ($stage == null) {
              //here to change the order of courses language in stage fields if this fields equal NULL
              $sql_u1 = "UPDATE $table_note_sql SET `stage` = $grade WHERE `code_note` = $code_note";
              // var_dump($sql_u1);
              $req_u1  =@mysql_query($sql_u1) or die ('Error in Sql'.$sql_u1);
            }


            if ($code_cours_elective != "10099012" && $code_cours_elective != "100990") {
              $electives .= ",'$code_cours_elective'";
              $electives_select .= ",'$code_cours_elective'";
            }



            // course info
            $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective' ";
            $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
            $row = mysql_fetch_assoc($req);
            $class = str_replace("/","_",$row['code_cours']);
            ?>
            <!-- Modifier -->
            <?php if ($letter_grade != ""): ?>
              <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
                <td><?php echo $row['code_cours']; ?></td>
                <td class="text-left"><?php echo $row['titre_eng']; ?></td>
                <td><?php echo $row['nbr_credit']; ?></td>
                <td class="td_edit_<?php echo $class; ?>">
                  <?php
                      if ($letter_grade == "T") {
                        $type = 1;
                      }
                      if ($letter_grade != "" && $letter_grade != "T") {
                          $type = 2;
                      }
                  ?>
                      <select class="form-control type_<?php echo $class; ?>"
                        onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                        <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                        <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                      </select>
                  <?php

                   ?>

                </td>
                <td class="td_session_edit_<?php echo $class; ?>">
                      <?php
                      if ($idSession == 0){ ?>
                          <select class="form-control session_<?php echo $class; ?>"
                            onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                            <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                            <?php
                           $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                           $req7=@mysql_query($sql7);
                           while($row7=mysql_fetch_assoc($req7)){
                               $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                               $cs=$row7['idSession'];
                               $cc=$row7['academic_year'];
                           ?>
                             <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                           <?php
                           }
                           ?>
                         </select>
                      <?php }else{ ?>
                        <select class="form-control session_<?php echo $class; ?>"
                          onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                          <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                          <?php
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                          $req7=@mysql_query($sql7);
                          while($row7=mysql_fetch_assoc($req7)){
                              $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                              $cs=$row7['idSession'];
                              $cc=$row7['academic_year'];
                          ?>
                            <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <?php } ?>
                </td>
                <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
                <td>
                  <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
                </td>
              </tr>
            <?php endif; ?>

            <!-- ajouter -->
            <tr class="text-center tr_<?php echo $class; ?>">
              <td>Electives 1</td>
              <td class="text-left">
                <?php echo $row['code_cours']." / ".$row['titre_eng']; ?>

              </td>
              <td><?php echo $row['nbr_credit']; ?></td>
              <td class="td_<?php echo $class; ?>">
                <?php
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      echo "Transfer";
                    }else{
                      echo "Enrolled";
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }else{
                ?>
                    <select class="form-control type_<?php echo $class; ?>"
                      onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                      <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                      <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                    </select>
                <?php
                  }
                 ?>

              </td>
              <td class="td_session_elective_<?php echo $class; ?>">
                <?php if ($idSession != null){ ?>
                    <?php if ($idSession == 0){ ?>
                        <?php echo "-"; ?>
                    <?php }else{
                            $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                            $req7=@mysql_query($sql7);
                            $row7=mysql_fetch_assoc($req7);
                            $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                            echo $ns;
                          } ?>
                <?php }else{ ?>
                    <select class="form-control session_elective_<?php echo $grade; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
              </td>
              <td class="td_grade_elective_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
              <td>
                <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
                <?php endif; ?>

              </td>
            </tr>
            <?php

            if ($code_cours_elective == "10099012"or $code_cours_elective == "100990") {

              $other_language = $other_language-1;

              //var_dump($other_language);
              if ($other_language == 0) {
                $electives .= ",'$code_cours_elective'";
              }
            }

          }else{  ?>
          <tr class="text-center">
            <td>Electives 1</td>
            <td class="text-left td_title_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
              <select class="form-control elective_grade_<?php echo $_number; ?>_<?php echo $grade; ?>" onchange="change_courses_elect(<?php echo $grade ?>,<?php echo $_number ?>)" >
                <option value="">Choose Elective course</option>
                <?php
                    $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE
                    `type` in (2,3) and nbr_credit = 1 order by titre_eng";
                    $req = mysql_query($sql) or die("SQL ERROR");
                    while($row = mysql_fetch_assoc($req)){
                ?>
                      <option value="<?php echo $row['code_cours']; ?>"><?php echo $row['code_cours']." / ".$row['titre_eng']." - Cr : ".$row['nbr_credit']; ?></option>
                <?php
                    }
                ?>
              </select>
            </td>
            <td>

            </td>
            <td class="td_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
                  <select class="form-control type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>  select_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_type_electi('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>

            </td>
            <td class="td_session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">

                  <select class="form-control session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_session_elect('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
            </td>
            <td class="td_grade_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"></td>
            <td>
              <?php if ($letter_grade != ""): ?>
                <button type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Edit</button>
              <?php endif; ?>
            </td>
          </tr>

        <?php } ?>

        <!-- Electives 9th 2 -->
        <?php
          // verify if the cours is tr or enrolled Language courses
          $_number = 2;
          $type = 0;
          $other_language = 0;

          $sql_v = "SELECT count(*) as nb FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3))  and code_cours in ('10099012','100990') ";

          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $other_language = $row_v['nb'];
        //  var_dump($other_language);



          $sql_v = "SELECT code_note,code_cours,letter_grade,idSession,stage FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3) and code_cours not in ($electives)) and stage = $grade order by code_note";
          //var_dump($sql_v);
          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $code_cours_elective = $row_v['code_cours'];
          $letter_grade = $row_v['letter_grade'];
          $idSession = $row_v['idSession'];
          $code_note = $row_v['code_note'];
          $stage = $row_v['stage'];
      //    var_dump($code_cours_elective);

          if ($code_cours_elective != null) {

            if ($stage == null) {
              //here to change the order of courses language in stage fields if this fields equal NULL
              $sql_u1 = "UPDATE $table_note_sql SET `stage` = $grade WHERE `code_note` = $code_note";
              // var_dump($sql_u1);
              $req_u1  =@mysql_query($sql_u1) or die ('Error in Sql'.$sql_u1);
            }


            if ($code_cours_elective != "10099012" && $code_cours_elective != "100990") {
              $electives .= ",'$code_cours_elective'";
              $electives_select .= ",'$code_cours_elective'";
            }



            // course info
            $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective' ";
            $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
            $row = mysql_fetch_assoc($req);
            $class = str_replace("/","_",$row['code_cours']);
            ?>
            <!-- Modifier -->
            <?php if ($letter_grade != ""): ?>
              <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
                <td><?php echo $row['code_cours']; ?></td>
                <td class="text-left"><?php echo $row['titre_eng']; ?></td>
                <td><?php echo $row['nbr_credit']; ?></td>
                <td class="td_edit_<?php echo $class; ?>">
                  <?php
                      if ($letter_grade == "T") {
                        $type = 1;
                      }
                      if ($letter_grade != "" && $letter_grade != "T") {
                          $type = 2;
                      }
                  ?>
                      <select class="form-control type_<?php echo $class; ?>"
                        onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                        <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                        <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                      </select>
                  <?php

                   ?>

                </td>
                <td class="td_session_edit_<?php echo $class; ?>">
                      <?php
                      if ($idSession == 0){ ?>
                          <select class="form-control session_<?php echo $class; ?>"
                            onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                            <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                            <?php
                           $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                           $req7=@mysql_query($sql7);
                           while($row7=mysql_fetch_assoc($req7)){
                               $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                               $cs=$row7['idSession'];
                               $cc=$row7['academic_year'];
                           ?>
                             <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                           <?php
                           }
                           ?>
                         </select>
                      <?php }else{ ?>
                        <select class="form-control session_<?php echo $class; ?>"
                          onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                          <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                          <?php
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                          $req7=@mysql_query($sql7);
                          while($row7=mysql_fetch_assoc($req7)){
                              $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                              $cs=$row7['idSession'];
                              $cc=$row7['academic_year'];
                          ?>
                            <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <?php } ?>
                </td>
                <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
                <td>
                  <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
                </td>
              </tr>
            <?php endif; ?>

            <!-- ajouter -->
            <tr class="text-center tr_<?php echo $class; ?>">
              <td>Electives <?php echo $_number; ?></td>
              <td class="text-left">
                <?php echo $row['code_cours']." / ".$row['titre_eng']; ?>

              </td>
              <td><?php echo $row['nbr_credit']; ?></td>
              <td class="td_<?php echo $class; ?>">
                <?php
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      echo "Transfer";
                    }else{
                      echo "Enrolled";
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }else{
                ?>
                    <select class="form-control type_<?php echo $class; ?>"
                      onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                      <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                      <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                    </select>
                <?php
                  }
                 ?>

              </td>
              <td class="td_session_elective_<?php echo $class; ?>">
                <?php if ($idSession != null){ ?>
                    <?php if ($idSession == 0){ ?>
                        <?php echo "-"; ?>
                    <?php }else{
                            $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                            $req7=@mysql_query($sql7);
                            $row7=mysql_fetch_assoc($req7);
                            $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                            echo $ns;
                          } ?>
                <?php }else{ ?>
                    <select class="form-control session_elective_<?php echo $grade; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
              </td>
              <td class="td_grade_elective_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
              <td>
                <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
                <?php endif; ?>

              </td>
            </tr>
            <?php

            if ($code_cours_elective == "10099012"or $code_cours_elective == "100990") {

              $other_language = $other_language-1;

              //var_dump($other_language);
              if ($other_language == 0) {
                $electives .= ",'$code_cours_elective'";
              }
            }

          }else{  ?>
          <tr class="text-center">
            <td>Electives <?php echo $_number; ?></td>
            <td class="text-left td_title_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
              <select class="form-control elective_grade_<?php echo $_number; ?>_<?php echo $grade; ?>" onchange="change_courses_elect(<?php echo $grade ?>,<?php echo $_number ?>)" >
                <option value="">Choose Elective course</option>
                <?php
                    $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE
                    `type` in (2,3)  and code_cours not in ($electives_select) and nbr_credit = 1 order by titre_eng";
                    $req = mysql_query($sql) or die("SQL ERROR");
                    while($row = mysql_fetch_assoc($req)){
                ?>
                      <option value="<?php echo $row['code_cours']; ?>"><?php echo $row['code_cours']." / ".$row['titre_eng']." - Cr : ".$row['nbr_credit']; ?></option>
                <?php
                    }
                ?>
              </select>
            </td>
            <td>

            </td>
            <td class="td_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
                  <select class="form-control type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>  select_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_type_electi('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>

            </td>
            <td class="td_session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">

                  <select class="form-control session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_session_elect('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
            </td>
            <td class="td_grade_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"></td>
            <td>
              <?php if ($letter_grade != ""): ?>
                <button type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Edit</button>
              <?php endif; ?>
            </td>
          </tr>

        <?php } ?>


    </table>
  </div>
  <!-- 10th -->
  <div class="col-md-12" style="margin-top:10px">
    <table class="table table-bordered">
      <tr class="text-center">
        <th colspan="3">Grade : 10th</th>
        <th colspan="4">1 year courses</th>
      </tr>
      <tr class="text-center">
        <th>Code cours</th>
        <th class="text-left">Title</th>
        <th>Cr</th>
        <th>Type</th>
        <th>Session</th>
        <th>Grade</th>
        <th>Action</th>
      </tr>

        <?php
          //

          $grade = 10;
          $type = 0;
          $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE `tr_partner` = 1 and `grade`= $grade";
          $req = mysql_query($sql) or die("SQL ERROR");
          while($row = mysql_fetch_assoc($req)){
            $code_cours = $row['code_cours'];
            $class = str_replace("/","_",$row['code_cours']);
            $type = "";

            // verify if the cours is tr or enrolled
            $sql_v = "SELECT code_note,letter_grade,idSession FROM $table_note_sql
            WHERE code_inscription='$code_inscription'
            AND code_cours= '$code_cours'";
            $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
            $row_v = mysql_fetch_assoc($req_v);
            $letter_grade = $row_v['letter_grade'];
            $idSession = $row_v['idSession'];
            $code_note = $row_v['code_note'];

        ?>

        <!-- Modifier -->
        <?php if ($letter_grade != ""): ?>
        <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
          <td><?php echo $row['code_cours']; ?></td>
          <td class="text-left"><?php echo $row['titre_eng']; ?></td>
          <td><?php echo $row['nbr_credit']; ?></td>
          <td class="td_edit_<?php echo $class; ?>">
            <?php
                if ($letter_grade == "T") {
                  $type = 1;
                }
                if ($letter_grade != "" && $letter_grade != "T") {
                    $type = 2;
                }
            ?>
                <select class="form-control type_<?php echo $class; ?>"
                  onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                  <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                  <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                  <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                </select>
            <?php

             ?>

          </td>
          <td class="td_session_edit_<?php echo $class; ?>">
                <?php
                if ($idSession == 0){ ?>
                    <select class="form-control session_<?php echo $class; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                     $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                     $req7=@mysql_query($sql7);
                     while($row7=mysql_fetch_assoc($req7)){
                         $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                         $cs=$row7['idSession'];
                         $cc=$row7['academic_year'];
                     ?>
                       <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                     <?php
                     }
                     ?>
                   </select>
                <?php }else{ ?>
                  <select class="form-control session_<?php echo $class; ?>"
                    onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
                <?php } ?>
          </td>
          <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
          <td>
            <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
          </td>
        </tr>
        <?php endif; ?>
        <!-- ajouter -->
          <tr class="text-center tr_<?php echo $class; ?>">
            <td><?php echo $row['code_cours']; ?></td>
            <td class="text-left"><?php echo $row['titre_eng']; ?></td>
            <td><?php echo $row['nbr_credit']; ?></td>
            <td class="td_<?php echo $class; ?>">
              <?php

                if ($letter_grade != null) {
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    echo "Transfer";
                  }else{
                    echo "Enrolled";
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }
                }else{
              ?>
                  <select class="form-control type_<?php echo $class; ?>"
                    onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>
              <?php
                }
               ?>

            </td>
            <td class="td_session_<?php echo $class; ?>">
              <?php if ($idSession != null){ ?>
                  <?php if ($idSession == 0){ ?>
                      <?php echo "-"; ?>
                  <?php }else{
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                          $req7=@mysql_query($sql7);
                          $row7=mysql_fetch_assoc($req7);
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                		      echo $ns;
                        } ?>
              <?php }else{ ?>
                  <select class="form-control session_<?php echo $class; ?>"
                    onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
              		  $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
              		  $req7=@mysql_query($sql7);
              		  while($row7=mysql_fetch_assoc($req7)){
              		      $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
              		      $cs=$row7['idSession'];
              		      $cc=$row7['academic_year'];
              		  ?>
              		    <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
              		  <?php
              		  }
              		  ?>
            			</select>
                <?php } ?>
            </td>
            <td class="td_grade_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
            <td>
              <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php
          }
        ?>

        <!-- Electives 10th 1 -->
        <?php
          // verify if the cours is tr or enrolled Language courses
          $_number = 1;
          $type = 0;
          $other_language = 0;

          $sql_v = "SELECT count(*) as nb FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3))  and code_cours in ('10099012','100990') ";

          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $other_language = $row_v['nb'];
        //  var_dump($other_language);



          $sql_v = "SELECT code_note,code_cours,letter_grade,idSession,stage FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3) and code_cours not in ($electives)) and stage = $grade order by code_note";
          //var_dump($sql_v);
          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $code_cours_elective = $row_v['code_cours'];
          $letter_grade = $row_v['letter_grade'];
          $idSession = $row_v['idSession'];
          $code_note = $row_v['code_note'];
          $stage = $row_v['stage'];
        //    var_dump($code_cours_elective);

          if ($code_cours_elective != null) {

            if ($stage == null) {
              //here to change the order of courses language in stage fields if this fields equal NULL
              $sql_u1 = "UPDATE $table_note_sql SET `stage` = $grade WHERE `code_note` = $code_note";
              // var_dump($sql_u1);
              $req_u1  =@mysql_query($sql_u1) or die ('Error in Sql'.$sql_u1);
            }


            if ($code_cours_elective != "10099012" && $code_cours_elective != "100990") {
              $electives .= ",'$code_cours_elective'";
              $electives_select .= ",'$code_cours_elective'";
            }



            // course info
            $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective' ";
            $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
            $row = mysql_fetch_assoc($req);
            $class = str_replace("/","_",$row['code_cours']);
            ?>
            <!-- Modifier -->
            <?php if ($letter_grade != ""): ?>
              <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
                <td><?php echo $row['code_cours']; ?></td>
                <td class="text-left"><?php echo $row['titre_eng']; ?></td>
                <td><?php echo $row['nbr_credit']; ?></td>
                <td class="td_edit_<?php echo $class; ?>">
                  <?php
                      if ($letter_grade == "T") {
                        $type = 1;
                      }
                      if ($letter_grade != "" && $letter_grade != "T") {
                          $type = 2;
                      }
                  ?>
                      <select class="form-control type_<?php echo $class; ?>"
                        onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                        <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                        <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                      </select>
                  <?php

                   ?>

                </td>
                <td class="td_session_edit_<?php echo $class; ?>">
                      <?php
                      if ($idSession == 0){ ?>
                          <select class="form-control session_<?php echo $class; ?>"
                            onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                            <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                            <?php
                           $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                           $req7=@mysql_query($sql7);
                           while($row7=mysql_fetch_assoc($req7)){
                               $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                               $cs=$row7['idSession'];
                               $cc=$row7['academic_year'];
                           ?>
                             <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                           <?php
                           }
                           ?>
                         </select>
                      <?php }else{ ?>
                        <select class="form-control session_<?php echo $class; ?>"
                          onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                          <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                          <?php
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                          $req7=@mysql_query($sql7);
                          while($row7=mysql_fetch_assoc($req7)){
                              $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                              $cs=$row7['idSession'];
                              $cc=$row7['academic_year'];
                          ?>
                            <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <?php } ?>
                </td>
                <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
                <td>
                  <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
                </td>
              </tr>
            <?php endif; ?>

            <!-- ajouter -->
            <tr class="text-center tr_<?php echo $class; ?>">
              <td>Electives <?php echo $_number; ?></td>
              <td class="text-left">
                <?php echo $row['code_cours']." / ".$row['titre_eng']; ?>

              </td>
              <td><?php echo $row['nbr_credit']; ?></td>
              <td class="td_<?php echo $class; ?>">
                <?php
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      echo "Transfer";
                    }else{
                      echo "Enrolled";
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }else{
                ?>
                    <select class="form-control type_<?php echo $class; ?>"
                      onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                      <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                      <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                    </select>
                <?php
                  }
                 ?>

              </td>
              <td class="td_session_elective_<?php echo $class; ?>">
                <?php if ($idSession != null){ ?>
                    <?php if ($idSession == 0){ ?>
                        <?php echo "-"; ?>
                    <?php }else{
                            $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                            $req7=@mysql_query($sql7);
                            $row7=mysql_fetch_assoc($req7);
                            $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                            echo $ns;
                          } ?>
                <?php }else{ ?>
                    <select class="form-control session_elective_<?php echo $grade; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
              </td>
              <td class="td_grade_elective_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
              <td>
                <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
                <?php endif; ?>

              </td>
            </tr>
            <?php

            if ($code_cours_elective == "10099012"or $code_cours_elective == "100990") {

              $other_language = $other_language-1;

              //var_dump($other_language);
              if ($other_language == 0) {
                $electives .= ",'$code_cours_elective'";
              }
            }

          }else{  ?>
          <tr class="text-center">
            <td>Electives <?php echo $_number; ?></td>
            <td class="text-left td_title_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
              <select class="form-control elective_grade_<?php echo $_number; ?>_<?php echo $grade; ?>" onchange="change_courses_elect(<?php echo $grade ?>,<?php echo $_number ?>)" >
                <option value="">Choose Elective course</option>
                <?php
                    $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE
                    `type` in (2,3) and nbr_credit = 1  and code_cours not in ($electives_select) order by titre_eng";
                    $req = mysql_query($sql) or die("SQL ERROR");
                    while($row = mysql_fetch_assoc($req)){
                ?>
                      <option value="<?php echo $row['code_cours']; ?>"><?php echo $row['code_cours']." / ".$row['titre_eng']." - Cr : ".$row['nbr_credit']; ?></option>
                <?php
                    }
                ?>
              </select>
            </td>
            <td>

            </td>
            <td class="td_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
                  <select class="form-control type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>  select_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_type_electi('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>

            </td>
            <td class="td_session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">

                  <select class="form-control session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_session_elect('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
            </td>
            <td class="td_grade_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"></td>
            <td>
              <?php if ($letter_grade != ""): ?>
                <button type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Edit</button>
              <?php endif; ?>
            </td>
          </tr>

        <?php } ?>



        <!-- Electives 10th 2 -->
        <?php
          // verify if the cours is tr or enrolled Language courses
          $_number = 2;
          $type = 0;
          $other_language = 0;

          $sql_v = "SELECT count(*) as nb FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3))  and code_cours in ('10099012','100990') ";

          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $other_language = $row_v['nb'];
        //  var_dump($other_language);



          $sql_v = "SELECT code_note,code_cours,letter_grade,idSession,stage FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3) and code_cours not in ($electives)) and stage = $grade order by code_note";
          //var_dump($sql_v);
          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $code_cours_elective = $row_v['code_cours'];
          $letter_grade = $row_v['letter_grade'];
          $idSession = $row_v['idSession'];
          $code_note = $row_v['code_note'];
          $stage = $row_v['stage'];
        //    var_dump($code_cours_elective);

          if ($code_cours_elective != null) {

            if ($stage == null) {
              //here to change the order of courses language in stage fields if this fields equal NULL
              $sql_u1 = "UPDATE $table_note_sql SET `stage` = $grade WHERE `code_note` = $code_note";
              // var_dump($sql_u1);
              $req_u1  =@mysql_query($sql_u1) or die ('Error in Sql'.$sql_u1);
            }


            if ($code_cours_elective != "10099012" && $code_cours_elective != "100990") {
              $electives .= ",'$code_cours_elective'";
              $electives_select .= ",'$code_cours_elective'";
            }



            // course info
            $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective' ";
            $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
            $row = mysql_fetch_assoc($req);
            $class = str_replace("/","_",$row['code_cours']);
            ?>
            <!-- Modifier -->
            <?php if ($letter_grade != ""): ?>
              <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
                <td><?php echo $row['code_cours']; ?></td>
                <td class="text-left"><?php echo $row['titre_eng']; ?></td>
                <td><?php echo $row['nbr_credit']; ?></td>
                <td class="td_edit_<?php echo $class; ?>">
                  <?php
                      if ($letter_grade == "T") {
                        $type = 1;
                      }
                      if ($letter_grade != "" && $letter_grade != "T") {
                          $type = 2;
                      }
                  ?>
                      <select class="form-control type_<?php echo $class; ?>"
                        onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                        <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                        <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                      </select>
                  <?php

                   ?>

                </td>
                <td class="td_session_edit_<?php echo $class; ?>">
                      <?php
                      if ($idSession == 0){ ?>
                          <select class="form-control session_<?php echo $class; ?>"
                            onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                            <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                            <?php
                           $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                           $req7=@mysql_query($sql7);
                           while($row7=mysql_fetch_assoc($req7)){
                               $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                               $cs=$row7['idSession'];
                               $cc=$row7['academic_year'];
                           ?>
                             <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                           <?php
                           }
                           ?>
                         </select>
                      <?php }else{ ?>
                        <select class="form-control session_<?php echo $class; ?>"
                          onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                          <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                          <?php
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                          $req7=@mysql_query($sql7);
                          while($row7=mysql_fetch_assoc($req7)){
                              $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                              $cs=$row7['idSession'];
                              $cc=$row7['academic_year'];
                          ?>
                            <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <?php } ?>
                </td>
                <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
                <td>
                  <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
                </td>
              </tr>
            <?php endif; ?>

            <!-- ajouter -->
            <tr class="text-center tr_<?php echo $class; ?>">
              <td>Electives <?php echo $_number; ?></td>
              <td class="text-left">
                <?php echo $row['code_cours']." / ".$row['titre_eng']; ?>

              </td>
              <td><?php echo $row['nbr_credit']; ?></td>
              <td class="td_<?php echo $class; ?>">
                <?php
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      echo "Transfer";
                    }else{
                      echo "Enrolled";
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }else{
                ?>
                    <select class="form-control type_<?php echo $class; ?>"
                      onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                      <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                      <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                    </select>
                <?php
                  }
                 ?>

              </td>
              <td class="td_session_elective_<?php echo $class; ?>">
                <?php if ($idSession != null){ ?>
                    <?php if ($idSession == 0){ ?>
                        <?php echo "-"; ?>
                    <?php }else{
                            $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                            $req7=@mysql_query($sql7);
                            $row7=mysql_fetch_assoc($req7);
                            $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                            echo $ns;
                          } ?>
                <?php }else{ ?>
                    <select class="form-control session_elective_<?php echo $grade; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
              </td>
              <td class="td_grade_elective_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
              <td>
                <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
                <?php endif; ?>

              </td>
            </tr>
            <?php

            if ($code_cours_elective == "10099012"or $code_cours_elective == "100990") {

              $other_language = $other_language-1;

              //var_dump($other_language);
              if ($other_language == 0) {
                $electives .= ",'$code_cours_elective'";
              }
            }

          }else{  ?>
          <tr class="text-center">
            <td>Electives <?php echo $_number; ?></td>
            <td class="text-left td_title_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
              <select class="form-control elective_grade_<?php echo $_number; ?>_<?php echo $grade; ?>" onchange="change_courses_elect(<?php echo $grade ?>,<?php echo $_number ?>)" >
                <option value="">Choose Elective course</option>
                <?php
                    $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE
                    `type` in (2,3) and nbr_credit = 1 and code_cours  not in ($electives_select) order by titre_eng";
                    $req = mysql_query($sql) or die("SQL ERROR");
                    while($row = mysql_fetch_assoc($req)){
                ?>
                      <option value="<?php echo $row['code_cours']; ?>"><?php echo $row['code_cours']." / ".$row['titre_eng']." - Cr : ".$row['nbr_credit']; ?></option>
                <?php
                    }
                ?>
              </select>
            </td>
            <td>

            </td>
            <td class="td_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
                  <select class="form-control type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>  select_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_type_electi('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>

            </td>
            <td class="td_session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">

                  <select class="form-control session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_session_elect('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
            </td>
            <td class="td_grade_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"></td>
            <td>
              <?php if ($letter_grade != ""): ?>
                <button type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Edit</button>
              <?php endif; ?>
            </td>
          </tr>

        <?php } ?>



    </table>
  </div>
  <!-- 11th -->
  <div class="col-md-12" style="margin-top:10px">
    <table class="table table-bordered">
      <tr class="text-center">
        <th colspan="3">Grade : 11th</th>
        <th colspan="4">1 year courses</th>
      </tr>
      <tr class="text-center">
        <th>Code cours</th>
        <th class="text-left">Title</th>
        <th>Cr</th>
        <th>Type</th>
        <th>Session</th>
        <th>Grade</th>
        <th>Action</th>
      </tr>

        <?php
          //

          $grade = 11;
          $type = 0;
          $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE `tr_partner` = 1 and `grade`= $grade";
          $req = mysql_query($sql) or die("SQL ERROR");
          while($row = mysql_fetch_assoc($req)){
            $code_cours = $row['code_cours'];
            $class = str_replace("/","_",$row['code_cours']);
            $type = "";

            // verify if the cours is tr or enrolled
            $sql_v = "SELECT code_note,letter_grade,idSession FROM $table_note_sql
            WHERE code_inscription='$code_inscription'
            AND code_cours= '$code_cours'";
            $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
            $row_v = mysql_fetch_assoc($req_v);
            $letter_grade = $row_v['letter_grade'];
            $idSession = $row_v['idSession'];
            $code_note = $row_v['code_note'];

        ?>

        <!-- Modifier -->
        <?php if ($letter_grade != ""): ?>
        <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
          <td><?php echo $row['code_cours']; ?></td>
          <td class="text-left"><?php echo $row['titre_eng']; ?></td>
          <td><?php echo $row['nbr_credit']; ?></td>
          <td class="td_edit_<?php echo $class; ?>">
            <?php
                if ($letter_grade == "T") {
                  $type = 1;
                }
                if ($letter_grade != "" && $letter_grade != "T") {
                    $type = 2;
                }
            ?>
                <select class="form-control type_<?php echo $class; ?>"
                  onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                  <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                  <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                  <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                </select>
            <?php

             ?>

          </td>
          <td class="td_session_edit_<?php echo $class; ?>">
                <?php
                if ($idSession == 0){ ?>
                    <select class="form-control session_<?php echo $class; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                     $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                     $req7=@mysql_query($sql7);
                     while($row7=mysql_fetch_assoc($req7)){
                         $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                         $cs=$row7['idSession'];
                         $cc=$row7['academic_year'];
                     ?>
                       <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                     <?php
                     }
                     ?>
                   </select>
                <?php }else{ ?>
                  <select class="form-control session_<?php echo $class; ?>"
                    onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
                <?php } ?>
          </td>
          <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
          <td>
            <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
          </td>
        </tr>
        <?php endif; ?>
        <!-- ajouter -->
          <tr class="text-center tr_<?php echo $class; ?>">
            <td><?php echo $row['code_cours']; ?></td>
            <td class="text-left"><?php echo $row['titre_eng']; ?></td>
            <td><?php echo $row['nbr_credit']; ?></td>
            <td class="td_<?php echo $class; ?>">
              <?php

                if ($letter_grade != null) {
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    echo "Transfer";
                  }else{
                    echo "Enrolled";
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }
                }else{
              ?>
                  <select class="form-control type_<?php echo $class; ?>"
                    onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>
              <?php
                }
               ?>

            </td>
            <td class="td_session_<?php echo $class; ?>">
              <?php if ($idSession != null){ ?>
                  <?php if ($idSession == 0){ ?>
                      <?php echo "-"; ?>
                  <?php }else{
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                          $req7=@mysql_query($sql7);
                          $row7=mysql_fetch_assoc($req7);
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                		      echo $ns;
                        } ?>
              <?php }else{ ?>
                  <select class="form-control session_<?php echo $class; ?>"
                    onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
              		  $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
              		  $req7=@mysql_query($sql7);
              		  while($row7=mysql_fetch_assoc($req7)){
              		      $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
              		      $cs=$row7['idSession'];
              		      $cc=$row7['academic_year'];
              		  ?>
              		    <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
              		  <?php
              		  }
              		  ?>
            			</select>
                <?php } ?>
            </td>
            <td class="td_grade_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
            <td>
              <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php
          }
        ?>
        <!-- Electives 11th 1 -->
        <?php
          // verify if the cours is tr or enrolled Language courses
          $_number = 1;
          $type = 0;
          $other_language = 0;

          $sql_v = "SELECT count(*) as nb FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3))  and code_cours in ('10099012','100990') ";

          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $other_language = $row_v['nb'];
        //  var_dump($other_language);



          $sql_v = "SELECT code_note,code_cours,letter_grade,idSession,stage FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3) and code_cours not in ($electives)) and stage = $grade order by code_note";
          //var_dump($sql_v);
          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $code_cours_elective = $row_v['code_cours'];
          $letter_grade = $row_v['letter_grade'];
          $idSession = $row_v['idSession'];
          $code_note = $row_v['code_note'];
          $stage = $row_v['stage'];
        //    var_dump($code_cours_elective);

          if ($code_cours_elective != null) {

            if ($stage == null) {
              //here to change the order of courses language in stage fields if this fields equal NULL
              $sql_u1 = "UPDATE $table_note_sql SET `stage` = $grade WHERE `code_note` = $code_note";
              // var_dump($sql_u1);
              $req_u1  =@mysql_query($sql_u1) or die ('Error in Sql'.$sql_u1);
            }


            if ($code_cours_elective != "10099012" && $code_cours_elective != "100990") {
              $electives .= ",'$code_cours_elective'";
              $electives_select .= ",'$code_cours_elective'";
            }



            // course info
            $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective' ";
            $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
            $row = mysql_fetch_assoc($req);
            $class = str_replace("/","_",$row['code_cours']);
            ?>
            <!-- Modifier -->
            <?php if ($letter_grade != ""): ?>
              <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
                <td><?php echo $row['code_cours']; ?></td>
                <td class="text-left"><?php echo $row['titre_eng']; ?></td>
                <td><?php echo $row['nbr_credit']; ?></td>
                <td class="td_edit_<?php echo $class; ?>">
                  <?php
                      if ($letter_grade == "T") {
                        $type = 1;
                      }
                      if ($letter_grade != "" && $letter_grade != "T") {
                          $type = 2;
                      }
                  ?>
                      <select class="form-control type_<?php echo $class; ?>"
                        onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                        <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                        <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                      </select>
                  <?php

                   ?>

                </td>
                <td class="td_session_edit_<?php echo $class; ?>">
                      <?php
                      if ($idSession == 0){ ?>
                          <select class="form-control session_<?php echo $class; ?>"
                            onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                            <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                            <?php
                           $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                           $req7=@mysql_query($sql7);
                           while($row7=mysql_fetch_assoc($req7)){
                               $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                               $cs=$row7['idSession'];
                               $cc=$row7['academic_year'];
                           ?>
                             <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                           <?php
                           }
                           ?>
                         </select>
                      <?php }else{ ?>
                        <select class="form-control session_<?php echo $class; ?>"
                          onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                          <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                          <?php
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                          $req7=@mysql_query($sql7);
                          while($row7=mysql_fetch_assoc($req7)){
                              $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                              $cs=$row7['idSession'];
                              $cc=$row7['academic_year'];
                          ?>
                            <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <?php } ?>
                </td>
                <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
                <td>
                  <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
                </td>
              </tr>
            <?php endif; ?>

            <!-- ajouter -->
            <tr class="text-center tr_<?php echo $class; ?>">
              <td>Electives <?php echo $_number; ?></td>
              <td class="text-left">
                <?php echo $row['code_cours']." / ".$row['titre_eng']; ?>

              </td>
              <td><?php echo $row['nbr_credit']; ?></td>
              <td class="td_<?php echo $class; ?>">
                <?php
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      echo "Transfer";
                    }else{
                      echo "Enrolled";
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }else{
                ?>
                    <select class="form-control type_<?php echo $class; ?>"
                      onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                      <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                      <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                    </select>
                <?php
                  }
                 ?>

              </td>
              <td class="td_session_elective_<?php echo $class; ?>">
                <?php if ($idSession != null){ ?>
                    <?php if ($idSession == 0){ ?>
                        <?php echo "-"; ?>
                    <?php }else{
                            $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                            $req7=@mysql_query($sql7);
                            $row7=mysql_fetch_assoc($req7);
                            $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                            echo $ns;
                          } ?>
                <?php }else{ ?>
                    <select class="form-control session_elective_<?php echo $grade; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
              </td>
              <td class="td_grade_elective_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
              <td>
                <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
                <?php endif; ?>

              </td>
            </tr>
            <?php

            if ($code_cours_elective == "10099012"or $code_cours_elective == "100990") {

              $other_language = $other_language-1;

              //var_dump($other_language);
              if ($other_language == 0) {
                $electives .= ",'$code_cours_elective'";
              }
            }

          }else{  ?>
          <tr class="text-center">
            <td>Electives <?php echo $_number; ?></td>
            <td class="text-left td_title_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
              <select class="form-control elective_grade_<?php echo $_number; ?>_<?php echo $grade; ?>" onchange="change_courses_elect(<?php echo $grade ?>,<?php echo $_number ?>)" >
                <option value="">Choose Elective course</option>
                <?php
                    $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE
                    `type` in (2,3) and nbr_credit = 0.5 and code_cours not in ($electives_select) order by titre_eng";
                    $req = mysql_query($sql) or die("SQL ERROR");
                    while($row = mysql_fetch_assoc($req)){
                ?>
                      <option value="<?php echo $row['code_cours']; ?>"><?php echo $row['code_cours']." / ".$row['titre_eng']." - Cr : ".$row['nbr_credit']; ?></option>
                <?php
                    }
                ?>
              </select>
            </td>
            <td>

            </td>
            <td class="td_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
                  <select class="form-control type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>  select_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_type_electi('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>

            </td>
            <td class="td_session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">

                  <select class="form-control session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_session_elect('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
            </td>
            <td class="td_grade_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"></td>
            <td>
              <?php if ($letter_grade != ""): ?>
                <button type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Edit</button>
              <?php endif; ?>
            </td>
          </tr>

        <?php } ?>



        <!-- Electives 11th 2 -->
        <?php
          // verify if the cours is tr or enrolled Language courses
          $_number = 2;
          $type = 0;
          $other_language = 0;

          $sql_v = "SELECT count(*) as nb FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3))  and code_cours in ('10099012','100990') ";

          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $other_language = $row_v['nb'];
        //  var_dump($other_language);



          $sql_v = "SELECT code_note,code_cours,letter_grade,idSession,stage FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3) and code_cours not in ($electives)) and stage = $grade order by code_note";
          //var_dump($sql_v);
          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $code_cours_elective = $row_v['code_cours'];
          $letter_grade = $row_v['letter_grade'];
          $idSession = $row_v['idSession'];
          $code_note = $row_v['code_note'];
          $stage = $row_v['stage'];
        //    var_dump($code_cours_elective);

          if ($code_cours_elective != null) {

            if ($stage == null) {
              //here to change the order of courses language in stage fields if this fields equal NULL
              $sql_u1 = "UPDATE $table_note_sql SET `stage` = $grade WHERE `code_note` = $code_note";
              // var_dump($sql_u1);
              $req_u1  =@mysql_query($sql_u1) or die ('Error in Sql'.$sql_u1);
            }


            if ($code_cours_elective != "10099012" && $code_cours_elective != "100990") {
              $electives .= ",'$code_cours_elective'";
              $electives_select .= ",'$code_cours_elective'";
            }



            // course info
            $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective' ";
            $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
            $row = mysql_fetch_assoc($req);
            $class = str_replace("/","_",$row['code_cours']);
            ?>
            <!-- Modifier -->
            <?php if ($letter_grade != ""): ?>
              <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
                <td><?php echo $row['code_cours']; ?></td>
                <td class="text-left"><?php echo $row['titre_eng']; ?></td>
                <td><?php echo $row['nbr_credit']; ?></td>
                <td class="td_edit_<?php echo $class; ?>">
                  <?php
                      if ($letter_grade == "T") {
                        $type = 1;
                      }
                      if ($letter_grade != "" && $letter_grade != "T") {
                          $type = 2;
                      }
                  ?>
                      <select class="form-control type_<?php echo $class; ?>"
                        onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                        <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                        <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                      </select>
                  <?php

                   ?>

                </td>
                <td class="td_session_edit_<?php echo $class; ?>">
                      <?php
                      if ($idSession == 0){ ?>
                          <select class="form-control session_<?php echo $class; ?>"
                            onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                            <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                            <?php
                           $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                           $req7=@mysql_query($sql7);
                           while($row7=mysql_fetch_assoc($req7)){
                               $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                               $cs=$row7['idSession'];
                               $cc=$row7['academic_year'];
                           ?>
                             <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                           <?php
                           }
                           ?>
                         </select>
                      <?php }else{ ?>
                        <select class="form-control session_<?php echo $class; ?>"
                          onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                          <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                          <?php
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                          $req7=@mysql_query($sql7);
                          while($row7=mysql_fetch_assoc($req7)){
                              $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                              $cs=$row7['idSession'];
                              $cc=$row7['academic_year'];
                          ?>
                            <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <?php } ?>
                </td>
                <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
                <td>
                  <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
                </td>
              </tr>
            <?php endif; ?>

            <!-- ajouter -->
            <tr class="text-center tr_<?php echo $class; ?>">
              <td>Electives <?php echo $_number; ?></td>
              <td class="text-left">
                <?php echo $row['code_cours']." / ".$row['titre_eng']; ?>

              </td>
              <td><?php echo $row['nbr_credit']; ?></td>
              <td class="td_<?php echo $class; ?>">
                <?php
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      echo "Transfer";
                    }else{
                      echo "Enrolled";
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }else{
                ?>
                    <select class="form-control type_<?php echo $class; ?>"
                      onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                      <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                      <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                    </select>
                <?php
                  }
                 ?>

              </td>
              <td class="td_session_elective_<?php echo $class; ?>">
                <?php if ($idSession != null){ ?>
                    <?php if ($idSession == 0){ ?>
                        <?php echo "-"; ?>
                    <?php }else{
                            $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                            $req7=@mysql_query($sql7);
                            $row7=mysql_fetch_assoc($req7);
                            $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                            echo $ns;
                          } ?>
                <?php }else{ ?>
                    <select class="form-control session_elective_<?php echo $grade; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
              </td>
              <td class="td_grade_elective_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
              <td>
                <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
                <?php endif; ?>

              </td>
            </tr>
            <?php

            if ($code_cours_elective == "10099012"or $code_cours_elective == "100990") {

              $other_language = $other_language-1;

              //var_dump($other_language);
              if ($other_language == 0) {
                $electives .= ",'$code_cours_elective'";
              }
            }

          }else{  ?>
          <tr class="text-center">
            <td>Electives <?php echo $_number; ?></td>
            <td class="text-left td_title_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
              <select class="form-control elective_grade_<?php echo $_number; ?>_<?php echo $grade; ?>" onchange="change_courses_elect(<?php echo $grade ?>,<?php echo $_number ?>)" >
                <option value="">Choose Elective course</option>
                <?php
                    $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE
                    `type` in (2,3) and nbr_credit = 1 and code_cours not in ($electives_select) order by titre_eng";
                    $req = mysql_query($sql) or die("SQL ERROR");
                    while($row = mysql_fetch_assoc($req)){
                ?>
                      <option value="<?php echo $row['code_cours']; ?>"><?php echo $row['code_cours']." / ".$row['titre_eng']." - Cr : ".$row['nbr_credit']; ?></option>
                <?php
                    }
                ?>
              </select>
            </td>
            <td>

            </td>
            <td class="td_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
                  <select class="form-control type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>  select_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_type_electi('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>

            </td>
            <td class="td_session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">

                  <select class="form-control session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_session_elect('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
            </td>
            <td class="td_grade_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"></td>
            <td>
              <?php if ($letter_grade != ""): ?>
                <button type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Edit</button>
              <?php endif; ?>
            </td>
          </tr>

        <?php } ?>

        <!-- Electives 11th 3 -->
        <?php
          // verify if the cours is tr or enrolled Language courses
          $_number = 3;
          $type = 0;
          $other_language = 0;

          $sql_v = "SELECT count(*) as nb FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3))  and code_cours in ('10099012','100990') ";

          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $other_language = $row_v['nb'];
        //  var_dump($other_language);



          $sql_v = "SELECT code_note,code_cours,letter_grade,idSession,stage FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3) and code_cours not in ($electives)) and stage = $grade order by code_note";
          //var_dump($sql_v);
          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $code_cours_elective = $row_v['code_cours'];
          $letter_grade = $row_v['letter_grade'];
          $idSession = $row_v['idSession'];
          $code_note = $row_v['code_note'];
          $stage = $row_v['stage'];
        //    var_dump($code_cours_elective);

          if ($code_cours_elective != null) {

            if ($stage == null) {
              //here to change the order of courses language in stage fields if this fields equal NULL
              $sql_u1 = "UPDATE $table_note_sql SET `stage` = $grade WHERE `code_note` = $code_note";
              // var_dump($sql_u1);
              $req_u1  =@mysql_query($sql_u1) or die ('Error in Sql'.$sql_u1);
            }


            if ($code_cours_elective != "10099012" && $code_cours_elective != "100990") {
              $electives .= ",'$code_cours_elective'";
              $electives_select .= ",'$code_cours_elective'";
            }



            // course info
            $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective' ";
            $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
            $row = mysql_fetch_assoc($req);
            $class = str_replace("/","_",$row['code_cours']);
            ?>
            <!-- Modifier -->
            <?php if ($letter_grade != ""): ?>
              <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
                <td><?php echo $row['code_cours']; ?></td>
                <td class="text-left"><?php echo $row['titre_eng']; ?></td>
                <td><?php echo $row['nbr_credit']; ?></td>
                <td class="td_edit_<?php echo $class; ?>">
                  <?php
                      if ($letter_grade == "T") {
                        $type = 1;
                      }
                      if ($letter_grade != "" && $letter_grade != "T") {
                          $type = 2;
                      }
                  ?>
                      <select class="form-control type_<?php echo $class; ?>"
                        onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                        <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                        <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                      </select>
                  <?php

                   ?>

                </td>
                <td class="td_session_edit_<?php echo $class; ?>">
                      <?php
                      if ($idSession == 0){ ?>
                          <select class="form-control session_<?php echo $class; ?>"
                            onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                            <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                            <?php
                           $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                           $req7=@mysql_query($sql7);
                           while($row7=mysql_fetch_assoc($req7)){
                               $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                               $cs=$row7['idSession'];
                               $cc=$row7['academic_year'];
                           ?>
                             <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                           <?php
                           }
                           ?>
                         </select>
                      <?php }else{ ?>
                        <select class="form-control session_<?php echo $class; ?>"
                          onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                          <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                          <?php
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                          $req7=@mysql_query($sql7);
                          while($row7=mysql_fetch_assoc($req7)){
                              $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                              $cs=$row7['idSession'];
                              $cc=$row7['academic_year'];
                          ?>
                            <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <?php } ?>
                </td>
                <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
                <td>
                  <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
                </td>
              </tr>
            <?php endif; ?>

            <!-- ajouter -->
            <tr class="text-center tr_<?php echo $class; ?>">
              <td>Electives <?php echo $_number; ?></td>
              <td class="text-left">
                <?php echo $row['code_cours']." / ".$row['titre_eng']; ?>

              </td>
              <td><?php echo $row['nbr_credit']; ?></td>
              <td class="td_<?php echo $class; ?>">
                <?php
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      echo "Transfer";
                    }else{
                      echo "Enrolled";
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }else{
                ?>
                    <select class="form-control type_<?php echo $class; ?>"
                      onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                      <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                      <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                    </select>
                <?php
                  }
                 ?>

              </td>
              <td class="td_session_elective_<?php echo $class; ?>">
                <?php if ($idSession != null){ ?>
                    <?php if ($idSession == 0){ ?>
                        <?php echo "-"; ?>
                    <?php }else{
                            $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                            $req7=@mysql_query($sql7);
                            $row7=mysql_fetch_assoc($req7);
                            $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                            echo $ns;
                          } ?>
                <?php }else{ ?>
                    <select class="form-control session_elective_<?php echo $grade; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
              </td>
              <td class="td_grade_elective_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
              <td>
                <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
                <?php endif; ?>

              </td>
            </tr>
            <?php

            if ($code_cours_elective == "10099012"or $code_cours_elective == "100990") {

              $other_language = $other_language-1;

              //var_dump($other_language);
              if ($other_language == 0) {
                $electives .= ",'$code_cours_elective'";
              }
            }

          }else{  ?>
          <tr class="text-center">
            <td>Electives <?php echo $_number; ?></td>
            <td class="text-left td_title_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
              <select class="form-control elective_grade_<?php echo $_number; ?>_<?php echo $grade; ?>" onchange="change_courses_elect(<?php echo $grade ?>,<?php echo $_number ?>)" >
                <option value="">Choose Elective course</option>
                <?php
                    $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE
                    `type` in (2,3) and nbr_credit = 1 and code_cours not in ($electives_select) order by titre_eng";
                    $req = mysql_query($sql) or die("SQL ERROR");
                    while($row = mysql_fetch_assoc($req)){
                ?>
                      <option value="<?php echo $row['code_cours']; ?>"><?php echo $row['code_cours']." / ".$row['titre_eng']." - Cr : ".$row['nbr_credit']; ?></option>
                <?php
                    }
                ?>
              </select>
            </td>
            <td>

            </td>
            <td class="td_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
                  <select class="form-control type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>  select_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_type_electi('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>

            </td>
            <td class="td_session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">

                  <select class="form-control session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_session_elect('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
            </td>
            <td class="td_grade_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"></td>
            <td>
              <?php if ($letter_grade != ""): ?>
                <button type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Edit</button>
              <?php endif; ?>
            </td>
          </tr>

        <?php } ?>

    </table>
  </div>
  <!-- 12th -->
  <div class="col-md-12" style="margin-top:10px">
    <table class="table table-bordered">
      <tr class="text-center">
        <th colspan="3">Grade : 12th</th>
        <th colspan="4">1 year courses</th>
      </tr>
      <tr class="text-center">
        <th>Code cours</th>
        <th class="text-left">Title</th>
        <th>Cr</th>
        <th>Type</th>
        <th>Session</th>
        <th>Grade</th>
        <th>Action</th>
      </tr>

        <?php
          //

          $grade = 12;
          $type = 0;
          $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE `tr_partner` = 1 and `grade`= $grade";
          $req = mysql_query($sql) or die("SQL ERROR");
          while($row = mysql_fetch_assoc($req)){
            $code_cours = $row['code_cours'];
            $class = str_replace("/","_",$row['code_cours']);
            $type = "";

            // verify if the cours is tr or enrolled
            $sql_v = "SELECT code_note,letter_grade,idSession FROM $table_note_sql
            WHERE code_inscription='$code_inscription'
            AND code_cours= '$code_cours'";
            $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
            $row_v = mysql_fetch_assoc($req_v);
            $letter_grade = $row_v['letter_grade'];
            $idSession = $row_v['idSession'];
            $code_note = $row_v['code_note'];

        ?>

        <!-- Modifier -->
        <?php if ($letter_grade != ""): ?>
        <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
          <td><?php echo $row['code_cours']; ?></td>
          <td class="text-left"><?php echo $row['titre_eng']; ?></td>
          <td><?php echo $row['nbr_credit']; ?></td>
          <td class="td_edit_<?php echo $class; ?>">
            <?php
                if ($letter_grade == "T") {
                  $type = 1;
                }
                if ($letter_grade != "" && $letter_grade != "T") {
                    $type = 2;
                }
            ?>
                <select class="form-control type_<?php echo $class; ?>"
                  onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                  <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                  <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                  <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                </select>
            <?php

             ?>

          </td>
          <td class="td_session_edit_<?php echo $class; ?>">
                <?php
                if ($idSession == 0){ ?>
                    <select class="form-control session_<?php echo $class; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                     $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                     $req7=@mysql_query($sql7);
                     while($row7=mysql_fetch_assoc($req7)){
                         $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                         $cs=$row7['idSession'];
                         $cc=$row7['academic_year'];
                     ?>
                       <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                     <?php
                     }
                     ?>
                   </select>
                <?php }else{ ?>
                  <select class="form-control session_<?php echo $class; ?>"
                    onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
                <?php } ?>
          </td>
          <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
          <td>
            <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
          </td>
        </tr>
        <?php endif; ?>
        <!-- ajouter -->
          <tr class="text-center tr_<?php echo $class; ?>">
            <td><?php echo $row['code_cours']; ?></td>
            <td class="text-left"><?php echo $row['titre_eng']; ?></td>
            <td><?php echo $row['nbr_credit']; ?></td>
            <td class="td_<?php echo $class; ?>">
              <?php

                if ($letter_grade != null) {
                  if ($letter_grade == "T") {
                    $ttl_tr=$ttl_tr+$row['nbr_credit'];
                    echo "Transfer";
                  }else{
                    echo "Enrolled";
                    $ttl_en=$ttl_en+$row['nbr_credit'];
                  }
                }else{
              ?>
                  <select class="form-control type_<?php echo $class; ?>"
                    onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>
              <?php
                }
               ?>

            </td>
            <td class="td_session_<?php echo $class; ?>">
              <?php if ($idSession != null){ ?>
                  <?php if ($idSession == 0){ ?>
                      <?php echo "-"; ?>
                  <?php }else{
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                          $req7=@mysql_query($sql7);
                          $row7=mysql_fetch_assoc($req7);
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                		      echo $ns;
                        } ?>
              <?php }else{ ?>
                  <select class="form-control session_<?php echo $class; ?>"
                    onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
              		  $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
              		  $req7=@mysql_query($sql7);
              		  while($row7=mysql_fetch_assoc($req7)){
              		      $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
              		      $cs=$row7['idSession'];
              		      $cc=$row7['academic_year'];
              		  ?>
              		    <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
              		  <?php
              		  }
              		  ?>
            			</select>
                <?php } ?>
            </td>
            <td class="td_grade_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
            <td>
              <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php
          }
        ?>
        <!-- Electives 12th 1 -->
        <?php
          // verify if the cours is tr or enrolled Language courses
          $_number = 1;
          $type = 0;
          $other_language = 0;

          $sql_v = "SELECT count(*) as nb FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3))  and code_cours in ('10099012','100990') ";

          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $other_language = $row_v['nb'];
        //  var_dump($other_language);



          $sql_v = "SELECT code_note,code_cours,letter_grade,idSession,stage FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3) and code_cours not in ($electives)) and stage = $grade order by code_note";
          //var_dump($sql_v);
          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $code_cours_elective = $row_v['code_cours'];
          $letter_grade = $row_v['letter_grade'];
          $idSession = $row_v['idSession'];
          $code_note = $row_v['code_note'];
          $stage = $row_v['stage'];
        //    var_dump($code_cours_elective);

          if ($code_cours_elective != null) {

            if ($stage == null) {
              //here to change the order of courses language in stage fields if this fields equal NULL
              $sql_u1 = "UPDATE $table_note_sql SET `stage` = $grade WHERE `code_note` = $code_note";
              // var_dump($sql_u1);
              $req_u1  =@mysql_query($sql_u1) or die ('Error in Sql'.$sql_u1);
            }


            if ($code_cours_elective != "10099012" && $code_cours_elective != "100990") {
              $electives .= ",'$code_cours_elective'";
              $electives_select .= ",'$code_cours_elective'";
            }



            // course info
            $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective' ";
            $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
            $row = mysql_fetch_assoc($req);
            $class = str_replace("/","_",$row['code_cours']);
            ?>
            <!-- Modifier -->
            <?php if ($letter_grade != ""): ?>
              <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
                <td><?php echo $row['code_cours']; ?></td>
                <td class="text-left"><?php echo $row['titre_eng']; ?></td>
                <td><?php echo $row['nbr_credit']; ?></td>
                <td class="td_edit_<?php echo $class; ?>">
                  <?php
                      if ($letter_grade == "T") {
                        $type = 1;
                      }
                      if ($letter_grade != "" && $letter_grade != "T") {
                          $type = 2;
                      }
                  ?>
                      <select class="form-control type_<?php echo $class; ?>"
                        onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                        <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                        <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                      </select>
                  <?php

                   ?>

                </td>
                <td class="td_session_edit_<?php echo $class; ?>">
                      <?php
                      if ($idSession == 0){ ?>
                          <select class="form-control session_<?php echo $class; ?>"
                            onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                            <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                            <?php
                           $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                           $req7=@mysql_query($sql7);
                           while($row7=mysql_fetch_assoc($req7)){
                               $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                               $cs=$row7['idSession'];
                               $cc=$row7['academic_year'];
                           ?>
                             <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                           <?php
                           }
                           ?>
                         </select>
                      <?php }else{ ?>
                        <select class="form-control session_<?php echo $class; ?>"
                          onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                          <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                          <?php
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                          $req7=@mysql_query($sql7);
                          while($row7=mysql_fetch_assoc($req7)){
                              $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                              $cs=$row7['idSession'];
                              $cc=$row7['academic_year'];
                          ?>
                            <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <?php } ?>
                </td>
                <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
                <td>
                  <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
                </td>
              </tr>
            <?php endif; ?>

            <!-- ajouter -->
            <tr class="text-center tr_<?php echo $class; ?>">
              <td>Electives <?php echo $_number; ?></td>
              <td class="text-left">
                <?php echo $row['code_cours']." / ".$row['titre_eng']; ?>

              </td>
              <td><?php echo $row['nbr_credit']; ?></td>
              <td class="td_<?php echo $class; ?>">
                <?php
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      echo "Transfer";
                    }else{
                      echo "Enrolled";
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }else{
                ?>
                    <select class="form-control type_<?php echo $class; ?>"
                      onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                      <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                      <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                    </select>
                <?php
                  }
                 ?>

              </td>
              <td class="td_session_elective_<?php echo $class; ?>">
                <?php if ($idSession != null){ ?>
                    <?php if ($idSession == 0){ ?>
                        <?php echo "-"; ?>
                    <?php }else{
                            $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                            $req7=@mysql_query($sql7);
                            $row7=mysql_fetch_assoc($req7);
                            $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                            echo $ns;
                          } ?>
                <?php }else{ ?>
                    <select class="form-control session_elective_<?php echo $grade; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
              </td>
              <td class="td_grade_elective_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
              <td>
                <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
                <?php endif; ?>

              </td>
            </tr>
            <?php

            if ($code_cours_elective == "10099012"or $code_cours_elective == "100990") {

              $other_language = $other_language-1;

              //var_dump($other_language);
              if ($other_language == 0) {
                $electives .= ",'$code_cours_elective'";
              }
            }

          }else{  ?>
          <tr class="text-center">
            <td>Electives <?php echo $_number; ?></td>
            <td class="text-left td_title_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
              <select class="form-control elective_grade_<?php echo $_number; ?>_<?php echo $grade; ?>" onchange="change_courses_elect(<?php echo $grade ?>,<?php echo $_number ?>)" >
                <option value="">Choose Elective course</option>
                <?php
                    $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE
                    `type` in (2,3) and nbr_credit = 1 and code_cours not in ($electives_select) order by titre_eng";
                    $req = mysql_query($sql) or die("SQL ERROR");
                    while($row = mysql_fetch_assoc($req)){
                ?>
                      <option value="<?php echo $row['code_cours']; ?>"><?php echo $row['code_cours']." / ".$row['titre_eng']." - Cr : ".$row['nbr_credit']; ?></option>
                <?php
                    }
                ?>
              </select>
            </td>
            <td>

            </td>
            <td class="td_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
                  <select class="form-control type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>  select_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_type_electi('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>

            </td>
            <td class="td_session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">

                  <select class="form-control session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_session_elect('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
            </td>
            <td class="td_grade_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"></td>
            <td>
              <?php if ($letter_grade != ""): ?>
                <button type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Edit</button>
              <?php endif; ?>
            </td>
          </tr>

        <?php } ?>



        <!-- Electives 12th 2 -->
        <?php
          // verify if the cours is tr or enrolled Language courses
          $_number = 2;
          $type = 0;
          $other_language = 0;

          $sql_v = "SELECT count(*) as nb FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3))  and code_cours in ('10099012','100990') ";

          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $other_language = $row_v['nb'];
        //  var_dump($other_language);



          $sql_v = "SELECT code_note,code_cours,letter_grade,idSession,stage FROM $table_note_sql
          WHERE code_inscription='$code_inscription'
          AND code_cours in (SELECT `code_cours` FROM `tbl_cours` WHERE
          `type` in (2,3) and code_cours not in ($electives)) and stage = $grade order by code_note";
          //var_dump($sql_v);
          $req_v  =@mysql_query($sql_v) or die ('Erreur de verification inscription ');
          $row_v = mysql_fetch_assoc($req_v);
          $code_cours_elective = $row_v['code_cours'];
          $letter_grade = $row_v['letter_grade'];
          $idSession = $row_v['idSession'];
          $code_note = $row_v['code_note'];
          $stage = $row_v['stage'];
        //    var_dump($code_cours_elective);

          if ($code_cours_elective != null) {

            if ($stage == null) {
              //here to change the order of courses language in stage fields if this fields equal NULL
              $sql_u1 = "UPDATE $table_note_sql SET `stage` = $grade WHERE `code_note` = $code_note";
              // var_dump($sql_u1);
              $req_u1  =@mysql_query($sql_u1) or die ('Error in Sql'.$sql_u1);
            }


            if ($code_cours_elective != "10099012" && $code_cours_elective != "100990") {
              $electives .= ",'$code_cours_elective'";
              $electives_select .= ",'$code_cours_elective'";
            }



            // course info
            $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours_elective' ";
            $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
            $row = mysql_fetch_assoc($req);
            $class = str_replace("/","_",$row['code_cours']);
            ?>
            <!-- Modifier -->
            <?php if ($letter_grade != ""): ?>
              <tr class="text-center tr_edit_<?php echo $code_note; ?> tr_edit_<?php echo $class; ?>" style="display:none">
                <td><?php echo $row['code_cours']; ?></td>
                <td class="text-left"><?php echo $row['titre_eng']; ?></td>
                <td><?php echo $row['nbr_credit']; ?></td>
                <td class="td_edit_<?php echo $class; ?>">
                  <?php
                      if ($letter_grade == "T") {
                        $type = 1;
                      }
                      if ($letter_grade != "" && $letter_grade != "T") {
                          $type = 2;
                      }
                  ?>
                      <select class="form-control type_<?php echo $class; ?>"
                        onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" >
                        <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                        <option <?php if ($type == 1){ echo "selected";} ?> value="1" >Transfer</option>
                        <option <?php if ($type == 2){ echo "selected";} ?> value="2" >Enrolled</option>
                      </select>
                  <?php

                   ?>

                </td>
                <td class="td_session_edit_<?php echo $class; ?>">
                      <?php
                      if ($idSession == 0){ ?>
                          <select class="form-control session_<?php echo $class; ?>"
                            onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)" style="display:none">
                            <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                            <?php
                           $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                           $req7=@mysql_query($sql7);
                           while($row7=mysql_fetch_assoc($req7)){
                               $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                               $cs=$row7['idSession'];
                               $cc=$row7['academic_year'];
                           ?>
                             <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                           <?php
                           }
                           ?>
                         </select>
                      <?php }else{ ?>
                        <select class="form-control session_<?php echo $class; ?>"
                          onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','edit',<?php echo $grade; ?>)">
                          <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                          <?php
                          $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                          $req7=@mysql_query($sql7);
                          while($row7=mysql_fetch_assoc($req7)){
                              $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                              $cs=$row7['idSession'];
                              $cc=$row7['academic_year'];
                          ?>
                            <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <?php } ?>
                </td>
                <td class="td_grade_edit_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
                <td>
                  <button type="button" name="button" onclick="hide_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Cancel</button>
                </td>
              </tr>
            <?php endif; ?>

            <!-- ajouter -->
            <tr class="text-center tr_<?php echo $class; ?>">
              <td>Electives <?php echo $_number; ?></td>
              <td class="text-left">
                <?php echo $row['code_cours']." / ".$row['titre_eng']; ?>

              </td>
              <td><?php echo $row['nbr_credit']; ?></td>
              <td class="td_<?php echo $class; ?>">
                <?php
                  if ($letter_grade != null) {
                    if ($letter_grade == "T") {
                      $ttl_tr=$ttl_tr+$row['nbr_credit'];
                      echo "Transfer";
                    }else{
                      echo "Enrolled";
                      $ttl_en=$ttl_en+$row['nbr_credit'];
                    }
                  }else{
                ?>
                    <select class="form-control type_<?php echo $class; ?>"
                      onchange="change_type('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" >
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                      <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                      <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                    </select>
                <?php
                  }
                 ?>

              </td>
              <td class="td_session_elective_<?php echo $class; ?>">
                <?php if ($idSession != null){ ?>
                    <?php if ($idSession == 0){ ?>
                        <?php echo "-"; ?>
                    <?php }else{
                            $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
                            $req7=@mysql_query($sql7);
                            $row7=mysql_fetch_assoc($req7);
                            $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                            echo $ns;
                          } ?>
                <?php }else{ ?>
                    <select class="form-control session_elective_<?php echo $grade; ?>"
                      onchange="change_session('<?php echo $class; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>)" style="display:none">
                      <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                      <?php
                      $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                      $req7=@mysql_query($sql7);
                      while($row7=mysql_fetch_assoc($req7)){
                          $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                          $cs=$row7['idSession'];
                          $cc=$row7['academic_year'];
                      ?>
                        <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <?php } ?>
              </td>
              <td class="td_grade_elective_<?php echo $class; ?>"><?php echo $letter_grade; ?></td>
              <td>
                <?php if ($letter_grade != "" && ($letter_grade == "X" or $letter_grade == "T")): ?>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);" style="margin-bottom: 4px;">edit</button>
                  <button class="btn btn-success btn-sm" type="button" name="button" onclick="function_delete(<?php echo $code_note; ?>,'<?php echo $prefixe; ?>');">delete</button>
                <?php endif; ?>

              </td>
            </tr>
            <?php

            if ($code_cours_elective == "10099012"or $code_cours_elective == "100990") {

              $other_language = $other_language-1;

              //var_dump($other_language);
              if ($other_language == 0) {
                $electives .= ",'$code_cours_elective'";
              }
            }

          }else{  ?>
          <tr class="text-center">
            <td>Electives <?php echo $_number; ?></td>
            <td class="text-left td_title_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
              <select class="form-control elective_grade_<?php echo $_number; ?>_<?php echo $grade; ?>" onchange="change_courses_elect(<?php echo $grade ?>,<?php echo $_number ?>)" >
                <option value="">Choose Elective course</option>
                <?php
                    $sql = "SELECT `code_cours`, `titre_eng`, `nbr_credit`, `type`, `grade`, `tr_partner` FROM `tbl_cours` WHERE
                    `type` in (2,3) and nbr_credit = 1 and code_cours not in ($electives_select) order by titre_eng";
                    $req = mysql_query($sql) or die("SQL ERROR");
                    while($row = mysql_fetch_assoc($req)){
                ?>
                      <option value="<?php echo $row['code_cours']; ?>"><?php echo $row['code_cours']." / ".$row['titre_eng']." - Cr : ".$row['nbr_credit']; ?></option>
                <?php
                    }
                ?>
              </select>
            </td>
            <td>

            </td>
            <td class="td_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">
                  <select class="form-control type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>  select_type_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_type_electi('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none" >
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose Registration Type</option>
                    <option <?php if ($type == 1){ echo "selected";} ?> value="1">Transfer</option>
                    <option <?php if ($type == 2){ echo "selected";} ?> value="2">Enrolled</option>
                  </select>

            </td>
            <td class="td_session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>">

                  <select class="form-control session_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"
                    onchange="change_session_elect('<?php echo $grade; ?>','<?php echo $code_inscription; ?>','<?php echo $prefixe; ?>','add',<?php echo $grade; ?>,<?php echo $_number ?>)" style="display:none">
                    <option value="" <?php if ($type == ""){ echo "selected";} ?>>Choose session</option>
                    <?php
                    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where archive=1  order by ordering DESC ";
                    $req7=@mysql_query($sql7);
                    while($row7=mysql_fetch_assoc($req7)){
                        $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];
                        $cs=$row7['idSession'];
                        $cc=$row7['academic_year'];
                    ?>
                      <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
                    <?php
                    }
                    ?>
                  </select>
            </td>
            <td class="td_grade_elective_<?php echo $_number; ?>_<?php echo $grade; ?>"></td>
            <td>
              <?php if ($letter_grade != ""): ?>
                <button type="button" name="button" onclick="show_edit('<?php echo $class ?>',<?php echo $code_note; ?>);">Edit</button>
              <?php endif; ?>
            </td>
          </tr>

        <?php } ?>


    </table>
  </div>
  <!-- TOTAL  -->
  <div class="col-md-12">
    <table class="table table-bordered">
      <tr class="text-center">
        <td class="text-right" colspan="6">Total Transfer credits</td>
        <td colspan="1">
          <?php echo $ttl_tr." Cr"; ?>
        </td>
      </tr>
      <tr class="text-center">
        <td class="text-right" colspan="6">Total Enrolled credits</td>
        <td colspan="1">
          <?php echo $ttl_en." Cr"; ?>
        </td>
      </tr>
    </table>
  </div>
</div>


<script type="text/javascript">
  // $(document).ready(function() {
  //   $('#example').DataTable();
  // } );



  function change_type(id,code_inscription,prefixe,method,grade){
    var val = $(".type_"+id).val();
    //alert(val);
    if (val == 1) {
      // transfer
      $.ajax({
           url: '/module/registration/ajax/transfer_courses_e.php',
           type: 'POST',
              data:
              {   
                 id : id,//id du catégorie 
                 val : val,
                 code_inscription : code_inscription,
                 prefixe : prefixe,
                 method: method,
                 grade: grade     
              },
              dataType: 'json',
              success: function(reponse) {
               // console.log(reponse);
               // console.log(reponse.status);
               if (reponse.status == 1) {
                 if (method == "add") {
                   $(".type_"+id).addClass('is-valid');
                   $(".type_"+id).hide();
                   $(".td_"+id).html("Transfer");
                   $(".td_session_"+id).html("-");
                   $(".td_grade_"+id).html("T");
                   $(".session_"+id).hide();
                 }
                 if (method == "edit") {
                   $(".type_"+id).addClass('is-valid');
                   $(".td_"+id).html("Transfer");
                   $(".td_session_"+id).html("-");
                   $(".td_grade_"+id).html("T");
                   $(".session_"+id).hide();
                   $(".tr_edit_"+id).hide();
                   $(".tr_"+id).show();
                   $(".session_"+id).val('');
                   //Language
                   $(".td_type_language_"+id).html("Transfer");
                   $(".td_session_language_"+id).html("-");
                   $(".td_grade_language_"+id).html("T");
                   // electives
                   $(".td_type_elective_"+id).html("Transfer");
                   $(".td_session_elective_"+id).html("-");
                   $(".td_grade_elective_"+id).html("T");
                 }

               }else{
                 $(".type_"+id).addClass('is-invalid');
               }
             }
       });
    }else{
      // enrol
      $(".session_"+id).show();
    }
  }

  function change_session(id,code_inscription,prefixe,method,grade){
    var val = $(".session_"+id).val();
    //alert(val);
    // transfer
    $.ajax({
         url: '/module/registration/ajax/register_cours_e.php',
         type: 'POST',
         data:
          {   
             id : id,//id du catégorie 
             val : val,
             code_inscription : code_inscription,
             prefixe : prefixe,
             method: method,
             grade: grade         
          },
          dataType: 'json',
          success: function(reponse) {
           // console.log(reponse);
           // console.log(reponse.status);
           session = reponse.session;
           if (reponse.status == 1) {
             if (method == "add") {
               $(".session_"+id).addClass('is-valid');
               $(".session_"+id).hide();
               $(".td_"+id).html("Enrolled");
               $(".td_session_"+id).html(session);
               $(".td_grade_"+id).html("X");
               $(".session_"+id).hide();
             }
             if (method == "edit") {
               $(".session_"+id).addClass('is-valid');
               $(".td_"+id).html("Enrolled");
               $(".td_session_"+id).html(session);
               $(".td_grade_"+id).html("X");
               $(".tr_edit_"+id).hide();
               $(".tr_"+id).show();
               // language
               $(".td_type_language_"+id).html("Enrolled");
               $(".td_session_language_"+id).html(session);
               $(".td_grade_language_"+id).html("X");
               // electives

               $(".td_type_elective_"+id).html("Enrolled");
               $(".td_session_elective_"+id).html(session);
               $(".td_grade_elective_"+id).html("X");
             }
           }else{
             $(".session_"+id).addClass('is-invalid');
           }
         }
     });

  }


  function change_courses(grade){
    $(".select_type_language_"+grade).show();
  }

  function change_type_select(id,code_inscription,prefixe,method,grade){
    var val = $(".language_grade_"+id).val();
    var val_type = $(".type_language_"+id).val();

    //alert(code_inscription+" / "+prefixe+" / "+val+" / "+id+" / "+method);


    if (val_type == 1) {
      // transfer
      $.ajax({
           url: '/module/registration/ajax/transfer_courses_e.php',
           type: 'POST',
              data:
              {   
                 id : val,//id du catégorie 
                 val : val_type,
                 code_inscription : code_inscription,
                 prefixe : prefixe,
                 method: method,
                 grade: grade      
              },
              dataType: 'json',
              success: function(reponse) {
               // console.log(reponse);
               // console.log(reponse.status);

               if (reponse.status == 1) {


                 if (method == "add") {
                   if (reponse.choose_other == 0) {
                     $(".type_language_"+id).addClass('is-valid');
                     $(".type_language_"+id).hide();
                     $(".td_type_language_"+id).html("Transfer");
                     $(".td_session_language_"+id).html("-");
                     $(".td_grade_language_"+id).html("T");
                     $(".td_title_language_"+id).html(reponse.title);
                   }else{
                     $(".type_language_"+id).val('');
                     alert('Please Choose another Course, this course is registred');
                   }
                 }

                 if (method == "edit") {
                   $(".type_language_"+id).addClass('is-valid');
                   $(".type_language_"+id).hide();
                   $(".td_type_language_"+id).html("Transfer");
                   $(".td_session_language_"+id).html("-");
                   $(".td_grade_language_"+id).html("T");
                   $(".td_title_language_"+id).html(reponse.title);
                   $(".tr_"+id).show();
                   $(".session_"+id).val('');
                   $(".session_language_"+id).val('');
                 }


                // $(".session_language_"+id).hide();
               }else{
                 $(".type_language_"+id).addClass('is-invalid');
               }
             }
       });
    }else{
      // enrol
      $(".session_language_"+id).show();
    }
  }


  function change_session_select(id,code_inscription,prefixe,method,grade){
    var val = $(".language_grade_"+id).val();
    var val_session = $(".session_language_"+id).val();
    //alert(code_inscription+" / "+prefixe+" / "+val_session+" / "+id);
    // transfer
    $.ajax({
         url: '/module/registration/ajax/register_cours_e.php',
         type: 'POST',
            data:
            {   
               id : val,//id du catégorie 
               val : val_session,
               code_inscription : code_inscription,
               prefixe : prefixe,
               method: method,
               grade: grade      
            },
            dataType: 'json',
            success: function(reponse) {
             // console.log(reponse);
             // console.log(reponse.status);
             session = reponse.session;
             if (reponse.status == 1) {

               if (method == "add") {
                 if (reponse.choose_other == 0) {
                   $(".type_language_"+id).addClass('is-valid');
                   $(".type_language_"+id).hide();
                   $(".td_type_language_"+id).html("Enrolled");
                   $(".td_session_language_"+id).html(session);
                   $(".td_grade_language_"+id).html("X");
                   $(".td_title_language_"+id).html(reponse.title);
                 }else{
                   $(".type_language_"+id).val('');
                   $(".session_language_"+id).val('');
                   alert('Please Choose another Course, this course is registred');
                 }
               }
               if (method == "edit") {
                 $(".type_language_"+id).addClass('is-valid');
                 $(".type_language_"+id).hide();
                 $(".td_type_language_"+id).html("Enrolled");
                 $(".td_session_language_"+id).html(session);
                 $(".td_grade_language_"+id).html("X");
                 $(".td_title_language_"+id).html(reponse.title);
                 $(".tr_"+id).show();
                 $(".session_"+id).val('');
               }

              // $(".session_language_"+id).hide();
             }else{
               $(".type_language_"+id).addClass('is-invalid');
             }
           }
     });
  }


  function change_courses_elect(grade,number){
    $(".select_type_elective_"+number+"_"+grade).show();
  }


  function change_type_electi(id,code_inscription,prefixe,method,grade,number){
    var val = $(".elective_grade_"+number+'_'+id).val();
    var val_type = $(".type_elective_"+number+'_'+id).val();

    console.log(val_type);


    if (val_type == 1) {
      // transfer
      $.ajax({
           url: '/module/registration/ajax/transfer_courses_e.php',
           type: 'POST',
              data:
              {   
                 id : val,//id du catégorie 
                 val : val_type,
                 code_inscription : code_inscription,
                 prefixe : prefixe,
                 method: method,
                 grade: grade      
              },
              dataType: 'json',
              success: function(reponse) {
               console.log(reponse);
               console.log(reponse.status);
               if (reponse.status == 1) {
                 if (reponse.choose_other == 0) {
                   $(".type_elective_"+number+'_'+id).addClass('is-valid');
                   $(".type_elective_"+number+'_'+id).hide();
                   $(".td_type_elective_"+number+'_'+id).html("Transfer");
                   $(".td_session_elective_"+number+'_'+id).html("-");
                   $(".td_grade_elective_"+number+'_'+id).html("T");
                   $(".td_title_elective_"+number+'_'+id).html(reponse.title);
                  // $(".session_elective_"+number+'_'+id).hide();
                }else{
                  $(".type_elective_"+number+'_'+id).val('');
                  alert('Please Choose another Course, this course is registred');
                }
               }else{
                 $(".type_elective_"+number+'_'+id).addClass('is-invalid');
               }
             }
       });
    }else{
      // enrol
      $(".session_elective_"+number+'_'+id).show();
    }
  }


  function change_session_elect(id,code_inscription,prefixe,method,grade,number){
    var val = $(".elective_grade_"+number+'_'+id).val();
    var val_session = $(".session_elective_"+number+'_'+id).val();
    //alert(code_inscription+" / "+prefixe+" / "+val_session+" / "+id);
    // transfer
    $.ajax({
           url: '/module/registration/ajax/register_cours_e.php',
           type: 'POST',
            data:
            {   
               id : val,//id du catégorie 
               val : val_session,
               code_inscription : code_inscription,
               prefixe : prefixe,
               method: method,
               grade: grade          
            },
            dataType: 'json',
            success: function(reponse) {
             // console.log(reponse);
             // console.log(reponse.status);
             session = reponse.session;
             if (reponse.status == 1) {
               if (reponse.choose_other == 0) {
                 $(".type_elective_"+number+'_'+id).addClass('is-valid');
                 $(".type_elective_"+number+'_'+id).hide();
                 $(".td_type_elective_"+number+'_'+id).html("Enrolled");
                 $(".td_session_elective_"+number+'_'+id).html(session);
                 $(".td_grade_elective_"+number+'_'+id).html("X");
                 $(".td_title_elective_"+number+'_'+id).html(reponse.title);
                // $(".session_elective_"+number+'_'+id).hide();
              }else{
                $(".type_elective_"+number+'_'+id).val('');
                $(".session_elective_"+number+'_'+id).val('');
                alert('Please Choose another Course, this course is registred');
              }
             }else{
               $(".type_elective_"+number+'_'+id).addClass('is-invalid');
             }
           }
       });
  }


  // delete

  function function_delete(code_note,prefixe){
    //alert(code_note+prefixe);

    $.ajax({
           url: '/module/registration/ajax/delete_cours.php',
           type: 'POST',
            data:
            {   
               id : code_note,
               prefixe : prefixe
            },
            dataType: 'json',
            success: function(reponse) {
             console.log(reponse);
             console.log(reponse.status);
             session = reponse.session;
             if (reponse.status == 1) {
               window.location.reload();
             }else{
               alert("Reload the page than try again");
             }
           }
       });
  }

  function show_edit(id,code_note){
    $(".tr_edit_"+code_note).show();
    $(".tr_"+id).hide();
  }

  function hide_edit(id,code_note){
    $(".tr_edit_"+code_note).hide();
    $(".tr_"+id).show();
  }



</script>
