<style type="text/css">
  .valider{
    width: 100%;
    background-color: #c16862;
    border-color: #fff;
    color: #fff;
  }
</style>
<?php
    $user_ids = array(2,51,54);
    $user_id = $_SESSION['admin_id_user'];
		$niveau=$filiere=$annee=$where=$code=$search=$sgroupe=$annee_inscription=$elearning=$search_student=$school='';
		$groupeFilter=" ";



	     if((isset($_POST['tous'])) && (!empty($_POST['tous']))){
	    	$niveau=$filiere=$annee=$where=$code=$search=$annee_inscription=$sgroupe='';
			unset($_SESSION['niveau']);
			unset($_SESSION['filiere']);
			unset($_SESSION['annee_etude']);
			unset($_SESSION['annee_inscription']);
			unset($_SESSION['search_student']);
			unset($_SESSION['elearning']);
			unset($_SESSION['school']);
	   																}



	   else{

	     //nom ou prenom comme crit&eacute;re

					 if((isset($_POST['search_student'])) && (!empty($_POST['search_student'])) ){
						$search_student = $_SESSION['search_student'] = addslashes(trim($_POST['search_student']));
						$groupeFilter="";
						$where = $where." and e.nom like '%".$search_student."%' or e.prenom like '%".$search_student."%'";
																				  }
					  else if( (isset($_POST['search_student'])) && (empty($_POST['search_student'])) ){
  	                            unset($_SESSION['search_student']);
 						                                                          }

						else if( (isset($_SESSION['search_student']))&& (!empty($_SESSION['search_student'])) ){
								 $groupeFilter="";
								 $search_student=$_SESSION['search_student'];
								 $where = $where." and e.nom like '%".$search_student."%' or e.prenom like '%".$search_student."%'";							                                                                  }

				              //groupe comme crit&eacute;re

					 if((isset($_POST['groupe'])) && (!empty($_POST['groupe'])) ){
						$sgroupe = $_SESSION['sgroupe'] = $_POST['groupe'];
						$groupeFilter="";
						$where = $where." and e.groupe=".$sgroupe;
																				  }
					  else if( (isset($_POST['groupe'])) && (empty($_POST['groupe'])) ){
  	                            unset($_SESSION['sgroupe']);
 						                                                          }

						else if( (isset($_SESSION['sgroupe']))&& (!empty($_SESSION['sgroupe'])) ){
								 $groupeFilter="";
								 $sgroupe=$_SESSION['sgroupe'];
								 $where = $where." and e.groupe=".$sgroupe;									                                                                  }
									//fili&eacute;re comme critere



						if( (isset($_POST['filiere'])) && (!empty($_POST['filiere'])) ){
							$filiere = $_SESSION['filiere'] = $_POST['filiere'];
							$where = $where." and e.filiere='". $filiere."'";
																					   }
							else if((isset($_POST['filiere'])) && (empty($_POST['filiere']))){
  	                          unset($_SESSION['filiere']);
 						                                                                       }
					            else if( (isset($_SESSION['filiere'])) && (!empty($_SESSION['filiere'])) ){
								 $filiere=$_SESSION['filiere'];
  	                          	 $where = $where." and e.filiere='". $filiere."'";
						                                                                                  }
									//ann&eacute;e d'&eacute;tude  comme crit&egrave;re

							 if( (isset($_POST['annee_etude'])) && (!empty($_POST['annee_etude'])) ){
								$annee = $_SESSION['annee_etude'] = $_POST['annee_etude'];
								$where =$where." and  e.annee = '".$annee."'";
																									}

									else if( (isset($_POST['annee_etude'])) && (empty($_POST['annee_etude'])) ){
  	                                                  unset($_SESSION['annee_etude']);
						                                                                            }

								else if( (isset($_SESSION['annee_etude'])) && (!empty($_SESSION['annee_etude'])) ){
								   $annee=$_SESSION['annee_etude'];
  	                               $where = $where." and  e.annee = '".$annee."'";
						                                                                            }

                       	//ann&eacute;e d'inscription  comme crit&eacute;re

							 if( (isset($_POST['annee_inscription'])) && (!empty($_POST['annee_inscription'])) ){
								$annee_inscription = $_SESSION['annee_inscription'] = $_POST['annee_inscription'];
								$where =$where." and  e.annee_inscription = '".$annee_inscription."'";
																												}

									else if( (isset($_POST['annee_inscription'])) && (empty($_POST['annee_inscription'])) ){
  	                                                  unset($_SESSION['annee_inscription']);
						                                                                           						   }

								else if( (isset($_SESSION['annee_inscription'])) && (!empty($_SESSION['annee_inscription'])) ){
								   $annee_inscription = $_SESSION['annee_inscription'];
  	                               $where = $where." and  e.annee_inscription = '".$annee_inscription."'";
						                                                                            						  }

								  //Elearning  comme crit&eacute;re

							 if( (isset($_POST['elearning'])) && ($_POST['elearning']!='') ){
								$elearning = $_SESSION['elearning'] = $_POST['elearning'];
								$where =$where." and  e.elearning = '".$elearning."'";
																												}

									else if( (isset($_POST['elearning'])) && ($_POST['elearning']=='') ){
  	                                                  unset($_SESSION['elearning']);
						                                                                           						   }

								else if( (isset($_SESSION['elearning'])) && ($_SESSION['elearning']!='') ){
								   $elearning = $_SESSION['elearning'];
  	                               $where = $where." and  e.elearning = '".$elearning."'";
						                                                                            						  }

							//school  comme crit&eacute;re

							 if( (isset($_POST['school'])) && ($_POST['school']!='') ){
								$school = $_SESSION['school'] = $_POST['school'];
								if ($school== 'piimt'){$where =$where." and  e.piimt = 1";}
								elseif($school== 'aul'){$where =$where." and  e.aul = 1";}
								elseif($school== 'umt'){$where =$where." and  e.umt = 1";}

																												}

									else if( (isset($_POST['school'])) && ($_POST['school']=='') ){
  	                                                  unset($_SESSION['school']);
						                                                                           						   }

								else if( (isset($_SESSION['school'])) && ($_SESSION['school']!='') ){
								   $school = $_SESSION['school'];
  	                               if ($school== 'piimt'){$where =$where." and  e.piimt = 1";}
								   elseif($school== 'aul'){$where =$where." and  e.aul = 1";}
								   elseif($school== 'umt'){$where =$where." and  e.umt = 1";}


						                                                                            						  }



	      }
	/* $sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name,
	 		 e.tel, f.nom_filiere, e.date_inscription, g.title, e.annee,e.acces,e.ville
			 FROM $tbl_etudiant_rabat as e, $tbl_filiere as f, $tbl_groupe as g
			 where e.filiere=f.id_filiere and e.groupe=g.id and groupe != 99 AND e.archive = 0"
			 . $where. $groupeFilter. " GROUP BY e.code_inscription ORDER BY name ";*/
$sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name,
	 		 e.tel,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.finance,e.files,e.onsite
			 FROM tbl_etudiant_rabat as e
			 where  e.archive != 10"
			 . $where. $groupeFilter. " GROUP BY e.code_inscription ORDER BY e.code_inscription ";

?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td class="titre">&nbsp;&nbsp;Listing Students </td>
	<td width="150">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>

		 <td valign="top" align="center">
		   <a href="gestion_des_etudiants_rabat.php?new=oui">
		  <div class="ajouter"></div>
		  New</a>
		  </td>
		  <td valign="top" align="center">
		  <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants_gen.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }"> <div class="modifier"></div>
		  Edit</a>
		  </td>
		   <td valign="top" align="center">
		   <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants_gen.php?detail='+chemin;

				     window.location.replace(chemin);

				   }

				   " ><div class="detail"></div>
		   Information</a>
   		  </td>

		   <?php $id_user = $_SESSION['admin_id_user'] ;
		  if($id_user != '23' ){?>
		  <td valign="top" align="center">
		   <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='transcript.php?code_inscription='+chemin+'&prefixe=RB';

				     window.location.replace(chemin);

				   }

				   "><div class="buletin"></div>Transcript </a>
		  </td>

		 <?php } ?>
		  <td valign="top" align="center" >
		  <a href="gestion_des_etudiants_rabat.php?laureat" title="laureat">
		  <div class="detail"></div><?php echo 'Alumni'; ?></a>
		  </td>
           <td valign="top" align="center">
		   <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionnez un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants_rabat.php?supprimer='+chemin;

				     window.location.replace(chemin);

				   }

				   "><div class="delete"></div>
		   Delete
		   </a>
		  </td>

 		  <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="Imprimer">
		  <div class="imprimer"></div>
		  Print
		  </a>
		  </td>
		</tr>
	  </table>

	</td>

  </tr>

</table>

 <table width="100%" cellspacing="1" border="0"  class="adminlist" >
 <form action="#" method="post" name="adminMenu" >

