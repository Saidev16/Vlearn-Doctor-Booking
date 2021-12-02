<?php
// include("../../administrator/secure.php");

$bd="hisadm_hisdb";



$login="hisadm_hisusr";



$mdp="hispass11";



$serveur='127.0.0.1';



function connecter($serveur,$login,$mdp,$bd)

{

$connect = @mysql_connect($serveur,$login,$mdp);
mysql_query("SET NAMES 'utf8'", $connect);

if ( ! $connect )

die ('Failed to connect server vnc');

@mysql_select_db($bd, $connect) or die ('Database Select Failed');


}

connecter($serveur,$login,$mdp,$bd);

$code_inscription = $_GET['code_inscription'];
$prefixe = $_GET['prefixe'];
$email = $_SESSION['admin_email'];
if($prefixe=='MOR')
  { $officialCode='Morocco' ;}
   else  if($prefixe=='AG')
   {    $officialCode='Algeria';    }
   else if($prefixe=='ORL')
   {    $officialCode='USA';   }
    else if($prefixe=='BN')
         {    $officialCode='Benin';   }
      else  if($prefixe=='BF')
         {    $officialCode='Burkina';       }
         else if ($prefixe=='CAM')
         {    $officialCode='Cameroun';      }
         else if ($prefixe=='CB')
         {    $officialCode='Casa';      }
         else if ($prefixe=='RB')
         {    $officialCode='Rabat';      }


$table = array(
  'CAM' => 'tbl_etudiant_cameroun',
  'ORL' => 'tbl_etudiant_usa',
  'BN' => 'tbl_etudiant_benin',
  'GS' => 'tbl_etudiant_GUES',
  'MOR' => 'tbl_etudiant_morocco',
  'AG' => 'tbl_etudiant_algeria',
  'BF' => 'tbl_etudiant_burkina',
  'CB' => 'tbl_etudiant_casa',
  'RB' => 'tbl_etudiant_rabat',
  'IC' => 'tbl_etudiant_ivory'
);

$url = array(
  'CAM' => '/administrator/gestion_des_etudiants_cameroun.php',
  'ORL' => '/administrator/gestion_des_etudiants_usa.php',
  'BN' => '/administrator/gestion_des_etudiants_benin.php',
  'GS' => '/administrator/gestion_des_etudiants_gues.php',
  'MOR' => '/administrator/gestion_morocco.php?Itemid=60',
  'AG' => '/administrator/gestion_des_etudiants_algeria.php',
  'BF' => '/administrator/gestion_des_etudiants_burkina.php?Itemid=46',
  'IC' => '/administrator/gestion_des_etudiants_ivory.php',
  'RB' => '/administrator/gestion_des_etudiants_rabat.php',
  'CB' => '/administrator/gestion_des_etudiants_casa.php',
  'gen' => '/administrator/gestion_des_etudiants_gen.php'
);

$gen = 0;
if (isset($_GET['gen'])) {
  $gen = $_GET['gen'];
}
 // var_dump($gen);
if ($gen == 0) {
  $link = $url["$prefixe"];
}else{
  $link = $url['gen'];
}
// var_dump($link);
$sql_table = $table["$prefixe"];

$sql = "SELECT * FROM `$sql_table` WHERE `prefixe` = '$prefixe' and `code_inscription` = $code_inscription limit 1";
//var_dump($sql);
$req = mysql_query($sql) or die("SQL ERROR");
$row = mysql_fetch_assoc($req);
$user_name = strtolower($row['prenom'].$code_inscription);
$user_name = preg_replace('/[^A-Za-z0-9\-]/', '', $user_name);

