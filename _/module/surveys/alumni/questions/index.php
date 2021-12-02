<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Alumni Surveys ['Questions']
	 &nbsp;&nbsp;<span class="task"></span>
 	</td>
	<td width="22%">&nbsp;</td>
  </tr>
</table>
<?php if (isset($_SESSION['message_success']) && $_SESSION['message_success'] !=  ""): ?>
          <div class="alert  btn-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4><?php echo $_SESSION['message_success']; ?></h4>
          </div>
          <script type="text/javascript">
              jQuery('.close').click(function(){
                  jQuery('.alert').fadeOut();
              });
          </script>
<?php endif ?>
<?php if (isset($_SESSION['message_error'] ) && $_SESSION['message_error'] != "" ): ?>
	<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4><?php echo $_SESSION['message_error']; ?></h4>
	</div>
<?php endif ?>
<?php if (isset($_SESSION['message_deja'] ) && $_SESSION['message_deja'] != "" ): ?>
  <div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4><?php echo $_SESSION['message_deja']; ?></h4>
  </div>
<?php endif ?>
<div style="float:right;">
  <a href="Surveys.php?admin_alumni_add" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">New Question</a>
  <a href="Surveys.php?list_affectation" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Dispatching</a>
  <a href="Surveys.php" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs"> Surveys </a>
  <a href="Surveys.php?response_list" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Answers</a>
</div>
<div class="search_ajax">
  <table width="100%" align="center" cellspacing="1"  class="adminlist" >

   <thead>
    <tr >
      <th>ID</th>
      <th align="left">Question</th>
    	<th align="center" >Status</th>
     <!-- <th align="center">type</th>-->
    	<th align="center" >Action </th>
    </tr>
    </thead>
    <tbody >
  	<?php
          // pagination
          $sql = "SELECT COUNT('id') as 'nb' FROM `questions_alumni`";
          $req1 = mysql_query($sql) or die("error");
          $data = mysql_fetch_assoc($req1);

          $nb = $data['nb'];
          $perpage = 20;
          $nbpage = ceil($nb/$perpage);
          $pre = 0;
          $sui = 0;
          if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbpage) {
            $pre = $_GET['page']-1;
            if ($_GET['page'] < $nbpage ) {
              $sui = $_GET['page']+1;
            }

            $cpage = $_GET['page'];
          }else{
            if ($nbpage >1) {
              $sui = 2;
            }
            $cpage = 1;
          }



          // end pagination



          $req = "SELECT * FROM `questions_alumni` WHERE  1 = 1 LIMIT ".(($cpage-1)*$perpage).",".$perpage;
          @mysql_query($req) or die("erreur de la selection des qustions ");
          $query = mysql_query($req);
          while ($row=mysql_fetch_assoc($query)){
          ?>
            <td style="text-align: center;"><?php echo $row['id']; ?></td>
            <td style="text-align: left;padding: 5px;"><?php echo $row['question']; ?> </td>
            <td style="text-align: center;">
                <?php if ($row['statut'] == 0): ?>
                    <?php echo "active"; ?>
                <?php endif ?>
                <?php if ($row['statut'] == 1): ?>
                    <?php echo "désactiver"; ?>
                <?php endif ?>
            </td>
           <!-- <td>
              <?php if ($row['id_question'] == 0): ?>
                  <?php echo "parent"; ?>
              <?php endif ?>
              <?php if ($row['id_question'] == -1): ?>
                  <?php echo "simple"; ?>
              <?php endif ?>
              <?php if ($row['id_question'] != 0 && $row['id_question'] != -1): ?>
                  <?php
                    echo "ID de la question Parent ".$row['id_question'];
                  ?>
              <?php endif ?>
            </td>-->
            <td style="text-align: center;">
            		<a href="Surveys.php?admin_alumni_modifier&id=<?php echo $row['id'] ?>"  style="color: #fff;" class="btn btn-success btn-xs">Edit</a>
            		-
                <?php if ($row['statut'] == 0): ?>
                  <a href="Surveys.php?desactiver_question&id=<?php echo $row['id'] ?> " onclick="if(window.confirm('Voulez-vous vraiment désactiver cette question ?')){return true;}else{return false;}" style="color: #fff;" class="btn btn-danger btn-xs">Disable</a>
                <?php endif ?>
                <?php if ($row['statut'] == 1): ?>
                  <a href="Surveys.php?activer_question&id=<?php echo $row['id'] ?> " onclick="if(window.confirm('Voulez-vous vraiment activer cette question ?')){return true;}else{return false;}" style="color: #fff;" class="btn btn-success btn-xs">Activer</a>
                <?php endif ?>

  	      </td>
          </tr>

      <?php } ?>

   </tbody>
  </table>
  <?php if ($nbpage != 1): ?>
    <div id="pagination" align="center">
      <?php
          if ($pre == 0) {
              //echo "precedent /";
          }else{
            echo "<a class='pagination' href='Surveys.php?admin_alumni&page=".$pre."'><span class='previews'>&lt;&lt;</span></a>";
          }

          for ($i=1; $i <= $nbpage ; $i++) {

              // if ($i==$cpage) {
              //     echo $i." /";
              //     $pre = $i -1;
              // }else{
                  echo "<a href='Surveys.php?admin_alumni&page=".$i."'><span class='page'>".$i."</span></a>";
              // }
          }
          if ($sui == 0) {
              //echo "suivant";
          }else{
            echo "<a class='pagination' href='Surveys.php?admin_alumni&page=".$sui."'><span class='previews'>&gt;&gt;</span></a> ";
          }


       ?>
     </div>
  <?php endif ?>
</div>
<script type="text/javascript">
 	jQuery(".close").click(function(){
 		jQuery('.close').parent().hide();
 	});
 	jQuery("#tous").click(function(){
 		jQuery("#programme").val('');
		jQuery("#nom").val('');
 		jQuery("#prenom").val('');
 		jQuery('#session').val('');
 		jQuery('#annee').val('');
    jQuery('#specialite').val('');
 		var tous = jQuery("#tous").val();
 		jQuery.post(
 			"../module/these/search_ajax.php",
 			{tous : tous},
 			function(data){
 				jQuery(".search_ajax").html(data);
 			});
 	});
 	function get(){
 		var nom = jQuery("#nom").val();
 		var prenom = jQuery("#prenom").val();
 		var session = jQuery('#session').val();
 		var annee = jQuery('#annee').val();
 		var programme = jQuery("#programme").val();
    var specialite = jQuery("#specialite").val();
    //alert(specialite);
 		jQuery.post(
 			"../module/these/search_ajax.php",
 			{nom : nom, prenom : prenom,session : session,annee : annee,programme : programme,specialite : specialite},
 			function(data){
 				jQuery(".search_ajax").html(data);
 			});
 	}
</script>


<?php
 	$_SESSION['message_error'] = "";
 	$_SESSION['message'] = "";
  $_SESSION['message_success'] = "";
?>

<?php
  $_SESSION['programme'] = '';
  $_SESSION['session'] = '';
  $_SESSION['annee'] = '';
  $_SESSION['titre'] = '';
  $_SESSION['code_inscription'] = '';
  $_SESSION['message_file1'] = '';
  $_SESSION['message_file2'] = '';
  $_SESSION['message_file3'] = '';
  $_SESSION['message_file'] = '';
  $_SESSION['message_programme'] = '';
  $_SESSION['message_titre'] = '';
  $_SESSION['message_session'] = '';
  $_SESSION['message_annee'] = '';
  $_SESSION['message_success'] = '';
  $_SESSION['message_etudiant'] = '';
  $_SESSION['specialite'] = "";
?>