<input type="hidden" name="boxchecked" value="0" />

<div class="container_search">






   		   <input type="text" class="input" name="search_student" style="width:125px" value="<?php echo $search_student?>"  />
		   <input type="submit" vname="valider" value="Submit" class="input"  />
		   <input type="submit" value="All" name="tous" class="input"  />
  </div>

  <tr align="center">
		 <th width="43">#</th>
		 <th width="43">&nbsp;</th>
		 <th width="43"><?php echo 'Code'; ?></th>
		 <th width="272"><?php echo 'Name'; ?></th>
		 		<!-- <th width="272"><?php echo 'Section'; ?></th>-->
		  <th width="272"><?php echo 'Registration Date'; ?></th>
		  <th width="272"><?php echo 'Accreditation Students'; ?></th>
		   <th width="125"><?php echo 'Complete File'; ?></th>
		  <th width="125"><?php echo 'Onsite File'; ?></th>
		  <!-- <th width="125"><?php echo 'Finance'; ?></th>-->
      <?php if (in_array($user_id,$user_ids)): ?>
        <th width="125"><?php echo 'Registration'; ?></th>
      <?php endif; ?>



   </tr>


	  <?php
		 $i=0;
		 $total = @mysql_query($sql) or die("erreur lors de s&eacute;lection des &eacute;tudiants");
		 $url = $_SERVER['PHP_SELF']."?limit=";
		 $nblignes = mysql_num_rows($total);
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);
		 while ($ligne = mysql_fetch_array($result)) {
		 $i++;
		 $ci=$ligne["code_inscription"];
		 $prefixe=$ligne["prefixe"];
		   ?>

	   <tr height="17px"  class="<?php echo $ci; ?>" prefixe="<?php echo $prefixe; ?>" height="17px">
	 <td align="center">&nbsp;<?=$i?>
		 <td align="center">
		 <input type="radio" id="<?=$ci?>" name="id" value="<?=$ci?>"
		 onClick="document.adminMenu.boxchecked.value='<?php echo $ci.'&prefixe='.$prefixe;?>'" /></td>
		 <td class="gras">&nbsp;<?=$prefixe.$ci?></td>
		 <td>&nbsp;<?=ucfirst(stripslashes($ligne["name"]))?></td>
		 <!-- <td>&nbsp;<?php if($ligne['groupe']== '2')
		  { echo 'FH';}
		  else  if($ligne['groupe']== '3')
		  { echo 'FE';} else { echo' ';}?></td>-->
		 <td>&nbsp;<?php
		$date=$ligne["date_inscription"];
		$tab=split('[/.-]',$date);
		echo $tab[1].'-'.$tab[2].'-'.$tab[0];

		?>

	</td>
		<td class="td_edit" style="text-align: center;" id="" value="finance">
      <?php
 		$sqlZin="select code_inscription,prefixe from tbl_etudiant_all where code_inscription='$ci' and prefixe='$prefixe' ";
		$a1= @mysql_query($sqlZin) or die ('Failure to select branches');
  		$row = mysql_fetch_assoc($a1);
		 $code = $row['code_inscription'];
		 $pre=$row['prefixe'];

      if ($code == $ci and $pre == $prefixe)
      	{ ?>
        <img src="../images/yes.png" border="0" width="18" height="18">
      <?php } else { ?>

        <img src="../images/non.ico" border="0" width="18" height="18">

      <?php } ?>
    </td>
	<td class="finance_input_<?php echo $ci; ?>" style="display:none;">
		<input type="radio" name="finance"  value="1" <?php if ($code == $ci and $pre == $prefixe ){echo "checked";} ?>></input> Yes <br>
		<input type="radio" name="finance"  value="0" <?php if ($code != $ci and $pre != $prefixe ){echo "checked";} ?>></input> No <br>

 		<button class="valider" type="button" value="finance" >Confirm</button>
    </td>
     <td class="td_edit" style="text-align: center;" id="" value="files">
          <?php
          if ($ligne["files"] == 0)
          { ?>
            <img src="../images/non.ico" border="0" width="18" height="18">
            <?php } else if ($ligne["files"] == 1) { ?>

              <img src="../images/yes.png" border="0" width="18" height="18">

              <?php }  ?>
              </td>
              <td class="files_input_<?php echo $ci; ?>" style="display:none;">
              <input type="radio" name="files"  value="1" <?php if ($ligne["files"]  == 1) {echo "checked";} ?>></input> Yes <br>
              <input type="radio" name="files"  value="0" <?php if ($ligne["files"]  == 0) {echo "checked";} ?>></input> No <br>
              <button class="valider" type="button" value="files" >Confirm</button>
              </td>



               <td class="td_edit" style="text-align: center;" id="" value="onsite">
          <?php
          if ($ligne["onsite"] == 0)
          { ?>
            <img src="../images/non.ico" border="0" width="18" height="18">
            <?php } else if ($ligne["onsite"] == 1) { ?>

              <img src="../images/yes.png" border="0" width="18" height="18">

              <?php }  ?>
              </td>
              <td class="onsite_input_<?php echo $ci; ?>" style="display:none;">
              <input type="radio" name="onsite"  value="1" <?php if ($ligne["onsite"]  == 1) {echo "checked";} ?>></input> Yes <br>
              <input type="radio" name="onsite"  value="0" <?php if ($ligne["onsite"]  == 0) {echo "checked";} ?>></input> No <br>
              <button class="valider" type="button" value="onsite" >Confirm</button>
              </td>
              <?php if (in_array($user_id,$user_ids)): ?>
                <td style="text-align:center">
                    <a target="_blank" href="/administrator/registration.php?inscription=<?php echo $ci ?>&prefixe=<?php echo $prefixe; ?>">Courses</a>
                </td>
              <?php endif; ?>
	</tr>
		 <?php
		  }
		 ?>

   </form>