$agent = $_SESSION['admin_nom']." ".$_SESSION['admin_prenom'];
/*
  2 => FR
  3 => ENG
*/
$section  = $row['groupe'];
$data =
  array(
    "prenom" => $row['prenom'],
    "nom" => $row['nom'],
    "email" =>  $email,
    "code_inscription" => $code_inscription,
    "prefixe" => $prefixe,
     "officialCode" => $officialCode
  );
  //var_dump($data);
  $data_json_edit = json_encode($data);

  $data =
    array(
      "lastname" => $row['prenom'],
      "firstname" => $row['nom'],
      "officialCode" =>  $officialCode,
      "officialEmail" => "",
      "username" => $user_name,
      "password" => "",
      "password_conf" => "",
      "isCourseCreator" => 0,
      "language" => NULL,
      "email" =>  $email,
      "phone" => "",
      "picture" => "",
      "code_inscription" => $code_inscription,
      "prefixe" => $prefixe,
      "section" => $section,
      "agent" => $agent
    );
    //var_dump($data);
    $data_json_add = json_encode($data);

  //die();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a href="<?php echo $link; ?>" type="button" class="btn btn-success">Return</a>
      <a class="navbar-brand" href="#">
        HIS
        <img src="ASL.png" width="30"  class="d-inline-block align-top" alt="" loading="lazy">

      </a>
    </nav>
    <div class="container">
      <div class="row section_update" style="margin:80px;display:none;">
        <div class="col-md-12">
          <p class="lead">
             Update testing access to student <strong><?php echo $row['nom']." ".$row['prenom']; ?>...</strong>
          </p>
        </div>
        <div class="col-md-12 ">

          <div class="spinner-border text-success loader_display" role="status" style="display:none;">
            <span class="sr-only">Loading...</span>
          </div>
          <button type="button" class="btn btn-sm btn-primary " style="float:right" onclick="editUser('info')">Edit informations</button>
          <button type="button" class="btn btn-sm btn-primary  mr-2 mb-2" style="float:right" onclick="editUser('password')">Edit Password</button>
          <a href="<?php echo $link; ?>" type="button" class="btn btn-sm btn-success return mr-2" style="float:right;margin-bottom: 10px;display:none" >Return to students</a>
        </div>
        <div class="col-md-12">
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated progress_act" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
          </div>

          <div class="alert alert-success" role="alert" style="margin-top:5px">
            Student updated successfully in HIS.
          </div>
          <!-- <div class="alert alert-warning" role="alert">
            The creation of access to testing.
          </div> -->
          <div class="alert alert-success success" role="alert" style="display:none">
            Student access testing updated successfully.
          </div>
          <div class="alert alert-danger danger" role="alert" style="display:none">
            Error in register student Please contact administration.
          </div>
            <dl class="row change_password" style="display:none;">
              <dt class="col-sm-4">Login</dt>
              <dd class="col-sm-8 login">Wait...</dd>
              <dt class="col-sm-4 ">Password</dt>
              <dd class="col-sm-8 password">Wait...</dd>
            </dl>
        </div>
      </div>
      <div class="row section_create" style="margin:80px;display:none">
        <div class="col-md-12 ">
            <p class="lead">
               Create a new testing access to student <strong><?php echo $row['nom']." ".$row['prenom']; ?>...</strong>
            </p>
          </div>
          <div class="col-md-12">

            <div class="spinner-border text-success loader_display" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <button type="button" class="btn btn-sm btn-primary " style="float:right" onclick="addUser()">Create Testing Access</button>
            <a href="<?php echo $link; ?>" type="button" class="btn btn-sm btn-success return mr-2" style="float:right;margin-bottom: 10px;display:none" >Return to students</a>
          </div>
          <div class="col-md-12">
            <div class="progress">
              <div class="progress-bar progress-bar-striped progress-bar-animated progress_act" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
            </div>

            <div class="alert alert-success" role="alert" style="margin-top:5px">
              Student created successfully in his.
            </div>
            <div class="alert alert-warning" role="alert">
              The creation of access to testing.
            </div>
            <div class="alert alert-success success" role="alert" style="display:none">
              Student access testing created successfully.
            </div>
            <div class="alert alert-danger danger" role="alert" style="display:none">
              Error in register student Please contact administration.
            </div>
              <dl class="row">
                <dt class="col-sm-4">Login</dt>
                <dd class="col-sm-8 login">Wait...</dd>
                <dt class="col-sm-4 ">Password</dt>
                <dd class="col-sm-8 password">Wait...</dd>
              </dl>
          </div>
      </div>
    </div>




  </body>

  <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->



    <script type="text/javascript">
      function editUser(action){
        //console.log("ok");
        var data = <?php echo $data_json_edit; ?>;
        data['action'] = action;
        $('.progress_act').attr("style" , "width: 0%")
        $('.progress_act').attr("aria-valuenow" , "0")
        $('.success').hide();
        $('.change_password').hide();
        $('.loader_display').show();
        $.ajax({
          url: "https://testing.americanhigh.us/claroline/api_testing/editUser.php",
          type: 'POST',
          data: data,
          dataType: 'json',
          success: function(reponse) {
            console.log(reponse);
            success = reponse.success;
            email_sent = reponse.emailSent
            user_name = reponse.user_name
            password = reponse.password
            if (success == 1) {
              $('.success').show();
              $('.return').show();
              $('.danger').hide();
              $('.loader_display').hide();
              if (action == "password") {
                $('.login').html(user_name)
                $('.password').html(password)
                $('.change_password').show();
              }
              $('.progress_act').attr( "style" , "width: 100%" )
              $('.progress_act').attr( "aria-valuenow" , "100" )
            }
            if (success == 0) {
              $('.danger').show();
              $('.loader_display').show();
              $('.success').hide();
              $('.login').html("error")
              $('.password').html("error")
            }
          }
        });
      }


      function fetch_user(){
        $.ajax({
          url: "https://testing.americanhigh.us/claroline/api_testing/search_student.php",
          type: 'POST',
          data: <?php echo $data_json_edit; ?>,
          dataType: 'json',
          success: function(reponse) {
            console.log(reponse);
            success = reponse.success;
            if (success == 1) {
              $('.section_update').show();
            }
            if (success == 0) {
              $('.section_create').show();
            }
          }
        });
      }
      fetch_user();

      function addUser(){
        //console.log("ok");
        $.ajax({
          url: "https://testing.americanhigh.us/claroline/api_testing/addUser.php",
          type: 'POST',
          data: <?php echo $data_json_add; ?>,
          dataType: 'json',
          success: function(reponse) {
            console.log(reponse);
            success = reponse.success;
            email_sent = reponse.emailSent
            user_name = reponse.user_name
            password = reponse.password
            if (success == 1) {
              $('.success').show();
              $('.return').show();
              $('.danger').hide();
              $('.loader_display').hide();
              $('.login').html(user_name)
              $('.password').html(password)
              $('.progress_act').attr( "style" , "width: 100%" )
              $('.progress_act').attr( "aria-valuenow" , "100" )
            }
            if (success == 0) {
              $('.danger').show();
              $('.loader_display').show();
              $('.success').hide();
              $('.login').html("error")
              $('.password').html("error")
            }
          }
        });
      }


    </script>




</html>