</table>
  <div id='pagination' align='center'>
         <?php echo pagination($url,$parpage,$nblignes,$nbpages);
		 ?>
  </div>
<script type="text/javascript">

  jQuery('body').keyup(function(event){
    if ( event.which == 27 ) {
      var ancien_id = jQuery("#open").parent().attr('class');
      var type = jQuery("#open").attr('value');
      jQuery("."+type+"_input_"+ancien_id).hide();
      jQuery("#open").slideDown();
      jQuery("#open").attr('id','');
      jQuery("#open_input").hide();
      jQuery("#open_input").attr('id','');

    }
    if (event.which == 13) {
      alert("don't use enter to update, please click on 'Confirm' to confirm thank you.");
    }
  });

  jQuery(".td_edit").click(function(){
    var type =  jQuery(this).attr('value');
    var id = jQuery(this).parent().attr('class');
    var ancien_id = jQuery("#open").parent().attr('class');
    jQuery("."+type+"_input_"+ancien_id).hide();
    jQuery("#open").slideDown();
    jQuery("#open").attr('id','');
    jQuery("#open_input").hide();
    jQuery("#open_input").attr('id','');
    jQuery(this).hide();
    var selector = "."+type+"_input_"+id;
    jQuery(selector).slideDown();
    jQuery(selector).attr('id','open_input');
    jQuery(this).attr('id','open');
  });

  jQuery(".valider").click(function(){
      var type =  jQuery(this).attr('value');
      var id = jQuery(this).parent().parent().attr('class');
      var value = jQuery("#open_input>input:checked").val();

      var ancien_value = jQuery("#open_input").attr('valueancien');
      var prefixe = jQuery(this).parent().parent().attr('prefixe');
      if (ancien_value != value) {
          jQuery.ajax({
              dataType: "html",
              evalscripts:true,
              type: "POST",
              url: 'gestion_des_etudiants_rabat.php?ajaxmod',
              data: ({type:type,id:id,value:value,prefixe:prefixe}),
              beforeSend: function(){

              },
              success: function (data, textStatus){
                  jQuery('#open').html(value);
                  var ancien_id = jQuery("#open").parent().attr('class');
                  var type = jQuery("#open").attr('value');
                  jQuery("."+type+"_input_"+ancien_id).hide();

                    if (value == 1) {
                      jQuery('#open').html('<img src="../images/yes.png" border="0" width="18" height="18">');
                    }
                    if (value == 0) {
                      jQuery('#open').html('<img src="../images/non.ico" border="0" width="18" height="18">');
                    }


                  jQuery("#open").slideDown();
                  jQuery("#open").attr('id','');
                  jQuery("#open_input").hide();
                  jQuery("#open_input").attr('id','');

              }
          });
        }else{
          var ancien_id = jQuery("#open").parent().attr('class');
          var type = jQuery("#open").attr('value');
          jQuery("."+type+"_input_"+ancien_id).hide();
          jQuery("#open").slideDown();
          jQuery("#open").attr('id','');
          jQuery("#open_input").hide();
          jQuery("#open_input").attr('id','');
        }

  });


</script>
